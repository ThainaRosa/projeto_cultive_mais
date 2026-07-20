@extends('layouts.partner')

@section('title', 'Minhas coletas')

@section('content')
    <div><p class="text-sm font-bold uppercase tracking-wider text-teal-700">Agenda</p><h1 class="mt-2 text-3xl font-extrabold text-teal-950">Solicitações aceitas</h1><p class="mt-3 text-slate-600">Acompanhe as coletas que estão sob sua responsabilidade.</p></div>

    <div class="mt-8 overflow-hidden rounded-3xl border border-teal-900/10 bg-white">
        @forelse ($collectionRequests as $collectionRequest)
            <a href="{{ route('partner.collection-requests.show', $collectionRequest) }}" class="grid gap-3 border-b border-slate-100 px-6 py-5 last:border-0 hover:bg-teal-50/50 sm:grid-cols-[1fr_auto_auto] sm:items-center sm:gap-8">
                <div><strong class="text-teal-950">{{ $collectionRequest->wasteRecord->wasteCategory->name }}</strong><p class="mt-1 text-sm text-slate-500">{{ $collectionRequest->resident->name }} · {{ $collectionRequest->wasteRecord->quantity }} {{ $collectionRequest->wasteRecord->unit }}</p></div>
                <span class="text-sm font-semibold text-slate-600">{{ $collectionRequest->scheduled_date?->format('d/m/Y') }}</span>
                @include('partner.partials.status-badge', ['status' => $collectionRequest->status])
            </a>
        @empty
            <div class="px-6 py-14 text-center"><h2 class="font-bold text-teal-950">Nenhuma coleta aceita</h2><p class="mt-2 text-sm text-slate-500">Aceite uma solicitação pendente para começar.</p><a href="{{ route('partner.collection-requests.pending') }}" class="mt-3 inline-flex font-bold text-teal-700">Ver pendentes</a></div>
        @endforelse
    </div>

    <div class="mt-6">{{ $collectionRequests->links() }}</div>
@endsection
