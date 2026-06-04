<?php

namespace App\Livewire;

use App\Models\Menu;
use App\Models\MenuCategory;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class PosCashier extends Component
{
    use WithPagination;

    public ?int $selectedCategoryId = null;
    public array $cart = [];
    public string $orderType = 'dine_in';
    public ?string $tableNumber = null;
    public ?string $customerName = null;
    public string $paymentMethod = 'cash';
    public float|int|string|null $paidAmount = 0;

    public function updatedSelectedCategoryId(): void
    {
        $this->resetPage();
    }

    public function updatedOrderType(): void
    {
        if ($this->orderType === 'takeaway') {
            $this->tableNumber = null;
        }
    }

    public function updatedPaymentMethod(): void
    {
        if ($this->paymentMethod === 'qris') {
            $this->paidAmount = $this->grandTotal();
        }
    }

    public function addToCart(int $menuId): void
    {
        $menu = Menu::query()->where('is_available', true)->findOrFail($menuId);

        if (isset($this->cart[$menuId])) {
            $this->cart[$menuId]['quantity']++;
            return;
        }

        $this->cart[$menuId] = [
            'menu_id' => $menu->id,
            'name' => $menu->name,
            'price' => (float) $menu->price,
            'quantity' => 1,
            'note' => '',
        ];
    }

    public function increment(int $menuId): void
    {
        if (isset($this->cart[$menuId])) {
            $this->cart[$menuId]['quantity']++;
        }
    }

    public function decrement(int $menuId): void
    {
        if (! isset($this->cart[$menuId])) {
            return;
        }

        $this->cart[$menuId]['quantity']--;

        if ($this->cart[$menuId]['quantity'] <= 0) {
            unset($this->cart[$menuId]);
        }
    }

    public function remove(int $menuId): void
    {
        unset($this->cart[$menuId]);
    }

    public function subtotal(): float
    {
        return collect($this->cart)->sum(fn (array $item) => $item['price'] * $item['quantity']);
    }

    public function grandTotal(): float
    {
        return $this->subtotal();
    }

    public function changeAmount(): float
    {
        if ($this->paymentMethod === 'qris') {
            return 0;
        }

        return max(0, (float) $this->paidAmount - $this->grandTotal());
    }

    public function checkout()
    {
        if ($this->paymentMethod === 'qris') {
            $this->paidAmount = $this->grandTotal();
        }

        $this->validate([
            'cart' => ['required', 'array', 'min:1'],
            'orderType' => ['required', Rule::in(['dine_in', 'takeaway'])],
            'tableNumber' => [Rule::requiredIf($this->orderType === 'dine_in'), 'nullable', 'string', 'max:50'],
            'customerName' => ['nullable', 'string', 'max:255'],
            'paymentMethod' => ['required', Rule::in(['cash', 'qris'])],
            'paidAmount' => ['required', 'numeric', 'min:'.$this->grandTotal()],
        ], [], [
            'tableNumber' => 'nomor meja',
            'paidAmount' => 'uang bayar',
        ]);

        $transaction = DB::transaction(function () {
            $transaction = Transaction::query()->create([
                'invoice_number' => $this->generateInvoiceNumber(),
                'cashier_id' => auth()->id(),
                'order_type' => $this->orderType,
                'order_status' => 'pending',
                'table_number' => $this->orderType === 'dine_in' ? $this->tableNumber : null,
                'customer_name' => $this->customerName,
                'subtotal' => $this->subtotal(),
                'grand_total' => $this->grandTotal(),
                'paid_amount' => (float) $this->paidAmount,
                'change_amount' => $this->paymentMethod === 'cash' ? (float) $this->paidAmount - $this->grandTotal() : 0,
                'payment_method' => $this->paymentMethod,
                'transaction_status' => 'paid',
                'transaction_date' => now(),
            ]);

            foreach ($this->cart as $item) {
                $transaction->items()->create([
                    'menu_id' => $item['menu_id'],
                    'menu_name' => $item['name'],
                    'price' => $item['price'],
                    'quantity' => $item['quantity'],
                    'note' => $item['note'] ?: null,
                    'subtotal' => $item['price'] * $item['quantity'],
                ]);
            }

            return $transaction;
        });

        $this->reset(['cart', 'tableNumber', 'customerName', 'paidAmount']);

        return redirect()->route('transactions.show', $transaction);
    }

    public function render()
    {
        $menus = Menu::query()
            ->with('category')
            ->where('is_available', true)
            ->when($this->selectedCategoryId, fn ($query) => $query->where('menu_category_id', $this->selectedCategoryId))
            ->orderBy('name')
            ->paginate(8);

        return view('livewire.pos-cashier', [
            'categories' => MenuCategory::query()->where('is_active', true)->orderBy('name')->get(),
            'menus' => $menus,
        ]);
    }

    private function generateInvoiceNumber(): string
    {
        do {
            $invoice = 'INV-'.now()->format('Ymd-His').'-'.random_int(100, 999);
        } while (Transaction::query()->where('invoice_number', $invoice)->exists());

        return $invoice;
    }
}
