<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>المبيعات - إكسابها</title>
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
            <h2 class="text-4xl font-bold text-gray-900 mb-8 text-center">المبيعات</h2>

            @if($orders->count() > 0)
                <div class="max-w-4xl mx-auto space-y-4 relative z-10">
                    @foreach($orders as $order)
                        <div class="bg-white rounded-xl p-6 shadow-lg hover:shadow-xl transition">
                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <h3 class="text-xl font-semibold text-gray-900">طلب #{{ $order->id }}</h3>
                                    <p class="text-gray-500 text-sm">{{ $order->created_at->diffForHumans() }}</p>
                                </div>
                                <span class="px-4 py-2 rounded-full text-sm font-medium
                                    @if($order->status === 'pending') bg-yellow-100 text-yellow-800
                                    @elseif($order->status === 'completed') bg-green-100 text-green-800
                                    @elseif($order->status === 'cancelled') bg-red-100 text-red-800
                                    @else bg-blue-100 text-blue-800 @endif">
                                    {{ $order->status }}
                                </span>
                            </div>
                            
                            <div class="border-t pt-4">
                                <p class="text-gray-700 mb-2"><strong>المنتج:</strong> {{ $order->product->title }}</p>
                                <p class="text-gray-700 mb-2"><strong>السعر:</strong> {{ number_format($order->total_amount) }} ريال</p>
                                <p class="text-gray-700 mb-2"><strong>المشتري:</strong> {{ $order->buyer_name }}</p>
                                <p class="text-gray-700"><strong>الهاتف:</strong> {{ $order->buyer_phone }}</p>
                            </div>

                            <div class="mt-4 flex gap-3">
                                <a href="{{ route('orders.show', $order) }}" 
                                   class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition">
                                    عرض التفاصيل
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-8">
                    {{ $orders->links() }}
                </div>
            @else
                <div class="max-w-md mx-auto text-center bg-white rounded-xl p-12 shadow-lg">
                    <svg class="w-24 h-24 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">لا توجد مبيعات</h3>
                    <p class="text-gray-600 mb-6">لم يتم طلب أي من منتجاتك حتى الآن</p>
                </div>
            @endif
        </div>
    </section>
</body>
</html>
