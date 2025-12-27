<div>
    <style>
        .dark-card {
            background: white;
            border-radius: 10px;
            border: none;
            overflow: hidden;
            transition: all .3s ease;
            display: flex;
            flex-flow: column wrap;
            height: 100%;
            box-shadow: 0 8px 32px rgba(255, 255, 255, 0.3);
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
            color: #f3f4f6;
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
            border: 1px solid #7b23cd;
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
            font-family: monospace;
            font-size: 16px;
        }
    </style>

    <!-- Search and Filters -->
    <div class="elegant-card rounded-3xl shadow-xl p-6 mb-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
            <!-- Search -->
            <div class="lg:col-span-2">
                <input wire:model.live="search" type="text" placeholder="ابحث عن المنتجات..."
                    class="w-full px-4 py-3 bg-white/70 border border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all">
            </div>

            <!-- Category Filter -->
            <div>
                <select wire:model.live="category_id"
                    class="w-full px-4 py-3 bg-white/70 border border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all">
                    <option value="">جميع التصنيفات</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Condition Filter -->
            <div>
                <select wire:model.live="condition"
                    class="w-full px-4 py-3 bg-white/70 border border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all">
                    <option value="">جميع الحالات</option>
                    <option value="new">جديد</option>
                    <option value="like_new">شبه جديد</option>
                    <option value="good">جيد</option>
                    <option value="fair">مقبول</option>
                    <option value="poor">يحتاج إصلاح</option>
                </select>
            </div>

            <!-- Sort -->
            <div>
                <select wire:model.live="sort"
                    class="w-full px-4 py-3 bg-white/70 border border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all">
                    <option value="latest">الأحدث</option>
                    <option value="oldest">الأقدم</option>
                    <option value="price_low">السعر: من الأقل</option>
                    <option value="price_high">السعر: من الأعلى</option>
                </select>
            </div>
        </div>

        <!-- Price Range -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
            <div>
                <input wire:model.live="min_price" type="number" placeholder="أقل سعر"
                    class="w-full px-4 py-3 bg-white/70 border border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all">
            </div>
            <div>
                <input wire:model.live="max_price" type="number" placeholder="أعلى سعر"
                    class="w-full px-4 py-3 bg-white/70 border border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all">
            </div>
            <div>
                <button wire:click="clearFilters"
                    class="w-full px-4 py-3 bg-gray-500 text-white rounded-xl hover:bg-gray-600 transition-all">
                    مسح الفلاتر
                </button>
            </div>
        </div>
    </div>

    <!-- Results Count -->
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-900">
            المنتجات المتاحة ({{ $products->total() }})
        </h2>

        @auth
            <a href="{{ route('products.create') }}"
                class="px-6 py-3 bg-gradient-to-r from-purple-600 to-indigo-600 text-white rounded-xl font-semibold hover:from-purple-700 hover:to-indigo-700 transition-all shadow-lg">
                + إضافة إعلان
            </a>
        @endauth
    </div>

    <!-- Products Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-8">
        @forelse($products as $product)
            <div class="dark-card">
                <div class="card-figure">
                    <img src="{{ $product->getFirstMediaUrl('images') ?: 'https://via.placeholder.com/800x600?text=No+Image' }}"
                        alt="{{ $product->title }}">
                    <div class="card-overlay"></div>

                    <div class="absolute top-3 right-3">
                        <span class="card-badge">
                            <span class="w-2 h-2 bg-yellow-400 rounded-full animate-pulse"></span>
                            {{ $product->bids()->count() }} مزايد
                        </span>
                    </div>

                    <div class="absolute bottom-3 left-3">
                        <span class="price-pill">
                            {{ number_format($product->current_bid ?? $product->price) }} ج.م
                        </span>
                    </div>
                </div>

                <div class="card-body">
                    <div>
                        <h3 class="card-title truncate">{{ $product->title }}</h3>
                        <p class="card-description line-clamp-2 mt-1">{{ $product->description }}</p>
                    </div>

                    <div class="flex justify-between items-center text-sm py-2 border-t border-b border-white/10">
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
                            <a href="{{ route('login') }}?redirect={{ urlencode($bidUrl) }}" class="btn-bid flex-1">تسجيل
                                الدخول</a>
                        @endauth

                        <a href="{{ route('products.show', $product->slug) }}" class="btn-details flex-1">عرض</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full">
                <div class="elegant-card rounded-3xl shadow-xl p-12 text-center">
                    <svg class="w-24 h-24 text-gray-300 mx-auto mb-6" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4">
                        </path>
                    </svg>
                    <h3 class="text-2xl font-bold text-gray-600 mb-2">لا توجد منتجات</h3>
                    <p class="text-gray-500 mb-6">لم يتم العثور على منتجات تطابق معايير البحث</p>
                    @auth
                        <a href="{{ route('products.create') }}"
                            class="inline-block px-6 py-3 bg-gradient-to-r from-purple-600 to-indigo-600 text-white rounded-xl font-semibold hover:from-purple-700 hover:to-indigo-700 transition-all">
                            كن أول من يضيف إعلان
                        </a>
                    @endauth
                </div>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if ($products->hasPages())
        <div class="flex justify-center">
            {{ $products->links() }}
        </div>
    @endif
</div>
