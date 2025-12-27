<x-admin-layout>
    <div class="mb-8 flex justify-between items-center">
        <div>
            <h2 class="text-3xl font-bold text-gray-900">تفاصيل المنتج</h2>
            <p class="text-gray-500 mt-1">عرض التفاصيل والمزايدات</p>
        </div>
        <a href="{{ route('admin.products.index') }}"
            class="text-purple-600 hover:text-purple-700 flex items-center gap-1 font-bold">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3">
                </path>
            </svg>
            عودة للقائمة
        </a>
    </div>

    <!-- Product Details Card -->
    <div class="glass-panel p-6 mb-6">
        <div class="flex flex-col md:flex-row gap-6">
            <!-- Image -->
            <div class="w-full md:w-1/3">
                <img src="{{ $product->getFirstMediaUrl('images') ?: 'https://via.placeholder.com/400' }}"
                    alt="{{ $product->title }}" class="w-full rounded-xl shadow-lg object-cover h-64">
            </div>

            <!-- Info -->
            <div class="w-full md:w-2/3">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">{{ $product->title }}</h3>
                        <span
                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                            {{ $product->category->name }}
                        </span>
                        @if ($product->is_auction)
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-orange-100 text-orange-800 mr-2">
                                مزاد
                            </span>
                        @endif
                    </div>
                    <div class="text-left">
                        <div class="text-2xl font-bold text-purple-600">{{ number_format($product->price) }} ج.م</div>
                        @if ($product->is_auction)
                            <div class="text-sm text-gray-500 mt-1">أعلى مزايدة:
                                {{ number_format($product->current_bid) }} ج.م</div>
                        @endif
                    </div>
                </div>

                <div class="prose prose-sm max-w-none text-gray-600 mb-6">
                    <p>{{ $product->description }}</p>
                </div>

                <div class="flex items-center gap-4 border-t border-gray-100 pt-4">
                    <div class="flex items-center gap-2">
                        <div
                            class="w-8 h-8 rounded-full bg-purple-100 text-purple-600 flex items-center justify-center font-bold">
                            {{ substr($product->user->name, 0, 1) }}
                        </div>
                        <div>
                            <div class="text-sm font-bold text-gray-900">{{ $product->user->name }}</div>
                            <div class="text-xs text-gray-500">{{ $product->user->email }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bids Section -->
    @if ($product->is_auction || $product->bids->count() > 0)
        <div class="glass-panel overflow-hidden">
            <div class="p-6 border-b border-gray-100 bg-gray-50">
                <h3 class="text-lg font-bold text-gray-900">سجل المزايدات ({{ $product->bids->count() }})</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-right">
                    <thead>
                        <tr class="text-gray-500 text-xs uppercase bg-white border-b border-gray-100">
                            <th class="px-6 py-4 font-medium">المزايد</th>
                            <th class="px-6 py-4 font-medium">المبلغ</th>
                            <th class="px-6 py-4 font-medium">التاريخ</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 bg-white">
                        @forelse($product->bids->sortByDesc('amount') as $bid)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <span class="font-bold text-gray-900">{{ $bid->user->name }}</span>
                                        <span class="text-xs text-gray-400">({{ $bid->user->email }})</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-orange-600 font-bold">{{ number_format($bid->amount) }}
                                        ج.م</span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">
                                    {{ $bid->created_at->format('Y-m-d H:i:s') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-6 py-8 text-center text-gray-500">
                                    لا توجد مزايدات حتى الآن
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    @endif

</x-admin-layout>
