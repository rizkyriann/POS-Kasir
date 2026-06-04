<?php

namespace App\Livewire;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class OrderList extends Component
{
    use WithPagination;

    public string $status = '';
    public string $date = '';
    public string $cashierId = '';

    public function updating($property, $value = null): void
    {
        if (in_array($property, ['status', 'date', 'cashierId'], true)) {
            $this->resetPage();
        }
    }

    public function updateStatus(int $transactionId, string $status): void
    {
        validator(['status' => $status], ['status' => ['required', Rule::in(['pending', 'processing', 'completed', 'cancelled'])]])->validate();

        $transaction = Transaction::query()->findOrFail($transactionId);

        if (auth()->user()->role === 'kasir') {
            $allowed = ($transaction->order_status === 'pending' && $status === 'processing')
                || ($transaction->order_status === 'processing' && $status === 'completed');

            abort_unless($allowed, 403);
        }

        $transaction->update(['order_status' => $status]);
    }

    public function render()
    {
        return view('livewire.order-list', [
            'orders' => Transaction::query()
                ->with('cashier')
                ->when($this->status, fn ($query) => $query->where('order_status', $this->status))
                ->when($this->date, fn ($query) => $query->whereDate('transaction_date', $this->date))
                ->when($this->cashierId, fn ($query) => $query->where('cashier_id', $this->cashierId))
                ->latest('transaction_date')
                ->paginate(12),
            'cashiers' => User::query()->whereIn('role', ['owner', 'admin', 'kasir'])->orderBy('name')->get(),
        ]);
    }
}
