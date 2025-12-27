<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>المنتجات - إكسابها</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @livewireStyles
    
    <style>
        body { font-family: 'Tajawal', sans-serif; }
        .gradient-bg {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 50%, #cbd5e1 100%);
            position: relative;
        }
        .gradient-bg::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: 
                radial-gradient(circle at 30% 20%, rgba(139, 92, 246, 0.05) 0%, transparent 50%),
                radial-gradient(circle at 70% 80%, rgba(59, 130, 246, 0.05) 0%, transparent 50%);
        }
        .elegant-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.5);
        }
    </style>
</head>
<body class="gradient-bg min-h-screen" dir="rtl">
    
    <x-navbar />

    <!-- Hero Section -->
    <section class="py-12 relative z-10">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                اكتشف أفضل العروض
            </h2>
            <p class="text-xl text-gray-600 mb-8 max-w-2xl mx-auto">
                تسوق من آلاف المنتجات المتنوعة واعثر على ما تبحث عنه بأفضل الأسعار
            </p>
        </div>
    </section>

    <!-- Main Content -->
    <div class="container mx-auto px-4 pb-12 relative z-10">
        @livewire('products-list')
    </div>

    <!-- Footer -->
    <footer class="bg-white/80 backdrop-blur-lg border-t border-white/20 py-8 mt-12">
        <div class="container mx-auto px-4 text-center">
            <div class="flex items-center justify-center gap-2 mb-4">
                <div class="w-8 h-8 bg-gradient-to-br from-purple-500 to-indigo-600 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                </div>
                <span class="text-lg font-bold text-gray-900">إكسابها</span>
            </div>
            <p class="text-gray-600">
                © {{ date('Y') }} إكسابها. جميع الحقوق محفوظة.
            </p>
        </div>
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
                    if (diff <= 0) {
                        this.timeString = 'انتهى';
                        clearInterval(this.timer);
                        return;
                    }
                    const h = Math.floor(diff / 3600000);
                    const m = Math.floor((diff % 3600000) / 60000);
                    const s = Math.floor((diff % 60000) / 1000);
                    this.timeString = `${String(h).padStart(2,'0')}:${String(m).padStart(2,'0')}:${String(s).padStart(2,'0')}`;
                }
            };
        }
    </script>
</body>
</html>