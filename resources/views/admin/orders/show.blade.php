<x-admin-layout>
    <div class="mb-8 flex justify-between items-center">
        <div>
            <h2 class="text-3xl font-bold text-gray-900">تفاصيل الطلب #{{ $order->id }}</h2>
            <p class="text-gray-500 mt-1">{{ $order->order_number }}</p>
        </div>
        <a href="{{ route('admin.orders.index') }}"
            class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold py-2 px-4 rounded-lg text-sm transition">
            العودة للطلبات
        </a>
    </div>

    @if(session('message'))
        <div class="mb-4 bg-green-100 text-green-700 px-4 py-3 rounded-lg">{{ session('message') }}</div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Order Info --}}
        <div class="lg:col-span-2 space-y-6">
            <div class="glass-panel p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4">معلومات المنتج</h3>
                <div class="flex gap-4 items-start">
                    @if($order->product && $order->product->getFirstMediaUrl('images'))
                        <img src="{{ $order->product->getFirstMediaUrl('images', 'thumb') }}"
                            class="w-20 h-20 object-cover rounded-lg" alt="{{ $order->product_title }}">
                    @endif
                    <div>
                        <p class="font-bold text-gray-900 text-lg">{{ $order->product_title }}</p>
                        <p class="text-gray-500 text-sm mt-1">الحالة: {{ $order->product_condition == 'new' ? 'جديد' : 'مستعمل' }}</p>
                        <p class="text-purple-600 font-bold mt-2">{{ number_format($order->product_price) }} ج.م</p>
                    </div>
                </div>
            </div>

            <div class="glass-panel p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4">معلومات المشتري</h3>
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <p class="text-gray-500">الاسم</p>
                        <p class="font-medium text-gray-900">{{ $order->buyer_name }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500">البريد الإلكتروني</p>
                        <p class="font-medium text-gray-900">{{ $order->buyer_email }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500">رقم الهاتف</p>
                        <p class="font-medium text-gray-900">{{ $order->buyer_phone ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500">العنوان</p>
                        <p class="font-medium text-gray-900">{{ $order->buyer_address ?? '-' }}</p>
                    </div>
                </div>
            </div>

            @if($order->seller)
            <div class="glass-panel p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4">معلومات البائع</h3>
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <p class="text-gray-500">الاسم</p>
                        <p class="font-medium text-gray-900">{{ $order->seller->name }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500">البريد الإلكتروني</p>
                        <p class="font-medium text-gray-900">{{ $order->seller->email }}</p>
                    </div>
                </div>
            </div>
            @endif

            @if($order->notes)
            <div class="glass-panel p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-2">ملاحظات</h3>
                <p class="text-gray-700 text-sm">{{ $order->notes }}</p>
            </div>
            @endif
        </div>

        {{-- Sidebar --}}
        <div class="space-y-6">
            <div class="glass-panel p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4">ملخص الطلب</h3>
                <div class="space-y-3 text-sm">
                    <div class="flex justify-between">
                        <span class="text-gray-500">رقم الطلب</span>
                        <span class="font-medium">{{ $order->order_number }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">تاريخ الطلب</span>
                        <span class="font-medium">{{ $order->created_at->format('Y-m-d') }}</span>
                    </div>
                    <div class="flex justify-between border-t pt-3">
                        <span class="text-gray-500">الإجمالي</span>
                        <span class="font-bold text-purple-600 text-base">{{ number_format($order->total_amount) }} ج.م</span>
                    </div>
                </div>
            </div>

            <div class="glass-panel p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4">الحالة</h3>
                @if($order->status == 'completed')
                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-bold">مكتمل</span>
                @elseif($order->status == 'pending')
                    <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm font-bold">معلق</span>
                @elseif($order->status == 'cancelled')
                    <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm font-bold">ملغي</span>
                @else
                    <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm font-bold">{{ $order->status }}</span>
                @endif

                @if($order->cancelled_at)
                    <p class="text-xs text-gray-500 mt-2">تم الإلغاء: {{ $order->cancelled_at->format('Y-m-d') }}</p>
                    @if($order->cancellation_reason)
                        <p class="text-xs text-gray-500 mt-1">السبب: {{ $order->cancellation_reason }}</p>
                    @endif
                @endif

                <form method="POST" action="{{ route('admin.orders.updateStatus', $order) }}" class="mt-4">
                    @csrf
                    @method('PATCH')
                    <select name="status" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm mb-3 focus:outline-none focus:ring-2 focus:ring-purple-300">
                        <option value="pending" @selected($order->status == 'pending')>معلق</option>
                        <option value="confirmed" @selected($order->status == 'confirmed')>مؤكد</option>
                        <option value="completed" @selected($order->status == 'completed')>مكتمل</option>
                        <option value="cancelled" @selected($order->status == 'cancelled')>ملغي</option>
                    </select>
                    <button type="submit"
                        class="w-full bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded-lg text-sm transition">
                        تحديث الحالة
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>
