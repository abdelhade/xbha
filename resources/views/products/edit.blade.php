<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>تعديل الإعلان - مزادي</title>
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
            <h2 style="font-size:1.75rem;font-weight:900;color:#f0e8cc">تعديل الإعلان</h2>
            <p style="font-size:.875rem;color:rgba(240,232,204,.45);margin-top:.25rem">قم بتحديث تفاصيل منتجك</p>
        </div>

        @if(session()->has('message'))
            <div style="margin-bottom:1.5rem;padding:1rem;background:rgba(46,138,153,.15);border:1px solid rgba(46,138,153,.3);color:#3aa0b0;border-radius:.75rem">
                {{ session('message') }}
            </div>
        @endif

        <style>
        .elegant-card { background: rgba(26,46,53,.7) !important; border: 1px solid rgba(46,138,153,.15) !important; }
        .elegant-card h3 { color: #f0e8cc !important; }
        .elegant-card p { color: rgba(240,232,204,.55) !important; }
        .elegant-card label { color: rgba(240,232,204,.65) !important; }
        .elegant-card input, .elegant-card select, .elegant-card textarea {
            background: rgba(15,30,35,.6) !important;
            border-color: rgba(46,138,153,.2) !important;
            color: #f0e8cc !important;
        }
        .elegant-card input::placeholder, .elegant-card textarea::placeholder { color: rgba(240,232,204,.3) !important; }
        .elegant-card .text-gray-900 { color: #f0e8cc !important; }
        .elegant-card .text-gray-600, .elegant-card .text-gray-700 { color: rgba(240,232,204,.55) !important; }
        .elegant-card .text-gray-500 { color: rgba(240,232,204,.4) !important; }
        .elegant-card .border-gray-200 { border-color: rgba(46,138,153,.2) !important; }
        .elegant-card .bg-white\/70 { background: rgba(15,30,35,.6) !important; }
        .elegant-card .bg-blue-100, .elegant-card .bg-green-100 { background: rgba(46,138,153,.15) !important; }
        .elegant-card .text-blue-600, .elegant-card .text-green-600 { color: #3aa0b0!important; }
        .elegant-card .border-dashed { border-color: rgba(46,138,153,.3) !important; }
        .elegant-card .text-gray-400 { color: rgba(46,138,153,.4) !important; }
        .elegant-card .text-gray-700 { color: rgba(240,232,204,.65) !important; }
        .elegant-card .bg-gradient-to-r { background: linear-gradient(135deg,rgba(46,138,153,.2),rgba(46,138,153,.05)) !important; }
        .elegant-card .from-purple-600 { --tw-gradient-from: #2e8a99 !important; }
        .elegant-card .to-indigo-600 { --tw-gradient-to: #1f6370 !important; }
        .elegant-card .hover\:from-purple-700:hover { --tw-gradient-from: #1f6370 !important; }
        .elegant-card .hover\:to-indigo-700:hover { --tw-gradient-to: #164d58 !important; }
        .elegant-card .bg-gray-500 { background: rgba(46,138,153,.15) !important; color: #3aa0b0 !important; }
        .elegant-card .hover\:bg-gray-600:hover { background: rgba(46,138,153,.25) !important; }
        .elegant-card .bg-white { background: rgba(15,30,35,.5) !important; color: rgba(240,232,204,.6) !important; }
        .elegant-card .border-gray-300 { border-color: rgba(46,138,153,.2) !important; }
        .elegant-card .hover\:bg-gray-50:hover { background: rgba(46,138,153,.08) !important; }
        .elegant-card .text-red-600 { color: #f47c51 !important; }
        .elegant-card .focus\:ring-purple-500:focus { --tw-ring-color: rgba(46,138,153,.3) !important; }
        .elegant-card .focus\:border-purple-500:focus { border-color: rgba(46,138,153,.5) !important; }
    </style>
    @livewire('edit-product', ['product' => $product])
    </div>

    @livewireScripts
</body>
</html>
