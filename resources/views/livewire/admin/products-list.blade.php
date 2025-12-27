<div>
    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between mb-4">
        <div class="flex items-center gap-2">
            <button type="button" wire:click="setFilter('all')" class="px-4 py-2 rounded-xl text-sm font-semibold transition border {{ $filter === 'all' ? 'bg-red-600 text-white border-red-600' : 'bg-white text-gray-800 border-gray-200 hover:bg-gray-50' }}">الكل</button>
            <button type="button" wire:click="setFilter('pending')" class="px-4 py-2 rounded-xl text-sm font-semibold transition border {{ $filter === 'pending' ? 'bg-red-600 text-white border-red-600' : 'bg-white text-gray-800 border-gray-200 hover:bg-gray-50' }}">معلقة</button>
            <button type="button" wire:click="setFilter('published')" class="px-4 py-2 rounded-xl text-sm font-semibold transition border {{ $filter === 'published' ? 'bg-red-600 text-white border-red-600' : 'bg-white text-gray-800 border-gray-200 hover:bg-gray-50' }}">منشورة</button>
        </div>
        <div class="w-full sm:max-w-md">
            <input type="text" wire:model.debounce.300ms="search" placeholder="ابحث عن منتج" class="w-full rounded-xl border border-gray-200 bg-white px-4 py-2 text-sm focus:border-red-400 focus:ring-red-400" />
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
                    <th class="px-4 py-3 text-xs font-semibold text-gray-600">الصورة</th>
                    <th class="px-4 py-3 text-xs font-semibold text-gray-600">العنوان</th>
                    <th class="px-4 py-3 text-xs font-semibold text-gray-600">البائع</th>
                    <th class="px-4 py-3 text-xs font-semibold text-gray-600">السعر</th>
                    <th class="px-4 py-3 text-xs font-semibold text-gray-600">الحالة</th>
                    <th class="px-4 py-3 text-xs font-semibold text-gray-600">إجراءات</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach($products as $product)
                    <tr class="hover:bg-gray-50/60">
                        <td class="px-4 py-3 text-sm text-gray-700">{{ $product->id }}</td>
                        <td class="px-4 py-3 text-sm">
                            @if($product->getFirstMediaUrl('featured') || $product->getFirstMediaUrl('images'))
                                <img src="{{ $product->getFirstMediaUrl('featured') ?: $product->getFirstMediaUrl('images') }}" class="h-12 w-12 rounded-xl object-cover border border-gray-200" />
                            @else
                                <span class="text-xs text-gray-400">—</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-900">{{ $product->title }}</td>
                        <td class="px-4 py-3 text-sm text-gray-700">{{ optional($product->user)->name }}</td>
                        <td class="px-4 py-3 text-sm text-gray-700">{{ $product->price }}</td>
                        <td class="px-4 py-3 text-sm">
                            @if($product->status)
                                <span class="inline-flex items-center px-2 py-1 rounded-lg text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">منشور</span>
                            @else
                                <span class="inline-flex items-center px-2 py-1 rounded-lg text-xs font-semibold bg-yellow-50 text-yellow-800 border border-yellow-200">معلّق</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-sm">
                            <div class="flex items-center gap-2">
                                <a href="{{ route('admin.products.edit', $product) }}" class="inline-flex items-center justify-center px-3 py-2 rounded-xl bg-white border border-gray-200 text-gray-800 font-semibold hover:bg-gray-50 transition">تعديل</a>
                                @if(! $product->status)
                                    <button type="button" wire:click="approveProduct({{ $product->id }})" class="inline-flex items-center justify-center px-3 py-2 rounded-xl bg-emerald-600 text-white font-semibold hover:bg-emerald-700 transition">موافقة</button>
                                @endif
                                @if($confirming === $product->id)
                                    <button type="button" wire:click="deleteProduct({{ $product->id }})" class="inline-flex items-center justify-center px-3 py-2 rounded-xl bg-red-600 text-white font-semibold hover:bg-red-700 transition">تأكيد الحذف</button>
                                @else
                                    <button type="button" wire:click="confirmDelete({{ $product->id }})" class="inline-flex items-center justify-center px-3 py-2 rounded-xl bg-white border border-red-200 text-red-700 font-semibold hover:bg-red-50 transition">حذف</button>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $products->links() }}</div>
</div>