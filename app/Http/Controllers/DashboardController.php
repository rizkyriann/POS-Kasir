<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Support\Carbon;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $today = Carbon::today();
        $baseQuery = Transaction::query()->whereDate('transaction_date', $today);

        if (auth()->user()->role === 'kasir') {
            $baseQuery->where('cashier_id', auth()->id());
        }

        return view('dashboard.index', [
            'todayTransactions' => (clone $baseQuery)->where('transaction_status', 'paid')->count(),
            'todayRevenue' => (clone $baseQuery)->where('transaction_status', 'paid')->sum('grand_total'),
            'pendingOrders' => (clone $baseQuery)->where('order_status', 'pending')->count(),
            'processingOrders' => (clone $baseQuery)->where('order_status', 'processing')->count(),
        ]);
    }
}
