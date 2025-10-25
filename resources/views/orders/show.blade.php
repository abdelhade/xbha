<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>تفاصيل الطلب - إكسابها</title>
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
                        <h2 class="text-3xl font-bold mb-2">طلب #{{ $order->id }}</h2>
                        <p class="text-purple-100">{{ $order->created_at->format('Y-m-d H:i') }}</p>
                    </div>

                    <div class="p-6 space-y-6">
                        <div class="flex items-center justify-between pb-4 border-b">
                            <h3 class="text-lg font-semibold">حالة الطلب</h3>
                            <span class="px-4 py-2 rounded-full text-sm font-medium
                                @if($order->status === 'pending') bg-yellow-100 text-yellow-800
                                @elseif($order->status === 'completed') bg-green-100 text-green-800
                                @elseif($order->status === 'cancelled') bg-red-100 text-red-800
                                @else bg-blue-100 text-blue-800 @endif">
                                {{ $order->status }}
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

                        <div class="flex gap-3 pt-4">
                            <a href="{{ route('orders.index') }}" 
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
