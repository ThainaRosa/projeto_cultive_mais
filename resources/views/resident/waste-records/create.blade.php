@extends('layouts.resident')

@section('title', 'Cadastrar resíduo')

@section('content')
    <div class="mx-auto max-w-2xl">
        <a href="{{ route('resident.waste-records.index') }}" class="text-sm font-bold text-emerald-700">← Voltar para meus resíduos</a>
        <h1 class="mt-5 text-3xl font-extrabold text-emerald-950">Cadastrar resíduo</h1>
        <p class="mt-2 text-stone-600">Informe os dados básicos do material que está disponível.</p>

        <form method="POST" action="{{ route('resident.waste-records.store') }}" class="mt-8 rounded-3xl border border-emerald-900/10 bg-white p-6 sm:p-8">
            @include('resident.waste-records.form', ['wasteRecord' => null, 'submitLabel' => 'Cadastrar resíduo'])
        </form>
    </div>
@endsection
