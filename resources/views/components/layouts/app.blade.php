<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', request()->cookie('language')) }}" data-theme="{{ request()->cookie('theme') ?? 'dark' }}"
      @if(request()->cookie('theme') === 'dark') class="dark" @endif>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ config('app.name') }} | {{ $title ?? '' }}</title>

    <link rel="icon" type="image/svg" href="{{ asset('img/Logo.svg') }}">

    @vite('resources/css/app.css')
    @livewireStyles
    @livewireScripts
</head>
<body class="antialiased flex flex-col min-h-screen">

<x-navigation.sidebar :content="$slot"/>

<x-navigation.footer/>

@vite('resources/js/app.js')

</body>
</html>
