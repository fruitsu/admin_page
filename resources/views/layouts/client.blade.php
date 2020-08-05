<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,600&display=swap&subset=cyrillic" rel="stylesheet">

    <link href="{{ asset('css/client.css') }}" rel="stylesheet">
    @stack('styles')
</head>
<body>
<div id="app" class="d-flex flex-column min-vh-100" v-cloak>
    <main class="flex-grow-1">
        @yield('content')
    </main>
</div>

<script src="{{ asset('js/client.js') }}" defer></script>
@stack('scripts')
</body>
</html>
