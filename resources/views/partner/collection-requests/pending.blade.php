@extends('layouts.partner')

@section('title', 'Solicitações pendentes')

@section('content')
    <div><p class="text-sm font-bold uppercase tracking-wider text-teal-700">Oportunidades de coleta</p><h1 class="mt-2 text-3xl font-extrabold text-teal-950">Solicitações pendentes</h1><p class="mt-3 text-slate-600">Escolha uma solicitação disponível para consultar os detalhes e informar a data da coleta.</p></div>

    <div class="mt-8 overflow-hidden rounded-3xl border border-teal-900/10 bg-white">
        @forelse ($collectionRequests as $collectionRequest)
            <a href="{{ route('partner.collection-requests.show', $collectionRequest) }}" class="grid gap-3 border-b border-slate-100 px-6 py-5 last:border-0 hover:bg-teal-50/50 sm:grid-cols-[1fr_auto_auto] sm:items-center sm:gap-8">
                <div><strong class="text-teal-950">{{ $collectionRequest->wasteRecord->wasteCategory->name }}</strong><p class="mt-1 text-sm text-slate-500">{{ $collectionRequest->resident->name }} · solicitada em {{ $collectionRequest->created_at->format('d/m/Y') }}</p></div>
                <span class="text-sm font-semibold text-slate-600">{{ $collectionRequest->wasteRecord->quantity }} {{ $collectionRequest->wasteRecord->unit }}</span>
                @include('partner.partials.status-badge', ['status' => $collectionRequest->status])
            </a>
        @empty
            <div class="px-6 py-14 text-center"><h2 class="font-bold text-teal-950">Nenhuma solicitação pendente</h2><p class="mt-2 text-sm text-slate-500">Novas solicitações aparecerão aqui.</p></div>
        @endforelse
    </div>

    <div class="mt-6">{{ $collectionRequests->links() }}</div>
@endsection
