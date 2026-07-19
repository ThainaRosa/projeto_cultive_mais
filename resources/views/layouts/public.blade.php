<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="@yield('description', 'Cultive Mais conecta moradores e parceiros para dar um destino melhor aos resíduos orgânicos.')">

        <title>@yield('title', 'Cultive Mais')</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen bg-[#f7f8f2] font-sans text-stone-800 antialiased">
        <div class="flex min-h-screen flex-col">
            @include('partials.public-header')

            <main class="flex-1">
                @yield('content')
            </main>

            @include('partials.public-footer')
        </div>
    </body>
</html>
