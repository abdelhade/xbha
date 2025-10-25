<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>المفضلة - إكسابها</title>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
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
    </style>
</head>
<body class="gradient-bg min-h-screen" dir="rtl">
    <x-navbar />

    <section class="py-12 relative z-10">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl font-bold text-gray-900 mb-8 text-center">المفضلة</h2>

            @if($favorites->count() > 0)
                <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($favorites as $favorite)
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition">
                            @if($favorite->product->getFirstMediaUrl('images'))
                                <img src="{{ $favorite->product->getFirstMediaUrl('images') }}" 
                                     alt="{{ $favorite->product->title }}" 
                                     class="w-full h-48 object-cover">
                            @else
                                <div class="w-full h-48 bg-gradient-to-br from-purple-500 to-indigo-600 flex items-center justify-center">
                                    <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            @endif
                            
                            <div class="p-4">
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $favorite->product->title }}</h3>
                                <p class="text-purple-600 font-bold text-xl mb-3">{{ number_format($favorite->product->price) }} ريال</p>
                                
                                <div class="flex gap-2">
                                    <a href="{{ route('products.show', $favorite->product) }}" 
                                       class="flex-1 px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition text-center">
                                        عرض
                                    </a>
                                    <form action="{{ route('favorites.destroy', $favorite) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="px-4 py-2 bg-red-100 text-red-600 rounded-lg hover:bg-red-200 transition">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="max-w-md mx-auto text-center bg-white rounded-xl p-12 shadow-lg">
                    <svg class="w-24 h-24 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                    </svg>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">لا توجد مفضلات</h3>
                    <p class="text-gray-600 mb-6">لم تقم بإضافة أي منتجات للمفضلة</p>
                    <a href="{{ route('products.index') }}" 
                       class="inline-block px-6 py-3 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition">
                        تصفح المنتجات
                    </a>
                </div>
            @endif
        </div>
    </section>
</body>
</html>
