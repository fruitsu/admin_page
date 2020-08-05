<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="locales" content="{{ json_encode(config('app.locales')) }}">

    <title>{{ config('app.name') . (isset($page_title) ? ' | ' . $page_title : '') }}</title>

    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Fira+Sans:100,300,400,400i,700,700i&amp;subset=cyrillic"
          rel="stylesheet">

    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    @stack('styles')
</head>
<body>
@includeIf('partials.admin.icons')

<div id="app" v-cloak>
    @includeIf('partials.admin.header')
    @includeIf('partials.admin.aside')
    @includeIf('partials.admin.messages')

    <main>
        @yield('content')
    </main>
</div>

<script src="{{ asset('js/admin.js') }}" defer></script>
@stack('scripts')
</body>
</html>
