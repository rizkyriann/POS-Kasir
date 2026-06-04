@extends('layouts.app')

@section('content')
<div class="ta-page-header">
    <div>
        <p class="ta-kicker">Master Data</p>
        <h1 class="ta-title">Menu Cafe</h1>
    </div>
    <a href="{{ route('menus.create') }}" class="ta-btn-primary">Tambah Menu</a>
</div>

<div class="ta-table-wrap">
    <div class="overflow-x-auto">
        <table class="ta-table min-w-[820px]">
            <thead><tr><th>Menu</th><th>Kategori</th><th>Harga</th><th>Status</th><th>Aksi</th></tr></thead>
            <tbody>
                @foreach($menus as $menu)
                    <tr>
                        <td class="font-semibold text-gray-900">{{ $menu->name }}<p class="text-xs font-normal text-gray-500">{{ $menu->description }}</p></td>
                        <td>{{ $menu->category?->name }}</td>
                        <td>Rp {{ number_format($menu->price, 0, ',', '.') }}</td>
                        <td><span class="rounded-full px-3 py-1 text-xs font-semibold {{ $menu->is_available ? 'bg-success-50 text-success-700' : 'bg-gray-100 text-gray-600' }}">{{ $menu->is_available ? 'Tersedia' : 'Tidak tersedia' }}</span></td>
                        <td class="text-right"><a class="font-semibold text-brand-500" href="{{ route('menus.edit', $menu) }}">Edit</a><form method="POST" action="{{ route('menus.destroy', $menu) }}" class="ml-3 inline">@csrf @method('DELETE')<button class="font-semibold text-error-500" onclick="return confirm('Nonaktifkan menu ini?')">Nonaktifkan</button></form></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="mt-4">{{ $menus->links() }}</div>
@endsection
