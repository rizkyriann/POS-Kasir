@extends('layouts.app')

@section('content')
<div class="ta-page-header">
    <div>
        <p class="ta-kicker">Pengaturan</p>
        <h1 class="ta-title">Settings Cafe</h1>
    </div>
</div>

<form method="POST" action="{{ route('settings.update') }}" class="ta-card max-w-2xl p-6">
    @csrf @method('PUT')
    <label class="block text-sm font-semibold text-gray-700">Nama Cafe</label>
    <input name="cafe_name" value="{{ old('cafe_name', $settings['cafe_name']) }}" required class="ta-input mt-2">
    <label class="mt-4 block text-sm font-semibold text-gray-700">Alamat</label>
    <textarea name="cafe_address" rows="3" class="ta-input mt-2 h-auto">{{ old('cafe_address', $settings['cafe_address']) }}</textarea>
    <label class="mt-4 block text-sm font-semibold text-gray-700">Telepon</label>
    <input name="cafe_phone" value="{{ old('cafe_phone', $settings['cafe_phone']) }}" class="ta-input mt-2">
    <label class="mt-4 block text-sm font-semibold text-gray-700">Footer Struk</label>
    <textarea name="receipt_footer_text" rows="3" class="ta-input mt-2 h-auto">{{ old('receipt_footer_text', $settings['receipt_footer_text']) }}</textarea>
    <button class="ta-btn-primary mt-6">Simpan</button>
</form>
@endsection
