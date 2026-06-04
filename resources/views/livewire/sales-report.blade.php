<div>
    <div class="ta-page-header"><div><p class="ta-kicker">Laporan</p><h1 class="ta-title">Penjualan</h1></div></div>
    <div class="ta-card mb-4 grid gap-3 p-4 md:grid-cols-3 xl:grid-cols-6">
        <input wire:model.live="startDate" type="date" class="ta-input"><input wire:model.live="endDate" type="date" class="ta-input">
        <select wire:model.live="cashierId" class="ta-input"><option value="">Semua kasir</option>@foreach($cashiers as $cashier)<option value="{{ $cashier->id }}">{{ $cashier->name }}</option>@endforeach</select>
        <select wire:model.live="paymentMethod" class="ta-input"><option value="">Semua payment</option><option value="cash">Cash</option><option value="qris">QRIS</option></select>
        <select wire:model.live="orderType" class="ta-input"><option value="">Semua tipe</option><option value="dine_in">Dine in</option><option value="takeaway">Takeaway</option></select>
        <select wire:model.live="transactionStatus" class="ta-input"><option value="paid">Paid</option><option value="cancelled">Cancelled</option><option value="refunded">Refunded</option><option value="">Semua status</option></select>
    </div>
    <div class="grid gap-4 md:grid-cols-3 xl:grid-cols-6">
        <div class="ta-card p-5"><p class="text-xs text-gray-500">Transaksi</p><p class="mt-2 text-2xl font-bold text-gray-900">{{ $totalTransactions }}</p></div><div class="ta-card p-5 md:col-span-2"><p class="text-xs text-gray-500">Omzet paid</p><p class="mt-2 text-2xl font-bold text-gray-900">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p></div><div class="ta-card p-5"><p class="text-xs text-gray-500">Cash</p><p class="mt-2 text-2xl font-bold text-gray-900">{{ $cashCount }}</p></div><div class="ta-card p-5"><p class="text-xs text-gray-500">QRIS</p><p class="mt-2 text-2xl font-bold text-gray-900">{{ $qrisCount }}</p></div><div class="ta-card p-5"><p class="text-xs text-gray-500">Dine/Take</p><p class="mt-2 text-2xl font-bold text-gray-900">{{ $dineInCount }}/{{ $takeawayCount }}</p></div>
    </div>
    <div class="mt-5 grid gap-4 lg:grid-cols-2">
        <div class="ta-card p-5"><h2 class="mb-3 font-bold text-gray-900">Menu Terlaris</h2><div class="divide-y-2 divide-gray-200">@forelse($topMenus as $menu)<div class="flex justify-between py-3"><span>{{ $menu->menu_name }}</span><strong>{{ $menu->total_quantity }} item</strong></div>@empty<p class="text-sm text-gray-500">Belum ada data.</p>@endforelse</div></div>
        <div class="ta-card p-5"><h2 class="mb-3 font-bold text-gray-900">Transaksi Terbaru</h2><div class="divide-y-2 divide-gray-200">@forelse($transactions as $transaction)<div class="flex justify-between py-3 text-sm"><span>{{ $transaction->invoice_number }}<br><span class="text-gray-500">{{ $transaction->cashier?->name }}</span></span><strong>Rp {{ number_format($transaction->grand_total, 0, ',', '.') }}</strong></div>@empty<p class="text-sm text-gray-500">Belum ada data.</p>@endforelse</div></div>
    </div>
</div>
