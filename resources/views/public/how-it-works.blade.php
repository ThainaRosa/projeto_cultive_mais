@extends('layouts.public')

@section('title', 'Como funciona — Cultive Mais')
@section('description', 'Veja como moradores e parceiros usam o Cultive Mais para organizar o destino de resíduos orgânicos.')

@section('content')
    <section class="bg-emerald-950 text-white">
        <div class="mx-auto max-w-7xl px-5 py-20 sm:px-8 sm:py-28 lg:px-10">
            <p class="text-sm font-bold uppercase tracking-[0.2em] text-lime-300">Simples do início ao fim</p>
            <h1 class="mt-5 max-w-4xl text-4xl font-extrabold tracking-tight sm:text-6xl">Da separação em casa ao destino responsável.</h1>
            <p class="mt-6 max-w-2xl text-lg leading-8 text-emerald-100/75">O Cultive Mais organiza a conexão entre quem tem resíduos orgânicos disponíveis e quem pode coletá-los.</p>
        </div>
    </section>

    <section class="py-20 sm:py-24">
        <div class="mx-auto max-w-5xl px-5 sm:px-8">
            <div class="space-y-5">
                @foreach ([
                    ['01', 'Separe os resíduos', 'Reserve restos de frutas, verduras, cascas, sementes, borra de café e resíduos de jardim em um recipiente adequado.'],
                    ['02', 'Cadastre o que está disponível', 'O morador informa a categoria, descreve o material e registra a quantidade aproximada.'],
                    ['03', 'Combine a coleta', 'Parceiros consultam os resíduos disponíveis e podem organizar a retirada ou indicar um ponto de coleta.'],
                    ['04', 'Conclua o ciclo', 'Depois da coleta, o registro é finalizado e o resíduo segue para um destino de reaproveitamento.'],
                ] as [$number, $title, $text])
                    <article class="grid gap-5 rounded-3xl border border-emerald-900/10 bg-white p-6 shadow-sm sm:grid-cols-[90px_1fr] sm:items-center sm:p-8">
                        <span class="text-4xl font-extrabold text-emerald-200">{{ $number }}</span>
                        <div><h2 class="text-xl font-bold text-emerald-950">{{ $title }}</h2><p class="mt-2 leading-7 text-stone-600">{{ $text }}</p></div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="bg-white py-20">
        <div class="mx-auto grid max-w-7xl gap-6 px-5 sm:px-8 md:grid-cols-2 lg:px-10">
            <article class="rounded-[2rem] bg-emerald-100 p-8 sm:p-10">
                <p class="text-sm font-bold uppercase tracking-wider text-emerald-700">Para moradores</p>
                <h2 class="mt-3 text-3xl font-extrabold text-emerald-950">Separe e informe.</h2>
                <p class="mt-4 leading-7 text-stone-600">O cadastro ajuda parceiros a entender o material disponível e planejar uma coleta compatível.</p>
            </article>
            <article class="rounded-[2rem] bg-emerald-900 p-8 text-white sm:p-10">
                <p class="text-sm font-bold uppercase tracking-wider text-lime-300">Para parceiros</p>
                <h2 class="mt-3 text-3xl font-extrabold">Encontre e colete.</h2>
                <p class="mt-4 leading-7 text-emerald-100/75">Os registros facilitam a identificação de oportunidades de coleta perto da área de atuação.</p>
            </article>
        </div>
    </section>

    <section class="px-5 py-20 text-center sm:px-8">
        <h2 class="text-3xl font-extrabold text-emerald-950">Pronto para começar?</h2>
        <p class="mx-auto mt-4 max-w-xl leading-7 text-stone-600">Cadastre-se gratuitamente e participe da rede Cultive Mais.</p>
        <a href="{{ url('/register') }}" class="mt-7 inline-flex rounded-full bg-emerald-800 px-7 py-3.5 text-sm font-bold text-white hover:bg-emerald-700">Criar cadastro</a>
    </section>
@endsection
