<?php

namespace App\Livewire;

use App\Models\Transaction;
use App\Models\TransactionItem;
use App\Models\User;
use Livewire\Component;

class SalesReport extends Component
{
    public string $startDate = '';
    public string $endDate = '';
    public string $cashierId = '';
    public string $paymentMethod = '';
    public string $orderType = '';
    public string $transactionStatus = 'paid';

    public function mount(): void
    {
        $this->startDate = now()->toDateString();
        $this->endDate = now()->toDateString();
    }

    public function render()
    {
        $query = Transaction::query()
            ->when($this->startDate, fn ($query) => $query->whereDate('transaction_date', '>=', $this->startDate))
            ->when($this->endDate, fn ($query) => $query->whereDate('transaction_date', '<=', $this->endDate))
            ->when($this->cashierId, fn ($query) => $query->where('cashier_id', $this->cashierId))
            ->when($this->paymentMethod, fn ($query) => $query->where('payment_method', $this->paymentMethod))
            ->when($this->orderType, fn ($query) => $query->where('order_type', $this->orderType))
            ->when($this->transactionStatus, fn ($query) => $query->where('transaction_status', $this->transactionStatus));

        $transactionIds = (clone $query)->pluck('id');

        return view('livewire.sales-report', [
            'cashiers' => User::query()->orderBy('name')->get(),
            'totalTransactions' => (clone $query)->count(),
            'totalRevenue' => (clone $query)->where('transaction_status', 'paid')->sum('grand_total'),
            'cashCount' => (clone $query)->where('payment_method', 'cash')->count(),
            'qrisCount' => (clone $query)->where('payment_method', 'qris')->count(),
            'dineInCount' => (clone $query)->where('order_type', 'dine_in')->count(),
            'takeawayCount' => (clone $query)->where('order_type', 'takeaway')->count(),
            'topMenus' => TransactionItem::query()
                ->selectRaw('menu_name, SUM(quantity) as total_quantity, SUM(subtotal) as total_sales')
                ->whereIn('transaction_id', $transactionIds)
                ->groupBy('menu_name')
                ->orderByDesc('total_quantity')
                ->limit(5)
                ->get(),
            'transactions' => (clone $query)->with('cashier')->latest('transaction_date')->limit(20)->get(),
        ]);
    }
}
