<x-admin-layout>
    <div class="mb-8 flex justify-between items-center">
        <div>
            <h2 class="text-3xl font-bold text-gray-900">لوحة المعلومات</h2>
            <p class="text-gray-500 mt-1">نظرة عامة على أداء الموقع والطلبات المعلقة</p>
        </div>
        <div class="text-sm text-gray-500">
            {{ now()->translatedFormat('l j F Y') }}
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Pending Requests -->
        <div class="glass-panel p-6 relative overflow-hidden group">
            <div
                class="absolute -right-4 -top-4 w-24 h-24 bg-purple-500/10 rounded-full blur-2xl group-hover:bg-purple-500/20 transition">
            </div>
            <div class="relative z-10">
                <div class="flex justify-between items-start mb-4">
                    <div class="p-2 bg-purple-500/10 rounded-lg text-purple-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <span class="text-xs font-medium bg-purple-100 text-purple-600 py-1 px-2 rounded-full">
                        يحتاج مراجعة
                    </span>
                </div>
                <h3 class="text-3xl font-bold text-gray-900 mb-1">{{ $pendingCount }}</h3>
                <p class="text-gray-500 text-sm">إعلانات بانتظار الموافقة</p>
            </div>
        </div>

        <!-- Total Products -->
        <div class="glass-panel p-6 relative overflow-hidden group">
            <div
                class="absolute -right-4 -top-4 w-24 h-24 bg-purple-500/10 rounded-full blur-2xl group-hover:bg-purple-500/20 transition">
            </div>
            <div class="relative z-10">
                <div class="flex justify-between items-start mb-4">
                    <div class="p-2 bg-purple-500/10 rounded-lg text-purple-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                </div>
                <h3 class="text-3xl font-bold text-gray-900 mb-1">{{ $productsCount }}</h3>
                <p class="text-gray-500 text-sm">إجمالي الإعلانات</p>
            </div>
        </div>

        <!-- Users -->
        <div class="glass-panel p-6 relative overflow-hidden group">
            <div
                class="absolute -right-4 -top-4 w-24 h-24 bg-purple-500/10 rounded-full blur-2xl group-hover:bg-purple-500/20 transition">
            </div>
            <div class="relative z-10">
                <div class="flex justify-between items-start mb-4">
                    <div class="p-2 bg-purple-500/10 rounded-lg text-purple-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                            </path>
                        </svg>
                    </div>
                </div>
                <h3 class="text-3xl font-bold text-gray-900 mb-1">{{ $usersCount }}</h3>
                <p class="text-gray-500 text-sm">مستخدم مسجل</p>
            </div>
        </div>

        <!-- Orders -->
        <div class="glass-panel p-6 relative overflow-hidden group">
            <div
                class="absolute -right-4 -top-4 w-24 h-24 bg-purple-500/10 rounded-full blur-2xl group-hover:bg-purple-500/20 transition">
            </div>
            <div class="relative z-10">
                <div class="flex justify-between items-start mb-4">
                    <div class="p-2 bg-purple-500/10 rounded-lg text-purple-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                    </div>
                    @if ($pendingOrdersCount > 0)
                        <span class="text-xs font-medium bg-purple-100 text-purple-600 py-1 px-2 rounded-full">
                            {{ $pendingOrdersCount }} جديد
                        </span>
                    @endif
                </div>
                <h3 class="text-3xl font-bold text-gray-900 mb-1">{{ $ordersCount }}</h3>
                <p class="text-gray-500 text-sm">إجمالي الطلبات</p>
            </div>
        </div>
    </div>

    <!-- Recent Pending Approvals -->
    <div class="glass-panel overflow-hidden">
        <div class="p-6 border-b border-gray-100 flex justify-between items-center bg-gray-50">
            <h3 class="text-lg font-bold text-gray-900">إعلانات بانتظار الموافقة</h3>
            <a href="{{ route('admin.products.approvals') }}" class="text-sm text-purple-600 hover:text-purple-700">عرض
                الكل</a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-right">
                <thead>
                    <tr class="text-gray-500 text-xs uppercase bg-gray-50 border-b border-gray-100">
                        <th class="px-6 py-4 font-medium">المنتج</th>
                        <th class="px-6 py-4 font-medium">البائع</th>
                        <th class="px-6 py-4 font-medium">السعر</th>
                        <th class="px-6 py-4 font-medium">التاريخ</th>
                        <th class="px-6 py-4 font-medium">الإجراءات</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($pendingProducts as $product)
                        <tr class="hover:bg-gray-50 transition group">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-12 h-12 rounded-lg bg-gray-200 overflow-hidden flex-shrink-0 border border-gray-200">
                                        <img src="{{ $product->getFirstMediaUrl('images') ?: 'https://via.placeholder.com/150' }}"
                                            class="w-full h-full object-cover group-hover:scale-110 transition duration-500"
                                            alt="">
                                    </div>
                                    <div class="min-w-0">
                                        <div class="font-medium text-gray-900 truncate max-w-[200px]"
                                            title="{{ $product->title }}">{{ $product->title }}</div>
                                        <div class="text-xs text-gray-500">
                                            {{ $product->category->name ?? 'بدون تصنيف' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-700">
                                {{ $product->user->name }}
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-emerald-600 font-bold text-sm">{{ number_format($product->price) }}
                                    ج.م</span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">
                                {{ $product->created_at->diffForHumans() }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <form action="{{ route('admin.products.approve', $product) }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="bg-emerald-50 text-emerald-600 hover:bg-emerald-600 hover:text-white px-3 py-1.5 rounded-lg text-xs font-bold transition flex items-center gap-1 border border-emerald-200">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            موافقة
                                        </button>
                                    </form>
                                    <a href="{{ route('admin.products.edit', $product) }}"
                                        class="p-1.5 text-gray-400 hover:text-gray-900 bg-gray-100 hover:bg-gray-200 rounded-lg transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                                            </path>
                                        </svg>
                                    </a>
                                    <a href="{{ route('products.show', $product->slug) }}" target="_blank"
                                        class="p-1.5 text-gray-400 hover:text-gray-900 bg-gray-100 hover:bg-gray-200 rounded-lg transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14">
                                            </path>
                                        </svg>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                                <div class="flex flex-col items-center gap-2">
                                    <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <p>لا توجد إعلانات بانتظار الموافقة</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>
