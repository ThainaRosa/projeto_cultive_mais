@extends('layouts.resident')

@section('title', 'Meus resíduos')

@section('content')
    <div class="flex items-end justify-between gap-5">
        <div><p class="text-sm font-bold uppercase tracking-wider text-emerald-700">Meus resíduos</p><h1 class="mt-2 text-3xl font-extrabold text-emerald-950">Registros cadastrados</h1></div>
        <a href="{{ route('resident.waste-records.create') }}" class="rounded-full bg-emerald-800 px-5 py-3 text-sm font-bold text-white hover:bg-emerald-700">Novo resíduo</a>
    </div>

    <div class="mt-8 overflow-hidden rounded-3xl border border-emerald-900/10 bg-white">
        @forelse ($wasteRecords as $wasteRecord)
            <a href="{{ route('resident.waste-records.show', $wasteRecord) }}" class="grid gap-3 border-b border-stone-100 px-6 py-5 last:border-0 hover:bg-emerald-50/50 sm:grid-cols-[1fr_auto_auto] sm:items-center sm:gap-8">
                <div><strong class="text-emerald-950">{{ $wasteRecord->wasteCategory->name }}</strong><p class="mt-1 line-clamp-1 text-sm text-stone-500">{{ $wasteRecord->description }}</p></div>
                <span class="text-sm font-semibold text-stone-600">{{ $wasteRecord->quantity }} {{ $wasteRecord->unit }}</span>
                @include('resident.partials.status-badge', ['status' => $wasteRecord->status])
            </a>
        @empty
            <div class="px-6 py-14 text-center"><h2 class="font-bold text-emerald-950">Nenhum resíduo cadastrado</h2><p class="mt-2 text-sm text-stone-500">Cadastre um resíduo orgânico para começar.</p></div>
        @endforelse
    </div>

    <div class="mt-6">{{ $wasteRecords->links() }}</div>
@endsection
