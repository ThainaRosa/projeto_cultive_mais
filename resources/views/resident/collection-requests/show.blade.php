@extends('layouts.resident')

@section('title', 'Status da solicitação')

@section('content')
    <div class="mx-auto max-w-3xl">
        <a href="{{ route('resident.collection-requests.index') }}" class="text-sm font-bold text-emerald-700">← Voltar para solicitações</a>

        <div class="mt-6 rounded-3xl border border-emerald-900/10 bg-white p-6 sm:p-9">
            <div class="flex items-start justify-between gap-5"><div><p class="text-sm font-semibold text-stone-500">Solicitação #{{ $collectionRequest->id }}</p><h1 class="mt-2 text-3xl font-extrabold text-emerald-950">Status da coleta</h1></div>@include('resident.partials.status-badge', ['status' => $collectionRequest->status])</div>

            <dl class="mt-8 grid gap-6 border-t border-stone-100 pt-7 sm:grid-cols-2">
                <div><dt class="text-xs font-bold uppercase tracking-wider text-stone-500">Resíduo</dt><dd class="mt-2 font-semibold text-emerald-950">{{ $collectionRequest->wasteRecord->wasteCategory->name }}</dd><dd class="mt-1 text-sm text-stone-600">{{ $collectionRequest->wasteRecord->quantity }} {{ $collectionRequest->wasteRecord->unit }}</dd></div>
                <div><dt class="text-xs font-bold uppercase tracking-wider text-stone-500">Data da solicitação</dt><dd class="mt-2 font-semibold text-emerald-950">{{ $collectionRequest->requested_date?->format('d/m/Y') ?? 'Não informada' }}</dd></div>
                <div><dt class="text-xs font-bold uppercase tracking-wider text-stone-500">Data agendada</dt><dd class="mt-2 font-semibold text-emerald-950">{{ $collectionRequest->scheduled_date?->format('d/m/Y') ?? 'A definir' }}</dd></div>
                <div><dt class="text-xs font-bold uppercase tracking-wider text-stone-500">Parceiro</dt><dd class="mt-2 font-semibold text-emerald-950">{{ $collectionRequest->partner?->name ?? 'Aguardando parceiro' }}</dd></div>
                @if ($collectionRequest->collectionPoint)
                    <div class="sm:col-span-2"><dt class="text-xs font-bold uppercase tracking-wider text-stone-500">Ponto de coleta</dt><dd class="mt-2 font-semibold text-emerald-950">{{ $collectionRequest->collectionPoint->name }}</dd></div>
                @endif
                @if ($collectionRequest->notes)
                    <div class="sm:col-span-2"><dt class="text-xs font-bold uppercase tracking-wider text-stone-500">Observações</dt><dd class="mt-2 leading-7 text-stone-700">{{ $collectionRequest->notes }}</dd></div>
                @endif
            </dl>

            @if (! in_array($collectionRequest->status, [\App\Models\CollectionRequest::STATUS_COMPLETED, \App\Models\CollectionRequest::STATUS_CANCELLED], true))
                <form method="POST" action="{{ route('resident.collection-requests.cancel', $collectionRequest) }}" class="mt-8 border-t border-stone-100 pt-6" onsubmit="return confirm('Deseja cancelar esta solicitação?')">
                    @csrf
                    @method('PATCH')
                    <button class="rounded-full border border-red-200 px-5 py-3 text-sm font-bold text-red-700 hover:bg-red-50">Cancelar solicitação</button>
                </form>
            @endif
        </div>
    </div>
@endsection
