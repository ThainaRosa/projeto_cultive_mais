@extends('layouts.partner')

@section('title', 'Visão geral')

@section('content')
    <div class="flex flex-col gap-5 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <p class="text-sm font-bold uppercase tracking-wider text-teal-700">Olá, {{ auth()->user()->name }}</p>
            <h1 class="mt-2 text-3xl font-extrabold tracking-tight text-teal-950 sm:text-4xl">Coletas ao seu alcance.</h1>
            <p class="mt-3 text-slate-600">Encontre solicitações, organize datas e acompanhe suas coletas.</p>
        </div>
        <a href="{{ route('partner.collection-requests.pending') }}" class="rounded-full bg-teal-800 px-6 py-3 text-center text-sm font-bold text-white hover:bg-teal-700">Ver solicitações pendentes</a>
    </div>

    <div class="mt-10 grid gap-5 sm:grid-cols-3">
        <div class="rounded-3xl border border-teal-900/10 bg-white p-6"><span class="text-sm font-semibold text-slate-500">Solicitações pendentes</span><strong class="mt-3 block text-4xl text-amber-600">{{ $pendingCount }}</strong></div>
        <div class="rounded-3xl border border-teal-900/10 bg-white p-6"><span class="text-sm font-semibold text-slate-500">Solicitações aceitas</span><strong class="mt-3 block text-4xl text-blue-700">{{ $acceptedCount }}</strong></div>
        <div class="rounded-3xl border border-teal-900/10 bg-white p-6"><span class="text-sm font-semibold text-slate-500">Coletas concluídas</span><strong class="mt-3 block text-4xl text-emerald-700">{{ $completedCount }}</strong></div>
    </div>

    <section class="mt-10 overflow-hidden rounded-3xl border border-teal-900/10 bg-white">
        <div class="flex items-center justify-between border-b border-slate-100 px-6 py-5">
            <h2 class="text-lg font-bold text-teal-950">Novas solicitações</h2>
            <a href="{{ route('partner.collection-requests.pending') }}" class="text-sm font-bold text-teal-700 hover:text-teal-600">Ver todas</a>
        </div>
        @forelse ($recentPendingRequests as $collectionRequest)
            <a href="{{ route('partner.collection-requests.show', $collectionRequest) }}" class="flex items-center justify-between gap-4 border-b border-slate-100 px-6 py-5 last:border-0 hover:bg-teal-50/50">
                <div><strong class="block text-teal-950">{{ $collectionRequest->wasteRecord->wasteCategory->name }}</strong><span class="mt-1 block text-sm text-slate-500">{{ $collectionRequest->wasteRecord->quantity }} {{ $collectionRequest->wasteRecord->unit }} · {{ $collectionRequest->resident->name }}</span></div>
                @include('partner.partials.status-badge', ['status' => $collectionRequest->status])
            </a>
        @empty
            <div class="px-6 py-12 text-center"><p class="text-slate-500">Não há solicitações pendentes no momento.</p></div>
        @endforelse
    </section>
@endsection
