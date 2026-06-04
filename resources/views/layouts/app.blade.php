<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'POS Kasir Cafe' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="font-outfit bg-gray-50 text-gray-800 antialiased" x-data="{ sidebarToggle: false, menuToggle: false }">
    @auth
        <div class="flex h-screen overflow-hidden">
            <aside
                :class="sidebarToggle ? 'translate-x-0 lg:w-[90px]' : '-translate-x-full'"
                class="sidebar fixed left-0 top-0 z-9999 flex h-screen w-[290px] flex-col overflow-y-hidden border-r-2 border-gray-200 bg-white px-5 lg:static lg:translate-x-0"
            >
                <div :class="sidebarToggle ? 'justify-center' : 'justify-between'" class="flex items-center gap-2 pt-8 pb-7">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
                        <span class="flex size-10 items-center justify-center rounded-xl bg-brand-500 font-bold text-white">PC</span>
                        <span :class="sidebarToggle ? 'lg:hidden' : ''" class="logo">
                            <span class="block text-lg font-bold text-gray-900">POS Cafe</span>
                            <span class="block text-xs text-gray-500">Kasir 1 outlet</span>
                        </span>
                    </a>
                </div>

                <div class="flex flex-col overflow-y-auto duration-300 ease-linear no-scrollbar">
                    <nav>
                        <div>
                            <h3 class="mb-4 text-xs uppercase leading-[20px] text-gray-400">
                                <span class="menu-group-title" :class="sidebarToggle ? 'lg:hidden' : ''">Menu</span>
                            </h3>
                            <ul class="mb-6 flex flex-col gap-2">
                                <li><a href="{{ route('dashboard') }}" class="menu-item group {{ request()->routeIs('dashboard') ? 'menu-item-active' : 'menu-item-inactive' }}"><span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">Dashboard</span></a></li>
                                <li><a href="{{ route('pos') }}" class="menu-item group {{ request()->routeIs('pos') ? 'menu-item-active' : 'menu-item-inactive' }}"><span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">POS Kasir</span></a></li>
                                <li><a href="{{ route('orders.index') }}" class="menu-item group {{ request()->routeIs('orders.*') ? 'menu-item-active' : 'menu-item-inactive' }}"><span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">Order</span></a></li>
                                <li><a href="{{ route('transactions.index') }}" class="menu-item group {{ request()->routeIs('transactions.*') ? 'menu-item-active' : 'menu-item-inactive' }}"><span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">Transaksi</span></a></li>
                            </ul>
                        </div>

                        @if(auth()->user()->hasRole('owner', 'admin'))
                            <div>
                                <h3 class="mb-4 text-xs uppercase leading-[20px] text-gray-400">
                                    <span class="menu-group-title" :class="sidebarToggle ? 'lg:hidden' : ''">Manajemen</span>
                                </h3>
                                <ul class="mb-6 flex flex-col gap-2">
                                    <li><a href="{{ route('menu-categories.index') }}" class="menu-item group {{ request()->routeIs('menu-categories.*') ? 'menu-item-active' : 'menu-item-inactive' }}"><span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">Kategori Menu</span></a></li>
                                    <li><a href="{{ route('menus.index') }}" class="menu-item group {{ request()->routeIs('menus.*') ? 'menu-item-active' : 'menu-item-inactive' }}"><span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">Menu Cafe</span></a></li>
                                    <li><a href="{{ route('users.index') }}" class="menu-item group {{ request()->routeIs('users.*') ? 'menu-item-active' : 'menu-item-inactive' }}"><span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">User</span></a></li>
                                    <li><a href="{{ route('reports.index') }}" class="menu-item group {{ request()->routeIs('reports.*') ? 'menu-item-active' : 'menu-item-inactive' }}"><span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">Laporan</span></a></li>
                                    <li><a href="{{ route('settings.edit') }}" class="menu-item group {{ request()->routeIs('settings.*') ? 'menu-item-active' : 'menu-item-inactive' }}"><span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">Settings</span></a></li>
                                </ul>
                            </div>
                        @endif
                    </nav>
                </div>
            </aside>

            <div x-cloak x-show="sidebarToggle" @click="sidebarToggle = false" class="fixed inset-0 z-9998 bg-gray-900/50 lg:hidden"></div>

            <div class="relative flex flex-1 flex-col overflow-x-hidden overflow-y-auto">
                <header class="sticky top-0 z-999 flex w-full border-gray-200 bg-white lg:border-b-2">
                    <div class="flex grow flex-col items-center justify-between lg:flex-row lg:px-6">
                        <div class="flex w-full items-center justify-between gap-2 border-b-2 border-gray-200 px-3 py-3 sm:gap-4 lg:justify-normal lg:border-b-0 lg:px-0 lg:py-4">
                            <button
                                :class="sidebarToggle ? 'lg:bg-transparent bg-gray-100' : ''"
                                class="z-99999 flex h-10 w-10 items-center justify-center rounded-lg border-gray-200 text-gray-500 lg:h-11 lg:w-11 lg:border-2"
                                @click.stop="sidebarToggle = !sidebarToggle"
                                type="button"
                            >
                                <svg class="fill-current" width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M2.5 5.5h15v1.5h-15V5.5Zm0 3.75h15v1.5h-15v-1.5Zm0 3.75h15v1.5h-15V13Z"/></svg>
                            </button>

                            <a href="{{ route('dashboard') }}" class="font-bold text-gray-900 lg:hidden">POS Cafe</a>

                            <div class="hidden lg:block">
                                <p class="text-sm font-medium text-gray-500">{{ now()->translatedFormat('l, d F Y') }}</p>
                            </div>

                            <button class="flex h-10 w-10 items-center justify-center rounded-lg text-gray-700 hover:bg-gray-100 lg:hidden" :class="menuToggle ? 'bg-gray-100' : ''" @click.stop="menuToggle = !menuToggle" type="button">
                                <svg class="fill-current" width="22" height="22" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M6 10.5a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z"/></svg>
                            </button>
                        </div>

                        <div x-cloak :class="menuToggle ? 'flex' : 'hidden'" class="shadow-theme-md w-full items-center justify-between gap-4 px-5 py-4 lg:flex lg:justify-end lg:px-0 lg:shadow-none">
                            <div class="flex items-center gap-3">
                                <div class="hidden text-right sm:block">
                                    <p class="text-sm font-semibold text-gray-700">{{ auth()->user()->name }}</p>
                                    <p class="text-xs text-gray-500">{{ strtoupper(auth()->user()->role) }}</p>
                                </div>
                                <div class="flex size-11 items-center justify-center rounded-full bg-brand-50 font-bold text-brand-500">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button class="rounded-lg border-2 border-gray-200 px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50" type="submit">Logout</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </header>

                <main>
                    <div class="mx-auto max-w-(--breakpoint-2xl) p-4 md:p-6">
                        @if(session('status'))
                            <div class="mb-4 rounded-xl border-2 border-success-200 bg-success-50 px-4 py-3 text-sm text-success-700">{{ session('status') }}</div>
                        @endif
                        @if($errors->any())
                            <div class="mb-4 rounded-xl border-2 border-error-200 bg-error-50 px-4 py-3 text-sm text-error-700">{{ $errors->first() }}</div>
                        @endif

                        {{ $slot ?? '' }}
                        @yield('content')
                    </div>
                </main>
            </div>
        </div>
    @else
        <main class="min-h-screen bg-gray-50">
            {{ $slot ?? '' }}
            @yield('content')
        </main>
    @endauth

    @livewireScripts
</body>
</html>
