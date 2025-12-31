<div>
    @if (session()->has('message'))
        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
            {{ session('message') }}
        </div>
    @endif

    <!-- Admin Pending Approvals Section -->
    @if (auth()->user()->hasRole('admin'))
        @php
            $pendingApprovals = \App\Models\Product::where('status', 0)->orderBy('created_at', 'desc')->take(5)->get();
        @endphp
        @if ($pendingApprovals->count() > 0)
            <div class="mb-8 bg-yellow-50 border border-yellow-200 rounded-xl p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-bold text-yellow-800 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z">
                            </path>
                        </svg>
                        طلبات الموافقة المعلقة
                    </h3>
                    <a href="{{ route('admin.products.approvals') }}" 
                       class="text-sm bg-yellow-600 text-white px-4 py-2 rounded-lg hover:bg-yellow-700 transition">
                        عرض الكل ({{ \App\Models\Product::where('status', 0)->count() }})
                    </a>
                </div>
                <div class="space-y-3">
                    @foreach ($pendingApprovals as $product)
                        <div class="bg-white rounded-lg p-4 shadow-sm border border-yellow-200">
                            <div class="flex items-start gap-4">
                                @if ($product->getMedia('images')->count() > 0)
                                    <img src="{{ $product->getMedia('images')->first()->getUrl() }}" 
                                         class="w-16 h-16 object-cover rounded-lg border border-gray-200">
                                @else
                                    <div class="w-16 h-16 bg-gray-100 rounded-lg border border-gray-200 flex items-center justify-center">
                                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                        </svg>
                                    </div>
                                @endif
                                <div class="flex-1">
                                    <h4 class="font-semibold text-gray-900 mb-1">{{ $product->title }}</h4>
                                    <p class="text-sm text-gray-600 mb-2">{{ Str::limit($product->description, 100) }}</p>
                                    <div class="flex items-center gap-4 text-sm">
                                        <span class="text-gray-500">السعر: {{ number_format($product->price) }} ج.م</span>
                                        <span class="text-gray-500">•</span>
                                        <span class="text-gray-500">{{ $product->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                                <div class="flex gap-2">
                                    <a href="{{ route('admin.products.edit', $product) }}" 
                                       class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                            </path>
                                        </svg>
                                    </a>
                                    <form action="{{ route('admin.products.approve', $product) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" 
                                                class="p-2 text-green-600 hover:bg-green-50 rounded-lg transition"
                                                onclick="return confirm('هل أنت متأكد من الموافقة على هذا المنتج؟')">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7"></path>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    @endif

    <div class="flex justify-between items-center mb-8">
        @if ($notifications->where('read_at', null)->count() > 0)
            <button wire:click="markAllAsRead"
                class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition">
                تحديد الكل كمقروء
            </button>
        @endif
    </div>

    @if ($notifications->count() > 0)
        <div class="space-y-3">
            @foreach ($notifications as $notification)
                <button wire:click="markAsRead('{{ $notification->id }}')"
                    class="block w-full text-right bg-white rounded-xl p-6 shadow hover:shadow-lg transition {{ $notification->read_at ? 'opacity-75' : 'border-r-4 border-purple-600' }}">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="text-gray-900 font-medium mb-1">{{ $notification->data['message'] }}</p>
                            <div class="flex items-center gap-4 text-sm text-gray-600">
                                @if (isset($notification->data['order_number']))
                                    <span>رقم الطلب: {{ $notification->data['order_number'] }}</span>
                                @elseif(isset($notification->data['amount']))
                                    <span>المبلغ: {{ number_format($notification->data['amount']) }} ج.م</span>
                                @endif
                                <span>•</span>
                                <span>{{ $notification->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                        @if (!$notification->read_at)
                            <div class="w-3 h-3 bg-purple-600 rounded-full"></div>
                        @endif
                    </div>
                </button>
            @endforeach
        </div>

        <div class="mt-8">
            {{ $notifications->links() }}
        </div>
    @else
        <div class="text-center bg-white rounded-xl p-12 shadow-lg">
            <svg class="w-24 h-24 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9">
                </path>
            </svg>
            <h3 class="text-2xl font-bold text-gray-900 mb-2">لا توجد إشعارات</h3>
            <p class="text-gray-600">ليس لديك أي إشعارات حالياً</p>
        </div>
    @endif
</div>
