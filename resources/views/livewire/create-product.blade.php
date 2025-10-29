<div>
    <!-- Product Images -->
    <div class="elegant-card rounded-3xl shadow-xl p-8 mb-8">
        <div class="flex items-center gap-3 mb-6">
            <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
            </div>
            <div>
                <h3 class="text-xl font-bold text-gray-900">صور المنتج</h3>
                <p class="text-gray-600 text-sm">أضف صور واضحة لمنتجك (حد أقصى 5 صور)</p>
            </div>
        </div>

        <div>
            <input type="file" wire:model="images" multiple accept="image/*" class="hidden" id="images">
            <label for="images" class="cursor-pointer">
                <div class="rounded-2xl p-8 text-center border-2 border-dashed border-gray-300 hover:border-purple-500 transition-colors">
                    <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    <h4 class="text-lg font-semibold text-gray-700 mb-2">اضغط لإضافة الصور</h4>
                    <span class="mt-4 inline-block px-6 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition">
                        اختر الصور
                    </span>
                </div>
            </label>
        </div>

        @error('images.*') 
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p> 
        @enderror

        @if($images)
            <div class="mt-6">
                <p class="text-sm text-gray-600 mb-3">تم اختيار {{ count($images) }} صورة</p>
                <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
                    @foreach($images as $index => $image)
                        <div class="relative group">
                            <div class="w-full h-32 bg-gradient-to-br from-purple-100 to-blue-100 rounded-lg shadow-md flex flex-col items-center justify-center p-3">
                                <svg class="w-12 h-12 text-purple-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <p class="text-xs text-center text-gray-700 font-medium">{{ $image->getClientOriginalName() }}</p>
                            </div>
                            <button type="button" 
                                    wire:click="removeImage({{ $index }})"
                                    class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-7 h-7 flex items-center justify-center shadow-lg hover:bg-red-600 transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>

    <!-- Basic Information -->
    <div class="elegant-card rounded-3xl shadow-xl p-8 mb-8">
        <div class="flex items-center gap-3 mb-6">
            <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
            </div>
            <div>
                <h3 class="text-xl font-bold text-gray-900">المعلومات الأساسية</h3>
                <p class="text-gray-600 text-sm">أدخل تفاصيل المنتج</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">عنوان الإعلان *</label>
                <input wire:model="title" 
                       type="text" 
                       placeholder="مثال: آيفون 14 برو ماكس 256 جيجا"
                       class="w-full px-4 py-3 bg-white/70 border border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all">
                @error('title') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">التصنيف *</label>
                <div class="flex gap-2">
                    <select wire:model="category_id" class="flex-1 px-4 py-3 bg-white/70 border border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all">
                        <option value="">اختر التصنيف</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <a href="{{ route('categories.create') }}" target="_blank" class="px-4 py-3 bg-green-600 text-white rounded-xl hover:bg-green-700 transition flex items-center justify-center" title="إضافة تصنيف جديد">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                    </a>
                </div>
                @error('category_id') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">السعر (ريال) *</label>
                <input wire:model="price" 
                       type="number" 
                       step="0.01"
                       max="999999999"
                       placeholder="0.00"
                       class="w-full px-4 py-3 bg-white/70 border border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all">
                @error('price') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">حالة المنتج *</label>
                <select wire:model="condition" class="w-full px-4 py-3 bg-white/70 border border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all">
                    <option value="">اختر الحالة</option>
                    <option value="new">جديد</option>
                    <option value="like_new">شبه جديد</option>
                    <option value="good">جيد</option>
                    <option value="fair">مقبول</option>
                    <option value="poor">يحتاج إصلاح</option>
                </select>
                @error('condition') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">الموقع *</label>
                <input wire:model="location" 
                       type="text" 
                       placeholder="مثال: الرياض، حي النخيل"
                       class="w-full px-4 py-3 bg-white/70 border border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all">
                @error('location') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">وصف المنتج *</label>
                <textarea wire:model="description" 
                          rows="5" 
                          placeholder="اكتب وصفاً مفصلاً عن المنتج، حالته، مميزاته، وأي معلومات مهمة أخرى..."
                          class="w-full px-4 py-3 bg-white/70 border border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all resize-none"></textarea>
                @error('description') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
        </div>
    </div>

    <!-- Submit Buttons -->
    <div class="elegant-card rounded-3xl shadow-xl p-8">
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <button type="button" 
                    wire:click="save" 
                    wire:loading.attr="disabled"
                    class="px-8 py-4 bg-gradient-to-r from-purple-600 to-indigo-600 text-white rounded-xl font-semibold hover:from-purple-700 hover:to-indigo-700 transition-all shadow-lg disabled:opacity-50">
                <span wire:loading.remove wire:target="save">نشر الإعلان</span>
                <span wire:loading wire:target="save">جاري النشر...</span>
            </button>
            
            <button type="button" 
                    wire:click="saveDraft" 
                    wire:loading.attr="disabled"
                    class="px-8 py-4 bg-gray-500 text-white rounded-xl font-semibold hover:bg-gray-600 transition-all shadow-lg disabled:opacity-50">
                <span wire:loading.remove wire:target="saveDraft">حفظ كمسودة</span>
                <span wire:loading wire:target="saveDraft">جاري الحفظ...</span>
            </button>
            
            <a href="{{ route('dashboard') }}" class="px-8 py-4 bg-white text-gray-700 border border-gray-300 rounded-xl font-semibold hover:bg-gray-50 transition-all text-center">
                إلغاء
            </a>
        </div>
    </div>
</div>