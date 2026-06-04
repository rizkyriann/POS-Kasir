@extends('layouts.app')

@section('content')
<div class="ta-page-header"><div><p class="ta-kicker">Akses</p><h1 class="ta-title">Tambah User</h1></div></div>
<form method="POST" action="{{ route('users.store') }}" class="ta-card max-w-2xl p-6">
    @csrf
    @include('users.form', ['user' => null])
</form>
@endsection
