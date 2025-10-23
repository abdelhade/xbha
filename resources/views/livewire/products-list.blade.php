<div>
    <!-- Search and Filters -->
    <div class="elegant-card rounded-3xl shadow-xl p-6 mb-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
            <!-- Search -->
            <div class="lg:col-span-2">
                <input wire:model.live="search" 
                       type="text" 
                       placeholder="ابحث عن المنتجات..."
                       class="w-full px-4 py-3 bg-white/70 border border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all">
            </div>

            <!-- Category Filter -->
            <div>
                <select wire:model.live="category_id" class="w-full px-4 py-3 bg-white/70 border border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all">
                    <option value="">جميع التصنيفات</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Condition Filter -->
            <div>
                <select wire:model.live="condition" class="w-full px-4 py-3 bg-white/70 border border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all">
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
                <select wire:model.live="sort" class="w-full px-4 py-3 bg-white/70 border border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all">
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
                <input wire:model.live="min_price" 
                       type="number" 
                       placeholder="أقل سعر"
                       class="w-full px-4 py-3 bg-white/70 border border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all">
            </div>
            <div>
                <input wire:model.live="max_price" 
                       type="number" 
                       placeholder="أعلى سعر"
                       class="w-full px-4 py-3 bg-white/70 border border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all">
            </div>
            <div>
                <button wire:click="clearFilters" class="w-full px-4 py-3 bg-gray-500 text-white rounded-xl hover:bg-gray-600 transition-all">
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
            <a href="{{ route('products.create') }}" class="px-6 py-3 bg-gradient-to-r from-purple-600 to-indigo-600 text-white rounded-xl font-semibold hover:from-purple-700 hover:to-indigo-700 transition-all shadow-lg">
                + إضافة إعلان
            </a>
        @endauth
    </div>

    <!-- Products Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-8">
        @forelse($products as $product)
            <a href="{{ route('products.show', $product->slug) }}" class="block elegant-card rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 group">
                <!-- Product Image -->
                <div class="relative h-48 bg-gray-200 overflow-hidden">
                    @if($product->getFirstMediaUrl('images'))
                        <img src="{{ $product->getFirstMediaUrl('images') }}" 
                             alt="{{ $product->title }}" 
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                    @else
                        <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-gray-100 to-gray-200">
                            <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    @endif

                    <!-- Condition Badge -->
                    <div class="absolute top-3 right-3">
                        <span class="px-2 py-1 text-xs font-medium rounded-full
                            @if($product->condition === 'new') bg-green-100 text-green-800
                            @elseif($product->condition === 'like_new') bg-blue-100 text-blue-800
                            @elseif($product->condition === 'good') bg-yellow-100 text-yellow-800
                            @elseif($product->condition === 'fair') bg-orange-100 text-orange-800
                            @else bg-red-100 text-red-800
                            @endif">
                            @switch($product->condition)
                                @case('new') جديد @break
                                @case('like_new') شبه جديد @break
                                @case('good') جيد @break
                                @case('fair') مقبول @break
                                @case('poor') يحتاج إصلاح @break
                            @endswitch
                        </span>
                    </div>

                    <!-- Price -->
                    <div class="absolute bottom-3 left-3">
                        <span class="px-3 py-1 bg-white/90 backdrop-blur-sm text-purple-600 font-bold rounded-full">
                            {{ number_format($product->price) }} ر.س
                        </span>
                    </div>
                </div>

                <!-- Product Info -->
                <div class="p-4">
                    <h3 class="font-bold text-gray-900 mb-2 line-clamp-2 group-hover:text-purple-600 transition-colors">
                        {{ $product->title }}
                    </h3>
                    
                    <p class="text-gray-600 text-sm mb-3 line-clamp-2">
                        {{ $product->description }}
                    </p>

                    <div class="flex items-center justify-between text-sm text-gray-500 mb-3">
                        <span class="flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            {{ $product->location }}
                        </span>
                        
                        <span class="flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                            {{ $product->views_count }}
                        </span>
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <div class="w-8 h-8 bg-gradient-to-br from-purple-500 to-indigo-600 rounded-full flex items-center justify-center">
                                <span class="text-xs font-bold text-white">{{ substr($product->user->name, 0, 1) }}</span>
                            </div>
                            <span class="text-sm text-gray-600">{{ $product->user->name }}</span>
                        </div>
                        
                        <span class="text-xs text-gray-400">
                            {{ $product->created_at->diffForHumans() }}
                        </span>
                    </div>

                    <!-- Category -->
                    <div class="mt-3 pt-3 border-t border-gray-100">
                        <span class="inline-block px-2 py-1 bg-gray-100 text-gray-600 text-xs rounded-full">
                            {{ $product->category->name }}
                        </span>
                    </div>
                </div>

                <!-- Hover Actions -->
                <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                    <span class="px-6 py-2 bg-white text-gray-900 rounded-lg font-semibold">
                        عرض التفاصيل
                    </span>
                </div>
            </a>
        @empty
            <div class="col-span-full">
                <div class="elegant-card rounded-3xl shadow-xl p-12 text-center">
                    <svg class="w-24 h-24 text-gray-300 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                    </svg>
                    <h3 class="text-2xl font-bold text-gray-600 mb-2">لا توجد منتجات</h3>
                    <p class="text-gray-500 mb-6">لم يتم العثور على منتجات تطابق معايير البحث</p>
                    @auth
                        <a href="{{ route('products.create') }}" class="inline-block px-6 py-3 bg-gradient-to-r from-purple-600 to-indigo-600 text-white rounded-xl font-semibold hover:from-purple-700 hover:to-indigo-700 transition-all">
                            كن أول من يضيف إعلان
                        </a>
                    @endauth
                </div>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($products->hasPages())
        <div class="flex justify-center">
            {{ $products->links() }}
        </div>
    @endif

    <style>
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
</div>