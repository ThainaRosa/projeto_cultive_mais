@extends('layouts.public')

@section('title', 'Pontos de coleta — Cultive Mais')
@section('description', 'Consulte os pontos de coleta de resíduos orgânicos disponíveis em Cotia.')

@section('content')
    <section class="bg-emerald-100">
        <div class="mx-auto grid max-w-7xl gap-8 px-5 py-20 sm:px-8 sm:py-24 lg:grid-cols-[1fr_auto] lg:items-end lg:px-10">
            <div>
                <p class="text-sm font-bold uppercase tracking-[0.2em] text-emerald-700">Mais perto de você</p>
                <h1 class="mt-5 max-w-3xl text-4xl font-extrabold tracking-tight text-emerald-950 sm:text-6xl">Pontos de coleta em Cotia.</h1>
                <p class="mt-6 max-w-2xl text-lg leading-8 text-emerald-950/65">Confira os locais disponíveis e escolha a opção mais conveniente para entregar seus resíduos orgânicos.</p>
            </div>
            <div class="flex items-center gap-3 rounded-2xl bg-white/70 px-5 py-4 text-sm font-semibold text-emerald-900">
                <span class="size-3 rounded-full bg-lime-500"></span>
                {{ $collectionPoints->count() }} {{ $collectionPoints->count() === 1 ? 'ponto ativo' : 'pontos ativos' }}
            </div>
        </div>
    </section>

    <section class="py-20 sm:py-24">
        <div class="mx-auto max-w-7xl px-5 sm:px-8 lg:px-10">
            <div class="grid gap-6 lg:grid-cols-3">
                @forelse ($collectionPoints as $point)
                    <article class="flex flex-col rounded-3xl border border-emerald-900/10 bg-white p-7 shadow-sm">
                        <div class="flex items-start justify-between gap-4">
                            <span class="flex size-12 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-800">
                                <svg class="size-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M20 10c0 5-8 11-8 11S4 15 4 10a8 8 0 1 1 16 0Z"/><circle cx="12" cy="10" r="2.5"/></svg>
                            </span>
                            <span class="rounded-full bg-lime-100 px-3 py-1 text-xs font-bold text-emerald-800">Ativo</span>
                        </div>
                        <h2 class="mt-6 text-xl font-bold text-emerald-950">{{ $point->name }}</h2>
                        <p class="mt-3 leading-7 text-stone-600">{{ $point->address }}<br>{{ $point->neighborhood }} — {{ $point->city }}/{{ $point->state }}</p>
                        <dl class="mt-6 space-y-3 border-t border-stone-100 pt-5 text-sm">
                            <div><dt class="font-bold text-emerald-950">Horário</dt><dd class="mt-1 text-stone-600">{{ $point->opening_hours ?: 'Não informado' }}</dd></div>
                            <div><dt class="font-bold text-emerald-950">Telefone</dt><dd class="mt-1 text-stone-600">{{ $point->phone ?: 'Não informado' }}</dd></div>
                        </dl>
                    </article>
                @empty
                    <div class="rounded-3xl border border-dashed border-emerald-900/20 bg-white p-10 text-center lg:col-span-3">
                        <h2 class="text-xl font-bold text-emerald-950">Nenhum ponto disponível no momento</h2>
                        <p class="mt-3 text-stone-600">Novos locais serão exibidos aqui assim que estiverem ativos.</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-10 rounded-3xl bg-amber-100 p-6 sm:flex sm:items-center sm:justify-between sm:gap-8 sm:p-8">
                <div><h2 class="text-lg font-bold text-emerald-950">Antes de sair de casa</h2><p class="mt-2 text-sm leading-6 text-emerald-950/65">Confirme o horário de atendimento e leve os resíduos bem acondicionados.</p></div>
                <a href="{{ route('organic-waste') }}" class="mt-5 inline-flex shrink-0 font-bold text-emerald-800 sm:mt-0">Veja o que separar →</a>
            </div>
        </div>
    </section>
@endsection
