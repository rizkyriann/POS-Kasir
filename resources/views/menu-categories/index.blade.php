@extends('layouts.app')

@section('content')
<div class="ta-page-header">
    <div>
        <p class="ta-kicker">Master Data</p>
        <h1 class="ta-title">Kategori Menu</h1>
    </div>
    <a href="{{ route('menu-categories.create') }}" class="ta-btn-primary">Tambah Kategori</a>
</div>

<div class="ta-table-wrap">
    <div class="overflow-x-auto">
        <table class="ta-table min-w-[720px]">
            <thead><tr><th>Nama</th><th>Deskripsi</th><th>Menu</th><th>Status</th><th>Aksi</th></tr></thead>
            <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td class="font-semibold text-gray-900">{{ $category->name }}</td>
                        <td class="text-gray-600">{{ $category->description ?: '-' }}</td>
                        <td>{{ $category->menus_count }}</td>
                        <td><span class="rounded-full px-3 py-1 text-xs font-semibold {{ $category->is_active ? 'bg-success-50 text-success-700' : 'bg-gray-100 text-gray-600' }}">{{ $category->is_active ? 'Aktif' : 'Nonaktif' }}</span></td>
                        <td class="text-right">
                            <a class="font-semibold text-brand-500" href="{{ route('menu-categories.edit', $category) }}">Edit</a>
                            <form method="POST" action="{{ route('menu-categories.destroy', $category) }}" class="ml-3 inline">@csrf @method('DELETE')<button class="font-semibold text-error-500" onclick="return confirm('Hapus/nonaktifkan kategori ini?')">Hapus</button></form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="mt-4">{{ $categories->links() }}</div>
@endsection
