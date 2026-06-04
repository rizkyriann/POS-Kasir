@extends('layouts.app')

@section('content')
<div class="ta-page-header"><div><p class="ta-kicker">Master Data</p><h1 class="ta-title">Tambah Kategori Menu</h1></div></div>
<form method="POST" action="{{ route('menu-categories.store') }}" class="ta-card max-w-2xl p-6">
    @csrf
    <label class="block text-sm font-semibold">Nama</label>
    <input name="name" value="{{ old('name') }}" required class="ta-input mt-2">
    <label class="mt-4 block text-sm font-semibold">Deskripsi</label>
    <textarea name="description" rows="4" class="ta-input mt-2 h-auto">{{ old('description') }}</textarea>
    <label class="mt-4 flex items-center gap-2 text-sm"><input type="checkbox" name="is_active" value="1" checked> Aktif</label>
    <div class="mt-6 flex gap-3"><button class="ta-btn-primary">Simpan</button><a href="{{ route('menu-categories.index') }}" class="ta-btn-secondary">Batal</a></div>
</form>
@endsection
