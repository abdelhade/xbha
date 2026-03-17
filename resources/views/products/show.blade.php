<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $product->title }} - مزادي</title>
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Kufi+Arabic:wght@300;400;600;700;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @livewireStyles
    <style>
        *{box-sizing:border-box}
        body{font-family:'Noto Kufi Arabic',sans-serif;background:#0f1e23;color:#f0e8cc;min-height:100vh}
        .page-wrap{max-width:1200px;margin:0 auto;padding:1.5rem}
        .breadcrumb{display:flex;align-items:center;gap:.5rem;font-size:.82rem;color:rgba(240,232,204,.4);margin-bottom:1.5rem;flex-wrap:wrap}
        .breadcrumb a{color:rgba(240,232,204,.4);text-decoration:none;transition:color .2s}
        .breadcrumb a:hover{color:#2e8a99}
        .breadcrumb span{color:rgba(240,232,204,.7)}
        .elegant-card{background:rgba(26,46,53,.7);border:1px solid rgba(46,138,153,.15);border-radius:1.5rem}
    </style>
</head>
<body>
    <x-navbar />
    <div class="page-wrap">
        <nav class="breadcrumb">
            <a href="/">الرئيسية</a>
            <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            <a href="{{ route('products.index') }}">المنتجات</a>
            <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            <span>{{ $product->title }}</span>
        </nav>
        @livewire('product-details', ['product' => $product])
    </div>
    @livewireScripts
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (location.hash === '#placeBid') {
                const el = document.getElementById('bid-input');
                if (el) { el.scrollIntoView({ behavior: 'smooth', block: 'center' }); setTimeout(() => el.focus(), 600); }
            }
        });
    </script>
</body>
</html>
