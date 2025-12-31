<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>تفاصيل الطلب - mazadi</title>
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
            <div class="max-w-3xl mx-auto">
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="bg-gradient-to-r from-purple-600 to-indigo-600 p-6 text-white">
                        <div class="flex items-center justify-between">
                            <div>
                                <h2 class="text-3xl font-bold mb-2">طلب #{{ $order->id }}</h2>
                                <p class="text-purple-100">{{ $order->created_at->format('Y-m-d H:i') }}</p>
                            </div>
                            @if(auth()->id() === $order->buyer_id)
                                <a href="{{ route('chat.show', encrypt($order->seller_id)) }}" 
                                   class="px-6 py-3 bg-white text-purple-600 rounded-lg hover:bg-purple-50 transition font-semibold flex items-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                    </svg>
                                    مراسلة البائع
                                </a>
                            @elseif(auth()->id() === $order->seller_id)
                                <a href="{{ route('chat.show', encrypt($order->buyer_id)) }}" 
                                   class="px-6 py-3 bg-white text-purple-600 rounded-lg hover:bg-purple-50 transition font-semibold flex items-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                    </svg>
                                    مراسلة المشتري
                                </a>
                            @endif
                        </div>
                    </div>

                    <div class="p-6 space-y-6">
                        <div class="flex items-center justify-between pb-4 border-b">
                            <h3 class="text-lg font-semibold">حالة الطلب</h3>
                            <span class="px-4 py-2 rounded-full text-sm font-medium
                                @if($order->status === 'pending') bg-yellow-100 text-yellow-800
                                @elseif($order->status === 'completed') bg-green-100 text-green-800
                                @elseif($order->status === 'cancelled') bg-red-100 text-red-800
                                @else bg-blue-100 text-blue-800 @endif">
                                @if($order->status === 'pending') قيد الانتظار
                                @elseif($order->status === 'completed') مكتمل
                                @elseif($order->status === 'cancelled') ملغي
                                @else {{ $order->status }} @endif
                            </span>
                        </div>

                        <div class="pb-4 border-b">
                            <h3 class="text-lg font-semibold mb-4">المنتج</h3>
                            <div class="flex gap-4">
                                @if($order->product->getFirstMediaUrl('images'))
                                    <img src="{{ $order->product->getFirstMediaUrl('images') }}" 
                                         alt="{{ $order->product->title }}" 
                                         class="w-24 h-24 rounded-lg object-cover">
                                @endif
                                <div>
                                    <h4 class="font-semibold mb-1">{{ $order->product->title }}</h4>
                                    <p class="text-gray-600 text-sm mb-2">{{ $order->product->category->name }}</p>
                                    <p class="text-purple-600 font-bold">{{ number_format($order->product->price) }} ريال</p>
                                </div>
                            </div>
                        </div>

                        <div class="pb-4 border-b">
                            <h3 class="text-lg font-semibold mb-4">البائع</h3>
                            <p class="text-gray-700 mb-2"><strong>الاسم:</strong> {{ $order->seller->name }}</p>
                            <p class="text-gray-700"><strong>البريد:</strong> {{ $order->seller->email }}</p>
                        </div>

                        <div class="pb-4 border-b">
                            <h3 class="text-lg font-semibold mb-4">المشتري</h3>
                            <p class="text-gray-700 mb-2"><strong>الاسم:</strong> {{ $order->buyer_name }}</p>
                            <p class="text-gray-700 mb-2"><strong>الهاتف:</strong> {{ $order->buyer_phone }}</p>
                            <p class="text-gray-700"><strong>العنوان:</strong> {{ $order->buyer_address ?? 'غير محدد' }}</p>
                        </div>

                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="flex justify-between items-center">
                                <span class="text-lg font-semibold">المجموع</span>
                                <span class="text-2xl font-bold text-purple-600">{{ number_format($order->total_amount) }} ريال</span>
                            </div>
                        </div>

                        @if($order->notes)
                            <div>
                                <h3 class="text-lg font-semibold mb-2">ملاحظات</h3>
                                <p class="text-gray-700 bg-gray-50 p-4 rounded-lg">{{ $order->notes }}</p>
                            </div>
                        @endif

                        @if($order->status === 'pending')
                            @if(auth()->id() === $order->seller_id)
                                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                                    <h3 class="text-lg font-semibold mb-3">تغيير حالة الطلب</h3>
                                    <div class="flex gap-3">
                                        <form action="{{ route('orders.updateStatus', $order) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="completed">
                                            <button type="submit" 
                                                    class="px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition font-semibold">
                                                ✓ تم التسليم
                                            </button>
                                        </form>
                                        <form action="{{ route('orders.updateStatus', $order) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="cancelled">
                                            <button type="submit" 
                                                    onclick="return confirm('هل أنت متأكد من إلغاء الطلب؟')"
                                                    class="px-6 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 transition font-semibold">
                                                ✕ إلغاء الطلب
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @elseif(auth()->id() === $order->buyer_id)
                                <div class="bg-orange-50 border border-orange-200 rounded-lg p-4">
                                    <h3 class="text-lg font-semibold mb-3">إلغاء الطلب</h3>
                                    <p class="text-gray-600 text-sm mb-3">يمكنك إلغاء الطلب إذا لم يتم التسليم بعد</p>
                                    <form action="{{ route('orders.updateStatus', $order) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="cancelled">
                                        <button type="submit" 
                                                onclick="return confirm('هل أنت متأكد من إلغاء الطلب؟')"
                                                class="px-6 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 transition font-semibold">
                                            ✕ إلغاء الطلب
                                        </button>
                                    </form>
                                </div>
                            @endif
                        @endif

                        <div class="flex gap-3 pt-4">
                            <a href="{{ auth()->id() === $order->seller_id ? route('orders.sales') : route('orders.index') }}" 
                               class="px-6 py-3 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition">
                                العودة
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
