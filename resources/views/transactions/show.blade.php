@extends('layouts.app')

@section('content')
<div class="ta-page-header">
    <div>
        <p class="ta-kicker">Detail Transaksi</p>
        <h1 class="ta-title">{{ $transaction->invoice_number }}</h1>
    </div>
    <a href="{{ route('transactions.receipt', $transaction) }}" target="_blank" class="ta-btn-primary">Cetak Struk</a>
</div>

<div class="grid gap-4 lg:grid-cols-3">
    <div class="ta-card p-6 lg:col-span-2">
        <h2 class="mb-4 text-lg font-bold text-gray-900">Item</h2>
        <div class="divide-y-2 divide-gray-200">
            @foreach($transaction->items as $item)
                <div class="py-4">
                    <div class="flex justify-between gap-4">
                        <div>
                            <p class="font-semibold text-gray-900">{{ $item->menu_name }}</p>
                            <p class="text-sm text-gray-500">{{ $item->quantity }} x Rp {{ number_format($item->price, 0, ',', '.') }} {{ $item->note ? '· '.$item->note : '' }}</p>
                        </div>
                        <p class="font-semibold text-gray-900">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="ta-card p-6">
        <h2 class="mb-4 text-lg font-bold text-gray-900">Ringkasan</h2>
        <div class="space-y-3 text-sm">
            <p class="flex justify-between border-b-2 border-gray-200 pb-2"><span class="text-gray-500">Kasir</span><strong>{{ $transaction->cashier?->name }}</strong></p>
            <p class="flex justify-between border-b-2 border-gray-200 pb-2"><span class="text-gray-500">Order</span><strong>{{ $transaction->order_type }}</strong></p>
            <p class="flex justify-between border-b-2 border-gray-200 pb-2"><span class="text-gray-500">Status order</span><strong>{{ $transaction->order_status }}</strong></p>
            <p class="flex justify-between border-b-2 border-gray-200 pb-2"><span class="text-gray-500">Payment</span><strong>{{ $transaction->payment_method }}</strong></p>
            <p class="flex justify-between border-b-2 border-gray-200 pb-2"><span class="text-gray-500">Subtotal</span><strong>Rp {{ number_format($transaction->subtotal, 0, ',', '.') }}</strong></p>
            <p class="flex justify-between border-b-2 border-gray-200 pb-2"><span class="text-gray-500">Grand total</span><strong>Rp {{ number_format($transaction->grand_total, 0, ',', '.') }}</strong></p>
            <p class="flex justify-between border-b-2 border-gray-200 pb-2"><span class="text-gray-500">Dibayar</span><strong>Rp {{ number_format($transaction->paid_amount, 0, ',', '.') }}</strong></p>
            <p class="flex justify-between"><span class="text-gray-500">Kembali</span><strong>Rp {{ number_format($transaction->change_amount, 0, ',', '.') }}</strong></p>
        </div>
    </div>
</div>
@endsection
