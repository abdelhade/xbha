<div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-lg font-bold mb-4">{{ $productId ? 'تعديل المنتج' : 'إنشاء منتج' }}</h2>

    @if(session()->has('message'))
        <div class="mb-4 text-green-700">{{ session('message') }}</div>
    @endif

    <form wire:submit.prevent="save">
        <div class="mb-3">
            <label class="block mb-1">العنوان</label>
            <input wire:model="title" class="w-full border p-2 rounded" />
            @error('title') <div class="text-red-600">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="block mb-1">الإسم للعنوان (slug)</label>
            <input wire:model="slug" class="w-full border p-2 rounded" />
            @error('slug') <div class="text-red-600">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="block mb-1">التصنيف</label>
            <select wire:model="category_id" class="w-full border p-2 rounded">
                <option value="">-- اختر تصنيف --</option>
                @foreach($categories as $c)
                    <option value="{{ $c->id }}">{{ $c->name }}</option>
                @endforeach
            </select>
            @error('category_id') <div class="text-red-600">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="block mb-1">البائع</label>
            <select wire:model="user_id" class="w-full border p-2 rounded">
                <option value="">-- اختر مستخدم --</option>
                @foreach($users as $u)
                    <option value="{{ $u->id }}">{{ $u->name }}</option>
                @endforeach
            </select>
            @error('user_id') <div class="text-red-600">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="block mb-1">السعر</label>
            <input wire:model="price" class="w-full border p-2 rounded" />
            @error('price') <div class="text-red-600">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="block mb-1">الوصف</label>
            <textarea wire:model="description" class="w-full border p-2 rounded"></textarea>
            @error('description') <div class="text-red-600">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="block mb-1">الصور</label>
            <input type="file" wire:model="images" multiple />
            @error('images.*') <div class="text-red-600">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="inline-flex items-center">
                <input type="checkbox" wire:model="status"> <span class="mr-2">مفعل</span>
            </label>
        </div>

        <div class="flex items-center justify-between">
            <a href="{{ route('admin.products.index') }}" class="text-gray-600">إلغاء</a>
            <div>
                @if($productId && ! $status)
                    <button type="button" wire:click="approve" class="px-4 py-2 bg-green-600 text-white rounded ml-2">موافقة ونشر</button>
                @endif
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">حفظ</button>
            </div>
        </div>
    </form>
</div>