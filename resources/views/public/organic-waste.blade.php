@extends('layouts.public')

@section('title', 'Sobre resíduos orgânicos — Cultive Mais')
@section('description', 'Saiba quais resíduos orgânicos podem ser separados e por que dar um destino melhor a eles.')

@section('content')
    <section class="relative overflow-hidden bg-amber-100">
        <div class="absolute -right-20 -top-24 size-80 rounded-full bg-lime-300/50" aria-hidden="true"></div>
        <div class="relative mx-auto max-w-7xl px-5 py-20 sm:px-8 sm:py-28 lg:px-10">
            <p class="text-sm font-bold uppercase tracking-[0.2em] text-emerald-700">Conhecer para separar</p>
            <h1 class="mt-5 max-w-4xl text-4xl font-extrabold tracking-tight text-emerald-950 sm:text-6xl">Resíduos orgânicos ainda têm muito a oferecer.</h1>
            <p class="mt-6 max-w-2xl text-lg leading-8 text-emerald-950/70">São materiais de origem vegetal ou animal que podem se decompor naturalmente. Quando separados, podem ganhar destinos mais úteis do que o lixo comum.</p>
        </div>
    </section>

    <section class="py-20 sm:py-24">
        <div class="mx-auto grid max-w-7xl gap-10 px-5 sm:px-8 lg:grid-cols-[0.8fr_1.2fr] lg:px-10">
            <div>
                <p class="text-sm font-bold uppercase tracking-wider text-emerald-700">O que separar</p>
                <h2 class="mt-4 text-3xl font-extrabold text-emerald-950 sm:text-4xl">Materiais que fazem parte do dia a dia.</h2>
                <p class="mt-5 leading-7 text-stone-600">Comece pelos resíduos vegetais mais comuns e mantenha-os separados de embalagens, plásticos e produtos químicos.</p>
            </div>
            <div class="grid gap-4 sm:grid-cols-2">
                @foreach ([
                    ['🍎', 'Restos de frutas e verduras'],
                    ['🥑', 'Cascas e sementes'],
                    ['☕', 'Borra e filtro de café'],
                    ['🍂', 'Folhas e resíduos de jardim'],
                    ['🥚', 'Outros resíduos orgânicos'],
                ] as [$icon, $label])
                    <div class="flex items-center gap-4 rounded-2xl border border-emerald-900/10 bg-white p-5">
                        <span class="text-2xl" aria-hidden="true">{{ $icon }}</span>
                        <strong class="text-emerald-950">{{ $label }}</strong>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="bg-white py-20 sm:py-24">
        <div class="mx-auto max-w-7xl px-5 sm:px-8 lg:px-10">
            <div class="grid gap-6 md:grid-cols-3">
                <article class="rounded-3xl bg-[#f7f8f2] p-7"><span class="text-sm font-extrabold text-emerald-600">01</span><h2 class="mt-5 text-xl font-bold text-emerald-950">Evite contaminação</h2><p class="mt-3 leading-7 text-stone-600">Não misture vidro, metal, plástico, produtos de limpeza ou outros materiais não orgânicos.</p></article>
                <article class="rounded-3xl bg-[#f7f8f2] p-7"><span class="text-sm font-extrabold text-emerald-600">02</span><h2 class="mt-5 text-xl font-bold text-emerald-950">Armazene com cuidado</h2><p class="mt-3 leading-7 text-stone-600">Use um recipiente fechado e mantenha-o limpo até combinar a coleta ou levar ao ponto indicado.</p></article>
                <article class="rounded-3xl bg-[#f7f8f2] p-7"><span class="text-sm font-extrabold text-emerald-600">03</span><h2 class="mt-5 text-xl font-bold text-emerald-950">Informe corretamente</h2><p class="mt-3 leading-7 text-stone-600">Ao cadastrar, descreva o conteúdo e a quantidade aproximada para facilitar o planejamento.</p></article>
            </div>
        </div>
    </section>

    <section class="py-20 sm:py-24">
        <div class="mx-auto max-w-5xl rounded-[2.5rem] bg-emerald-900 px-6 py-12 text-center text-white sm:px-12 sm:py-16">
            <p class="text-sm font-bold uppercase tracking-wider text-lime-300">Destino melhor</p>
            <h2 class="mt-4 text-3xl font-extrabold sm:text-4xl">Separar é o primeiro passo do reaproveitamento.</h2>
            <p class="mx-auto mt-5 max-w-2xl leading-7 text-emerald-100/75">A matéria orgânica pode contribuir para processos como compostagem, devolvendo nutrientes ao solo e fortalecendo ciclos mais sustentáveis.</p>
            <a href="{{ route('how-it-works') }}" class="mt-8 inline-flex rounded-full bg-lime-300 px-7 py-3.5 text-sm font-bold text-emerald-950 hover:bg-lime-200">Veja como participar</a>
        </div>
    </section>
@endsection
