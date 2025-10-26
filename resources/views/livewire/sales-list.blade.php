<div>
    <div class="mb-6 flex gap-3">
        <button wire:click="$set('statusFilter', 'all')" 
                class="px-4 py-2 rounded-lg transition {{ $statusFilter === 'all' ? 'bg-purple-600 text-white' : 'bg-white text-gray-700 hover:bg-gray-100' }}">
            الكل
        </button>
        <button wire:click="$set('statusFilter', 'pending')" 
                class="px-4 py-2 rounded-lg transition {{ $statusFilter === 'pending' ? 'bg-yellow-600 text-white' : 'bg-white text-gray-700 hover:bg-gray-100' }}">
            قيد الانتظار
        </button>
        <button wire:click="$set('statusFilter', 'completed')" 
                class="px-4 py-2 rounded-lg transition {{ $statusFilter === 'completed' ? 'bg-green-600 text-white' : 'bg-white text-gray-700 hover:bg-gray-100' }}">
            مكتمل
        </button>
        <button wire:click="$set('statusFilter', 'cancelled')" 
                class="px-4 py-2 rounded-lg transition {{ $statusFilter === 'cancelled' ? 'bg-red-600 text-white' : 'bg-white text-gray-700 hover:bg-gray-100' }}">
            ملغي
        </button>
    </div>

    @if($orders->count() > 0)
        <div class="space-y-4">
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

                    <div class="mt-4">
                        <a href="{{ route('orders.show', $order) }}" 
                           class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition inline-block">
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
        <div class="text-center bg-white rounded-xl p-12 shadow-lg">
            <svg class="w-24 h-24 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
            </svg>
            <h3 class="text-2xl font-bold text-gray-900 mb-2">لا توجد مبيعات</h3>
            <p class="text-gray-600">لم يتم طلب أي من منتجاتك حتى الآن</p>
        </div>
    @endif
</div>
