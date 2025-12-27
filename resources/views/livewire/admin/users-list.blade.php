<div>
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-4">
        <div class="w-full sm:max-w-md">
            <input type="text" wire:model.debounce.300ms="search" placeholder="ابحث عن مستخدم" class="w-full rounded-xl border border-gray-200 bg-white px-4 py-2 text-sm focus:border-red-400 focus:ring-red-400" />
        </div>
    </div>

    @if(session()->has('message'))
        <div class="mb-4 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-900 text-right">{{ session('message') }}</div>
    @endif

    <div class="overflow-x-auto">
        <table class="w-full text-right">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-xs font-semibold text-gray-600">#</th>
                    <th class="px-4 py-3 text-xs font-semibold text-gray-600">الاسم</th>
                    <th class="px-4 py-3 text-xs font-semibold text-gray-600">الإيميل</th>
                    <th class="px-4 py-3 text-xs font-semibold text-gray-600">الأدوار</th>
                    <th class="px-4 py-3 text-xs font-semibold text-gray-600">إجراءات</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach($users as $user)
                    <tr class="hover:bg-gray-50/60">
                        <td class="px-4 py-3 text-sm text-gray-700">{{ $user->id }}</td>
                        <td class="px-4 py-3 text-sm text-gray-900">{{ $user->name }}</td>
                        <td class="px-4 py-3 text-sm text-gray-700">{{ $user->email }}</td>
                        <td class="px-4 py-3 text-sm text-gray-700">{{ $user->roles->pluck('name')->join(', ') }}</td>
                        <td class="px-4 py-3 text-sm">
                            <div class="flex items-center gap-2">
                                <a href="{{ route('admin.users.edit', $user) }}" class="inline-flex items-center justify-center px-3 py-2 rounded-xl bg-white border border-gray-200 text-gray-800 font-semibold hover:bg-gray-50 transition">تعديل</a>
                                @if($confirming === $user->id)
                                    <button type="button" wire:click="deleteUser({{ $user->id }})" class="inline-flex items-center justify-center px-3 py-2 rounded-xl bg-red-600 text-white font-semibold hover:bg-red-700 transition">تأكيد الحذف</button>
                                @else
                                    <button type="button" wire:click="confirmDelete({{ $user->id }})" class="inline-flex items-center justify-center px-3 py-2 rounded-xl bg-white border border-red-200 text-red-700 font-semibold hover:bg-red-50 transition">حذف</button>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $users->links() }}</div>
</div>