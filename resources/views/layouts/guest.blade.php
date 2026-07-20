<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Cultive Mais') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-stone-900 antialiased">
        <div class="flex min-h-screen flex-col items-center bg-emerald-50 px-4 pb-8 pt-8 sm:justify-center sm:pt-8">
            <div>
                <a href="{{ route('home') }}" class="flex items-center gap-3" aria-label="Voltar para a página inicial">
                    <span class="flex size-12 items-center justify-center rounded-full bg-emerald-800 text-white">
                        <svg class="size-7" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M19.5 4.5C12.8 4.5 7 7.2 7 13.2c0 1 .2 1.9.6 2.7 2.8-3.7 6.2-5.8 9.9-7.1-3.2 1.8-5.9 4.4-7.9 7.7 1 .7 2.2 1 3.5 1 5.6 0 7.4-5.8 6.4-13Z"/></svg>
                    </span>
                    <span class="text-xl font-extrabold text-emerald-950">Cultive Mais</span>
                </a>
            </div>

            <div class="mt-7 w-full overflow-hidden rounded-3xl border border-emerald-900/10 bg-white px-6 py-7 shadow-xl shadow-emerald-950/5 sm:max-w-md sm:px-8">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
