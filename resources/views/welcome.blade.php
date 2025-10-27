<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>إكسابها - اكتشف، اشتري، وبيع الإعلانات المميزة</title>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Tajawal', sans-serif; }
        .hero-bg { background: linear-gradient(180deg, #f0f4ff 0%, #ffffff 100%); }
        .card-hover { transition: all 0.3s; }
        .card-hover:hover { transform: translateY(-8px); box-shadow: 0 20px 40px rgba(0,0,0,0.1); }
    </style>
</head>
<body class="bg-white">
    
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
                        أكبر سوق للإعلانات المبوبة في السعودية. تصفح آلاف الإعلانات من الإلكترونيات للسيارات والعقارات
                    </p>
                    
                    <div class="flex flex-wrap gap-4 mb-12">
                        <a href="/products" class="px-8 py-4 bg-purple-600 text-white rounded-lg font-bold text-lg hover:bg-purple-700 transition">
                            استكشف الآن
                        </a>
                        @auth
                            <a href="/products/create" class="px-8 py-4 border-2 border-purple-600 text-purple-600 rounded-lg font-bold text-lg hover:bg-purple-50 transition">
                                أضف إعلان
                            </a>
                        @else
                            <a href="{{ route('register') }}" class="px-8 py-4 border-2 border-purple-600 text-purple-600 rounded-lg font-bold text-lg hover:bg-purple-50 transition">
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
                
                <div class="relative">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-4">
                            <div class="bg-white rounded-2xl p-4 shadow-lg card-hover">
                                <div class="h-48 bg-gradient-to-br from-blue-100 to-purple-100 rounded-xl mb-3"></div>
                                <div class="h-4 bg-gray-200 rounded w-3/4 mb-2"></div>
                                <div class="h-3 bg-gray-100 rounded w-1/2"></div>
                            </div>
                            <div class="bg-white rounded-2xl p-4 shadow-lg card-hover">
                                <div class="h-32 bg-gradient-to-br from-green-100 to-blue-100 rounded-xl mb-3"></div>
                                <div class="h-4 bg-gray-200 rounded w-2/3 mb-2"></div>
                                <div class="h-3 bg-gray-100 rounded w-1/3"></div>
                            </div>
                        </div>
                        <div class="space-y-4 pt-8">
                            <div class="bg-white rounded-2xl p-4 shadow-lg card-hover">
                                <div class="h-40 bg-gradient-to-br from-orange-100 to-red-100 rounded-xl mb-3"></div>
                                <div class="h-4 bg-gray-200 rounded w-3/4 mb-2"></div>
                                <div class="h-3 bg-gray-100 rounded w-1/2"></div>
                            </div>
                            <div class="bg-white rounded-2xl p-4 shadow-lg card-hover">
                                <div class="h-36 bg-gradient-to-br from-pink-100 to-purple-100 rounded-xl mb-3"></div>
                                <div class="h-4 bg-gray-200 rounded w-2/3 mb-2"></div>
                                <div class="h-3 bg-gray-100 rounded w-1/3"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Products -->
    <section class="py-20 px-6 bg-gray-50">
        <div class="container mx-auto max-w-7xl">
            <div class="flex items-center justify-between mb-12">
                <div>
                    <h2 class="text-3xl font-bold text-gray-900 mb-2">أحدث الإعلانات</h2>
                    <p class="text-gray-600">تصفح أحدث المنتجات المعروضة</p>
                </div>
                <a href="/products" class="text-purple-600 font-semibold hover:text-purple-700">عرض الكل →</a>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">
                @forelse($products as $product)
                <a href="{{ route('products.show', $product->slug) }}" class="bg-white rounded-2xl overflow-hidden hover:shadow-xl transition card-hover">
                    @if($product->getFirstMediaUrl('images'))
                        <img src="{{ $product->getFirstMediaUrl('images') }}" alt="{{ $product->title }}" class="w-full h-48 object-cover">
                    @else
                        <div class="w-full h-48 bg-gradient-to-br from-blue-100 to-purple-100 flex items-center justify-center">
                            <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    @endif
                    <div class="p-4">
                        <h3 class="font-bold text-gray-900 mb-2 truncate">{{ $product->title }}</h3>
                        <p class="text-xl font-bold text-purple-600 mb-2">{{ number_format($product->price, 2) }} ريال</p>
                        <div class="flex items-center justify-between text-xs text-gray-500">
                            <span>{{ $product->category->name }}</span>
                            <span>{{ $product->location }}</span>
                        </div>
                    </div>
                </a>
                @empty
                <div class="col-span-5 text-center py-12">
                    <p class="text-gray-500">لا توجد منتجات حالياً</p>
                </div>
                @endforelse
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
                
                @foreach($categories as $cat)
                <a href="/products" class="bg-white border border-gray-200 rounded-xl p-6 hover:border-purple-600 hover:shadow-lg transition text-center">
                    <div class="text-4xl mb-2">{{ $cat['icon'] }}</div>
                    <div class="text-sm font-semibold text-gray-900">{{ $cat['name'] }}</div>
                </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Stats -->
    <section class="py-20 px-6 bg-white">
        <div class="container mx-auto max-w-7xl">
            <div class="grid md:grid-cols-3 gap-8 text-center">
                <div>
                    <div class="text-5xl font-bold text-purple-600 mb-2">10,000+</div>
                    <div class="text-xl text-gray-600">إعلان نشط</div>
                </div>
                <div>
                    <div class="text-5xl font-bold text-purple-600 mb-2">5,000+</div>
                    <div class="text-xl text-gray-600">مستخدم نشط</div>
                </div>
                <div>
                    <div class="text-5xl font-bold text-purple-600 mb-2">50,000+</div>
                    <div class="text-xl text-gray-600">عملية بيع</div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="py-20 px-6 bg-purple-600 text-white">
        <div class="container mx-auto max-w-4xl text-center">
            <h2 class="text-4xl md:text-5xl font-bold mb-6">ابدأ البيع والشراء اليوم</h2>
            <p class="text-xl mb-8 opacity-90">انضم لآلاف المستخدمين وابدأ في بيع وشراء الإعلانات</p>
            <div class="flex flex-wrap gap-4 justify-center">
                @auth
                    <a href="/products/create" class="px-10 py-4 bg-white text-purple-600 rounded-lg font-bold text-lg hover:bg-gray-100 transition">
                        أضف إعلانك الآن
                    </a>
                @else
                    <a href="{{ route('register') }}" class="px-10 py-4 bg-white text-purple-600 rounded-lg font-bold text-lg hover:bg-gray-100 transition">
                        ابدأ الآن
                    </a>
                @endauth
                <a href="/products" class="px-10 py-4 border-2 border-white text-white rounded-lg font-bold text-lg hover:bg-white/10 transition">
                    تصفح الإعلانات
                </a>
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
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
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
            <div class="border-t border-gray-800 pt-8 flex flex-col md:flex-row justify-between items-center text-sm text-gray-400">
                <p>&copy; {{ date('Y') }} إكسابها. جميع الحقوق محفوظة.</p>
                <div class="flex gap-6 mt-4 md:mt-0">
                    <a href="#" class="hover:text-white">الشروط</a>
                    <a href="#" class="hover:text-white">الخصوصية</a>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>
