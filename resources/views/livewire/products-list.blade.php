<div>
    <style>
        .product-card {
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            border-radius: 16px;
            border: 1px solid rgba(226, 232, 240, 0.8);
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
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(139, 92, 246, 0.05) 0%, rgba(59, 130, 246, 0.05) 100%);
            opacity: 0;
            transition: opacity 0.3s ease;
            pointer-events: none;
        }

        .product-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            border-color: rgba(139, 92, 246, 0.3);
        }

        .product-card:hover::before {
            opacity: 1;
        }

        .product-image-container {
            position: relative;
            height: 180px;
            overflow: hidden;
            border-bottom: 1px solid rgba(226, 232, 240, 0.8);
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
            background: linear-gradient(135deg, #10b981 0%, #34d399 100%);
            color: #ffffff;
            padding: 6px 12px;
            font-weight: 800;
            border-radius: 999px;
            font-size: 12px;
            position: absolute;
            bottom: 8px;
            left: 8px;
            box-shadow: 0 4px 6px -1px rgba(16, 185, 129, 0.3);
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
            color: #1f2937;
            font-size: 14px;
            font-weight: 700;
            line-height: 1.3;
            margin-bottom: 2px;
            transition: color 0.2s ease;
        }

        .product-card:hover .product-title {
            color: #7c3aed;
        }

        .product-description {
            color: #6b7280;
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
            border-top: 1px solid rgba(226, 232, 240, 0.8);
            border-bottom: 1px solid rgba(226, 232, 240, 0.8);
        }

        .meta-item {
            text-align: center;
            flex: 1;
        }

        .meta-label {
            color: #9ca3af;
            font-size: 10px;
            font-weight: 500;
            margin-bottom: 2px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .meta-value {
            color: #374151;
            font-size: 12px;
            font-weight: 600;
        }

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
            background: linear-gradient(135deg, #7c3aed 0%, #a78bfa 100%);
            color: #ffffff;
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
        }

        .btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
        }

        .btn-primary:hover::before {
            left: 100%;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px -5px rgba(124, 58, 237, 0.4);
        }

        .btn-secondary {
            background: transparent;
            color: #7c3aed;
            border: 2px solid #7c3aed;
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
        }

        .btn-secondary:hover {
            background: linear-gradient(135deg, rgba(124, 58, 237, 0.1) 0%, rgba(167, 139, 250, 0.1) 100%);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px -2px rgba(124, 58, 237, 0.2);
        }

        .wishlist-btn {
            position: absolute;
            top: 8px;
            left: 8px;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.9);
            border: 2px solid rgba(226, 232, 240, 0.8);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            z-index: 10;
        }

        .wishlist-btn:hover {
            background: #fef2f2;
            border-color: #f87171;
            transform: scale(1.1);
        }

        .wishlist-btn.active {
            background: #fef2f2;
            border-color: #ef4444;
        }

        .wishlist-btn svg {
            width: 16px;
            height: 16px;
            transition: all 0.3s ease;
        }

        .wishlist-btn:hover svg {
            fill: #ef4444;
            stroke: #ef4444;
        }

        .wishlist-btn.active svg {
            fill: #ef4444;
            stroke: #ef4444;
        }

        .quick-view-btn {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: rgba(255, 255, 255, 0.95);
            color: #1f2937;
            padding: 12px 20px;
            border-radius: 8px;
            font-weight: 600;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            cursor: pointer;
            border: 1px solid rgba(226, 232, 240, 0.8);
            backdrop-filter: blur(8px);
        }

        .product-card:hover .quick-view-btn {
            opacity: 1;
            visibility: visible;
        }

        .quick-view-btn:hover {
            background: #ffffff;
            transform: translate(-50%, -50%) scale(1.05);
        }

        .skeleton {
            background: linear-gradient(90deg, #f3f4f6 25%, #e5e7eb 50%, #f3f4f6 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
        }

        @keyframes loading {
            0% { background-position: 200% 0; }
            100% { background-position: -200% 0; }
        }

        /* Mobile Responsive Improvements */
        @media (max-width: 768px) {
            .product-card {
                border-radius: 12px;
            }
            
            .product-image-container {
                height: 160px;
            }
            
            .product-title {
                font-size: 13px;
            }
            
            .product-description {
                font-size: 11px;
            }
            
            .product-meta {
                flex-direction: column;
                gap: 6px;
                padding: 6px 0;
            }
            
            .meta-item {
                text-align: right;
            }
            
            .product-actions {
                flex-direction: column;
                gap: 4px;
            }
            
            .btn-primary,
            .btn-secondary {
                padding: 6px 10px;
                font-size: 12px;
            }
            
            .product-badges {
                top: 6px;
                right: 6px;
                gap: 3px;
            }
            
            .product-badge {
                font-size: 9px;
                padding: 3px 6px;
            }
            
            .price-badge {
                font-size: 11px;
                padding: 4px 8px;
                bottom: 6px;
                left: 6px;
            }
            
            .wishlist-btn {
                width: 28px;
                height: 28px;
                top: 6px;
                left: 6px;
            }
            
            .wishlist-btn svg {
                width: 14px;
                height: 14px;
            }
        }

        @media (max-width: 640px) {
            .product-image-container {
                height: 140px;
            }
            
            .product-content {
                padding: 0.75rem;
            }
            
            .product-title {
                font-size: 12px;
            }
            
            .product-description {
                font-size: 10px;
                -webkit-line-clamp: 1;
            }
            
            .btn-primary,
            .btn-secondary {
                padding: 5px 8px;
                font-size: 11px;
            }
        }

        /* Touch device optimizations */
        @media (hover: none) {
            .product-card:hover {
                transform: none;
            }
            
            .product-card:hover .product-image {
                transform: none;
            }
            
            .quick-view-btn {
                opacity: 1;
                visibility: visible;
                position: static;
                transform: none;
                margin: 8px 0;
                width: 100%;
            }
            
            .product-card:hover .image-overlay {
                opacity: 0;
            }
        }

        /* Loading skeleton for mobile */
        .skeleton-card {
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            border-radius: 16px;
            border: 1px solid rgba(226, 232, 240, 0.8);
            overflow: hidden;
            margin-bottom: 1.5rem;
        }

        .skeleton-image {
            height: 240px;
            background: linear-gradient(90deg, #f3f4f6 25%, #e5e7eb 50%, #f3f4f6 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
        }

        .skeleton-content {
            padding: 1.25rem;
        }

        .skeleton-title {
            height: 20px;
            background: linear-gradient(90deg, #f3f4f6 25%, #e5e7eb 50%, #f3f4f6 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
            border-radius: 4px;
            margin-bottom: 8px;
        }

        .skeleton-text {
            height: 14px;
            background: linear-gradient(90deg, #f3f4f6 25%, #e5e7eb 50%, #f3f4f6 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
            border-radius: 4px;
            margin-bottom: 6px;
        }

        .skeleton-text:last-child {
            width: 60%;
        }
    </style>

    <!-- Search and Filters -->
    <div class="elegant-card rounded-3xl shadow-xl p-4 md:p-6 mb-8">
        <!-- Search Bar -->
        <div class="mb-6">
            <div class="relative">
                <input 
                    wire:model.live="search" 
                    wire:input.debounce.300ms="updateSearchSuggestions"
                    type="text" 
                    placeholder="ابحث عن المنتجات..."
                    class="w-full px-4 py-3 md:px-6 md:py-4 pr-12 bg-white/80 border border-gray-200 rounded-xl md:rounded-2xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all text-base md:text-lg">
                <svg class="absolute right-3 md:right-4 top-1/2 transform -translate-y-1/2 w-5 h-5 md:w-6 md:h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
                
                <!-- Search Suggestions Dropdown -->
                @if ($showSearchSuggestions && count($searchSuggestions) > 0)
                    <div class="absolute top-full left-0 right-0 mt-2 bg-white border border-gray-200 rounded-xl shadow-lg z-20 overflow-hidden">
                        @foreach ($searchSuggestions as $suggestion)
                            <button 
                                wire:click="selectSearchSuggestion('{{ $suggestion }}')"
                                class="w-full px-4 py-3 text-right hover:bg-gray-50 transition-colors text-sm md:text-base border-b border-gray-100 last:border-b-0">
                                <div class="flex items-center justify-between">
                                    <span>{{ $suggestion }}</span>
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </div>
                            </button>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        <!-- Main Filters -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 md:gap-4 mb-6">
            <!-- Category Filter -->
            <div>
                <label class="block text-xs md:text-sm font-medium text-gray-700 mb-1 md:mb-2">التصنيف</label>
                <select wire:model.live="category_id"
                    class="w-full px-3 py-2 md:px-4 md:py-3 bg-white/70 border border-gray-200 rounded-lg md:rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all text-sm md:text-base">
                    <option value="">جميع التصنيفات</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Condition Filter -->
            <div>
                <label class="block text-xs md:text-sm font-medium text-gray-700 mb-1 md:mb-2">الحالة</label>
                <select wire:model.live="condition"
                    class="w-full px-3 py-2 md:px-4 md:py-3 bg-white/70 border border-gray-200 rounded-lg md:rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all text-sm md:text-base">
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
                <label class="block text-xs md:text-sm font-medium text-gray-700 mb-1 md:mb-2">الترتيب</label>
                <select wire:model.live="sort"
                    class="w-full px-3 py-2 md:px-4 md:py-3 bg-white/70 border border-gray-200 rounded-lg md:rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all text-sm md:text-base">
                    <option value="latest">الأحدث</option>
                    <option value="oldest">الأقدم</option>
                    <option value="price_low">السعر: من الأقل</option>
                    <option value="price_high">السعر: من الأعلى</option>
                </select>
            </div>

            <!-- Location Filter -->
            <div>
                <label class="block text-xs md:text-sm font-medium text-gray-700 mb-1 md:mb-2">الموقع</label>
                <input wire:model.live="location" type="text" placeholder="المدينة أو المنطقة"
                    class="w-full px-3 py-2 md:px-4 md:py-3 bg-white/70 border border-gray-200 rounded-lg md:rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all text-sm md:text-base">
            </div>
        </div>

        <!-- Advanced Filters Toggle -->
        <div class="mb-4">
            <button onclick="toggleAdvancedFilters()" 
                class="text-purple-600 hover:text-purple-700 font-medium flex items-center gap-2 transition-colors text-sm md:text-base">
                <svg class="w-4 h-4 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path>
                </svg>
                فلاتر متقدمة
            </button>
        </div>

        <!-- Advanced Filters -->
        <div id="advancedFilters" class="hidden">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 md:gap-4 mb-6 p-3 md:p-4 bg-gray-50 rounded-xl">
                <!-- Rating Filter -->
                <div>
                    <label class="block text-xs md:text-sm font-medium text-gray-700 mb-1 md:mb-2">تقييم البائع</label>
                    <select wire:model.live="rating"
                        class="w-full px-3 py-2 md:px-4 md:py-3 bg-white/70 border border-gray-200 rounded-lg md:rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all text-sm md:text-base">
                        <option value="">الكل</option>
                        <option value="4">4+ نجوم</option>
                        <option value="3">3+ نجوم</option>
                        <option value="2">2+ نجوم</option>
                        <option value="1">1+ نجوم</option>
                    </select>
                </div>

                <!-- Auction Filter -->
                <div>
                    <label class="block text-xs md:text-sm font-medium text-gray-700 mb-1 md:mb-2">نوع البيع</label>
                    <select wire:model.live="is_auction"
                        class="w-full px-3 py-2 md:px-4 md:py-3 bg-white/70 border border-gray-200 rounded-lg md:rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all text-sm md:text-base">
                        <option value="">الكل</option>
                        <option value="1">مزادات فقط</option>
                        <option value="0">بيع مباشر فقط</option>
                    </select>
                </div>

                <!-- Has Bids Filter -->
                <div>
                    <label class="block text-xs md:text-sm font-medium text-gray-700 mb-1 md:mb-2">المزايدات</label>
                    <select wire:model.live="has_bids"
                        class="w-full px-3 py-2 md:px-4 md:py-3 bg-white/70 border border-gray-200 rounded-lg md:rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all text-sm md:text-base">
                        <option value="">الكل</option>
                        <option value="1">لديه مزايدات</option>
                        <option value="0">بدون مزايدات</option>
                    </select>
                </div>

                <!-- Clear Filters -->
                <div class="flex items-end">
                    <button wire:click="clearFilters"
                        class="w-full px-3 py-2 md:px-4 md:py-3 bg-red-500 text-white rounded-lg md:rounded-xl hover:bg-red-600 transition-all flex items-center justify-center gap-2 text-sm md:text-base">
                        <svg class="w-4 h-4 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                        مسح الفلاتر
                    </button>
                </div>
            </div>
        </div>

        <!-- Price Range -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 md:gap-4">
            <div>
                <label class="block text-xs md:text-sm font-medium text-gray-700 mb-1 md:mb-2">أقل سعر</label>
                <input wire:model.live="min_price" type="number" placeholder="0"
                    class="w-full px-3 py-2 md:px-4 md:py-3 bg-white/70 border border-gray-200 rounded-lg md:rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all text-sm md:text-base">
            </div>
            <div>
                <label class="block text-xs md:text-sm font-medium text-gray-700 mb-1 md:mb-2">أعلى سعر</label>
                <input wire:model.live="max_price" type="number" placeholder="10000"
                    class="w-full px-3 py-2 md:px-4 md:py-3 bg-white/70 border border-gray-200 rounded-lg md:rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all text-sm md:text-base">
            </div>
            <div>
                <label class="block text-xs md:text-sm font-medium text-gray-700 mb-1 md:mb-2">العملة</label>
                <div class="w-full px-3 py-2 md:px-4 md:py-3 bg-gray-100 border border-gray-200 rounded-lg md:rounded-xl text-gray-600 text-sm md:text-base">
                    ج.م مصري
                </div>
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
        @if ($isLoading)
            <!-- Skeleton Loading Cards -->
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
    <div class="fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 shadow-lg z-30 p-4">
        <div class="container mx-auto flex items-center justify-between">
            <div class="flex items-center gap-4">
                <span class="font-semibold text-gray-700">{{ count($compareList) }} منتجات للمقارنة</span>
                @if (count($compareList) >= 2)
                    <button wire:click="openCompareModal" 
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                        مقارنة
                    </button>
                @endif
            </div>
            <button wire:click="$set('compareList', [])" 
                class="text-gray-500 hover:text-gray-700 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    </div>
@endif

<!-- Quick View Modal -->
@if ($showQuickView && $quickViewProduct)
    <div class="fixed inset-0 z-50 overflow-y-auto" style="display: flex; align-items: center; justify-content: center;">
        <div class="fixed inset-0 bg-black bg-opacity-50 transition-opacity" wire:click="closeQuickView"></div>
        
        <div class="relative bg-white rounded-2xl shadow-2xl max-w-4xl w-full mx-4 max-h-[90vh] overflow-hidden">
            <!-- Modal Header -->
            <div class="flex items-center justify-between p-6 border-b border-gray-200">
                <h3 class="text-2xl font-bold text-gray-900">{{ $quickViewProduct->title }}</h3>
                <button wire:click="closeQuickView" class="text-gray-400 hover:text-gray-600 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            
            <!-- Modal Content -->
            <div class="p-6 overflow-y-auto max-h-[calc(90vh-200px)]">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Product Images -->
                    <div>
                        <div class="aspect-square rounded-xl overflow-hidden bg-gray-100">
                            <img src="{{ $quickViewProduct->getFirstMediaUrl('images') ?: 'https://via.placeholder.com/600x600?text=No+Image' }}" 
                                 alt="{{ $quickViewProduct->title }}" 
                                 class="w-full h-full object-cover">
                        </div>
                    </div>
                    
                    <!-- Product Details -->
                    <div class="space-y-6">
                        <!-- Price -->
                        <div>
                            <div class="text-3xl font-bold text-green-600">
                                {{ number_format($quickViewProduct->current_bid ?? $quickViewProduct->price) }} ج.م
                            </div>
                            @if ($quickViewProduct->is_auction && $quickViewProduct->current_bid)
                                <div class="text-sm text-gray-500 mt-1">
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
