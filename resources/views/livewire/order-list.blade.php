<div>
    <div class="ta-page-header"><div><p class="ta-kicker">Order</p><h1 class="ta-title">Daftar Order</h1></div></div>
    <div class="ta-card mb-4 grid gap-3 p-4 md:grid-cols-3">
        <select wire:model.live="status" class="ta-input"><option value="">Semua status</option><option value="pending">Pending</option><option value="processing">Processing</option><option value="completed">Completed</option><option value="cancelled">Cancelled</option></select>
        <input wire:model.live="date" type="date" class="ta-input">
        <select wire:model.live="cashierId" class="ta-input"><option value="">Semua kasir</option>@foreach($cashiers as $cashier)<option value="{{ $cashier->id }}">{{ $cashier->name }}</option>@endforeach</select>
    </div>
    <div class="grid gap-4 lg:grid-cols-2">
        @foreach($orders as $order)
            <div class="ta-card p-5">
                <div class="flex justify-between gap-3"><div><p class="font-bold text-gray-900">{{ $order->invoice_number }}</p><p class="text-sm text-gray-500">{{ $order->transaction_date->format('d/m/Y H:i') }} · {{ $order->cashier?->name }}</p></div><span class="h-fit rounded-full px-3 py-1 text-xs font-bold {{ ['pending'=>'bg-warning-50 text-warning-700','processing'=>'bg-blue-light-50 text-blue-light-700','completed'=>'bg-success-50 text-success-700','cancelled'=>'bg-error-50 text-error-700'][$order->order_status] ?? 'bg-gray-100' }}">{{ $order->order_status }}</span></div>
                <p class="mt-3 text-sm text-gray-600">{{ $order->order_type }} {{ $order->table_number ? '· Meja '.$order->table_number : '' }} {{ $order->customer_name ? '· '.$order->customer_name : '' }}</p>
                <p class="mt-2 font-semibold text-gray-900">Rp {{ number_format($order->grand_total, 0, ',', '.') }}</p>
                <div class="mt-4 flex flex-wrap gap-2">
                    @if($order->order_status === 'pending')<button wire:click="updateStatus({{ $order->id }}, 'processing')" class="ta-btn-primary">Processing</button>@endif
                    @if($order->order_status === 'processing')<button wire:click="updateStatus({{ $order->id }}, 'completed')" class="inline-flex items-center justify-center rounded-lg bg-success-500 px-4 py-2.5 text-sm font-semibold text-white hover:bg-success-600">Completed</button>@endif
                    @if(auth()->user()->hasRole('owner', 'admin') && $order->order_status !== 'cancelled')<button wire:click="updateStatus({{ $order->id }}, 'cancelled')" class="ta-btn-danger">Cancel</button>@endif
                    <a href="{{ route('transactions.show', $order) }}" class="ta-btn-secondary">Detail</a>
                </div>
            </div>
        @endforeach
    </div>
    <div class="mt-4">{{ $orders->links() }}</div>
</div>
