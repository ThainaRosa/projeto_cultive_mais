@extends('layouts.resident')

@section('title', 'Editar resíduo')

@section('content')
    <div class="mx-auto max-w-2xl">
        <a href="{{ route('resident.waste-records.show', $wasteRecord) }}" class="text-sm font-bold text-emerald-700">← Voltar para o resíduo</a>
        <h1 class="mt-5 text-3xl font-extrabold text-emerald-950">Editar resíduo</h1>

        <form method="POST" action="{{ route('resident.waste-records.update', $wasteRecord) }}" class="mt-8 rounded-3xl border border-emerald-900/10 bg-white p-6 sm:p-8">
            @method('PUT')
            @include('resident.waste-records.form', ['submitLabel' => 'Salvar alterações'])
        </form>
    </div>
@endsection
