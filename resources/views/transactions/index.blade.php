@extends('layouts.app')

@section('content')
<div class="ta-page-header">
    <div>
        <p class="ta-kicker">Riwayat</p>
        <h1 class="ta-title">Transaksi</h1>
    </div>
</div>

<div class="ta-table-wrap">
    <div class="overflow-x-auto">
        <table class="ta-table min-w-[900px]">
            <thead><tr><th>Invoice</th><th>Tanggal</th><th>Kasir</th><th>Tipe</th><th>Bayar</th><th>Total</th><th>Status</th><th>Aksi</th></tr></thead>
            <tbody>
                @foreach($transactions as $transaction)
                    <tr>
                        <td class="font-semibold text-gray-900">{{ $transaction->invoice_number }}</td>
                        <td>{{ $transaction->transaction_date->format('d/m/Y H:i') }}</td>
                        <td>{{ $transaction->cashier?->name }}</td>
                        <td>{{ $transaction->order_type }}</td>
                        <td>{{ $transaction->payment_method }}</td>
                        <td class="font-semibold">Rp {{ number_format($transaction->grand_total, 0, ',', '.') }}</td>
                        <td><span class="rounded-full bg-success-50 px-3 py-1 text-xs font-semibold text-success-700">{{ $transaction->transaction_status }}</span></td>
                        <td class="text-right"><a class="font-semibold text-brand-500" href="{{ route('transactions.show', $transaction) }}">Detail</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="mt-4">{{ $transactions->links() }}</div>
@endsection
