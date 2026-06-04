<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\Transaction;
use Illuminate\View\View;

class TransactionController extends Controller
{
    public function index(): View
    {
        $query = Transaction::query()->with('cashier')->latest('transaction_date');

        if (auth()->user()->role === 'kasir') {
            $query->where('cashier_id', auth()->id());
        }

        return view('transactions.index', ['transactions' => $query->paginate(15)]);
    }

    public function show(Transaction $transaction): View
    {
        $this->authorizeCashierTransaction($transaction);

        return view('transactions.show', ['transaction' => $transaction->load('cashier', 'items')]);
    }

    public function receipt(Transaction $transaction): View
    {
        $this->authorizeCashierTransaction($transaction);

        return view('transactions.receipt', [
            'transaction' => $transaction->load('cashier', 'items'),
            'settings' => [
                'cafe_name' => Setting::getValue('cafe_name', 'Cafe POS'),
                'cafe_address' => Setting::getValue('cafe_address'),
                'cafe_phone' => Setting::getValue('cafe_phone'),
                'receipt_footer_text' => Setting::getValue('receipt_footer_text', 'Terima kasih.'),
            ],
        ]);
    }

    private function authorizeCashierTransaction(Transaction $transaction): void
    {
        if (auth()->user()->role === 'kasir' && $transaction->cashier_id !== auth()->id()) {
            abort(403);
        }
    }
}
