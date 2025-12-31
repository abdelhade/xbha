<!DOCTYPE html>
<html class="light" dir="rtl" lang="ar">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>شاشة رئيسية للمزادات والإعلانات-mazadi</title>
    <link href="/favicon.ico" type="image/x-icon" rel="icon" />
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect" />
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700;800&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#8b5cf6", // Purple from reference
                        "primary-light": "#a78bfa",
                        "secondary": "#3b82f6", // Blue accent
                        "background-light": "#f8f9fa",
                        "background-dark": "#1a1a2e",
                        "surface-light": "#ffffff",
                        "surface-dark": "#24243e",
                        "text-main": "#1e293b",
                        "text-secondary": "#64748b",
                        "accent-pink": "#f472b6",
                        "accent-cyan": "#22d3ee",
                    },
                    fontFamily: {
                        "display": ["Tajawal", "sans-serif"],
                        "body": ["Tajawal", "sans-serif"]
                    },
                    borderRadius: {
                        "DEFAULT": "0.75rem",
                        "lg": "1rem",
                        "xl": "1.5rem",
                        "2xl": "2rem",
                        "full": "9999px"
                    },
                    boxShadow: {
                        "soft": "0 4px 20px -2px rgba(0,0,0,0.05)",
                        "card": "0 0 15px rgba(0,0,0,0.03)",
                        "glow": "0 0 20px -5px rgba(139, 92, 246, 0.3)"
                    }
                },
            },
        }
    </script>
    <style>
        /* Custom Font Import */
        @import url('https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800;900&display=swap');
        
        body {
            font-family: 'Cairo', sans-serif;
        }
        
        /* Hide scrollbar for webkit browsers */
        .hide-scrollbar::-webkit-scrollbar {
            display: none;
        }
        
        /* Hide scrollbar for IE, Edge and Firefox */
        .hide-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
            width: 100%;
        }
        
        @keyframes float {
            0% {
                transform: translate(0px, 0px) scale(1);
            }

            33% {
                transform: translate(30px, -50px) scale(1.1);
            }

            66% {
                transform: translate(-20px, 20px) scale(0.9);
            }

            100% {
                transform: translate(0px, 0px) scale(1);
            }
        }

        .animate-float {
            animation: float 20s infinite ease-in-out;
        }

        .animate-float-delayed {
            animation: float 25s infinite ease-in-out reverse;
        }

        body {
            width: 100%;
        }
    </style>

</head>

<body>
    <div
        class=" min-h-screen relative bg-background-light dark:bg-background-dark overflow-y-auto hide-scrollbar flex flex-col pb-24 shadow-2xl ">
        <x-navbar/>
        <main class="px-6 pt-3 space-y-12 relative z-10">
            <!-- Breadcrumbs -->
            <div class="flex items-center gap-2 text-sm text-text-secondary mb-4 px-2">
                <a href="/" class="hover:text-primary transition-colors">الرئيسية</a>
                <span class="material-symbols-outlined text-xs">chevron_left</span>
                <span class="text-primary font-medium">الرئيسية</span>
            </div>
            
            <section
                class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-primary/5 via-secondary/5 to-accent-pink/5 shadow-soft p-2 border border-white/50 dark:border-white/5 min-h-[400px] sm:min-h-[500px] md:min-h-[70vh]">
                <div class="absolute -top-10 -left-10 w-60 h-60 bg-accent-pink/20 rounded-full blur-3xl animate-float"></div>
                <div class="absolute top-10 -right-10 w-60 h-60 bg-accent-cyan/20 rounded-full blur-3xl animate-float-delayed"></div>
                <div class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-96 h-32 bg-primary/10 rounded-full blur-2xl"></div>
                
                <div class="relative z-10 grid lg:grid-cols-2 gap-8 items-center">
                    <div class="text-center lg:text-right space-y-6">
                        <div class="inline-flex items-center gap-2 bg-primary/10 text-primary px-3 py-1 rounded-full text-sm font-medium">
                            <span class="material-symbols-outlined text-sm">new_releases</span>
                            جديد: أفضل العروض هذا الأسبوع
                        </div>
                        
                        <h2
                            class="text-[52px] lg:text-[64px] font-extrabold leading-tight text-transparent bg-clip-text bg-gradient-to-r from-primary to-secondary">
                            اكتشف واشتري وبيع<br />
                            <span class="text-[48px] lg:text-[56px]">بكل ثقة</span>
                        </h2>
                        
                        <p class="text-lg text-text-secondary leading-relaxed max-w-2xl">
                            أكبر سوق للإعلانات المبوبة. تصفح آلاف الإعلانات من الإلكترونيات إلى السيارات والعقارات مع ضمان الأمان والجودة.
                        </p>
                        
                        <!-- Stats -->
                        <div class="flex justify-center lg:justify-start gap-8 py-4">
                            <div class="text-center">
                                <span class="block text-2xl font-bold text-primary">10K+</span>
                                <span class="text-sm text-text-secondary">إعلان نشط</span>
                            </div>
                            <div class="w-px bg-gray-200 dark:bg-gray-700 h-10 self-center"></div>
                            <div class="text-center">
                                <span class="block text-2xl font-bold text-secondary">5K+</span>
                                <span class="text-sm text-text-secondary">مستخدم</span>
                            </div>
                            <div class="w-px bg-gray-200 dark:bg-gray-700 h-10 self-center"></div>
                            <div class="text-center">
                                <span class="block text-2xl font-bold text-accent-pink">50K+</span>
                                <span class="text-sm text-text-secondary">عملية بيع</span>
                            </div>
                        </div>
                        
                        <!-- CTA Buttons -->
                        <div class="flex flex-col sm:flex-row justify-center lg:justify-start gap-4 pt-2">
                            <a href="{{ route('products.index') }}"
                                class="bg-primary hover:bg-primary/90 text-white px-8 py-4 rounded-2xl text-base font-bold shadow-lg shadow-primary/25 transition-all hover:scale-105 active:scale-95 flex items-center justify-center gap-2">
                                <span class="material-symbols-outlined">explore</span>
                                استكشف الآن
                            </a>
                            @auth
                                <a href="{{ route('products.create') }}"
                                    class="bg-white dark:bg-white/5 border border-primary/20 hover:border-primary text-primary dark:text-primary-light px-8 py-4 rounded-2xl text-base font-bold transition-all hover:scale-105 flex items-center justify-center gap-2">
                                    <span class="material-symbols-outlined">add_circle</span>
                                    أضف إعلان
                                </a>
                            @else
                                <a href="{{ route('register') }}"
                                    class="bg-white dark:bg-white/5 border border-primary/20 hover:border-primary text-primary dark:text-primary-light px-8 py-4 rounded-2xl text-base font-bold transition-all hover:scale-105 flex items-center justify-center gap-2">
                                    <span class="material-symbols-outlined">person_add</span>
                                    انضم الآن
                                </a>
                            @endauth
                        </div>
                    </div>
                    
                    <!-- Hero Image/Visual -->
                    <div class="relative hidden lg:block">
                        <div class="relative w-full h-96 rounded-2xl overflow-hidden bg-gradient-to-br from-primary/10 to-secondary/10 border border-white/20 dark:border-white/5">
                            <div class="absolute inset-0 flex items-center justify-center">
                                <div class="grid grid-cols-2 gap-4 p-8">
                                    <div class="bg-white dark:bg-surface-dark rounded-xl p-4 shadow-lg transform hover:scale-105 transition-transform">
                                        <span class="material-symbols-outlined text-3xl text-primary mb-2">smartphone</span>
                                        <h4 class="font-bold text-sm">إلكترونيات</h4>
                                        <p class="text-xs text-text-secondary">أحدث الأجهزة</p>
                                    </div>
                                    <div class="bg-white dark:bg-surface-dark rounded-xl p-4 shadow-lg transform hover:scale-105 transition-transform">
                                        <span class="material-symbols-outlined text-3xl text-secondary mb-2">directions_car</span>
                                        <h4 class="font-bold text-sm">سيارات</h4>
                                        <p class="text-xs text-text-secondary">مستعملة وجديدة</p>
                                    </div>
                                    <div class="bg-white dark:bg-surface-dark rounded-xl p-4 shadow-lg transform hover:scale-105 transition-transform">
                                        <span class="material-symbols-outlined text-3xl text-accent-pink mb-2">home</span>
                                        <h4 class="font-bold text-sm">عقارات</h4>
                                        <p class="text-xs text-text-secondary">للبيع والإيجار</p>
                                    </div>
                                    <div class="bg-white dark:bg-surface-dark rounded-xl p-4 shadow-lg transform hover:scale-105 transition-transform">
                                        <span class="material-symbols-outlined text-3xl text-orange-500 mb-2">gavel</span>
                                        <h4 class="font-bold text-sm">مزادات</h4>
                                        <p class="text-xs text-text-secondary">عروض حصرية</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Floating badges -->
                            <div class="absolute top-4 right-4 bg-green-500 text-white px-3 py-1 rounded-full text-xs font-bold animate-pulse">
                                موثوق 100%
                            </div>
                            <div class="absolute bottom-4 left-4 bg-primary text-white px-3 py-1 rounded-full text-xs font-bold">
                                دعم 24/7
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="relative overflow-hidden rounded-3xl from-surface-light dark:from-surface-dark dark:to-surface-light/50 shadow-soft p-6 border border-white/30 dark:border-white/5">
                <!-- Section Header -->
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-primary to-secondary flex items-center justify-center text-white shadow-lg">
                            <span class="material-symbols-outlined text-xl">category</span>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-text-main dark:text-white">تصفح حسب التصنيف</h3>
                            <p class="text-xs text-text-secondary">اكتشف آلاف المنتجات في مختلف الفئات</p>
                        </div>
                    </div>
                    <a href="{{ route('products.index') }}"
                        class="text-sm font-semibold text-primary flex items-center gap-1 hover:gap-2 transition-all bg-primary/10 hover:bg-primary/20 px-4 py-2 rounded-xl">
                        عرض الكل
                        <span class="material-symbols-outlined text-sm rotate-180">arrow_right_alt</span>
                    </a>
                </div>
                
                <!-- Categories Horizontal Scroll -->
                <div class="flex overflow-x-auto gap-4 pb-4 -mx-6 px-6 hide-scrollbar snap-x">
                    @php
                        $categories = \App\Models\Category::withCount('products')
                            ->where('status', 1)
                            ->orderBy('name')
                            ->take(12)
                            ->get();
                    @endphp

                    @foreach ($categories as $category)
                        <a href="{{ route('products.index') }}?category={{ $category->id }}"
                            class="group flex-shrink-0 w-24 snap-center">
                            <div
                                class="relative w-full aspect-square rounded-2xl bg-gradient-to-br from-white to-gray-50 dark:from-surface-dark dark:to-surface-dark/80 border border-gray-100 dark:border-gray-800 flex flex-col items-center justify-center shadow-sm group-hover:shadow-xl group-hover:border-primary/30 group-hover:-translate-y-2 transition-all duration-500 overflow-hidden">
                                
                                <!-- Background Pattern -->
                                <div class="absolute inset-0 opacity-5">
                                    <div class="absolute top-2 right-2 w-8 h-8 bg-primary/20 rounded-full blur-lg"></div>
                                    <div class="absolute bottom-2 left-2 w-6 h-6 bg-secondary/20 rounded-full blur-md"></div>
                                </div>
                                
                                <!-- Icon -->
                                <div class="relative z-10">
                                    @if ($category->icon)
                                        <span class="material-symbols-outlined text-2xl text-primary group-hover:scale-110 transition-transform">{{ $category->icon }}</span>
                                    @else
                                        <span class="material-symbols-outlined text-2xl text-blue-500 group-hover:scale-110 transition-transform">category</span>
                                    @endif
                                </div>
                                
                                <!-- Product Count Badge -->
                                @if ($category->products_count > 0)
                                    <div class="absolute top-2 right-2 bg-primary text-white text-xs font-bold px-2 py-1 rounded-full min-w-[20px] text-center">
                                        {{ $category->products_count > 99 ? '99+' : $category->products_count }}
                                    </div>
                                @endif
                            </div>
                            <div class="mt-2 text-center">
                                <span class="text-xs font-medium text-text-secondary group-hover:text-primary transition-colors">{{ $category->name }}</span>
                                @if ($category->products_count > 0)
                                    <p class="text-xs text-text-secondary/70">{{ $category->products_count }} منتج</p>
                                @endif
                            </div>
                        </a>
                    @endforeach

                    <!-- Placeholder Categories -->
                    @if ($categories->count() < 12)
                        @for ($i = $categories->count(); $i < 12; $i++)
                            <div class="group flex-shrink-0 w-24 snap-center opacity-60">
                                <div
                                    class="w-full aspect-square rounded-2xl bg-gray-100 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 flex flex-col items-center justify-center">
                                    <span class="material-symbols-outlined text-2xl text-gray-400">more_horiz</span>
                                </div>
                                <div class="mt-2 text-center">
                                    <span class="text-xs font-medium text-text-secondary">قريباً</span>
                                    <p class="text-xs text-text-secondary/70">قريباً</p>
                                </div>
                            </div>
                        @endfor
                    @endif
                </div>
                
            </section>
            <section class="pb-2 min-h-[50vh]">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-xl font-bold text-text-main dark:text-white">قريب الانتهاء وعليه مزايدة</h3>
                        <a href="{{ route('products.index') }}?filter=ending_soon"
                            class="text-sm font-semibold text-primary flex items-center gap-1 hover:gap-2 transition-all">
                            عرض الكل
                            <span class="material-symbols-outlined text-sm rotate-180">arrow_right_alt</span>
                        </a>
                    </div>
                    <div class="flex overflow-x-auto gap-6 pb-8 -mx-6 px-6 hide-scrollbar snap-x">
                    @php
                        $endingSoonProducts = \App\Models\Product::withCount('bids')
                            ->where('is_auction', true)
                            ->where('status', 1)
                            ->whereNotNull('auction_ends_at')
                            ->where('auction_ends_at', '>', now())
                            ->whereHas('bids')
                            ->orderBy('auction_ends_at', 'asc')
                            ->with(['user', 'category'])
                            ->take(6)
                            ->get();
                    @endphp

                    @forelse($endingSoonProducts as $product)
                        <div
                            class="min-w-[280px] min-h-[400px] snap-center bg-surface-light dark:bg-surface-dark rounded-2xl p-4 shadow-card border border-gray-100 dark:border-gray-800 group hover:shadow-lg transition-all duration-300">
                            <div class="relative min-h-[60%] rounded-xl overflow-hidden mb-4 bg-gray-100">
                                @if ($product->getFirstMediaUrl('images'))
                                    <div class="absolute inset-0 bg-cover bg-center transition-transform duration-500 group-hover:scale-110"
                                        style="background-image: url('{{ $product->getFirstMediaUrl('images') }}'); height: 100%;">
                                    </div>
                                @else
                                    <div
                                        class="absolute inset-0 bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center">
                                        <span class="material-symbols-outlined text-4xl text-gray-400">image</span>
                                    </div>
                                @endif

                                <div
                                    class="absolute top-2 right-2 bg-black/60 backdrop-blur-sm text-white text-xs font-bold px-2 py-1 rounded-md flex items-center gap-1">
                                    <span
                                        class="material-symbols-outlined text-sm text-orange-400">local_fire_department</span>
                                    {{ $product->bids_count }} مزايد
                                </div>
                                <div
                                    class="absolute bottom-2 right-2 bg-green-500 text-white text-xs font-bold px-2 py-1 rounded-md">
                                    {{ number_format($product->current_bid ?? $product->price) }} ج.م
                                </div>
                            </div>
                            <div class="space-y-3">
                                <div class="flex justify-between items-start gap-2">
                                    <h4 class="text-base font-bold text-text-main dark:text-white line-clamp-2 flex-1">
                                        {{ $product->title }}</h4>
                                    @if ($product->category)
                                        <span
                                            class="text-xs text-text-secondary bg-gray-100 dark:bg-white/5 px-2 py-0.5 rounded whitespace-nowrap">{{ $product->category->name }}</span>
                                    @endif
                                </div>
                                <div class="flex items-center justify-between text-xs text-text-secondary">
                                    <span>البائع: {{ $product->user->name }}</span>
                                    @if ($product->auction_ends_at)
                                        <span class="text-red-500 font-medium flex items-center gap-1 whitespace-nowrap"
                                            x-data="countdown({{ $product->auction_ends_at->getTimestamp() * 1000 }})" x-init="start()" x-text="timeString">
                                            <span class="material-symbols-outlined text-sm">timer</span>
                                            --:--:--
                                        </span>
                                    @endif
                                </div>
                                <div class="grid grid-cols-2 gap-2 pt-2">
                                    @auth
                                        @php
                                            $minBid = $product->current_bid
                                                ? $product->current_bid + ($product->min_bid_increment ?? 1)
                                                : $product->starting_price ?? ($product->price ?? 0);
                                            $bidUrl = route('products.show', $product->slug) . '#placeBid';
                                        @endphp
                                        <a href="{{ $bidUrl }}"
                                            class="bg-primary text-white text-sm font-bold py-2 rounded-lg hover:bg-primary-dark transition-colors text-center">زايد</a>
                                    @else
                                        <a href="{{ route('login') }}?redirect={{ urlencode(route('products.show', $product->slug) . '#placeBid') }}"
                                            class="bg-primary text-white text-sm font-bold py-2 rounded-lg hover:bg-primary-dark transition-colors text-center">دخول</a>
                                    @endauth
                                    <a href="{{ route('products.show', $product->slug) }}"
                                        class="border border-primary/20 text-primary text-sm font-bold py-2 rounded-lg hover:bg-primary/5 transition-colors text-center">عرض</a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div
                            class="min-w-[280px] snap-center bg-surface-light dark:bg-surface-dark rounded-2xl p-6 shadow-card border border-gray-100 dark:border-gray-800 text-center">
                            <span class="material-symbols-outlined text-4xl text-gray-300 mb-2">auction</span>
                            <p class="text-text-secondary text-sm">لا توجد مزادات قريبة الانتهاء حالياً</p>
                        </div>
                    @endforelse
                    </div>
                </div>
            </section>
        </main>
        
    </div>

    <!-- Footer -->
    <footer class=" ">
        <div class="container mx-auto px-4">
            <div class="text-center">
                <p class="text-gray-600 dark:text-gray-400 text-sm">
                    &copy; صنع بكل ❤️ by core-house team
                </p>
            </div>
        </div>
    </footer>

<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        // Countdown Timer Function
        function countdown(endTime) {
            return {
                timeString: '--:--:--',
                interval: null,
                start() {
                    this.interval = setInterval(() => {
                        const now = new Date().getTime();
                        const distance = endTime - now;
                        
                        if (distance < 0) {
                            clearInterval(this.interval);
                            this.timeString = 'انتهى';
                            return;
                        }
                        
                        const totalHours = Math.floor(distance / (1000 * 60 * 60));
                        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                        const seconds = Math.floor((distance % (1000 * 60)) / 1000);
                        
                        if (totalHours > 0) {
                            this.timeString = `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
                        } else {
                            this.timeString = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
                        }
                    }, 1000);
                },
                destroy() {
                    if (this.interval) {
                        clearInterval(this.interval);
                    }
                }
            };
        }
    </script>

</body>

</html>
