@extends('layouts.resident')

@section('title', 'Minhas solicitações')

@section('content')
    <div><p class="text-sm font-bold uppercase tracking-wider text-emerald-700">Coletas</p><h1 class="mt-2 text-3xl font-extrabold text-emerald-950">Minhas solicitações</h1><p class="mt-3 text-stone-600">Acompanhe o andamento das coletas solicitadas.</p></div>

    <div class="mt-8 overflow-hidden rounded-3xl border border-emerald-900/10 bg-white">
        @forelse ($collectionRequests as $collectionRequest)
            <a href="{{ route('resident.collection-requests.show', $collectionRequest) }}" class="grid gap-3 border-b border-stone-100 px-6 py-5 last:border-0 hover:bg-emerald-50/50 sm:grid-cols-[1fr_auto_auto] sm:items-center sm:gap-8">
                <div><strong class="text-emerald-950">{{ $collectionRequest->wasteRecord->wasteCategory->name }}</strong><p class="mt-1 text-sm text-stone-500">Solicitada em {{ $collectionRequest->created_at->format('d/m/Y') }}</p></div>
                <span class="text-sm font-semibold text-stone-600">{{ $collectionRequest->wasteRecord->quantity }} {{ $collectionRequest->wasteRecord->unit }}</span>
                @include('resident.partials.status-badge', ['status' => $collectionRequest->status])
            </a>
        @empty
            <div class="px-6 py-14 text-center"><h2 class="font-bold text-emerald-950">Nenhuma solicitação</h2><p class="mt-2 text-sm text-stone-500">Solicitações criadas a partir dos seus resíduos aparecerão aqui.</p></div>
        @endforelse
    </div>

    <div class="mt-6">{{ $collectionRequests->links() }}</div>
@endsection
