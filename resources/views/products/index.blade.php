<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>المنتجات - مزادي</title>
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
        .page-wrap{max-width:1280px;margin:0 auto;padding:1.5rem}
        .filter-card{background:rgba(26,46,53,.7);border:1px solid rgba(46,138,153,.15);border-radius:1.25rem;padding:1.5rem;margin-bottom:1.5rem}
        .form-input{width:100%;padding:.65rem 1rem;background:rgba(15,30,35,.6);border:1px solid rgba(46,138,153,.2);border-radius:.75rem;color:#f0e8cc;font-family:'Noto Kufi Arabic',sans-serif;font-size:.875rem;outline:none;transition:all .3s}
        .form-input::placeholder{color:rgba(240,232,204,.3)}
        .form-input:focus{border-color:rgba(46,138,153,.5);box-shadow:0 0 0 3px rgba(46,138,153,.08)}
        .form-label{display:block;font-size:.75rem;font-weight:600;color:rgba(240,232,204,.55);margin-bottom:.4rem;letter-spacing:.03em}
        select.form-input option{background:#1a2e35;color:#f0e8cc}
        .btn-coral{background:#f47c51;color:#fff;padding:.65rem 1.25rem;border-radius:.75rem;font-weight:700;font-size:.875rem;text-decoration:none;display:inline-flex;align-items:center;gap:.4rem;transition:all .2s;border:none;cursor:pointer;font-family:'Noto Kufi Arabic',sans-serif}
        .btn-coral:hover{background:#c95f3a}
        .btn-teal-outline{background:transparent;color:#2e8a99;border:1px solid rgba(46,138,153,.35);padding:.5rem 1rem;border-radius:.75rem;font-size:.82rem;font-weight:600;cursor:pointer;font-family:'Noto Kufi Arabic',sans-serif;transition:all .2s}
        .btn-teal-outline:hover{background:rgba(46,138,153,.1)}
        .btn-danger-sm{background:rgba(244,124,81,.1);color:#f47c51;border:none;padding:.4rem .75rem;border-radius:.6rem;font-size:.78rem;cursor:pointer;font-family:'Noto Kufi Arabic',sans-serif;transition:all .2s}
        .btn-danger-sm:hover{background:rgba(244,124,81,.2)}
        footer{background:rgba(26,46,53,.5);border-top:1px solid rgba(46,138,153,.1);padding:2rem 1.5rem;text-align:center;margin-top:3rem}
        footer p{font-size:.8rem;color:rgba(240,232,204,.3)}
    </style>
</head>
<body>
    <x-navbar />
    <div class="page-wrap">
        @livewire('products-list')
    </div>
    <footer>
        <p>© {{ date('Y') }} مزادي. جميع الحقوق محفوظة.</p>
    </footer>
    @livewireScripts
    <script>
        function countdown(endTimestamp) {
            return {
                end: typeof endTimestamp === 'number' ? new Date(endTimestamp) : null,
                timeString: '--:--:--',
                timer: null,
                start() {
                    if (!this.end) { this.timeString = '—'; return; }
                    this.update();
                    this.timer = setInterval(() => this.update(), 1000);
                },
                update() {
                    const now = new Date();
                    const diff = this.end - now;
                    if (diff <= 0) { this.timeString = 'انتهى'; clearInterval(this.timer); return; }
                    const h = Math.floor(diff / 3600000);
                    const m = Math.floor((diff % 3600000) / 60000);
                    const s = Math.floor((diff % 60000) / 1000);
                    this.timeString = `${String(h).padStart(2,'0')}:${String(m).padStart(2,'0')}:${String(s).padStart(2,'0')}`;
                }
            };
        }
        function toggleAdvancedFilters() {
            const el = document.getElementById('advancedFilters');
            el.classList.toggle('hidden');
        }
    </script>
</body>
</html>
