@extends('layouts.app')

@section('content')
<div class="ta-page-header">
    <div>
        <p class="ta-kicker">Dashboard {{ auth()->user()->role }}</p>
        <h1 class="ta-title">Ringkasan Hari Ini</h1>
    </div>
    <a href="{{ route('pos') }}" class="ta-btn-primary">Buka POS</a>
</div>

<div class="grid gap-4 md:grid-cols-2 xl:grid-cols-4">
    <div class="ta-card p-5">
        <p class="text-theme-sm text-gray-500">Transaksi paid</p>
        <p class="mt-3 text-title-sm font-bold text-gray-900">{{ $todayTransactions }}</p>
    </div>
    <div class="ta-card p-5">
        <p class="text-theme-sm text-gray-500">Omzet</p>
        <p class="mt-3 text-title-sm font-bold text-gray-900">Rp {{ number_format($todayRevenue, 0, ',', '.') }}</p>
    </div>
    <div class="ta-card p-5">
        <p class="text-theme-sm text-gray-500">Order pending</p>
        <p class="mt-3 text-title-sm font-bold text-gray-900">{{ $pendingOrders }}</p>
    </div>
    <div class="ta-card p-5">
        <p class="text-theme-sm text-gray-500">Order processing</p>
        <p class="mt-3 text-title-sm font-bold text-gray-900">{{ $processingOrders }}</p>
    </div>
</div>

<div class="mt-6 grid gap-4 md:grid-cols-3">
    <a href="{{ route('pos') }}" class="ta-card p-5 font-semibold text-brand-500 hover:border-brand-300">Transaksi Baru</a>
    <a href="{{ route('orders.index') }}" class="ta-card p-5 font-semibold text-gray-700 hover:border-brand-300">Daftar Order</a>
    <a href="{{ route('transactions.index') }}" class="ta-card p-5 font-semibold text-gray-700 hover:border-brand-300">Riwayat Transaksi</a>
</div>
@endsection
