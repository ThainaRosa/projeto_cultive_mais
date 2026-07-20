@extends('layouts.partner')

@section('title', 'Detalhes da solicitação')

@section('content')
    <div class="mx-auto max-w-3xl">
        <a href="{{ $collectionRequest->status === \App\Models\CollectionRequest::STATUS_PENDING ? route('partner.collection-requests.pending') : route('partner.collection-requests.accepted') }}" class="text-sm font-bold text-teal-700">← Voltar para solicitações</a>

        <div class="mt-6 rounded-3xl border border-teal-900/10 bg-white p-6 sm:p-9">
            <div class="flex items-start justify-between gap-5"><div><p class="text-sm font-semibold text-slate-500">Solicitação #{{ $collectionRequest->id }}</p><h1 class="mt-2 text-3xl font-extrabold text-teal-950">Detalhes da coleta</h1></div>@include('partner.partials.status-badge', ['status' => $collectionRequest->status])</div>

            <dl class="mt-8 grid gap-6 border-t border-slate-100 pt-7 sm:grid-cols-2">
                <div><dt class="text-xs font-bold uppercase tracking-wider text-slate-500">Morador</dt><dd class="mt-2 font-semibold text-teal-950">{{ $collectionRequest->resident->name }}</dd></div>
                <div><dt class="text-xs font-bold uppercase tracking-wider text-slate-500">Solicitado em</dt><dd class="mt-2 font-semibold text-teal-950">{{ $collectionRequest->requested_date?->format('d/m/Y') ?? $collectionRequest->created_at->format('d/m/Y') }}</dd></div>
                <div><dt class="text-xs font-bold uppercase tracking-wider text-slate-500">Resíduo</dt><dd class="mt-2 font-semibold text-teal-950">{{ $collectionRequest->wasteRecord->wasteCategory->name }}</dd><dd class="mt-1 text-sm text-slate-600">{{ $collectionRequest->wasteRecord->description }}</dd></div>
                <div><dt class="text-xs font-bold uppercase tracking-wider text-slate-500">Quantidade</dt><dd class="mt-2 font-semibold text-teal-950">{{ $collectionRequest->wasteRecord->quantity }} {{ $collectionRequest->wasteRecord->unit }}</dd></div>
                @if ($collectionRequest->scheduled_date)
                    <div><dt class="text-xs font-bold uppercase tracking-wider text-slate-500">Data da coleta</dt><dd class="mt-2 font-semibold text-teal-950">{{ $collectionRequest->scheduled_date->format('d/m/Y') }}</dd></div>
                @endif
                @if ($collectionRequest->collectionPoint)
                    <div><dt class="text-xs font-bold uppercase tracking-wider text-slate-500">Ponto de coleta</dt><dd class="mt-2 font-semibold text-teal-950">{{ $collectionRequest->collectionPoint->name }}</dd></div>
                @endif
            </dl>

            @if ($collectionRequest->status === \App\Models\CollectionRequest::STATUS_PENDING)
                <form method="POST" action="{{ route('partner.collection-requests.accept', $collectionRequest) }}" class="mt-8 border-t border-slate-100 pt-7">
                    @csrf
                    <label for="scheduled_date" class="block text-sm font-bold text-teal-950">Data prevista para coleta</label>
                    <div class="mt-3 flex flex-col gap-3 sm:flex-row">
                        <div class="flex-1"><input id="scheduled_date" name="scheduled_date" type="date" min="{{ now()->toDateString() }}" value="{{ old('scheduled_date') }}" required class="block w-full rounded-xl border-slate-300 focus:border-teal-600 focus:ring-teal-600">@error('scheduled_date') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror</div>
                        <button class="rounded-full bg-teal-800 px-6 py-3 text-sm font-bold text-white hover:bg-teal-700">Aceitar solicitação</button>
                    </div>
                </form>
            @elseif ($collectionRequest->status === \App\Models\CollectionRequest::STATUS_ACCEPTED)
                <div class="mt-8 flex flex-col gap-3 border-t border-slate-100 pt-7 sm:flex-row">
                    <form method="POST" action="{{ route('partner.collection-requests.complete', $collectionRequest) }}" onsubmit="return confirm('Confirmar que a coleta foi concluída?')">
                        @csrf
                        @method('PATCH')
                        <button class="w-full rounded-full bg-teal-800 px-6 py-3 text-sm font-bold text-white hover:bg-teal-700">Marcar como concluída</button>
                    </form>
                    <form method="POST" action="{{ route('partner.collection-requests.cancel', $collectionRequest) }}" onsubmit="return confirm('Deseja cancelar esta coleta?')">
                        @csrf
                        @method('PATCH')
                        <button class="w-full rounded-full border border-red-200 px-6 py-3 text-sm font-bold text-red-700 hover:bg-red-50">Cancelar coleta</button>
                    </form>
                </div>
            @endif
        </div>
    </div>
@endsection
