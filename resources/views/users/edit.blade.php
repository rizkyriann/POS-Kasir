@extends('layouts.app')

@section('content')
<div class="ta-page-header"><div><p class="ta-kicker">Akses</p><h1 class="ta-title">Edit User</h1></div></div>
<form method="POST" action="{{ route('users.update', $user) }}" class="ta-card max-w-2xl p-6">
    @csrf @method('PUT')
    @include('users.form', ['user' => $user])
</form>
@endsection
