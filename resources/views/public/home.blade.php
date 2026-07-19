@extends('layouts.public')

@section('title', 'Cultive Mais — resíduos que viram novos recursos')
@section('description', 'Conectamos moradores e parceiros para facilitar a coleta e o reaproveitamento de resíduos orgânicos em Cotia.')

@section('content')
    <section class="relative overflow-hidden">
        <div class="absolute -right-32 top-8 size-96 rounded-full bg-lime-200/45 blur-3xl" aria-hidden="true"></div>
        <div class="mx-auto grid max-w-7xl items-center gap-14 px-5 py-16 sm:px-8 sm:py-24 lg:grid-cols-[1.1fr_0.9fr] lg:px-10 lg:py-28">
            <div class="relative">
                <span class="inline-flex items-center gap-2 rounded-full bg-emerald-100 px-4 py-2 text-xs font-bold uppercase tracking-[0.14em] text-emerald-800">
                    <span class="size-2 rounded-full bg-lime-500"></span>
                    Uma rede local em Cotia
                </span>
                <h1 class="mt-7 max-w-3xl text-4xl font-extrabold leading-[1.05] tracking-tight text-emerald-950 sm:text-6xl lg:text-7xl">Resíduo orgânico vira recurso quando encontra o caminho certo.</h1>
                <p class="mt-7 max-w-2xl text-lg leading-8 text-stone-600">O Cultive Mais aproxima moradores e parceiros para tornar simples o cadastro, a coleta e o destino responsável de restos de alimentos e resíduos de jardim.</p>
                <div class="mt-9 flex flex-col gap-3 sm:flex-row">
                    <a href="{{ url('/register') }}" class="rounded-full bg-emerald-800 px-7 py-3.5 text-center text-sm font-bold text-white shadow-lg shadow-emerald-900/10 transition hover:-translate-y-0.5 hover:bg-emerald-700">Quero participar</a>
                    <a href="{{ url('/login') }}" class="rounded-full border border-emerald-900/20 bg-white px-7 py-3.5 text-center text-sm font-bold text-emerald-900 transition hover:border-emerald-700 hover:bg-emerald-50">Já tenho cadastro</a>
                </div>
            </div>

            <div class="relative mx-auto w-full max-w-lg">
                <div class="absolute -left-5 -top-5 size-28 rounded-full bg-amber-200" aria-hidden="true"></div>
                <div class="relative overflow-hidden rounded-[2.5rem] bg-emerald-900 p-7 text-white shadow-2xl shadow-emerald-950/20 sm:p-10">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold uppercase tracking-[0.2em] text-lime-300">Ciclo Cultive Mais</span>
                        <span class="flex size-12 items-center justify-center rounded-full bg-white/10">
                            <svg class="size-7 text-lime-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M7 20h10M12 20v-8M12 12c0-4.2 3.2-7 7.5-7 0 4.2-2.5 7-7.5 7ZM12 15c0-3.3-2.6-5.5-6-5.5 0 3.3 2 5.5 6 5.5Z" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </span>
                    </div>
                    <div class="mt-12 space-y-4">
                        <div class="flex items-center gap-4 rounded-2xl bg-white/10 p-4">
                            <span class="flex size-10 shrink-0 items-center justify-center rounded-full bg-lime-300 font-extrabold text-emerald-950">1</span>
                            <div><strong class="block">Separe</strong><span class="text-sm text-emerald-100/70">os resíduos orgânicos em casa</span></div>
                        </div>
                        <div class="ml-6 flex items-center gap-4 rounded-2xl bg-white/10 p-4">
                            <span class="flex size-10 shrink-0 items-center justify-center rounded-full bg-amber-300 font-extrabold text-emerald-950">2</span>
                            <div><strong class="block">Cadastre</strong><span class="text-sm text-emerald-100/70">o tipo e a quantidade disponível</span></div>
                        </div>
                        <div class="flex items-center gap-4 rounded-2xl bg-white/10 p-4">
                            <span class="flex size-10 shrink-0 items-center justify-center rounded-full bg-emerald-300 font-extrabold text-emerald-950">3</span>
                            <div><strong class="block">Conecte</strong><span class="text-sm text-emerald-100/70">com parceiros para a coleta</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-white py-20 sm:py-24">
        <div class="mx-auto max-w-7xl px-5 sm:px-8 lg:px-10">
            <div class="max-w-2xl">
                <p class="text-sm font-bold uppercase tracking-[0.18em] text-emerald-700">Uma ação compartilhada</p>
                <h2 class="mt-4 text-3xl font-extrabold tracking-tight text-emerald-950 sm:text-5xl">Cada pessoa faz uma parte. O impacto é de todos.</h2>
            </div>
            <div class="mt-12 grid gap-5 md:grid-cols-3">
                <article class="rounded-3xl border border-emerald-900/10 bg-[#f7f8f2] p-7">
                    <span class="flex size-12 items-center justify-center rounded-2xl bg-amber-200 text-xl">🏠</span>
                    <h3 class="mt-6 text-xl font-bold text-emerald-950">Moradores cadastram</h3>
                    <p class="mt-3 leading-7 text-stone-600">Informam o tipo, a quantidade e os detalhes dos resíduos orgânicos que separaram.</p>
                </article>
                <article class="rounded-3xl border border-emerald-900/10 bg-emerald-800 p-7 text-white">
                    <span class="flex size-12 items-center justify-center rounded-2xl bg-lime-300 text-xl">🚲</span>
                    <h3 class="mt-6 text-xl font-bold">Parceiros coletam</h3>
                    <p class="mt-3 leading-7 text-emerald-50/75">Visualizam os registros disponíveis, combinam a retirada e encaminham o material.</p>
                </article>
                <article class="rounded-3xl border border-emerald-900/10 bg-[#f7f8f2] p-7">
                    <span class="flex size-12 items-center justify-center rounded-2xl bg-emerald-200 text-xl">🌱</span>
                    <h3 class="mt-6 text-xl font-bold text-emerald-950">A cidade se beneficia</h3>
                    <p class="mt-3 leading-7 text-stone-600">Menos descarte misturado, mais reaproveitamento e nutrientes retornando ao solo.</p>
                </article>
            </div>
        </div>
    </section>

    <section class="py-20 sm:py-24">
        <div class="mx-auto grid max-w-7xl gap-12 px-5 sm:px-8 lg:grid-cols-2 lg:px-10">
            <div>
                <p class="text-sm font-bold uppercase tracking-[0.18em] text-emerald-700">Benefícios ambientais</p>
                <h2 class="mt-4 text-3xl font-extrabold tracking-tight text-emerald-950 sm:text-5xl">Pequenos hábitos alimentam grandes mudanças.</h2>
                <p class="mt-6 max-w-xl text-lg leading-8 text-stone-600">Separar resíduos orgânicos ajuda a manter materiais aproveitáveis fora do lixo comum e abre espaço para soluções locais, como compostagem e recuperação do solo.</p>
                <a href="{{ route('organic-waste') }}" class="mt-8 inline-flex items-center gap-2 font-bold text-emerald-800 hover:text-emerald-600">Entenda os resíduos orgânicos <span aria-hidden="true">→</span></a>
            </div>
            <div class="grid gap-4 sm:grid-cols-2">
                <div class="rounded-3xl bg-emerald-100 p-6"><strong class="text-lg text-emerald-950">Menos mistura</strong><p class="mt-2 text-sm leading-6 text-emerald-900/70">Resíduos separados não contaminam outros materiais recicláveis.</p></div>
                <div class="rounded-3xl bg-lime-200 p-6"><strong class="text-lg text-emerald-950">Mais nutrientes</strong><p class="mt-2 text-sm leading-6 text-emerald-900/70">O material pode voltar ao ciclo natural e contribuir com o solo.</p></div>
                <div class="rounded-3xl bg-amber-100 p-6 sm:col-span-2"><strong class="text-lg text-emerald-950">Conexões locais</strong><p class="mt-2 text-sm leading-6 text-emerald-900/70">Moradores, parceiros e pontos de coleta colaboram em uma rede próxima e acessível.</p></div>
            </div>
        </div>
    </section>

    <section class="px-5 pb-20 sm:px-8 sm:pb-24 lg:px-10">
        <div class="mx-auto max-w-7xl overflow-hidden rounded-[2.5rem] bg-amber-200 px-6 py-12 text-center sm:px-12 sm:py-16">
            <h2 class="text-3xl font-extrabold tracking-tight text-emerald-950 sm:text-5xl">Comece pelo que já está na sua cozinha.</h2>
            <p class="mx-auto mt-5 max-w-2xl text-lg leading-8 text-emerald-950/70">Crie sua conta, separe os resíduos e faça parte de uma rede que transforma descarte em oportunidade.</p>
            <div class="mt-8 flex flex-col justify-center gap-3 sm:flex-row">
                <a href="{{ url('/register') }}" class="rounded-full bg-emerald-900 px-7 py-3.5 text-sm font-bold text-white hover:bg-emerald-800">Criar meu cadastro</a>
                <a href="{{ route('collection-points') }}" class="rounded-full border border-emerald-950/20 px-7 py-3.5 text-sm font-bold text-emerald-950 hover:bg-white/40">Ver pontos de coleta</a>
            </div>
        </div>
    </section>
@endsection
