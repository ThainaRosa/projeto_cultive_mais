<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', 'Área do morador') — Cultive Mais</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen bg-stone-50 font-sans text-stone-800 antialiased">
        <header class="border-b border-emerald-950/10 bg-white">
            <div class="mx-auto flex max-w-7xl items-center justify-between px-5 py-4 sm:px-8 lg:px-10">
                <a href="{{ route('resident.dashboard') }}" class="flex items-center gap-3">
                    <span class="flex size-10 items-center justify-center rounded-full bg-emerald-800 text-white">
                        <svg class="size-6" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M19.5 4.5C12.8 4.5 7 7.2 7 13.2c0 1 .2 1.9.6 2.7 2.8-3.7 6.2-5.8 9.9-7.1-3.2 1.8-5.9 4.4-7.9 7.7 1 .7 2.2 1 3.5 1 5.6 0 7.4-5.8 6.4-13Z"/></svg>
                    </span>
                    <span><strong class="block text-lg leading-none text-emerald-950">Cultive Mais</strong><small class="text-xs font-semibold text-emerald-700">Área do morador</small></span>
                </a>

                <nav class="hidden items-center gap-6 md:flex" aria-label="Área do morador">
                    <a href="{{ route('resident.dashboard') }}" class="text-sm font-semibold hover:text-emerald-700 {{ request()->routeIs('resident.dashboard') ? 'text-emerald-700' : 'text-stone-600' }}">Visão geral</a>
                    <a href="{{ route('resident.waste-records.index') }}" class="text-sm font-semibold hover:text-emerald-700 {{ request()->routeIs('resident.waste-records.*') ? 'text-emerald-700' : 'text-stone-600' }}">Meus resíduos</a>
                    <a href="{{ route('resident.collection-requests.index') }}" class="text-sm font-semibold hover:text-emerald-700 {{ request()->routeIs('resident.collection-requests.*') ? 'text-emerald-700' : 'text-stone-600' }}">Solicitações</a>
                </nav>

                <details class="relative md:hidden">
                    <summary class="flex size-10 cursor-pointer list-none items-center justify-center rounded-full border border-stone-200 [&::-webkit-details-marker]:hidden" aria-label="Abrir menu">☰</summary>
                    <div class="absolute right-0 z-40 mt-3 w-64 rounded-2xl border border-stone-100 bg-white p-3 shadow-xl">
                        <a href="{{ route('resident.dashboard') }}" class="block rounded-xl px-4 py-3 text-sm font-semibold hover:bg-emerald-50">Visão geral</a>
                        <a href="{{ route('resident.waste-records.index') }}" class="block rounded-xl px-4 py-3 text-sm font-semibold hover:bg-emerald-50">Meus resíduos</a>
                        <a href="{{ route('resident.collection-requests.index') }}" class="block rounded-xl px-4 py-3 text-sm font-semibold hover:bg-emerald-50">Solicitações</a>
                        <form method="POST" action="{{ route('logout') }}" class="mt-2 border-t border-stone-100 pt-2">
                            @csrf
                            <button class="w-full rounded-xl px-4 py-3 text-left text-sm font-semibold text-red-700 hover:bg-red-50">Sair</button>
                        </form>
                    </div>
                </details>

                <div class="hidden items-center gap-4 md:flex">
                    <span class="text-sm text-stone-500">{{ auth()->user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="text-sm font-bold text-stone-600 hover:text-red-700">Sair</button>
                    </form>
                </div>
            </div>
        </header>

        <main class="mx-auto w-full max-w-7xl px-5 py-10 sm:px-8 lg:px-10 lg:py-12">
            @if (session('success'))
                <div class="mb-8 rounded-2xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-sm font-semibold text-emerald-800">{{ session('success') }}</div>
            @endif

            @yield('content')
        </main>
    </body>
</html>
