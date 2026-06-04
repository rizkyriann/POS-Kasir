<!DOCTYPE html>
<html lang="id">
<head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>Struk {{ $transaction->invoice_number }}</title><style>body{font-family:monospace;max-width:360px;margin:0 auto;padding:16px;color:#111}.center{text-align:center}.row{display:flex;justify-content:space-between;gap:12px}.line{border-top:1px dashed #999;margin:10px 0}.small{font-size:12px}@media print{button{display:none}body{padding:0}}</style></head>
<body>
    <div class="center"><h2>{{ $settings['cafe_name'] }}</h2><p class="small">{{ $settings['cafe_address'] }}</p><p class="small">{{ $settings['cafe_phone'] }}</p></div>
    <div class="line"></div>
    <p class="small">Invoice: {{ $transaction->invoice_number }}</p><p class="small">Tanggal: {{ $transaction->transaction_date->format('d/m/Y H:i') }}</p><p class="small">Kasir: {{ $transaction->cashier?->name }}</p><p class="small">Order: {{ $transaction->order_type }} {{ $transaction->table_number ? 'Meja '.$transaction->table_number : '' }}</p>@if($transaction->customer_name)<p class="small">Pelanggan: {{ $transaction->customer_name }}</p>@endif
    <div class="line"></div>
    @foreach($transaction->items as $item)<div><div class="row"><span>{{ $item->menu_name }}</span><span>{{ $item->quantity }}x</span></div><div class="row small"><span>@ Rp {{ number_format($item->price, 0, ',', '.') }}</span><span>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</span></div>@if($item->note)<p class="small">Catatan: {{ $item->note }}</p>@endif</div>@endforeach
    <div class="line"></div>
    <div class="row"><strong>Subtotal</strong><strong>Rp {{ number_format($transaction->subtotal, 0, ',', '.') }}</strong></div><div class="row"><strong>Total</strong><strong>Rp {{ number_format($transaction->grand_total, 0, ',', '.') }}</strong></div><div class="row small"><span>{{ strtoupper($transaction->payment_method) }}</span><span>Rp {{ number_format($transaction->paid_amount, 0, ',', '.') }}</span></div><div class="row small"><span>Kembali</span><span>Rp {{ number_format($transaction->change_amount, 0, ',', '.') }}</span></div>
    <div class="line"></div><p class="center small">{{ $settings['receipt_footer_text'] }}</p><button onclick="window.print()">Print</button>
</body>
</html>
