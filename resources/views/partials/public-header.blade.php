<header class="sticky top-0 z-50 border-b border-emerald-950/10 bg-[#f7f8f2]/95 backdrop-blur">
    <div class="mx-auto flex max-w-7xl items-center justify-between px-5 py-4 sm:px-8 lg:px-10">
        <a href="{{ route('home') }}" class="flex items-center gap-3" aria-label="Cultive Mais — página inicial">
            <span class="flex size-10 items-center justify-center rounded-full bg-emerald-800 text-white shadow-sm">
                <svg class="size-6" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="M19.5 4.5C12.8 4.5 7 7.2 7 13.2c0 1 .2 1.9.6 2.7 2.8-3.7 6.2-5.8 9.9-7.1-3.2 1.8-5.9 4.4-7.9 7.7 1 .7 2.2 1 3.5 1 5.6 0 7.4-5.8 6.4-13Z" fill="currentColor"/>
                    <path d="M5.2 12.2c-1.8 1.5-2.8 3.7-2.7 6.8" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                </svg>
            </span>
            <span>
                <span class="block text-lg font-extrabold leading-none tracking-tight text-emerald-950">Cultive Mais</span>
                <span class="mt-1 block text-[10px] font-semibold uppercase tracking-[0.2em] text-emerald-700">Conexões que regeneram</span>
            </span>
        </a>

        <nav class="hidden items-center gap-7 lg:flex" aria-label="Navegação principal">
            <a href="{{ route('home') }}" class="text-sm font-semibold transition hover:text-emerald-700 {{ request()->routeIs('home') ? 'text-emerald-700' : 'text-stone-600' }}">Início</a>
            <a href="{{ route('how-it-works') }}" class="text-sm font-semibold transition hover:text-emerald-700 {{ request()->routeIs('how-it-works') ? 'text-emerald-700' : 'text-stone-600' }}">Como funciona</a>
            <a href="{{ route('organic-waste') }}" class="text-sm font-semibold transition hover:text-emerald-700 {{ request()->routeIs('organic-waste') ? 'text-emerald-700' : 'text-stone-600' }}">Resíduos orgânicos</a>
            <a href="{{ route('collection-points') }}" class="text-sm font-semibold transition hover:text-emerald-700 {{ request()->routeIs('collection-points') ? 'text-emerald-700' : 'text-stone-600' }}">Pontos de coleta</a>
        </nav>

        <div class="hidden items-center gap-3 lg:flex">
            @auth
                <a href="{{ url('/dashboard') }}" class="rounded-full border border-emerald-800 px-5 py-2.5 text-sm font-bold text-emerald-800 transition hover:bg-emerald-50">Minha conta</a>
            @else
                <a href="{{ url('/login') }}" class="px-3 py-2 text-sm font-bold text-emerald-900 transition hover:text-emerald-700">Entrar</a>
                <a href="{{ url('/register') }}" class="rounded-full bg-emerald-800 px-5 py-2.5 text-sm font-bold text-white shadow-sm transition hover:bg-emerald-700">Cadastre-se</a>
            @endauth
        </div>

        <details class="group relative lg:hidden">
            <summary class="flex size-11 cursor-pointer list-none items-center justify-center rounded-full border border-emerald-900/15 text-emerald-900 [&::-webkit-details-marker]:hidden" aria-label="Abrir menu">
                <svg class="size-5 group-open:hidden" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <path d="M4 7h16M4 12h16M4 17h16" stroke-linecap="round"/>
                </svg>
                <svg class="hidden size-5 group-open:block" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <path d="m6 6 12 12M18 6 6 18" stroke-linecap="round"/>
                </svg>
            </summary>
            <div class="absolute right-0 mt-3 w-72 rounded-3xl border border-emerald-950/10 bg-white p-3 shadow-xl">
                <nav class="flex flex-col" aria-label="Navegação móvel">
                    <a href="{{ route('home') }}" class="rounded-2xl px-4 py-3 text-sm font-semibold hover:bg-emerald-50">Início</a>
                    <a href="{{ route('how-it-works') }}" class="rounded-2xl px-4 py-3 text-sm font-semibold hover:bg-emerald-50">Como funciona</a>
                    <a href="{{ route('organic-waste') }}" class="rounded-2xl px-4 py-3 text-sm font-semibold hover:bg-emerald-50">Resíduos orgânicos</a>
                    <a href="{{ route('collection-points') }}" class="rounded-2xl px-4 py-3 text-sm font-semibold hover:bg-emerald-50">Pontos de coleta</a>
                </nav>
                <div class="mt-2 grid grid-cols-2 gap-2 border-t border-stone-100 pt-3">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="col-span-2 rounded-full bg-emerald-800 px-4 py-3 text-center text-sm font-bold text-white">Minha conta</a>
                    @else
                        <a href="{{ url('/login') }}" class="rounded-full border border-emerald-800 px-4 py-3 text-center text-sm font-bold text-emerald-800">Entrar</a>
                        <a href="{{ url('/register') }}" class="rounded-full bg-emerald-800 px-4 py-3 text-center text-sm font-bold text-white">Cadastrar</a>
                    @endauth
                </div>
            </div>
        </details>
    </div>
</header>
