@extends('layouts.resident')

@section('title', 'Visão geral')

@section('content')
    <div class="flex flex-col gap-5 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <p class="text-sm font-bold uppercase tracking-wider text-emerald-700">Olá, {{ auth()->user()->name }}</p>
            <h1 class="mt-2 text-3xl font-extrabold tracking-tight text-emerald-950 sm:text-4xl">Sua contribuição começa aqui.</h1>
            <p class="mt-3 text-stone-600">Cadastre seus resíduos e acompanhe as solicitações de coleta.</p>
        </div>
        <a href="{{ route('resident.waste-records.create') }}" class="rounded-full bg-emerald-800 px-6 py-3 text-center text-sm font-bold text-white hover:bg-emerald-700">Cadastrar resíduo</a>
    </div>

    <div class="mt-10 grid gap-5 sm:grid-cols-3">
        <div class="rounded-3xl border border-emerald-900/10 bg-white p-6"><span class="text-sm font-semibold text-stone-500">Resíduos disponíveis</span><strong class="mt-3 block text-4xl text-emerald-800">{{ $availableWasteCount }}</strong></div>
        <div class="rounded-3xl border border-emerald-900/10 bg-white p-6"><span class="text-sm font-semibold text-stone-500">Aguardando coleta</span><strong class="mt-3 block text-4xl text-amber-600">{{ $requestedWasteCount }}</strong></div>
        <div class="rounded-3xl border border-emerald-900/10 bg-white p-6"><span class="text-sm font-semibold text-stone-500">Solicitações pendentes</span><strong class="mt-3 block text-4xl text-emerald-950">{{ $pendingRequestCount }}</strong></div>
    </div>

    <section class="mt-10 overflow-hidden rounded-3xl border border-emerald-900/10 bg-white">
        <div class="flex items-center justify-between border-b border-stone-100 px-6 py-5">
            <h2 class="text-lg font-bold text-emerald-950">Resíduos recentes</h2>
            <a href="{{ route('resident.waste-records.index') }}" class="text-sm font-bold text-emerald-700 hover:text-emerald-600">Ver todos</a>
        </div>
        @forelse ($recentWasteRecords as $wasteRecord)
            <a href="{{ route('resident.waste-records.show', $wasteRecord) }}" class="flex items-center justify-between gap-4 border-b border-stone-100 px-6 py-5 last:border-0 hover:bg-emerald-50/50">
                <div><strong class="block text-emerald-950">{{ $wasteRecord->wasteCategory->name }}</strong><span class="mt-1 block text-sm text-stone-500">{{ $wasteRecord->quantity }} {{ $wasteRecord->unit }}</span></div>
                @include('resident.partials.status-badge', ['status' => $wasteRecord->status])
            </a>
        @empty
            <div class="px-6 py-12 text-center"><p class="text-stone-500">Você ainda não cadastrou resíduos.</p><a href="{{ route('resident.waste-records.create') }}" class="mt-3 inline-flex font-bold text-emerald-700">Cadastrar o primeiro</a></div>
        @endforelse
    </section>
@endsection
