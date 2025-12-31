@hasrole('admin')
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>التصنيفات - mazadi</title>
    
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
                التصنيفات
            </h2>
            <p class="text-xl text-gray-600 mb-8 max-w-2xl mx-auto">
                تصفح جميع التصنيفات المتاحة واختر ما يناسبك
            </p>
        </div>
    </section>

    <!-- Main Content -->
    <div class="container mx-auto px-4 pb-12 relative z-10">
        <div class="max-w-6xl mx-auto">
            
            <!-- Add Category Button -->
            <div class="mb-8 text-center">
                <a href="{{ route('categories.create') }}" 
                   class="inline-flex items-center gap-2 bg-gradient-to-r from-purple-600 to-indigo-600 text-white px-6 py-3 rounded-lg font-medium hover:from-purple-700 hover:to-indigo-700 transition-all duration-200 shadow-lg hover:shadow-xl">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    إضافة تصنيف جديد
                </a>
            </div>

            <!-- Categories Grid -->
            @if($categories->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($categories as $category)
                        <div class="elegant-card rounded-xl p-6 hover:shadow-xl transition-all duration-300 group">
                            <div class="flex items-start justify-between mb-4">
                                <div class="flex items-center gap-3">
                                    @if($category->getFirstMediaUrl('icon'))
                                        <img src="{{ $category->getFirstMediaUrl('icon') }}" 
                                             alt="{{ $category->name }}" 
                                             class="w-12 h-12 rounded-lg object-cover">
                                    @else
                                        <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-indigo-600 rounded-lg flex items-center justify-center">
                                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                            </svg>
                                        </div>
                                    @endif
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-900 group-hover:text-purple-600 transition-colors">
                                            {{ $category->name }}
                                        </h3>
                                        <p class="text-sm text-gray-500">
                                            {{ $category->products->count() }} منتج
                                        </p>
                                    </div>
                                </div>
                                
                                <!-- Actions Dropdown -->
                                <div class="relative" x-data="{ open: false }">
                                    <button @click="open = !open" 
                                            class="p-2 text-gray-400 hover:text-gray-600 transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path>
                                        </svg>
                                    </button>
                                    
                                    <div x-show="open" 
                                         @click.away="open = false"
                                         x-transition:enter="transition ease-out duration-100"
                                         x-transition:enter-start="transform opacity-0 scale-95"
                                         x-transition:enter-end="transform opacity-100 scale-100"
                                         x-transition:leave="transition ease-in duration-75"
                                         x-transition:leave-start="transform opacity-100 scale-100"
                                         x-transition:leave-end="transform opacity-0 scale-95"
                                         class="absolute left-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 z-10">
                                        <div class="py-1">
                                            <a href="{{ route('categories.show', $category) }}" 
                                               class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                </svg>
                                                عرض المنتجات
                                            </a>
                                            <a href="{{ route('categories.edit', $category) }}" 
                                               class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                </svg>
                                                تعديل
                                            </a>
                                            <form action="{{ route('categories.destroy', $category) }}" 
                                                  method="POST" 
                                                  class="block"
                                                  onsubmit="return confirm('هل أنت متأكد من حذف هذا التصنيف؟')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="flex items-center gap-2 w-full px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                    </svg>
                                                    حذف
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            @if($category->description)
                                <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                                    {{ $category->description }}
                                </p>
                            @endif
                            
                            <!-- Subcategories -->
                            @if($category->children->count() > 0)
                                <div class="mt-4">
                                    <h4 class="text-sm font-medium text-gray-700 mb-2">التصنيفات الفرعية:</h4>
                                    <div class="flex flex-wrap gap-2">
                                        @foreach($category->children as $child)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                                {{ $child->name }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                            
                            <!-- View Products Button -->
                            <div class="mt-4 pt-4 border-t border-gray-100">
                                <a href="{{ route('categories.show', $category) }}" 
                                   class="inline-flex items-center gap-2 text-purple-600 hover:text-purple-700 font-medium text-sm transition-colors">
                                    عرض المنتجات
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- Empty State -->
                <div class="text-center py-12">
                    <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">لا توجد تصنيفات</h3>
                    <p class="text-gray-500 mb-6">ابدأ بإضافة تصنيف جديد لتنظيم منتجاتك</p>
                    <a href="{{ route('categories.create') }}" 
                       class="inline-flex items-center gap-2 bg-gradient-to-r from-purple-600 to-indigo-600 text-white px-6 py-3 rounded-lg font-medium hover:from-purple-700 hover:to-indigo-700 transition-all duration-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        إضافة تصنيف جديد
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
