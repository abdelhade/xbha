<div>
    <!-- Product Images & Info -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-12">
        <!-- Image Gallery -->
        <div>
            @if($product->getMedia('images')->count() > 0)
                <!-- Main Image -->
                <div class="relative mb-4">
                    <img src="{{ $product->getMedia('images')[$currentImageIndex]->getUrl() }}" 
                         alt="{{ $product->title }}" 
                         class="w-full h-96 object-cover rounded-2xl shadow-lg">
                    
                    @if($product->getMedia('images')->count() > 1)
                        <!-- Navigation Arrows -->
                        <button wire:click="previousImage" 
                                class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-black/50 text-white p-2 rounded-full hover:bg-black/70 transition">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                        </button>
                        <button wire:click="nextImage" 
                                class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-black/50 text-white p-2 rounded-full hover:bg-black/70 transition">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </button>
                    @endif
                </div>

                <!-- Thumbnail Images -->
                @if($product->getMedia('images')->count() > 1)
                    <div class="grid grid-cols-4 gap-2">
                        @foreach($product->getMedia('images') as $index => $image)
                            <button wire:click="selectImage({{ $index }})" 
                                    class="relative overflow-hidden rounded-lg {{ $currentImageIndex === $index ? 'ring-2 ring-purple-500' : '' }}">
                                <img src="{{ $image->getUrl() }}" 
                                     alt="{{ $product->title }}" 
                                     class="w-full h-20 object-cover hover:scale-105 transition-transform">
                            </button>
                        @endforeach
                    </div>
                @endif
            @else
                <!-- No Image Placeholder -->
                <div class="w-full h-96 bg-gradient-to-br from-gray-100 to-gray-200 rounded-2xl flex items-center justify-center">
                    <svg class="w-24 h-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
            @endif
        </div>

        <!-- Product Info -->
        <div>
            <!-- Title & Price -->
            <div class="mb-6">
                <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $product->title }}</h1>
                <div class="flex items-center gap-4 mb-4">
                    <span class="text-4xl font-bold text-purple-600">{{ number_format($product->price) }} ر.س</span>
                    <span class="px-3 py-1 text-sm font-medium rounded-full
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
            </div>

            <!-- Product Details -->
            <div class="space-y-4 mb-6">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                    </svg>
                    <span class="text-gray-700">{{ $product->category->name }}</span>
                </div>
                
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <span class="text-gray-700">{{ $product->location }}</span>
                </div>

                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                    <span class="text-gray-700">{{ $product->views_count }} مشاهدة</span>
                </div>

                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="text-gray-700">{{ $product->created_at->diffForHumans() }}</span>
                </div>
            </div>

            <!-- Seller Info -->
            <div class="bg-gray-50 rounded-2xl p-6 mb-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">معلومات البائع</h3>
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-indigo-600 rounded-full flex items-center justify-center">
                        <span class="text-lg font-bold text-white">{{ substr($product->user->name, 0, 1) }}</span>
                    </div>
                    <div>
                        <h4 class="font-semibold text-gray-900">{{ $product->user->name }}</h4>
                        <p class="text-sm text-gray-600">عضو منذ {{ $product->user->created_at->format('Y') }}</p>
                    </div>
                </div>

                @if($showContactInfo)
                    <div class="bg-white rounded-lg p-4 border border-gray-200">
                        <p class="text-sm text-gray-600 mb-2">معلومات التواصل:</p>
                        <p class="font-medium text-gray-900">{{ $product->user->email }}</p>
                    </div>
                @endif
            </div>

            <!-- Action Buttons -->
            <div class="space-y-3">
                <button wire:click="toggleContactInfo" 
                        class="w-full py-4 bg-gradient-to-r from-purple-600 to-indigo-600 text-white rounded-xl font-semibold hover:from-purple-700 hover:to-indigo-700 transition-all shadow-lg">
                    @if($showContactInfo)
                        إخفاء معلومات التواصل
                    @else
                        عرض معلومات التواصل
                    @endif
                </button>
                
                <button class="w-full py-4 bg-green-600 text-white rounded-xl font-semibold hover:bg-green-700 transition-all">
                    إرسال رسالة للبائع
                </button>
                
                <button class="w-full py-4 bg-gray-200 text-gray-700 rounded-xl font-semibold hover:bg-gray-300 transition-all">
                    إضافة للمفضلة
                </button>
            </div>
        </div>
    </div>

    <!-- Product Description -->
    <div class="elegant-card rounded-3xl shadow-xl p-8 mb-12">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">وصف المنتج</h2>
        <div class="prose prose-lg max-w-none text-gray-700">
            <p class="whitespace-pre-line">{{ $product->description }}</p>
        </div>
    </div>

    <!-- Related Products -->
    @if($relatedProducts->count() > 0)
        <div class="elegant-card rounded-3xl shadow-xl p-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">منتجات مشابهة</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($relatedProducts as $relatedProduct)
                    <a href="{{ route('products.show', $relatedProduct->slug) }}" 
                       class="block bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 group">
                        <div class="relative h-48 bg-gray-200">
                            @if($relatedProduct->getFirstMediaUrl('images'))
                                <img src="{{ $relatedProduct->getFirstMediaUrl('images') }}" 
                                     alt="{{ $relatedProduct->title }}" 
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-gray-100 to-gray-200">
                                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            @endif
                            
                            <div class="absolute bottom-3 left-3">
                                <span class="px-2 py-1 bg-white/90 backdrop-blur-sm text-purple-600 font-bold rounded-full text-sm">
                                    {{ number_format($relatedProduct->price) }} ر.س
                                </span>
                            </div>
                        </div>
                        
                        <div class="p-4">
                            <h3 class="font-semibold text-gray-900 mb-2 line-clamp-2">{{ $relatedProduct->title }}</h3>
                            <p class="text-sm text-gray-600">{{ $relatedProduct->location }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
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