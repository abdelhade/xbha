<div>
    <style>
        .product-card {
            background: rgba(26,46,53,.7);
            border-radius: 16px;
            border: 1px solid rgba(46,138,153,.15);
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            flex-direction: column;
            height: 100%;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            position: relative;
        }

        .product-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: linear-gradient(135deg, rgba(46,138,153,.08) 0%, transparent 100%);
            opacity: 0;
            transition: opacity 0.3s ease;
            pointer-events: none;
        }

        .product-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 20px 40px -10px rgba(0,0,0,.4);
            border-color: rgba(46,138,153,.35);
        }

        .product-card:hover::before {
            opacity: 1;
        }

        .product-image-container {
            position: relative;
            height: 180px;
            overflow: hidden;
            border-bottom: 1px solid rgba(46,138,153,.1);
        }

        .product-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .product-card:hover .product-image {
            transform: scale(1.1);
        }

        .image-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.7) 0%, transparent 40%);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .product-card:hover .image-overlay {
            opacity: 1;
        }

        .product-badges {
            position: absolute;
            top: 8px;
            right: 8px;
            display: flex;
            flex-direction: column;
            gap: 4px;
            z-index: 10;
        }

        .product-badge {
            background: rgba(0, 0, 0, 0.8);
            color: #fbbf24;
            font-size: 10px;
            padding: 4px 8px;
            border-radius: 999px;
            display: flex;
            align-items: center;
            gap: 4px;
            backdrop-filter: blur(8px);
            border: 1px solid rgba(251, 191, 36, 0.3);
            font-weight: 600;
            white-space: nowrap;
        }

        .price-badge {
            background: #f47c51;
            color: #fff;
            padding: 6px 12px;
            font-weight: 800;
            border-radius: 999px;
            font-size: 12px;
            position: absolute;
            bottom: 8px;
            left: 8px;
            box-shadow: 0 4px 12px rgba(244,124,81,.35);
        }

        .product-content {
            padding: 1rem;
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
            flex: 1;
            position: relative;
            z-index: 5;
        }

        .product-title {
            color: #f0e8cc;
            font-size: 14px;
            font-weight: 700;
            line-height: 1.3;
            margin-bottom: 2px;
            transition: color 0.2s ease;
        }

        .product-card:hover .product-title {
            color: #3aa0b0;
        }

        .product-description {
            color: rgba(240,232,204,.45);
            font-size: 12px;
            line-height: 1.4;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .product-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px 0;
            border-top: 1px solid rgba(46,138,153,.1);
            border-bottom: 1px solid rgba(46,138,153,.1);
        }

        .meta-item { text-align: center; flex: 1; }

        .meta-label {
            color: rgba(240,232,204,.35);
            font-size: 10px;
            font-weight: 500;
            margin-bottom: 2px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .meta-value { color: rgba(240,232,204,.75); font-size: 12px; font-weight: 600; }

        .countdown-timer {
            color: #dc2626;
            font-weight: 700;
            font-family: 'Courier New', monospace;
            font-size: 12px;
        }

        .product-actions {
            display: flex;
            gap: 8px;
            margin-top: auto;
        }

        .btn-primary {
            background: #f47c51;
            color: #fff;
            border-radius: 12px;
            padding: 8px 12px;
            font-weight: 700;
            text-align: center;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 4px;
            flex: 1;
            position: relative;
            overflow: hidden;
            font-size: 13px;
            font-family: 'Noto Kufi Arabic', sans-serif;
        }

        .btn-primary:hover { background: #c95f3a; transform: translateY(-2px); }

        .btn-secondary {
            background: transparent;
            color: #2e8a99;
            border: 1.5px solid rgba(46,138,153,.4);
            border-radius: 12px;
            padding: 6px 12px;
            font-weight: 600;
            text-align: center;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 4px;
            flex: 1;
            font-size: 13px;
            font-family: 'Noto Kufi Arabic', sans-serif;
        }

        .btn-secondary:hover { background: rgba(46,138,153,.1); transform: translateY(-2px); }

        .wishlist-btn {
            position: absolute;
            top: 8px; left: 8px;
            width: 32px; height: 32px;
            border-radius: 50%;
            background: rgba(15,30,35,.7);
            border: 1px solid rgba(46,138,153,.3);
            display: flex; align-items: center; justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            z-index: 10;
        }
        .wishlist-btn:hover { background: rgba(244,124,81,.15); border-color: #f47c51; transform: scale(1.1); }
        .wishlist-btn.active { background: rgba(244,124,81,.15); border-color: #f47c51; }
        .wishlist-btn svg { width: 16px; height: 16px; stroke: rgba(240,232,204,.6); transition: all 0.3s ease; }
        .wishlist-btn:hover svg, .wishlist-btn.active svg { fill: #f47c51; stroke: #f47c51; }

        .quick-view-btn {
            position: absolute; top: 50%; left: 50%;
            transform: translate(-50%, -50%);
            background: rgba(26,46,53,.9);
            color: #f0e8cc;
            padding: 10px 18px;
            border-radius: 8px;
            font-weight: 600;
            opacity: 0; visibility: hidden;
            transition: all 0.3s ease;
            cursor: pointer;
            border: 1px solid rgba(46,138,153,.3);
            backdrop-filter: blur(8px);
            font-family: 'Noto Kufi Arabic', sans-serif;
        }
        .product-card:hover .quick-view-btn { opacity: 1; visibility: visible; }
        .quick-view-btn:hover { background: rgba(46,138,153,.2); transform: translate(-50%, -50%) scale(1.05); }

        .skeleton { background: linear-gradient(90deg, rgba(46,138,153,.08) 25%, rgba(46,138,153,.15) 50%, rgba(46,138,153,.08) 75%); background-size: 200% 100%; animation: loading 1.5s infinite; }

        @keyframes loading { 0% { background-position: 200% 0; } 100% { background-position: -200% 0; } }

        @media (max-width: 768px) {
            .product-card { border-radius: 12px; }
            .product-image-container { height: 160px; }
            .product-title { font-size: 13px; }
            .product-description { font-size: 11px; }
            .product-meta { flex-direction: column; gap: 6px; padding: 6px 0; }
            .meta-item { text-align: right; }
            .product-actions { flex-direction: column; gap: 4px; }
            .btn-primary, .btn-secondary { padding: 6px 10px; font-size: 12px; }
            .product-badges { top: 6px; right: 6px; gap: 3px; }
            .product-badge { font-size: 9px; padding: 3px 6px; }
            .price-badge { font-size: 11px; padding: 4px 8px; bottom: 6px; left: 6px; }
            .wishlist-btn { width: 28px; height: 28px; top: 6px; left: 6px; }
            .wishlist-btn svg { width: 14px; height: 14px; }
        }

        @media (max-width: 640px) {
            .product-image-container { height: 140px; }
            .product-content { padding: 0.75rem; }
            .product-title { font-size: 12px; }
            .product-description { font-size: 10px; -webkit-line-clamp: 1; }
            .btn-primary, .btn-secondary { padding: 5px 8px; font-size: 11px; }
        }

        @media (hover: none) {
            .product-card:hover { transform: none; }
            .product-card:hover .product-image { transform: none; }
            .quick-view-btn { opacity: 1; visibility: visible; position: static; transform: none; margin: 8px 0; width: 100%; }
            .product-card:hover .image-overlay { opacity: 0; }
        }

        .skeleton-card { background: rgba(26,46,53,.5); border-radius: 16px; border: 1px solid rgba(46,138,153,.1); overflow: hidden; margin-bottom: 1.5rem; }
        .skeleton-image { height: 240px; background: linear-gradient(90deg, rgba(46,138,153,.06) 25%, rgba(46,138,153,.12) 50%, rgba(46,138,153,.06) 75%); background-size: 200% 100%; animation: loading 1.5s infinite; }
        .skeleton-content { padding: 1.25rem; }
        .skeleton-title { height: 20px; background: linear-gradient(90deg, rgba(46,138,153,.06) 25%, rgba(46,138,153,.12) 50%, rgba(46,138,153,.06) 75%); background-size: 200% 100%; animation: loading 1.5s infinite; border-radius: 4px; margin-bottom: 8px; }
        .skeleton-text { height: 14px; background: linear-gradient(90deg, rgba(46,138,153,.06) 25%, rgba(46,138,153,.12) 50%, rgba(46,138,153,.06) 75%); background-size: 200% 100%; animation: loading 1.5s infinite; border-radius: 4px; margin-bottom: 6px; }
        .skeleton-text:last-child { width: 60%; }
    </style>

    <!-- Search and Filters -->
    <div style="background:rgba(26,46,53,.7);border:1px solid rgba(46,138,153,.15);border-radius:1.25rem;padding:1.25rem 1.5rem;margin-bottom:1.5rem">
        <!-- Search Bar -->
        <div class="mb-6">
            <div class="relative">
                <input 
                    wire:model.live="search" 
                    wire:input.debounce.300ms="updateSearchSuggestions"
                    type="text" 
                    placeholder="ابحث عن المنتجات..."
                    style="width:100%;padding:.75rem 1rem .75rem 3rem;background:rgba(15,30,35,.6);border:1px solid rgba(46,138,153,.2);border-radius:.75rem;color:#f0e8cc;font-family:'Noto Kufi Arabic',sans-serif;font-size:.9rem;outline:none;transition:all .3s"
                    onfocus="this.style.borderColor='rgba(46,138,153,.5)'" onblur="this.style.borderColor='rgba(46,138,153,.2)'">
                <svg style="position:absolute;right:.85rem;top:50%;transform:translateY(-50%);width:18px;height:18px;color:rgba(240,232,204,.3)" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
                @if ($showSearchSuggestions && count($searchSuggestions) > 0)
                    <div style="position:absolute;top:100%;left:0;right:0;margin-top:.5rem;background:#1a2e35;border:1px solid rgba(46,138,153,.25);border-radius:.75rem;z-index:20;overflow:hidden">
                        @foreach ($searchSuggestions as $suggestion)
                            <button wire:click="selectSearchSuggestion('{{ $suggestion }}')"
                                style="width:100%;padding:.75rem 1rem;text-align:right;background:transparent;border:none;border-bottom:1px solid rgba(46,138,153,.1);color:#f0e8cc;font-family:'Noto Kufi Arabic',sans-serif;cursor:pointer;transition:background .2s"
                                onmouseover="this.style.background='rgba(46,138,153,.1)'" onmouseout="this.style.background='transparent'">
                                {{ $suggestion }}
                            </button>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        <!-- Main Filters -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 mb-4">
            <div>
                <label style="display:block;font-size:.75rem;font-weight:600;color:rgba(240,232,204,.5);margin-bottom:.4rem">التصنيف</label>
                <select wire:model.live="category_id" style="width:100%;padding:.6rem .85rem;background:rgba(15,30,35,.6);border:1px solid rgba(46,138,153,.2);border-radius:.65rem;color:#f0e8cc;font-family:'Noto Kufi Arabic',sans-serif;font-size:.85rem;outline:none">
                    <option value="">جميع التصنيفات</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label style="display:block;font-size:.75rem;font-weight:600;color:rgba(240,232,204,.5);margin-bottom:.4rem">الحالة</label>
                <select wire:model.live="condition" style="width:100%;padding:.6rem .85rem;background:rgba(15,30,35,.6);border:1px solid rgba(46,138,153,.2);border-radius:.65rem;color:#f0e8cc;font-family:'Noto Kufi Arabic',sans-serif;font-size:.85rem;outline:none">
                    <option value="">جميع الحالات</option>
                    <option value="new">جديد</option>
                    <option value="like_new">شبه جديد</option>
                    <option value="good">جيد</option>
                    <option value="fair">مقبول</option>
                    <option value="poor">يحتاج إصلاح</option>
                </select>
            </div>
            <div>
                <label style="display:block;font-size:.75rem;font-weight:600;color:rgba(240,232,204,.5);margin-bottom:.4rem">الترتيب</label>
                <select wire:model.live="sort" style="width:100%;padding:.6rem .85rem;background:rgba(15,30,35,.6);border:1px solid rgba(46,138,153,.2);border-radius:.65rem;color:#f0e8cc;font-family:'Noto Kufi Arabic',sans-serif;font-size:.85rem;outline:none">
                    <option value="latest">الأحدث</option>
                    <option value="oldest">الأقدم</option>
                    <option value="price_low">السعر: من الأقل</option>
                    <option value="price_high">السعر: من الأعلى</option>
                </select>
            </div>
            <div>
                <label style="display:block;font-size:.75rem;font-weight:600;color:rgba(240,232,204,.5);margin-bottom:.4rem">الموقع</label>
                <input wire:model.live="location" type="text" placeholder="المدينة أو المنطقة"
                    style="width:100%;padding:.6rem .85rem;background:rgba(15,30,35,.6);border:1px solid rgba(46,138,153,.2);border-radius:.65rem;color:#f0e8cc;font-family:'Noto Kufi Arabic',sans-serif;font-size:.85rem;outline:none">
            </div>
        </div>

        <!-- Advanced Filters Toggle -->
        <div class="mb-3">
            <button onclick="toggleAdvancedFilters()" 
                style="background:transparent;border:none;color:#2e8a99;font-family:'Noto Kufi Arabic',sans-serif;font-size:.85rem;font-weight:600;cursor:pointer;display:flex;align-items:center;gap:.4rem">
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/></svg>
                فلاتر متقدمة
            </button>
        </div>

        <!-- Advanced Filters -->
        <div id="advancedFilters" class="hidden">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 mb-4 p-3" style="background:rgba(15,30,35,.4);border-radius:.75rem">
                <div>
                    <label style="display:block;font-size:.75rem;font-weight:600;color:rgba(240,232,204,.5);margin-bottom:.4rem">تقييم البائع</label>
                    <select wire:model.live="rating" style="width:100%;padding:.6rem .85rem;background:rgba(15,30,35,.6);border:1px solid rgba(46,138,153,.2);border-radius:.65rem;color:#f0e8cc;font-family:'Noto Kufi Arabic',sans-serif;font-size:.85rem;outline:none">
                        <option value="">الكل</option>
                        <option value="4">4+ نجوم</option>
                        <option value="3">3+ نجوم</option>
                        <option value="2">2+ نجوم</option>
                        <option value="1">1+ نجوم</option>
                    </select>
                </div>
                <div>
                    <label style="display:block;font-size:.75rem;font-weight:600;color:rgba(240,232,204,.5);margin-bottom:.4rem">نوع البيع</label>
                    <select wire:model.live="is_auction" style="width:100%;padding:.6rem .85rem;background:rgba(15,30,35,.6);border:1px solid rgba(46,138,153,.2);border-radius:.65rem;color:#f0e8cc;font-family:'Noto Kufi Arabic',sans-serif;font-size:.85rem;outline:none">
                        <option value="">الكل</option>
                        <option value="1">مزادات فقط</option>
                        <option value="0">بيع مباشر فقط</option>
                    </select>
                </div>
                <div>
                    <label style="display:block;font-size:.75rem;font-weight:600;color:rgba(240,232,204,.5);margin-bottom:.4rem">المزايدات</label>
                    <select wire:model.live="has_bids" style="width:100%;padding:.6rem .85rem;background:rgba(15,30,35,.6);border:1px solid rgba(46,138,153,.2);border-radius:.65rem;color:#f0e8cc;font-family:'Noto Kufi Arabic',sans-serif;font-size:.85rem;outline:none">
                        <option value="">الكل</option>
                        <option value="1">لديه مزايدات</option>
                        <option value="0">بدون مزايدات</option>
                    </select>
                </div>
                <div style="display:flex;align-items:flex-end">
                    <button wire:click="clearFilters"
                        style="width:100%;padding:.6rem .85rem;background:rgba(244,124,81,.15);border:1px solid rgba(244,124,81,.3);color:#f47c51;border-radius:.65rem;font-family:'Noto Kufi Arabic',sans-serif;font-size:.85rem;font-weight:600;cursor:pointer;display:flex;align-items:center;justify-content:center;gap:.4rem;transition:all .2s">
                        <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        مسح الفلاتر
                    </button>
                </div>
            </div>
        </div>

        <!-- Price Range -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
            <div>
                <label style="display:block;font-size:.75rem;font-weight:600;color:rgba(240,232,204,.5);margin-bottom:.4rem">أقل سعر</label>
                <input wire:model.live="min_price" type="number" placeholder="0"
                    style="width:100%;padding:.6rem .85rem;background:rgba(15,30,35,.6);border:1px solid rgba(46,138,153,.2);border-radius:.65rem;color:#f0e8cc;font-family:'Noto Kufi Arabic',sans-serif;font-size:.85rem;outline:none">
            </div>
            <div>
                <label style="display:block;font-size:.75rem;font-weight:600;color:rgba(240,232,204,.5);margin-bottom:.4rem">أعلى سعر</label>
                <input wire:model.live="max_price" type="number" placeholder="10000"
                    style="width:100%;padding:.6rem .85rem;background:rgba(15,30,35,.6);border:1px solid rgba(46,138,153,.2);border-radius:.65rem;color:#f0e8cc;font-family:'Noto Kufi Arabic',sans-serif;font-size:.85rem;outline:none">
            </div>
            <div>
                <label style="display:block;font-size:.75rem;font-weight:600;color:rgba(240,232,204,.5);margin-bottom:.4rem">العملة</label>
                <div style="padding:.6rem .85rem;background:rgba(15,30,35,.3);border:1px solid rgba(46,138,153,.1);border-radius:.65rem;color:rgba(240,232,204,.4);font-size:.85rem">ج.م مصري</div>
            </div>
        </div>
    </div>

    <!-- Results Count -->
    <div class="flex justify-between items-center mb-6">
        <h2 style="font-size:1.25rem;font-weight:900;color:#f0e8cc">
            المنتجات المتاحة ({{ $products->total() }})
        </h2>

        @auth
            <a href="{{ route('products.create') }}"
                style="padding:.65rem 1.25rem;background:#f47c51;color:#fff;border-radius:.75rem;font-weight:700;font-size:.875rem;text-decoration:none;transition:all .2s"
                onmouseover="this.style.background='#c95f3a'" onmouseout="this.style.background='#f47c51'">
                + إضافة إعلان
            </a>
        @endauth
    </div>

    <!-- Products Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-8">
        @if ($isLoading)
            @for ($i = 1; $i <= 8; $i++)
                <div class="skeleton-card">
                    <div class="skeleton-image"></div>
                    <div class="skeleton-content">
                        <div class="skeleton-title"></div>
                        <div class="skeleton-text"></div>
                        <div class="skeleton-text"></div>
                        <div class="skeleton-text"></div>
                    </div>
                </div>
            @endfor
        @else
            @forelse($products as $product)
                <div class="product-card">
                    <div class="product-image-container">
                        <img src="{{ $product->getFirstMediaUrl('images') ?: 'https://via.placeholder.com/800x600?text=No+Image' }}"
                            alt="{{ $product->title }}" class="product-image">
                        <div class="image-overlay"></div>

                        <!-- Wishlist Button -->
                        <button wire:click="toggleWishlist({{ $product->id }})" 
                            class="wishlist-btn {{ $this->isInWishlist($product->id) ? 'active' : '' }}">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                        </button>

                        <!-- Product Badges -->
                        <div class="product-badges">
                            @if ($product->bids()->count() > 0)
                                <span class="product-badge">
                                    <span class="w-2 h-2 bg-yellow-400 rounded-full animate-pulse"></span>
                                    {{ $product->bids()->count() }} مزايد
                                </span>
                            @endif
                            @if ($product->is_auction)
                                <span class="product-badge">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6z"></path>
                                    </svg>
                                    مزاد
                                </span>
                            @endif
                        </div>

                        <!-- Price Badge -->
                        <div class="price-badge">
                            {{ number_format($product->current_bid ?? $product->price) }} ج.م
                        </div>

                        <!-- Quick View Button -->
                        <button wire:click="openQuickView({{ $product->id }})" class="quick-view-btn">
                            معاينة سريعة
                        </button>

                        <!-- Compare Button -->
                        <button wire:click="addToCompare({{ $product->id }})" 
                            class="absolute top-12 left-12 w-10 h-10 bg-white/90 border-2 border-gray-200 rounded-full flex items-center justify-center hover:bg-blue-50 hover:border-blue-400 transition-all z-10">
                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </button>
                    </div>

                    <div class="product-content">
                        <div>
                            <h3 class="product-title">{{ $product->title }}</h3>
                            <p class="product-description">{{ $product->description }}</p>
                        </div>

                        <div class="product-meta">
                            <div class="meta-item">
                                <div class="meta-label">الزمن المتبقي</div>
                                <div class="meta-value">
                                    @if ($product->is_auction && $product->auction_ends_at)
                                        <div x-data="countdown({{ $product->auction_ends_at->getTimestamp() * 1000 }})" x-init="start()" x-text="timeString"
                                            class="countdown-timer">--:--:--</div>
                                    @else
                                        <span>—</span>
                                    @endif
                                </div>
                            </div>
                            <div class="meta-item">
                                <div class="meta-label">البائع</div>
                                <div class="meta-value">{{ $product->user->name }}</div>
                            </div>
                        </div>

                        <div class="product-actions">
                            @php
                                $minBid = $product->current_bid
                                    ? $product->current_bid + ($product->min_bid_increment ?? 1)
                                    : $product->starting_price ?? ($product->price ?? 0);
                                $bidUrl = route('products.show', $product->slug) . '#placeBid';
                            @endphp

                            @auth
                                <button onclick="location.href='{{ $bidUrl }}'" class="btn-primary">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12"></path>
                                    </svg>
                                    {{ number_format($minBid) }}
                                </button>
                            @else
                                <a href="{{ route('login') }}?redirect={{ urlencode($bidUrl) }}" class="btn-primary">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                                    </svg>
                                    تسجيل الدخول
                                </a>
                            @endauth

                            <a href="{{ route('products.show', $product->slug) }}" class="btn-secondary">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                عرض
                            </a>
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
        @endif
    </div>

    <!-- Pagination -->
    @if ($products->hasPages())
        <div class="flex justify-center">
            {{ $products->links() }}
        </div>
    @endif
</div>

<!-- Compare Bar -->
@if (count($compareList) > 0)
    <div style="position:fixed;bottom:0;left:0;right:0;background:rgba(26,46,53,.95);backdrop-filter:blur(10px);border-top:1px solid rgba(46,138,153,.2);z-index:30;padding:1rem">
        <div style="max-width:1280px;margin:0 auto;display:flex;align-items:center;justify-content:space-between">
            <div style="display:flex;align-items:center;gap:1rem">
                <span style="font-weight:600;color:#f0e8cc;font-size:.9rem">{{ count($compareList) }} منتجات للمقارنة</span>
                @if (count($compareList) >= 2)
                    <button wire:click="openCompareModal" 
                        style="padding:.5rem 1rem;background:#2e8a99;color:#fff;border:none;border-radius:.6rem;font-family:'Noto Kufi Arabic',sans-serif;font-weight:600;cursor:pointer">
                        مقارنة
                    </button>
                @endif
            </div>
            <button wire:click="$set('compareList', [])" style="background:transparent;border:none;color:rgba(240,232,204,.5);cursor:pointer">
                <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
    </div>
@endif

<!-- Quick View Modal -->
@if ($showQuickView && $quickViewProduct)
    <div style="position:fixed;inset:0;z-index:50;display:flex;align-items:center;justify-content:center;overflow-y:auto">
        <div style="position:fixed;inset:0;background:rgba(0,0,0,.7)" wire:click="closeQuickView"></div>
        <div style="position:relative;background:#1a2e35;border:1px solid rgba(46,138,153,.25);border-radius:1.5rem;max-width:900px;width:100%;margin:1rem;max-height:90vh;overflow:hidden">
            <div style="display:flex;align-items:center;justify-content:space-between;padding:1.25rem 1.5rem;border-bottom:1px solid rgba(46,138,153,.15)">
                <h3 style="font-size:1.25rem;font-weight:700;color:#f0e8cc">{{ $quickViewProduct->title }}</h3>
                <button wire:click="closeQuickView" style="background:transparent;border:none;color:rgba(240,232,204,.5);cursor:pointer">
                    <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
            <div style="padding:1.5rem;overflow-y:auto;max-height:calc(90vh - 80px)">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <div style="aspect-ratio:1;border-radius:.75rem;overflow:hidden;background:rgba(46,138,153,.08)">
                            <img src="{{ $quickViewProduct->getFirstMediaUrl('images') ?: 'https://via.placeholder.com/600x600?text=No+Image' }}" 
                                 alt="{{ $quickViewProduct->title }}" 
                                 style="width:100%;height:100%;object-fit:cover">
                        </div>
                    </div>
                    <div style="display:flex;flex-direction:column;gap:1rem">
                        <div>
                            <div style="font-size:1.75rem;font-weight:900;color:#f47c51">
                                {{ number_format($quickViewProduct->current_bid ?? $quickViewProduct->price) }} ج.م
                            </div>
                            @if ($quickViewProduct->is_auction && $quickViewProduct->current_bid)
                                <div style="font-size:.8rem;color:rgba(240,232,204,.45);margin-top:.25rem">
                                    أعلى مزايدة: {{ number_format($quickViewProduct->current_bid) }} ج.م
                                </div>
                            @endif
                        </div>
                        
                        <!-- Description -->
                        <div>
                            <h4 class="font-semibold text-gray-900 mb-2">الوصف</h4>
                            <p class="text-gray-600">{{ $quickViewProduct->description }}</p>
                        </div>
                        
                        <!-- Details -->
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <h4 class="font-semibold text-gray-900 mb-2">التصنيف</h4>
                                <p class="text-gray-600">{{ $quickViewProduct->category->name }}</p>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900 mb-2">الحالة</h4>
                                <p class="text-gray-600">
                                    @switch($quickViewProduct->condition)
                                        @case('new') جديد @break
                                        @case('like_new') شبه جديد @break
                                        @case('good') جيد @break
                                        @case('fair') مقبول @break
                                        @case('poor') يحتاج إصلاح @break
                                        @default غير محدد
                                    @endswitch
                                </p>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900 mb-2">البائع</h4>
                                <p class="text-gray-600">{{ $quickViewProduct->user->name }}</p>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900 mb-2">الموقع</h4>
                                <p class="text-gray-600">{{ $quickViewProduct->location ?: 'غير محدد' }}</p>
                            </div>
                        </div>
                        
                        <!-- Auction Info -->
                        @if ($quickViewProduct->is_auction && $quickViewProduct->auction_ends_at)
                            <div>
                                <h4 class="font-semibold text-gray-900 mb-2">معلومات المزاد</h4>
                                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                                    <div class="flex items-center justify-between">
                                        <span class="text-yellow-800 font-medium">ينتهي المزاد خلال:</span>
                                        <div x-data="countdown({{ $quickViewProduct->auction_ends_at->getTimestamp() * 1000 }})" x-init="start()" x-text="timeString"
                                             class="text-yellow-600 font-bold">--:--:--</div>
                                    </div>
                                    <div class="mt-2 text-sm text-yellow-700">
                                        عدد المزايدات: {{ $quickViewProduct->bids()->count() }}
                                    </div>
                                </div>
                            </div>
                        @endif
                        
                        <!-- Actions -->
                        <div class="flex gap-4">
                            @php
                                $minBid = $quickViewProduct->current_bid
                                    ? $quickViewProduct->current_bid + ($quickViewProduct->min_bid_increment ?? 1)
                                    : $quickViewProduct->starting_price ?? ($quickViewProduct->price ?? 0);
                                $bidUrl = route('products.show', $quickViewProduct->slug) . '#placeBid';
                            @endphp
                            
                            @auth
                                <a href="{{ $bidUrl }}" 
                                   class="flex-1 bg-gradient-to-r from-purple-600 to-indigo-600 text-white py-3 px-6 rounded-xl font-semibold hover:from-purple-700 hover:to-indigo-700 transition-all text-center">
                                    مزايدة بـ {{ number_format($minBid) }} ج.م
                                </a>
                            @else
                                <a href="{{ route('login') }}?redirect={{ urlencode($bidUrl) }}" 
                                   class="flex-1 bg-gradient-to-r from-purple-600 to-indigo-600 text-white py-3 px-6 rounded-xl font-semibold hover:from-purple-700 hover:to-indigo-700 transition-all text-center">
                                    تسجيل الدخول للمزايدة
                                </a>
                            @endauth
                            
                            <a href="{{ route('products.show', $quickViewProduct->slug) }}" 
                               class="flex-1 border-2 border-purple-600 text-purple-600 py-3 px-6 rounded-xl font-semibold hover:bg-purple-50 transition-all text-center">
                                عرض التفاصيل
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

<script>
    function toggleAdvancedFilters() {
        const filters = document.getElementById('advancedFilters');
        filters.classList.toggle('hidden');
    }

    function openQuickView(productId) {
        // This would open a modal with product details
        console.log('Quick view for product:', productId);
        // You can implement a modal here or use Livewire modal
        // this.$wire.call('openQuickView', productId);
    }

    // Listen for Livewire wishlist events
    document.addEventListener('livewire:init', () => {
        Livewire.on('wishlistAdded', (productId) => {
            // Show success notification
            showNotification('تمت إضافة المنتج إلى المفضلة', 'success');
        });

        Livewire.on('wishlistRemoved', (productId) => {
            // Show info notification
            showNotification('تم حذف المنتج من المفضلة', 'info');
        });
    });

    function showNotification(message, type = 'info') {
        // Create notification element
        const notification = document.createElement('div');
        notification.className = `fixed top-4 right-4 z-50 px-6 py-3 rounded-lg shadow-lg transform transition-all duration-300 translate-x-full`;
        
        // Set colors based on type
        if (type === 'success') {
            notification.classList.add('bg-green-500', 'text-white');
        } else if (type === 'error') {
            notification.classList.add('bg-red-500', 'text-white');
        } else {
            notification.classList.add('bg-blue-500', 'text-white');
        }
        
        notification.textContent = message;
        document.body.appendChild(notification);
        
        // Animate in
        setTimeout(() => {
            notification.classList.remove('translate-x-full');
        }, 100);
        
        // Remove after 3 seconds
        setTimeout(() => {
            notification.classList.add('translate-x-full');
            setTimeout(() => {
                document.body.removeChild(notification);
            }, 300);
        }, 3000);
    }

    // Add smooth scroll behavior
    document.addEventListener('DOMContentLoaded', function() {
        // Add loading states
        const productCards = document.querySelectorAll('.product-card');
        productCards.forEach((card, index) => {
            card.style.animationDelay = `${index * 0.1}s`;
            card.classList.add('animate-fade-in-up');
        });
    });
</script>
