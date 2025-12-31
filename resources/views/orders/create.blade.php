<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>طلب شراء - mazadi</title>
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
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
            <div class="max-w-2xl mx-auto">
                <div class="bg-white rounded-xl shadow-lg p-8">
                    <h2 class="text-3xl font-bold text-gray-900 mb-6">إتمام الطلب</h2>

                    <div class="mb-6 p-4 bg-purple-50 rounded-lg border border-purple-200">
                        <div class="flex gap-4">
                            @if($product->getFirstMediaUrl('images'))
                                <img src="{{ $product->getFirstMediaUrl('images') }}" 
                                     alt="{{ $product->title }}" 
                                     class="w-20 h-20 rounded-lg object-cover">
                            @endif
                            <div>
                                <h3 class="font-semibold text-lg mb-1">{{ $product->title }}</h3>
                                <p class="text-gray-600 text-sm mb-2">{{ $product->category->name }}</p>
                                <p class="text-purple-600 font-bold text-xl">{{ number_format($product->price) }} ريال</p>
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('orders.store', $product) }}" method="POST" class="space-y-6">
                        @csrf

                        <div>
                            <label class="block text-gray-700 font-medium mb-2">الاسم الكامل *</label>
                            <input type="text" name="buyer_name" value="{{ old('buyer_name', auth()->user()->name) }}" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent" 
                                   required>
                            @error('buyer_name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-2">البريد الإلكتروني *</label>
                            <input type="email" name="buyer_email" value="{{ old('buyer_email', auth()->user()->email) }}" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent" 
                                   required>
                            @error('buyer_email')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-2">رقم الهاتف *</label>
                            <input type="tel" name="buyer_phone" value="{{ old('buyer_phone') }}" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent" 
                                   required>
                            @error('buyer_phone')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-2">العنوان</label>
                            <textarea name="buyer_address" rows="3" 
                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">{{ old('buyer_address') }}</textarea>
                            @error('buyer_address')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-2">ملاحظات إضافية</label>
                            <textarea name="notes" rows="3" 
                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent" 
                                      placeholder="أي ملاحظات أو طلبات خاصة...">{{ old('notes') }}</textarea>
                            @error('notes')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="flex justify-between items-center text-lg">
                                <span class="font-semibold">المجموع الكلي:</span>
                                <span class="text-2xl font-bold text-purple-600">{{ number_format($product->price) }} ريال</span>
                            </div>
                        </div>

                        <div class="flex gap-3">
                            <button type="submit" 
                                    class="flex-1 px-6 py-3 bg-gradient-to-r from-purple-600 to-indigo-600 text-white rounded-lg font-medium hover:from-purple-700 hover:to-indigo-700 transition">
                                تأكيد الطلب
                            </button>
                            <a href="{{ route('products.show', $product) }}" 
                               class="px-6 py-3 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition">
                                إلغاء
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
