<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>الطلبات - مزادي</title>
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Kufi+Arabic:wght@300;400;600;700;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body style="font-family:'Noto Kufi Arabic',sans-serif;background:#0f1e23;color:#f0e8cc;min-height:100vh">
    <x-navbar />

    <div style="max-width:900px;margin:0 auto;padding:2rem 1rem">
        <div style="margin-bottom:2rem">
            <h2 style="font-size:1.75rem;font-weight:900;color:#f0e8cc">طلباتي</h2>
            <p style="font-size:.875rem;color:rgba(240,232,204,.45);margin-top:.25rem">تتبع جميع طلباتك من مكان واحد</p>
        </div>
        @livewire('orders-list')
    </div>

    @livewireScripts
</body>
</html>
