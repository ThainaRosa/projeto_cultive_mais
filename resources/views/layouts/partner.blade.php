<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', 'Área do parceiro') — Cultive Mais</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen bg-slate-50 font-sans text-slate-800 antialiased">
        <header class="border-b border-teal-950/10 bg-white">
            <div class="mx-auto flex max-w-7xl items-center justify-between px-5 py-4 sm:px-8 lg:px-10">
                <a href="{{ route('partner.dashboard') }}" class="flex items-center gap-3">
                    <span class="flex size-10 items-center justify-center rounded-full bg-teal-800 text-white">
                        <svg class="size-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M4 16h12V7H7a3 3 0 0 0-3 3v6Z"/><path d="M16 10h2.5l2.5 3v3h-5v-6ZM7 19a2 2 0 1 0 0-4 2 2 0 0 0 0 4ZM18 19a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z"/></svg>
                    </span>
                    <span><strong class="block text-lg leading-none text-teal-950">Cultive Mais</strong><small class="text-xs font-semibold text-teal-700">Área do parceiro</small></span>
                </a>

                <nav class="hidden items-center gap-6 md:flex" aria-label="Área do parceiro">
                    <a href="{{ route('partner.dashboard') }}" class="text-sm font-semibold hover:text-teal-700 {{ request()->routeIs('partner.dashboard') ? 'text-teal-700' : 'text-slate-600' }}">Visão geral</a>
                    <a href="{{ route('partner.collection-requests.pending') }}" class="text-sm font-semibold hover:text-teal-700 {{ request()->routeIs('partner.collection-requests.pending') ? 'text-teal-700' : 'text-slate-600' }}">Pendentes</a>
                    <a href="{{ route('partner.collection-requests.accepted') }}" class="text-sm font-semibold hover:text-teal-700 {{ request()->routeIs('partner.collection-requests.accepted') ? 'text-teal-700' : 'text-slate-600' }}">Minhas coletas</a>
                </nav>

                <details class="relative md:hidden">
                    <summary class="flex size-10 cursor-pointer list-none items-center justify-center rounded-full border border-slate-200 [&::-webkit-details-marker]:hidden" aria-label="Abrir menu">☰</summary>
                    <div class="absolute right-0 z-40 mt-3 w-64 rounded-2xl border border-slate-100 bg-white p-3 shadow-xl">
                        <a href="{{ route('partner.dashboard') }}" class="block rounded-xl px-4 py-3 text-sm font-semibold hover:bg-teal-50">Visão geral</a>
                        <a href="{{ route('partner.collection-requests.pending') }}" class="block rounded-xl px-4 py-3 text-sm font-semibold hover:bg-teal-50">Solicitações pendentes</a>
                        <a href="{{ route('partner.collection-requests.accepted') }}" class="block rounded-xl px-4 py-3 text-sm font-semibold hover:bg-teal-50">Minhas coletas</a>
                        <form method="POST" action="{{ route('logout') }}" class="mt-2 border-t border-slate-100 pt-2">
                            @csrf
                            <button class="w-full rounded-xl px-4 py-3 text-left text-sm font-semibold text-red-700 hover:bg-red-50">Sair</button>
                        </form>
                    </div>
                </details>

                <div class="hidden items-center gap-4 md:flex">
                    <span class="text-sm text-slate-500">{{ auth()->user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="text-sm font-bold text-slate-600 hover:text-red-700">Sair</button>
                    </form>
                </div>
            </div>
        </header>

        <main class="mx-auto w-full max-w-7xl px-5 py-10 sm:px-8 lg:px-10 lg:py-12">
            @if (session('success'))
                <div class="mb-8 rounded-2xl border border-teal-200 bg-teal-50 px-5 py-4 text-sm font-semibold text-teal-800">{{ session('success') }}</div>
            @endif

            @yield('content')
        </main>
    </body>
</html>
