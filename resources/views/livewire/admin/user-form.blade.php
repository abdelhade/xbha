<div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-lg font-bold mb-4">{{ $userId ? 'تعديل المستخدم' : 'إنشاء مستخدم' }}</h2>

    @if(session()->has('message'))
        <div class="mb-4 text-green-700">{{ session('message') }}</div>
    @endif

    <form wire:submit.prevent="save">
        <div class="mb-3">
            <label class="block mb-1">الاسم</label>
            <input wire:model="name" class="w-full border p-2 rounded" />
            @error('name') <div class="text-red-600">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="block mb-1">الإيميل</label>
            <input wire:model="email" class="w-full border p-2 rounded" />
            @error('email') <div class="text-red-600">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="block mb-1">الباسورد (أتركه فارغًا إن لم تتغير)</label>
            <input wire:model="password" type="password" class="w-full border p-2 rounded" />
            @error('password') <div class="text-red-600">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="block mb-1">الأدوار</label>
            @foreach($roles as $role)
                <label class="inline-flex items-center mr-3">
                    <input type="checkbox" wire:model="roles" value="{{ $role->name }}"> <span class="mr-2">{{ $role->name }}</span>
                </label>
            @endforeach
        </div>

        <div class="flex items-center justify-between">
            <a href="{{ route('admin.users.index') }}" class="text-gray-600">إلغاء</a>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">حفظ</button>
        </div>
    </form>
</div>