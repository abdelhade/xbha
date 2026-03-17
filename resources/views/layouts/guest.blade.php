<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" href="/favicon.ico" type="image/x-icon">
        <title>مزادي</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link href="https://fonts.googleapis.com/css2?family=Noto+Kufi+Arabic:wght@300;400;600;700;900&display=swap" rel="stylesheet">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased" style="background:#0f1e23;min-height:100vh">

        <!-- Background pattern -->
        <div style="position:fixed;inset:0;background:radial-gradient(ellipse at 30% 20%,rgba(46,138,153,.15) 0%,transparent 60%),radial-gradient(ellipse at 70% 80%,rgba(244,124,81,.08) 0%,transparent 60%);pointer-events:none;z-index:0"></div>

        <div class="relative z-10 min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 px-4">

            <!-- Logo -->
            <div class="mb-8 text-center">
                <a href="/" style="font-size:2rem;font-weight:900;color:#f0e8cc;letter-spacing:0;text-decoration:none">
                    Mazadi <span style="color:#f47c51">✦</span>
                </a>
                <p style="color:rgba(240,232,204,.4);font-size:.8rem;margin-top:.25rem;letter-spacing:.1em">اكتشف · زايد · اربح</p>
            </div>

            <!-- Card -->
            <div style="width:100%;max-width:420px;background:rgba(26,46,53,.8);backdrop-filter:blur(20px);border:1px solid rgba(46,138,153,.2);border-radius:1.5rem;padding:2.5rem;box-shadow:0 25px 60px rgba(0,0,0,.4)">
                {{ $slot }}
            </div>

        </div>
    </body>
</html>
