<div>
    <!-- Existing Images -->
    @if($existingImages->count() > 0)
        <div class="elegant-card rounded-3xl shadow-xl p-8 mb-8">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-gray-900">الصور الحالية</h3>
                    <p class="text-gray-600 text-sm">انقر على الصورة لحذفها</p>
                </div>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
                @foreach($existingImages as $image)
                    <div class="relative group">
                        <img src="{{ $image->getUrl() }}" 
                             class="w-full h-24 object-cover rounded-lg shadow-md {{ in_array($image->id, $imagesToDelete) ? 'opacity-50 grayscale' : '' }}">
                        
                        @if(in_array($image->id, $imagesToDelete))
                            <button type="button" 
                                    wire:click="unmarkImageForDeletion({{ $image->id }})"
                                    class="absolute inset-0 bg-red-500/80 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                </svg>
                            </button>
                        @else
                            <button type="button" 
                                    wire:click="markImageForDeletion({{ $image->id }})"
                                    class="absolute top-2 right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Add New Images -->
    <div class="elegant-card rounded-3xl shadow-xl p-8 mb-8">
        <div class="flex items-center gap-3 mb-6">
            <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
            </div>
            <div>
                <h3 class="text-xl font-bold text-gray-900">إضافة صور جديدة</h3>
                <p class="text-gray-600 text-sm">أضف صور إضافية للمنتج</p>
            </div>
        </div>

        <div class="border-2 border-dashed border-gray-300 rounded-2xl p-8 text-center hover:border-purple-500 transition-colors">
            <input type="file" wire:model.live="newImages" multiple accept="image/*" class="hidden" id="newImages">
            
            <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
            <h4 class="text-lg font-semibold text-gray-700 mb-2">اضغط لإضافة صور جديدة</h4>
            <label for="newImages" class="cursor-pointer">
                <span class="mt-4 inline-block px-6 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition">
                    اختر الصور
                </span>
            </label>
            
            <div wire:loading wire:target="newImages" class="mt-4">
                <p class="text-purple-600">جاري رفع الصور...</p>
            </div>
        </div>

        @error('newImages.*') 
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p> 
        @enderror

        @if($newImages)
            <div class="mt-6">
                <p class="text-sm text-gray-600 mb-2">تم اختيار {{ count($newImages) }} صورة جديدة</p>
                <div class="flex flex-wrap gap-2">
                    @foreach($newImages as $index => $image)
                        <div class="flex items-center gap-2 bg-purple-50 px-3 py-2 rounded-lg">
                            <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <span class="text-sm text-gray-700">{{ $image->getClientOriginalName() }}</span>
                            <button type="button" 
                                    wire:click="$set('newImages.{{ $index }}', null)"
                                    class="text-red-500 hover:text-red-700">
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

    <!-- Product Information -->
    <div class="elegant-card rounded-3xl shadow-xl p-8 mb-8">
        <div class="flex items-center gap-3 mb-6">
            <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
            </div>
            <div>
                <h3 class="text-xl font-bold text-gray-900">معلومات المنتج</h3>
                <p class="text-gray-600 text-sm">تحديث تفاصيل المنتج</p>
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
                <select wire:model="category_id" class="w-full px-4 py-3 bg-white/70 border border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all">
                    <option value="">اختر التصنيف</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div class="md:col-span-2">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" wire:model.live="is_auction" class="w-5 h-5 text-purple-600 rounded focus:ring-purple-500">
                    <span class="text-sm font-medium text-gray-700">هل تريد جعل هذا المنتج في مزايدة؟</span>
                </label>
            </div>

            @if(!$is_auction)
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
            @else
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">سعر البداية (ريال) *</label>
                    <input wire:model="starting_price" 
                           type="number" 
                           step="0.01"
                           max="999999999"
                           placeholder="0.00"
                           class="w-full px-4 py-3 bg-white/70 border border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all">
                    @error('starting_price') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">مدة المزايدة (أيام) *</label>
                    <select wire:model="auction_days" class="w-full px-4 py-3 bg-white/70 border border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all">
                        <option value="1">1 يوم</option>
                        <option value="3">3 أيام</option>
                        <option value="7" selected>7 أيام</option>
                        <option value="14">14 يوم</option>
                        <option value="30">30 يوم</option>
                    </select>
                    @error('auction_days') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">الحد الأدنى للزيادة (ريال) *</label>
                    <input wire:model="min_bid_increment" 
                           type="number" 
                           step="1"
                           placeholder="10"
                           class="w-full px-4 py-3 bg-white/70 border border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all">
                    @error('min_bid_increment') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
            @endif

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

            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">حالة الإعلان</label>
                <div class="flex items-center gap-4">
                    <label class="flex items-center">
                        <input type="radio" wire:model="status" value="1" class="text-purple-600 focus:ring-purple-500">
                        <span class="mr-2 text-gray-700">نشط</span>
                    </label>
                    <label class="flex items-center">
                        <input type="radio" wire:model="status" value="0" class="text-gray-600 focus:ring-gray-500">
                        <span class="mr-2 text-gray-700">مسودة</span>
                    </label>
                </div>
            </div>
        </div>
    </div>

    <!-- Submit Buttons -->
    <div class="elegant-card rounded-3xl shadow-xl p-8">
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <button type="button" 
                    wire:click="update" 
                    wire:loading.attr="disabled"
                    class="px-8 py-4 bg-gradient-to-r from-purple-600 to-indigo-600 text-white rounded-xl font-semibold hover:from-purple-700 hover:to-indigo-700 transition-all shadow-lg disabled:opacity-50">
                <span wire:loading.remove wire:target="update">حفظ التغييرات</span>
                <span wire:loading wire:target="update">جاري الحفظ...</span>
            </button>
            
            <a href="{{ route('dashboard') }}" class="px-8 py-4 bg-white text-gray-700 border border-gray-300 rounded-xl font-semibold hover:bg-gray-50 transition-all text-center">
                إلغاء
            </a>
        </div>
    </div>
</div>