@extends('layouts.app')

@section('content')
<div class="ta-page-header">
    <div>
        <p class="ta-kicker">Akses</p>
        <h1 class="ta-title">User</h1>
    </div>
    <a href="{{ route('users.create') }}" class="ta-btn-primary">Tambah User</a>
</div>

<div class="ta-table-wrap">
    <div class="overflow-x-auto">
        <table class="ta-table min-w-[720px]">
            <thead><tr><th>Nama</th><th>Email</th><th>Role</th><th>Aksi</th></tr></thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td class="font-semibold text-gray-900">{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td><span class="rounded-full bg-brand-50 px-3 py-1 text-xs font-semibold text-brand-500">{{ $user->role }}</span></td>
                        <td class="text-right"><a class="font-semibold text-brand-500" href="{{ route('users.edit', $user) }}">Edit</a><form method="POST" action="{{ route('users.destroy', $user) }}" class="ml-3 inline">@csrf @method('DELETE')<button class="font-semibold text-error-500" onclick="return confirm('Hapus user ini?')">Hapus</button></form></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="mt-4">{{ $users->links() }}</div>
@endsection
