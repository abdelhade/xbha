<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>الإشعارات - إكسابها</title>
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
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-4xl font-bold text-gray-900">الإشعارات</h2>
                @if($notifications->where('read_at', null)->count() > 0)
                    <form action="{{ route('notifications.markAllAsRead') }}" method="POST">
                        @csrf
                        <button type="submit" class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition">
                            تحديد الكل كمقروء
                        </button>
                    </form>
                @endif
            </div>

            @if($notifications->count() > 0)
                <div class="max-w-4xl mx-auto space-y-3">
                    @foreach($notifications as $notification)
                        <a href="{{ route('notifications.read', $notification->id) }}" 
                           class="block bg-white rounded-xl p-6 shadow hover:shadow-lg transition {{ $notification->read_at ? 'opacity-75' : 'border-r-4 border-purple-600' }}">
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="text-gray-900 font-medium mb-1">{{ $notification->data['message'] }}</p>
                                    <div class="flex items-center gap-4 text-sm text-gray-600">
                                        <span>رقم الطلب: {{ $notification->data['order_number'] }}</span>
                                        <span>•</span>
                                        <span>{{ $notification->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                                @if(!$notification->read_at)
                                    <div class="w-3 h-3 bg-purple-600 rounded-full"></div>
                                @endif
                            </div>
                        </a>
                    @endforeach
                </div>

                <div class="mt-8">
                    {{ $notifications->links() }}
                </div>
            @else
                <div class="max-w-md mx-auto text-center bg-white rounded-xl p-12 shadow-lg">
                    <svg class="w-24 h-24 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                    </svg>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">لا توجد إشعارات</h3>
                    <p class="text-gray-600">ليس لديك أي إشعارات حالياً</p>
                </div>
            @endif
        </div>
    </section>
</body>
</html>
