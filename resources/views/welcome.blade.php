<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>إكسابها - اكتشف، اشتري، وبيع الإعلانات المميزة</title>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.12.0/dist/cdn.min.js"></script>
    <style>
        body {
            font-family: 'Tajawal', sans-serif;
            background-color: #0b0b1a;
            position: relative;
            overflow-x: hidden;
        }

        .hero-bg {
            position: relative;
            z-index: 10;
            /* Ensure content is above bubbles */
        }

        /* خلفية داكنة جداً */

        /* Dark card styles (copied from products listing) */
        .dark-card {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            transition: all .3s ease;
            display: flex;
            flex-flow: column wrap;
            height: 100%;
            box-shadow: 0 8px 32px rgba(164, 162, 162, 0.4);
        }

        .dark-card:hover {
            transform: translateY(-8px);

        }

        .card-figure {
            position: relative;
            height: 220px;
            overflow: hidden;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        .card-figure img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform .5s ease;
        }

        .dark-card:hover .card-figure img {
            transform: scale(1.08);
        }

        .card-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(0, 0, 0, .55), transparent 60%);
        }

        .card-badge {
            background: rgba(0, 0, 0, .7);
            color: #fbbf24;
            font-size: 12px;
            padding: 6px 10px;
            border-radius: 999px;
            display: flex;
            align-items: center;
            gap: 6px;
            backdrop-filter: blur(4px);
            border: 1px solid rgba(251, 191, 36, 0.2);
        }

        .price-pill {
            background: linear-gradient(90deg, #10b981, #34d399);
            color: #fff;
            padding: 8px 14px;
            font-weight: 800;
            border-radius: 999px;
            font-size: 14px;
        }

        .card-body {
            padding: 1rem;
            display: flex;
            flex-direction: column;
            gap: .75rem;
            flex: 1;

        }

        .card-title {

            font-size: 15px;
            font-weight: 700;
            line-height: 1.3;
        }

        .card-description {
            color: #d1d5db;
            font-size: 12px;
            line-height: 1.4;
        }

        .btn-bid {
            background: linear-gradient(90deg, #7c3aed, #a78bfa);
            color: #fff;
            border-radius: .75rem;
            padding: .7rem;
            font-weight: 700;
            text-align: center;
            transition: .3s;
            border: none;
            cursor: pointer;
            display: inline-block;
        }

        .btn-bid:hover {
            opacity: .95;
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(124, 58, 237, 0.4);
        }

        .btn-details {

            color: #7b23cd;
            border: 1px solid #7B23CD;
            border-radius: .75rem;
            padding: .55rem;
            font-weight: 600;
            text-align: center;
            transition: .3s;
            text-decoration: none;
            display: inline-block;
        }

        .btn-details:hover {
            background: linear-gradient(90deg, rgba(59, 130, 246, 0.3), rgba(99, 102, 241, 0.3));
            box-shadow: 0 4px 12px rgba(167, 243, 208, 0.2);
        }

        .countdown {
            color: #fbbf24;
            font-weight: 700;
            font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, 'Roboto Mono', monospace;
            font-size: 16px;
        }

        @media (max-width: 768px) {
            .card-figure {
                height: 12rem;
            }
        }
    </style>
</head>

<body class="bg-transparent">

    <x-navbar />

    <!-- Hero Section -->
    <section class="hero-bg py-20 px-6">
        <div class="container mx-auto max-w-7xl">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div>
                    <h1 class="text-5xl md:text-6xl font-extrabold text-gray-900 mb-6 leading-tight">
                        اكتشف، اشتري، وبيع<br>
                        <span class="text-purple-600">الإعلانات المميزة</span>
                    </h1>
                    <p class="text-xl text-gray-600 mb-8 leading-relaxed">
                        أكبر سوق للإعلانات المبوبة في مصر. تصفح آلاف الإعلانات من الإلكترونيات إلى السيارات والعقارات
                    </p>

                    <div class="flex flex-wrap gap-4 mb-12">
                        <a href="/products"
                            class="px-8 py-4 bg-purple-600 text-white rounded-lg font-bold text-lg hover:bg-purple-700 transition">
                            استكشف الآن
                        </a>
                        @auth
                            <a href="/products/create"
                                class="px-8 py-4 border-2 border-purple-600 text-purple-600 rounded-lg font-bold text-lg hover:bg-purple-50 transition">
                                أضف إعلان
                            </a>
                        @else
                            <a href="{{ route('register') }}"
                                class="px-8 py-4 border-2 border-purple-600 text-purple-600 rounded-lg font-bold text-lg hover:bg-purple-50 transition">
                                أضف إعلان
                            </a>
                        @endauth
                    </div>

                    <div class="flex items-center gap-8">
                        <div>
                            <div class="text-3xl font-bold text-gray-900">10K+</div>
                            <div class="text-sm text-gray-600">إعلان نشط</div>
                        </div>
                        <div>
                            <div class="text-3xl font-bold text-gray-900">5K+</div>
                            <div class="text-sm text-gray-600">مستخدم</div>
                        </div>
                        <div>
                            <div class="text-3xl font-bold text-gray-900">50K+</div>
                            <div class="text-sm text-gray-600">عملية بيع</div>
                        </div>
                    </div>
                </div>

                @php
                    $topAuction = \App\Models\Product::withCount('bids')
                        ->where('is_auction', true)
                        ->where('status', 1)
                        ->orderByDesc('bids_count')
                        ->with('user')
                        ->first();
                @endphp

                <div class="relative">
                    @if ($topAuction)
                        <div class="flex justify-center md:justify-end">
                            <div class="dark-card w-[300px] max-w-md">
                                <div class="card-figure">
                                    <img src="{{ $topAuction->getFirstMediaUrl('images') ?: 'https://via.placeholder.com/800x600?text=No+Image' }}"
                                        alt="{{ $topAuction->title }}" class="group-hover:scale-105">
                                    <div class="card-overlay"></div>

                                    <div class="absolute top-3 right-3">
                                        <span class="card-badge"><span
                                                class="w-2 h-2 bg-yellow-400 rounded-full animate-pulse"></span> الأكثر
                                            مزايدة</span>
                                    </div>

                                    <div class="absolute bottom-3 left-3">
                                        <span
                                            class="price-pill">{{ number_format($topAuction->current_bid ?? $topAuction->price) }}
                                            ج.م</span>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <div>
                                        <h3 class="card-title truncate">{{ $topAuction->title }}</h3>
                                        <p class="card-description line-clamp-2 mt-1">
                                            {{ $topAuction->description_short ?? $topAuction->description }}</p>
                                    </div>

                                    <div
                                        class="flex justify-between items-center text-sm py-2 border-t border-b border-white/10">
                                        <div class="text-right flex-1">
                                            <div class="text-gray-500 text-xs mb-1">الزمن المتبقي</div>
                                            @if ($topAuction->auction_ends_at)
                                                <div x-data="countdown({{ $topAuction->auction_ends_at->getTimestamp() * 1000 }})" x-init="start()" x-text="timeString"
                                                    class="countdown">--:--:--</div>
                                            @else
                                                <div class="text-gray-500">—</div>
                                            @endif
                                        </div>
                                        <div class="text-left flex-1">
                                            <div class="text-gray-500 text-xs mb-1">البائع</div>
                                            <div class="text-gray-300 text-sm">{{ $topAuction->user->name }}</div>
                                        </div>
                                    </div>

                                    <div class="flex gap-2 mt-auto">
                                        @php
                                            $minBid = $topAuction->current_bid
                                                ? $topAuction->current_bid + ($topAuction->min_bid_increment ?? 1)
                                                : $topAuction->starting_price ?? ($topAuction->price ?? 0);
                                            $bidUrl = route('products.show', $topAuction->slug) . '#placeBid';
                                        @endphp

                                        @auth
                                            <button class="btn-bid flex-1" onclick="location.href='{{ $bidUrl }}'">↑
                                                {{ number_format($minBid) }}</button>
                                        @else
                                            <a href="{{ route('login') }}?redirect={{ urlencode($bidUrl) }}"
                                                class="btn-bid flex-1">تسجيل الدخول</a>
                                        @endauth

                                        <a href="{{ route('products.show', $topAuction->slug) }}"
                                            class="btn-details flex-1">عرض</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="grid grid-cols-2 gap-4">
                            <div class="space-y-4">
                                <div class="bg-white rounded-2xl p-4 shadow-lg card-hover">
                                    <div class="h-48 bg-gradient-to-br from-blue-100 to-purple-100 rounded-xl mb-3">
                                    </div>
                                    <div class="h-4 bg-gray-200 rounded w-3/4 mb-2"></div>
                                    <div class="h-3 bg-gray-100 rounded w-1/2"></div>
                                </div>
                                <div class="bg-white rounded-2xl p-4 shadow-lg card-hover">
                                    <div class="h-32 bg-gradient-to-br from-green-100 to-blue-100 rounded-xl mb-3">
                                    </div>
                                    <div class="h-4 bg-gray-200 rounded w-2/3 mb-2"></div>
                                    <div class="h-3 bg-gray-100 rounded w-1/3"></div>
                                </div>
                            </div>
                            <div class="space-y-4 pt-8">
                                <div class="bg-white rounded-2xl p-4 shadow-lg card-hover">
                                    <div class="h-40 bg-gradient-to-br from-orange-100 to-red-100 rounded-xl mb-3">
                                    </div>
                                    <div class="h-4 bg-gray-200 rounded w-3/4 mb-2"></div>
                                    <div class="h-3 bg-gray-100 rounded w-1/2"></div>
                                </div>
                                <div class="bg-white rounded-2xl p-4 shadow-lg card-hover">
                                    <div class="h-36 bg-gradient-to-br from-pink-100 to-purple-100 rounded-xl mb-3">
                                    </div>
                                    <div class="h-4 bg-gray-200 rounded w-2/3 mb-2"></div>
                                    <div class="h-3 bg-gray-100 rounded w-1/3"></div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Categories -->
    <section class="py-20 px-6 bg-white">
        <div class="container mx-auto max-w-7xl">
            <div class="flex items-center justify-between mb-12">
                <div>
                    <h2 class="text-3xl font-bold text-gray-900 mb-2">تصفح حسب التصنيف</h2>
                    <p class="text-gray-600">اختر التصنيف المناسب لك</p>
                </div>
                <a href="/products" class="text-purple-600 font-semibold hover:text-purple-700">عرض الكل →</a>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-8 gap-4">
                @php
                    $categories = [
                        ['name' => 'الإلكترونيات', 'icon' => '📱'],
                        ['name' => 'السيارات', 'icon' => '🚗'],
                        ['name' => 'العقارات', 'icon' => '🏠'],
                        ['name' => 'الأزياء', 'icon' => '👔'],
                        ['name' => 'المنزل', 'icon' => '🛋️'],
                        ['name' => 'الرياضة', 'icon' => '⚽'],
                        ['name' => 'الكتب', 'icon' => '📚'],
                        ['name' => 'الألعاب', 'icon' => '🎮'],
                    ];
                @endphp

                @foreach ($categories as $cat)
                    <a href="/products"
                        class="bg-white border border-gray-200 rounded-xl p-6 hover:border-purple-600 hover:shadow-lg transition text-center">
                        <div class="text-4xl mb-2">{{ $cat['icon'] }}</div>
                        <div class="text-sm font-semibold text-gray-900">{{ $cat['name'] }}</div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Ending Soon & Top Bids -->
    <section class="py-20 px-6 bg-white">
        <div class="container mx-auto max-w-7xl">
            <div class="flex items-center justify-between mb-8">
                <div class="mb-10">
                    <h2 class="text-3xl font-bold text-gray-900">قريب الانتهاء وعليه مزايدة</h2>
                    <p class="text-gray-600">
                        مزادات أوشكت على الانتهاء ويوجد عليها مزايدات فعلية
                    </p>
                </div>
                <a href="{{ route('products.index') }}?filter=auctions"
                    class="text-purple-600 font-semibold hover:text-purple-700">عرض الكل →</a>
            </div>
            @php
                $endingSoonWithBids = \App\Models\Product::withCount('bids')
                    ->where('is_auction', true)
                    ->where('status', 1)
                    ->whereNotNull('auction_ends_at')
                    ->where('auction_ends_at', '>', now())
                    ->whereHas('bids') // لازم يكون عليه مزايدة
                    ->orderBy('auction_ends_at', 'asc') // الأقرب انتهاءً
                    ->with('user')
                    ->take(6)
                    ->get();
            @endphp

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 justify-items-center">
                @forelse($endingSoonWithBids as $product)
                    <div class="dark-card w-[300px] max-w-sm">

                        <!-- Image -->
                        <div class="card-figure">
                            <img src="{{ $product->getFirstMediaUrl('images') ?: 'https://via.placeholder.com/800x600?text=No+Image' }}"
                                alt="{{ $product->title }}">

                            <div class="card-overlay"></div>

                            <!-- Badge -->
                            <div class="absolute top-3 right-3">
                                <span class="card-badge">
                                    🔥 {{ $product->bids_count }} مزايد
                                </span>
                            </div>

                            <!-- Price -->
                            <div class="absolute bottom-3 left-3">
                                <span class="price-pill">
                                    {{ number_format($product->current_bid ?? $product->price) }} ج.م
                                </span>
                            </div>
                        </div>

                        <!-- Body -->
                        <div class="card-body">
                            <div>
                                <h3 class="card-title truncate">{{ $product->title }}</h3>
                                <p class="card-description line-clamp-2 mt-1">
                                    {{ $product->description_short ?? $product->description }}
                                </p>
                            </div>

                            <!-- Seller & Time -->
                            <div
                                class="flex justify-between items-center text-sm py-2 border-t border-b border-white/10">
                                <div class="text-right flex-1">
                                    <div class="text-gray-500 text-xs mb-1">الزمن المتبقي</div>
                                    <div x-data="countdown({{ $product->auction_ends_at->getTimestamp() * 1000 }})" x-init="start()" x-text="timeString"
                                        class="countdown">
                                        --:--:--
                                    </div>
                                </div>

                                <div class="text-left flex-1">
                                    <div class="text-gray-500 text-xs mb-1">البائع</div>
                                    <div class="text-gray-300 text-sm">
                                        {{ $product->user->name }}
                                    </div>
                                </div>
                            </div>

                            <!-- Actions -->
                            <div class="flex gap-2 mt-auto">
                                @auth
                                    <a href="{{ route('products.show', $product->slug) }}#placeBid"
                                        class="btn-bid flex-1 text-center">
                                        زايد
                                    </a>
                                @else
                                    <a href="{{ route('login') }}?redirect={{ urlencode(route('products.show', $product->slug) . '#placeBid') }}"
                                        class="btn-bid flex-1 text-center">
                                        دخول
                                    </a>
                                @endauth

                                <a href="{{ route('products.show', $product->slug) }}"
                                    class="btn-details flex-1 text-center">
                                    عرض
                                </a>
                            </div>
                        </div>

                    </div>
                @empty
                    <div class="text-gray-500 col-span-full text-center">
                        لا توجد مزادات قريبة الانتهاء حالياً
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Products by Category -->
    <section class="py-20 px-6 bg-gray-50">
        @php

            if (!isset($products)) {
                if (isset($categories)) {
                    $products = collect($categories)
                        ->flatMap(function ($c) {
                            return data_get($c, 'products', collect());
                        })
                        ->values();
                } else {
                    $products = collect();
                }
            } else {
                $products = is_array($products) ? collect($products) : $products;
            }
            $products = $products->take(9);
        @endphp
        <div class="container mx-auto max-w-7xl">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 justify-items-center">
                @foreach ($products as $product)
                    <div class="dark-card">
                        <div class="card-figure">
                            <img src="{{ $product->getFirstMediaUrl('images') ?: 'https://via.placeholder.com/800x600?text=No+Image' }}"
                                alt="{{ $product->title }}" class="group-hover:scale-105">
                            <div class="card-overlay"></div>

                            <div class="absolute top-3 right-3">
                                <span class="card-badge"><span
                                        class="w-2 h-2 bg-yellow-400 rounded-full animate-pulse"></span>
                                    {{ $product->bids()->count() }} مزايد</span>
                            </div>

                            <div class="absolute bottom-3 left-3">
                                <span class="price-pill">{{ number_format($product->current_bid ?? $product->price) }}
                                    ج.م</span>
                            </div>
                        </div>

                        <div class="card-body">
                            <div>
                                <h3 class="card-title truncate">{{ $product->title }}</h3>
                                <p class="card-description line-clamp-2 mt-1">
                                    {{ $product->description_short ?? $product->description }}</p>
                            </div>

                            <div
                                class="flex justify-between items-center text-sm py-2 border-t border-b border-white/10">
                                <div class="text-right flex-1">
                                    <div class="text-gray-500 text-xs mb-1">الزمن المتبقي</div>
                                    @if ($product->is_auction && $product->auction_ends_at)
                                        <div x-data="countdown({{ $product->auction_ends_at->getTimestamp() * 1000 }})" x-init="start()" x-text="timeString"
                                            class="countdown">--:--:--</div>
                                    @else
                                        <div class="text-gray-500">—</div>
                                    @endif
                                </div>
                                <div class="text-left flex-1">
                                    <div class="text-gray-500 text-xs mb-1">البائع</div>
                                    <div class="text-gray-300 text-sm">{{ $product->user->name }}</div>
                                </div>
                            </div>

                            <div class="flex gap-2 mt-auto">
                                @php
                                    $minBid = $product->current_bid
                                        ? $product->current_bid + ($product->min_bid_increment ?? 1)
                                        : $product->starting_price ?? ($product->price ?? 0);
                                    $bidUrl = route('products.show', $product->slug) . '#placeBid';
                                @endphp

                                @auth
                                    <button onclick="location.href='{{ $bidUrl }}'" class="btn-bid flex-1">↑
                                        {{ number_format($minBid) }}</button>
                                @else
                                    <a href="{{ route('login') }}?redirect={{ urlencode($bidUrl) }}"
                                        class="btn-bid flex-1">تسجيل الدخول</a>
                                @endauth

                                <a href="{{ route('products.show', $product->slug) }}"
                                    class="btn-details flex-1">عرض</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12 px-6">
        <div class="container mx-auto max-w-7xl">
            <div class="grid md:grid-cols-4 gap-8 mb-8">
                <div>
                    <div class="flex items-center gap-2 mb-4">
                        <div class="w-8 h-8 bg-purple-600 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                        </div>
                        <span class="text-xl font-bold">إكسابها</span>
                    </div>
                    <p class="text-gray-400 text-sm">أكبر سوق للإعلانات المبوبة في السعودية</p>
                </div>
                <div>
                    <h4 class="font-bold mb-4">السوق</h4>
                    <div class="space-y-2 text-sm text-gray-400">
                        <a href="/products" class="block hover:text-white">جميع الإعلانات</a>
                        <a href="#" class="block hover:text-white">الإحصائيات</a>
                        <a href="#" class="block hover:text-white">الموارد</a>
                    </div>
                </div>
                <div>
                    <h4 class="font-bold mb-4">حسابي</h4>
                    <div class="space-y-2 text-sm text-gray-400">
                        <a href="{{ route('login') }}" class="block hover:text-white">تسجيل الدخول</a>
                        <a href="{{ route('register') }}" class="block hover:text-white">إنشاء حساب</a>
                    </div>
                </div>
                <div>
                    <h4 class="font-bold mb-4">الشركة</h4>
                    <div class="space-y-2 text-sm text-gray-400">
                        <a href="#" class="block hover:text-white">من نحن</a>
                        <a href="#" class="block hover:text-white">اتصل بنا</a>
                    </div>
                </div>
            </div>
            <div
                class="border-t border-gray-800 pt-8 flex flex-col md:flex-row justify-between items-center text-sm text-gray-400">
                <p>&copy; {{ date('Y') }} إكسابها. جميع الحقوق محفوظة.</p>
                <div class="flex gap-6 mt-4 md:mt-0">
                    <a href="{{ route('terms') }}" class="hover:text-white">الشروط والأحكام</a>
                    <a href="{{ route('privacy') }}" class="hover:text-white">سياسة الخصوصية</a>
                    <a href="{{ route('about') }}" class="hover:text-white">من نحن</a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        function countdown(endTimestamp) {
            return {
                end: typeof endTimestamp === 'number' ? new Date(endTimestamp) : null,
                timeString: '--:--:--',
                timer: null,
                start() {
                    if (!this.end) {
                        this.timeString = '—';
                        return;
                    }
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
                    this.timeString =
                        `${String(h).padStart(2,'0')}:${String(m).padStart(2,'0')}:${String(s).padStart(2,'0')}`;
                }
            };
        }
    </script>
</body>

</html>
