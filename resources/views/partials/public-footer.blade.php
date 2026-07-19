<footer class="bg-emerald-950 text-emerald-50">
    <div class="mx-auto grid max-w-7xl gap-10 px-5 py-12 sm:px-8 md:grid-cols-[1.3fr_1fr_1fr] lg:px-10">
        <div>
            <a href="{{ route('home') }}" class="inline-flex items-center gap-3 text-xl font-extrabold">
                <span class="flex size-9 items-center justify-center rounded-full bg-lime-300 text-emerald-950">
                    <svg class="size-5" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                        <path d="M19.5 4.5C12.8 4.5 7 7.2 7 13.2c0 1 .2 1.9.6 2.7 2.8-3.7 6.2-5.8 9.9-7.1-3.2 1.8-5.9 4.4-7.9 7.7 1 .7 2.2 1 3.5 1 5.6 0 7.4-5.8 6.4-13Z"/>
                    </svg>
                </span>
                Cultive Mais
            </a>
            <p class="mt-4 max-w-sm text-sm leading-6 text-emerald-100/70">Uma rede local para aproximar quem separa resíduos orgânicos de quem pode transformá-los em novos recursos.</p>
        </div>
        <div>
            <h2 class="text-sm font-bold uppercase tracking-wider text-lime-300">Explore</h2>
            <div class="mt-4 flex flex-col gap-3 text-sm text-emerald-100/75">
                <a href="{{ route('how-it-works') }}" class="hover:text-white">Como funciona</a>
                <a href="{{ route('organic-waste') }}" class="hover:text-white">Sobre resíduos orgânicos</a>
                <a href="{{ route('collection-points') }}" class="hover:text-white">Pontos de coleta</a>
            </div>
        </div>
        <div>
            <h2 class="text-sm font-bold uppercase tracking-wider text-lime-300">Participe</h2>
            <p class="mt-4 text-sm leading-6 text-emerald-100/70">Separe hoje. Cultive um amanhã com menos desperdício.</p>
            <a href="{{ url('/register') }}" class="mt-4 inline-flex rounded-full border border-emerald-200/30 px-4 py-2 text-sm font-bold transition hover:bg-white hover:text-emerald-950">Criar conta</a>
        </div>
    </div>
    <div class="border-t border-white/10">
        <div class="mx-auto flex max-w-7xl flex-col gap-2 px-5 py-5 text-xs text-emerald-100/60 sm:flex-row sm:items-center sm:justify-between sm:px-8 lg:px-10">
            <p>&copy; {{ date('Y') }} Cultive Mais.</p>
            <p>Feito para uma Cotia mais circular.</p>
        </div>
    </div>
</footer>
