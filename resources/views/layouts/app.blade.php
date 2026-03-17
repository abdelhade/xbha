<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'مزادي') }}</title>
        <link rel="icon" href="/favicon.ico" type="image/x-icon">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Noto+Kufi+Arabic:wght@300;400;600;700;900&display=swap" rel="stylesheet">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
    </head>
    <body class="font-sans antialiased" style="background:#0f1e23;color:#f0e8cc;min-height:100vh">
        <div class="min-h-screen">
            @include('layouts.navigation')
            @isset($header)
                <header style="background:rgba(26,46,53,.6);border-bottom:1px solid rgba(46,138,153,.12);backdrop-filter:blur(8px)">
                    <div class="max-w-7xl mx-auto py-5 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset
            <main id="main-content">{{ $slot }}</main>
        </div>
        @livewireScripts
    </body>
</html>
