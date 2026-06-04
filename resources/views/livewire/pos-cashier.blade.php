<div>
    <div class="ta-page-header">
        <div>
            <p class="ta-kicker">Transaksi</p>
            <h1 class="ta-title">POS Kasir</h1>
        </div>
        <select wire:model.live="selectedCategoryId" class="ta-input max-w-xs bg-white">
            <option value="">Semua kategori</option>
            @foreach($categories as $category)<option value="{{ $category->id }}">{{ $category->name }}</option>@endforeach
        </select>
    </div>

    <div class="grid gap-5 xl:grid-cols-[1fr_420px]">
        <div>
            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4">
                @forelse($menus as $menu)
                    <div class="ta-card overflow-hidden">
                        <div class="flex h-36 items-center justify-center bg-gradient-to-br from-brand-50 to-gray-100 text-4xl font-black text-brand-200">
                            @if($menu->image)<img src="{{ Storage::url($menu->image) }}" class="h-full w-full object-cover" alt="{{ $menu->name }}">@else {{ strtoupper(substr($menu->name, 0, 1)) }} @endif
                        </div>
                        <div class="p-4">
                            <p class="text-theme-xs text-gray-500">{{ $menu->category?->name }}</p>
                            <h3 class="mt-1 font-bold text-gray-900">{{ $menu->name }}</h3>
                            <p class="mt-1 font-semibold text-brand-500">Rp {{ number_format($menu->price, 0, ',', '.') }}</p>
                            <button wire:click="addToCart({{ $menu->id }})" class="ta-btn-primary mt-4 w-full">Tambah {{ $cart[$menu->id]['quantity'] ?? '' }}</button>
                        </div>
                    </div>
                @empty
                    <div class="ta-card p-6 text-gray-500">Menu tersedia belum ada.</div>
                @endforelse
            </div>
            <div class="mt-5">{{ $menus->links() }}</div>
        </div>

        <div
            class="ta-card p-5 xl:sticky xl:top-24 xl:self-start"
            wire:key="payment-panel-{{ $this->grandTotal() }}"
            x-data="{
                paidAmount: @entangle('paidAmount').live,
                paidAmountLocal: Number(@js((float) $this->paidAmount)),
                paidAmountDisplay: '',
                paymentMethod: @entangle('paymentMethod').live,
                grandTotal: @js($this->grandTotal()),
                parseRupiah(value) {
                    return Number(String(value || '').replace(/[^0-9]/g, ''));
                },
                formatCurrency(value) {
                    return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0, maximumFractionDigits: 0 }).format(Math.max(0, Number(value || 0)));
                },
                formatRupiah(value) {
                    return new Intl.NumberFormat('id-ID').format(Math.max(0, Number(value || 0)));
                },
                syncPaidDisplay() {
                    this.paidAmountLocal = Number(this.paidAmount || this.paidAmountLocal || 0);
                    this.paidAmountDisplay = this.paidAmountLocal ? this.formatCurrency(this.paidAmountLocal) : '';
                },
                updatePaidAmount(event) {
                    const amount = this.parseRupiah(event.target.value);
                    this.paidAmountLocal = amount;
                    this.paidAmount = amount;
                    this.paidAmountDisplay = amount ? this.formatCurrency(amount) : '';
                    this.$nextTick(() => event.target.value = this.paidAmountDisplay);
                },
                changeAmount() {
                    if (this.paymentMethod === 'qris') return 0;
                    return Math.max(0, Number(this.paidAmountLocal || 0) - Number(this.grandTotal || 0));
                }
            }"
            x-init="syncPaidDisplay(); $watch('paymentMethod', value => { if (value === 'qris') { paidAmountLocal = grandTotal; paidAmount = grandTotal; syncPaidDisplay(); } })"
        >
            <h2 class="text-xl font-bold text-gray-900">Keranjang</h2>
            <div class="mt-4 divide-y-2 divide-gray-200">
                @forelse($cart as $id => $item)
                    <div class="py-4">
                        <div class="flex items-start justify-between gap-3">
                            <div><p class="font-semibold text-gray-900">{{ $item['name'] }}</p><p class="text-sm text-gray-500">Rp {{ number_format($item['price'], 0, ',', '.') }}</p></div>
                            <button wire:click="remove({{ $id }})" class="text-sm font-semibold text-error-500">Hapus</button>
                        </div>
                        <div class="mt-3 flex items-center gap-2">
                            <button wire:click="decrement({{ $id }})" class="h-9 w-9 rounded-lg border-2 border-gray-200 bg-gray-50 font-bold">-</button>
                            <span class="w-8 text-center font-bold">{{ $item['quantity'] }}</span>
                            <button wire:click="increment({{ $id }})" class="h-9 w-9 rounded-lg border-2 border-gray-200 bg-gray-50 font-bold">+</button>
                            <span class="ml-auto font-semibold text-gray-900">Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</span>
                        </div>
                        <input wire:model.live="cart.{{ $id }}.note" placeholder="Catatan item" class="ta-input mt-3 h-10">
                    </div>
                @empty
                    <p class="py-6 text-sm text-gray-500">Keranjang masih kosong.</p>
                @endforelse
            </div>

            <div class="mt-4 grid gap-3 sm:grid-cols-2 xl:grid-cols-1">
                <label class="text-sm font-semibold text-gray-700">Tipe order<select wire:model.live="orderType" class="ta-input mt-1"><option value="dine_in">Dine in</option><option value="takeaway">Takeaway</option></select></label>
                @if($orderType === 'dine_in')<label class="text-sm font-semibold text-gray-700">Nomor meja<input wire:model.live="tableNumber" class="ta-input mt-1"></label>@endif
                <label class="text-sm font-semibold text-gray-700">Nama pelanggan<input wire:model.live="customerName" class="ta-input mt-1"></label>
                <label class="text-sm font-semibold text-gray-700">Payment<select x-model="paymentMethod" class="ta-input mt-1"><option value="cash">Cash</option><option value="qris">QRIS</option></select></label>
                <template x-if="paymentMethod === 'cash'">
                    <label class="text-sm font-semibold text-gray-700">Uang bayar<input x-bind:value="paidAmountDisplay" x-on:input="updatePaidAmount($event)" type="text" inputmode="numeric" class="ta-input mt-1" placeholder="Rp 0"></label>
                </template>
            </div>

            <div class="mt-5 space-y-2 rounded-xl border-2 border-gray-200 bg-gray-50 p-4 text-sm"><p class="flex justify-between"><span>Subtotal</span><strong>Rp {{ number_format($this->subtotal(), 0, ',', '.') }}</strong></p><p class="flex justify-between"><span>Grand total</span><strong>Rp {{ number_format($this->grandTotal(), 0, ',', '.') }}</strong></p><p class="flex justify-between"><span>Kembalian</span><strong x-text="formatCurrency(changeAmount())">Rp {{ number_format($this->changeAmount(), 0, ',', '.') }}</strong></p></div>
            <button wire:click="checkout" wire:loading.attr="disabled" class="ta-btn-primary mt-4 w-full">Simpan Transaksi</button>
        </div>
    </div>
</div>
