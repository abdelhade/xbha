<x-admin-layout>
    <div class="mb-8 flex justify-between items-center">
        <div>
            <h2 class="text-3xl font-bold text-gray-900">إدارة الطلبات</h2>
            <p class="text-gray-500 mt-1">متابعة طلبات الشراء والمبيعات</p>
        </div>
    </div>

    <div class="glass-panel overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-right">
                <thead>
                    <tr class="text-gray-500 text-xs uppercase bg-gray-50 border-b border-gray-100">
                        <th class="px-6 py-4 font-medium">رقم الطلب</th>
                        <th class="px-6 py-4 font-medium">المشتري</th>
                        <th class="px-6 py-4 font-medium">إجمالي المبلغ</th>
                        <th class="px-6 py-4 font-medium">الحالة</th>
                        <th class="px-6 py-4 font-medium">التاريخ</th>
                        <th class="px-6 py-4 font-medium">الإجراءات</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($orders as $order)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 font-bold text-gray-900">
                                #{{ $order->id }}
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-700">
                                {{ $order->buyer->name }}
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-purple-600 font-bold">{{ number_format($order->total_price) }}
                                    ج.م</span>
                            </td>
                            <td class="px-6 py-4">
                                @if ($order->status == 'completed')
                                    <span
                                        class="bg-green-100 text-green-700 px-2 py-1 rounded-full text-xs font-bold">مكتمل</span>
                                @elseif($order->status == 'pending')
                                    <span
                                        class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded-full text-xs font-bold">معلق</span>
                                @elseif($order->status == 'cancelled')
                                    <span
                                        class="bg-red-100 text-red-700 px-2 py-1 rounded-full text-xs font-bold">ملغي</span>
                                @else
                                    <span
                                        class="bg-gray-100 text-gray-700 px-2 py-1 rounded-full text-xs font-bold">{{ $order->status }}</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">
                                {{ $order->created_at->format('Y-m-d H:i') }}
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ route('admin.orders.show', $order) }}"
                                    class="text-purple-600 hover:text-purple-800 font-bold text-sm">
                                    عرض التفاصيل
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                                لا توجد طلبات
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t border-gray-100">
            {{ $orders->links() }}
        </div>
    </div>
</x-admin-layout>
