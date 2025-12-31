@hasrole('admin')
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $category->name }} - mazadi</title>
    
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

    <!-- Category Header -->
    <section class="py-12 relative z-10">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto text-center">
                <div class="flex items-center justify-center gap-4 mb-6">
                    @if($category->getFirstMediaUrl('icon'))
                        <img src="{{ $category->getFirstMediaUrl('icon') }}" 
                             alt="{{ $category->name }}" 
                             class="w-16 h-16 rounded-xl object-cover shadow-lg">
                    @else
                        <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-indigo-600 rounded-xl flex items-center justify-center shadow-lg">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                            </svg>
                        </div>
                    @endif
                    <div>
                        <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-2">
                            {{ $category->name }}
                        </h1>
                        @if($category->description)
                            <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                                {{ $category->description }}
                            </p>
                        @endif
                    </div>
                </div>
                
                <!-- Breadcrumb -->
                <nav class="flex items-center justify-center gap-2 text-sm text-gray-500 mb-8">
                    <a href="{{ route('products.index') }}" class="hover:text-purple-600 transition-colors">المنتجات</a>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                    <span class="text-gray-900 font-medium">{{ $category->name }}</span>
                </nav>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <div class="container mx-auto px-4 pb-12 relative z-10">
        <div class="max-w-6xl mx-auto">
            
            <!-- Products Count -->
            <div class="mb-8 text-center">
                <p class="text-lg text-gray-600">
                    عرض {{ $products->count() }} منتج في هذا التصنيف
                </p>
            </div>

            <!-- Products Grid -->
            @if($products->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach($products as $product)
                        <div class="elegant-card rounded-xl overflow-hidden hover:shadow-xl transition-all duration-300 group">
                            <!-- Product Image -->
                            <div class="relative h-48 bg-gray-100 overflow-hidden">
                                @if($product->getFirstMediaUrl('images'))
                                    <img src="{{ $product->getFirstMediaUrl('images') }}" 
                                         alt="{{ $product->title }}" 
                                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gray-100">
                                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                @endif
                                
                                <!-- Price Badge -->
                                <div class="absolute top-4 left-4 bg-white/90 backdrop-blur-sm rounded-lg px-3 py-1">
                                    <span class="text-lg font-bold text-gray-900">{{ number_format($product->price) }} ج.م</span>
                                </div>
                                
                                <!-- Status Badge -->
                                @if($product->status)
                                    <div class="absolute top-4 right-4 bg-green-500 text-white rounded-lg px-2 py-1 text-xs font-medium">
                                        متاح
                                    </div>
                                @else
                                    <div class="absolute top-4 right-4 bg-red-500 text-white rounded-lg px-2 py-1 text-xs font-medium">
                                        غير متاح
                                    </div>
                                @endif
                            </div>
                            
                            <!-- Product Info -->
                            <div class="p-4">
                                <h3 class="text-lg font-semibold text-gray-900 mb-2 line-clamp-2 group-hover:text-purple-600 transition-colors">
                                    {{ $product->title }}
                                </h3>
                                
                                @if($product->description)
                                    <p class="text-gray-600 text-sm mb-3 line-clamp-2">
                                        {{ $product->description }}
                                    </p>
                                @endif
                                
                                <!-- Product Meta -->
                                <div class="flex items-center justify-between text-sm text-gray-500 mb-4">
                                    <div class="flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                        {{ $product->views_count ?? 0 }} مشاهدة
                                    </div>
                                    <div class="flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        {{ $product->created_at->diffForHumans() }}
                                    </div>
                                </div>
                                
                                <!-- View Product Button -->
                                <a href="{{ route('products.show', $product) }}" 
                                   class="block w-full text-center bg-gradient-to-r from-purple-600 to-indigo-600 text-white py-2 rounded-lg hover:from-purple-700 hover:to-indigo-700 transition-all duration-200 font-medium">
                                    عرض التفاصيل
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <!-- Pagination -->
                @if($products->hasPages())
                    <div class="mt-12 flex justify-center">
                        {{ $products->links() }}
                    </div>
                @endif
            @else
                <!-- Empty State -->
                <div class="text-center py-12">
                    <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">لا توجد منتجات في هذا التصنيف</h3>
                    <p class="text-gray-500 mb-6">لم يتم إضافة أي منتجات في هذا التصنيف بعد</p>
                    <a href="{{ route('products.create') }}" 
                       class="inline-flex items-center gap-2 bg-gradient-to-r from-purple-600 to-indigo-600 text-white px-6 py-3 rounded-lg font-medium hover:from-purple-700 hover:to-indigo-700 transition-all duration-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        إضافة منتج جديد
                    </a>
                </div>
            @endif
        </div>
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
</body>
</html>
@endhasrole