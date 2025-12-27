<x-admin-layout>
    <div class="mb-8 flex justify-between items-center">
        <div>
            <h2 class="text-3xl font-bold ">سجل الموافقات</h2>
            <p class="text-gray-400 mt-1">تاريخ عمليات الموافقة على الإعلانات</p>
        </div>
    </div>

    <div class="glass-panel overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-right">
                <thead>
                    <tr class="text-gray-400 text-xs uppercase bg-white/5 border-b border-white/5">
                        <th class="px-6 py-4 font-medium">المنتج</th>
                        <th class="px-6 py-4 font-medium">المسؤول</th>
                        <th class="px-6 py-4 font-medium">العملية</th>
                        <th class="px-6 py-4 font-medium">التاريخ</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse($approvals as $approval)
                        <tr class="hover:bg-white/5 transition">
                            <td class="px-6 py-4">
                                @if ($approval->product)
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-10 h-10 rounded-lg bg-gray-700 overflow-hidden flex-shrink-0 border border-white/10">
                                            <img src="{{ $approval->product->getFirstMediaUrl('images') ?: 'https://via.placeholder.com/150' }}"
                                                class="w-full h-full object-cover" alt="">
                                        </div>
                                        <div class="font-medium text-white">
                                            <a href="{{ route('admin.products.show', $approval->product) }}"
                                                class="hover:text-purple-400 transition">
                                                {{ $approval->product->title }}
                                            </a>
                                        </div>
                                    </div>
                                @else
                                    <span class="text-gray-500 italic">منتج محذوف</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-gray-300">
                                {{ $approval->admin->name ?? 'غير معروف' }}
                            </td>
                            <td class="px-6 py-4">
                                @if ($approval->action == 'approved')
                                    <span
                                        class="bg-emerald-500/10 text-emerald-400 px-2 py-1 rounded text-xs font-bold border border-emerald-500/20">
                                        موافقة
                                    </span>
                                @elseif($approval->action == 'rejected')
                                    <span
                                        class="bg-red-500/10 text-red-400 px-2 py-1 rounded text-xs font-bold border border-red-500/20">
                                        رفض
                                    </span>
                                @else
                                    <span class="bg-gray-500/10 text-gray-400 px-2 py-1 rounded text-xs font-bold">
                                        {{ $approval->action }}
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-400">
                                {{ $approval->created_at->format('Y-m-d H:i') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-8 text-center text-gray-500">
                                لا توجد سجلات
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-4 border-t border-white/5">
            {{ $approvals->links() }}
        </div>
    </div>
</x-admin-layout>
