@extends('layouts.resident')

@section('title', 'Detalhes do resíduo')

@section('content')
    <div class="mx-auto max-w-3xl">
        <a href="{{ route('resident.waste-records.index') }}" class="text-sm font-bold text-emerald-700">← Voltar para meus resíduos</a>

        <div class="mt-6 rounded-3xl border border-emerald-900/10 bg-white p-6 sm:p-9">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
                <div><p class="text-sm font-semibold text-stone-500">{{ $wasteRecord->wasteCategory->name }}</p><h1 class="mt-2 text-3xl font-extrabold text-emerald-950">{{ $wasteRecord->quantity }} {{ $wasteRecord->unit }}</h1></div>
                @include('resident.partials.status-badge', ['status' => $wasteRecord->status])
            </div>
            <div class="mt-8 border-t border-stone-100 pt-6"><h2 class="text-sm font-bold uppercase tracking-wider text-stone-500">Descrição</h2><p class="mt-3 whitespace-pre-line leading-7 text-stone-700">{{ $wasteRecord->description }}</p></div>
            <p class="mt-6 text-xs text-stone-400">Cadastrado em {{ $wasteRecord->created_at->format('d/m/Y \à\s H:i') }}</p>

            <div class="mt-8 flex flex-col gap-3 border-t border-stone-100 pt-6 sm:flex-row sm:flex-wrap">
                @if ($wasteRecord->status !== \App\Models\WasteRecord::STATUS_COLLECTED)
                    <a href="{{ route('resident.waste-records.edit', $wasteRecord) }}" class="rounded-full border border-emerald-800 px-5 py-3 text-center text-sm font-bold text-emerald-800 hover:bg-emerald-50">Editar</a>
                @endif
                @if ($wasteRecord->status === \App\Models\WasteRecord::STATUS_AVAILABLE)
                    <form method="POST" action="{{ route('resident.collection-requests.store', $wasteRecord) }}">
                        @csrf
                        <button class="w-full rounded-full bg-emerald-800 px-5 py-3 text-sm font-bold text-white hover:bg-emerald-700">Solicitar coleta</button>
                    </form>
                    <form method="POST" action="{{ route('resident.waste-records.cancel', $wasteRecord) }}" onsubmit="return confirm('Deseja cancelar este resíduo?')">
                        @csrf
                        @method('PATCH')
                        <button class="w-full rounded-full px-5 py-3 text-sm font-bold text-red-700 hover:bg-red-50">Cancelar resíduo</button>
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection
