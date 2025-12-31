<x-admin-layout>
    <div class="mb-8 flex justify-between items-center">
        <div>
            <h2 class="text-3xl font-bold text-gray-900">إدارة المنتجات</h2>
            <p class="text-gray-500 mt-1">عرض وإدارة جميع الإعلانات في الموقع</p>
        </div>
    </div>

    <div class="glass-panel overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-right">
                <thead>
                    <tr class="text-gray-500 text-xs uppercase bg-gray-50 border-b border-gray-100">
                        <th class="px-6 py-4 font-medium">المنتج</th>
                        <th class="px-6 py-4 font-medium">البائع</th>
                        <th class="px-6 py-4 font-medium">السعر</th>
                        <th class="px-6 py-4 font-medium">الحالة</th>
                        <th class="px-6 py-4 font-medium">التاريخ</th>
                        <th class="px-6 py-4 font-medium">الإجراءات</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($products as $product)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-12 h-12 rounded-lg bg-gray-200 overflow-hidden flex-shrink-0 border border-gray-200">
                                        <img src="{{ $product->getFirstMediaUrl('images') ?: 'https://via.placeholder.com/150' }}"
                                            class="w-full h-full object-cover" alt="">
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
                                <span class="text-purple-600 font-bold text-sm">{{ number_format($product->price) }}
                                    ج.م</span>
                            </td>
                            <td class="px-6 py-4">
                                @if ($product->status)
                                    <span
                                        class="bg-green-100 text-green-700 px-2 py-1 rounded-full text-xs font-bold">نشط</span>
                                @else
                                    <span
                                        class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded-full text-xs font-bold">بانتظار
                                        الموافقة</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">
                                {{ $product->created_at->format('Y-m-d') }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">

                                    <form action="{{ route('admin.products.destroy', $product) }}" method="POST"
                                        onsubmit="return confirm('هل أنت متأكد من حذف هذا المنتج؟');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="p-1.5 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                </path>
                                            </svg>
                                        </button>
                                    </form>
                                    <a href="{{ route('admin.products.show', $product) }}"
                                        class="p-1.5 text-gray-400 hover:text-gray-900 bg-gray-100 hover:bg-gray-200 rounded-lg transition">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                            <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                                لا توجد منتجات
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t border-gray-100">
            {{ $products->links() }}
        </div>
    </div>
</x-admin-layout>
