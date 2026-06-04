@extends('layouts.app')

@section('content')
<div class="mx-auto flex min-h-screen max-w-md items-center px-4">
    <form method="POST" action="{{ route('login.store') }}" class="shadow-theme-xl w-full rounded-3xl border-2 border-gray-200 bg-white p-8">
        @csrf
        <div class="mb-6 flex items-center gap-3">
            <span class="flex size-12 items-center justify-center rounded-xl bg-brand-500 font-bold text-white">PC</span>
            <div>
                <p class="text-sm font-semibold uppercase tracking-widest text-brand-500">POS Kasir Cafe</p>
                <h1 class="text-2xl font-bold text-gray-900">Login</h1>
            </div>
        </div>
        <p class="text-sm text-gray-500">Masuk sebagai owner, admin, atau kasir.</p>

        <label class="mt-6 block text-sm font-medium text-gray-700">Email</label>
        <input name="email" type="email" value="{{ old('email') }}" required autofocus class="shadow-theme-xs mt-2 h-12 w-full rounded-lg border-2 border-gray-300 bg-transparent px-4 text-sm text-gray-800 placeholder:text-gray-400 focus:border-brand-300 focus:ring-3 focus:ring-brand-500/10 focus:outline-hidden">

        <label class="mt-4 block text-sm font-medium text-gray-700">Password</label>
        <input name="password" type="password" required class="shadow-theme-xs mt-2 h-12 w-full rounded-lg border-2 border-gray-300 bg-transparent px-4 text-sm text-gray-800 placeholder:text-gray-400 focus:border-brand-300 focus:ring-3 focus:ring-brand-500/10 focus:outline-hidden">

        <label class="mt-4 flex items-center gap-2 text-sm text-gray-600">
            <input type="checkbox" name="remember" value="1" class="rounded border-gray-300">
            Ingat saya
        </label>

        <button class="mt-6 h-12 w-full rounded-lg bg-brand-500 px-4 font-semibold text-white hover:bg-brand-600">Masuk</button>
        <div class="mt-5 rounded-xl border-2 border-gray-200 bg-gray-50 p-4 text-xs text-gray-600">
            <p>Owner: owner@cafe.test / password</p>
            <p>Admin: admin@cafe.test / password</p>
            <p>Kasir: kasir@cafe.test / password</p>
        </div>
    </form>
</div>
@endsection
