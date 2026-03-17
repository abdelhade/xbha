<div>
    @if($existingImages->count() > 0)
        <div style="background:rgba(26,46,53,.7);border:1px solid rgba(46,138,153,.15);border-radius:1.25rem;padding:1.5rem;margin-bottom:1.5rem">
            <div style="display:flex;align-items:center;gap:.75rem;margin-bottom:1.25rem">
                <div style="width:2.5rem;height:2.5rem;background:rgba(46,138,153,.15);border-radius:.75rem;display:flex;align-items:center;justify-content:center">
                    <svg style="width:1.25rem;height:1.25rem;color:#2e8a99" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                </div>
                <div>
                    <h3 style="font-size:1rem;font-weight:700;color:#f0e8cc">الصور الحالية</h3>
                    <p style="font-size:.78rem;color:rgba(240,232,204,.45)">انقر على الصورة لحذفها</p>
                </div>
            </div>
            <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(100px,1fr));gap:.75rem">
                @foreach($existingImages as $image)
                    <div style="position:relative">
                        <img src="{{ $image->getUrl() }}" style="width:100%;height:6rem;object-fit:cover;border-radius:.75rem;border:1px solid rgba(46,138,153,.2);{{ in_array($image->id, $imagesToDelete) ? 'opacity:.4;filter:grayscale(1)' : '' }}">
                        @if(in_array($image->id, $imagesToDelete))
                            <button type="button" wire:click="unmarkImageForDeletion({{ $image->id }})"
                                style="position:absolute;inset:0;background:rgba(244,124,81,.6);border-radius:.75rem;border:none;cursor:pointer;display:flex;align-items:center;justify-content:center">
                                <svg style="width:1.25rem;height:1.25rem;color:#fff" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                            </button>
                        @else
                            <button type="button" wire:click="markImageForDeletion({{ $image->id }})"
                                style="position:absolute;top:.35rem;right:.35rem;background:#f47c51;color:#fff;border:none;border-radius:50%;width:1.4rem;height:1.4rem;display:flex;align-items:center;justify-content:center;cursor:pointer;opacity:0;transition:opacity .2s"
                                onmouseover="this.parentElement.querySelector('img').style.opacity='.6'" onmouseout="this.parentElement.querySelector('img').style.opacity='1'"
                                class="delete-btn">
                                <svg style="width:.85rem;height:.85rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            </button>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    {{-- New Images --}}
    <div style="background:rgba(26,46,53,.7);border:1px solid rgba(46,138,153,.15);border-radius:1.25rem;padding:1.5rem;margin-bottom:1.5rem">
        <div style="display:flex;align-items:center;gap:.75rem;margin-bottom:1.25rem">
            <div style="width:2.5rem;height:2.5rem;background:rgba(46,138,153,.15);border-radius:.75rem;display:flex;align-items:center;justify-content:center">
                <svg style="width:1.25rem;height:1.25rem;color:#2e8a99" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
            </div>
            <div>
                <h3 style="font-size:1rem;font-weight:700;color:#f0e8cc">إضافة صور جديدة</h3>
                <p style="font-size:.78rem;color:rgba(240,232,204,.45)">أضف صور إضافية للمنتج</p>
            </div>
        </div>
        <div style="border:2px dashed rgba(46,138,153,.25);border-radius:1rem;padding:2rem;text-align:center">
            <input type="file" wire:model.live="newImages" multiple accept="image/*" class="hidden" id="newImages" style="display:none">
            <svg style="width:3rem;height:3rem;color:rgba(46,138,153,.3);margin:0 auto .75rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
            <label for="newImages" style="cursor:pointer">
                <span style="display:inline-block;padding:.5rem 1.25rem;background:#2e8a99;color:#fff;border-radius:.75rem;font-size:.875rem;font-weight:700">اختر الصور</span>
            </label>
            <div wire:loading wire:target="newImages" style="margin-top:.75rem;font-size:.875rem;color:#3aa0b0">جاري رفع الصور...</div>
        </div>
        @error('newImages.*') <p style="margin-top:.5rem;font-size:.78rem;color:#f47c51">{{ $message }}</p> @enderror
        @if($newImages)
            <div style="margin-top:1rem">
                <p style="font-size:.8rem;color:rgba(240,232,204,.5);margin-bottom:.5rem">تم اختيار {{ count($newImages) }} صورة جديدة</p>
                <div style="display:flex;flex-wrap:wrap;gap:.5rem">
                    @foreach($newImages as $index => $image)
                        <div style="display:flex;align-items:center;gap:.5rem;background:rgba(46,138,153,.1);border:1px solid rgba(46,138,153,.2);padding:.4rem .75rem;border-radius:.6rem">
                            <span style="font-size:.8rem;color:#f0e8cc">{{ $image->getClientOriginalName() }}</span>
                            <button type="button" wire:click="$set('newImages.{{ $index }}', null)" style="color:#f47c51;background:transparent;border:none;cursor:pointer;display:flex">
                                <svg style="width:.9rem;height:.9rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            </button>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>

    {{-- Product Info --}}
    <div style="background:rgba(26,46,53,.7);border:1px solid rgba(46,138,153,.15);border-radius:1.25rem;padding:1.5rem;margin-bottom:1.5rem">
        <div style="display:flex;align-items:center;gap:.75rem;margin-bottom:1.25rem">
            <div style="width:2.5rem;height:2.5rem;background:rgba(46,138,153,.15);border-radius:.75rem;display:flex;align-items:center;justify-content:center">
                <svg style="width:1.25rem;height:1.25rem;color:#2e8a99" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            </div>
            <div>
                <h3 style="font-size:1rem;font-weight:700;color:#f0e8cc">معلومات المنتج</h3>
                <p style="font-size:.78rem;color:rgba(240,232,204,.45)">تحديث تفاصيل المنتج</p>
            </div>
        </div>
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem">
            <div style="grid-column:1/-1">
                <label style="display:block;font-size:.78rem;font-weight:600;color:rgba(240,232,204,.5);margin-bottom:.4rem">عنوان الإعلان *</label>
                <input wire:model="title" type="text" placeholder="مثال: آيفون 14 برو ماكس 256 جيجا"
                    style="width:100%;padding:.65rem 1rem;background:rgba(15,30,35,.6);border:1px solid rgba(46,138,153,.2);border-radius:.75rem;color:#f0e8cc;font-family:inherit;font-size:.875rem;outline:none;box-sizing:border-box"
                    onfocus="this.style.borderColor='rgba(46,138,153,.5)'" onblur="this.style.borderColor='rgba(46,138,153,.2)'">
                @error('title') <p style="margin-top:.35rem;font-size:.78rem;color:#f47c51">{{ $message }}</p> @enderror
            </div>
            <div>
                <label style="display:block;font-size:.78rem;font-weight:600;color:rgba(240,232,204,.5);margin-bottom:.4rem">التصنيف *</label>
                <select wire:model="category_id"
                    style="width:100%;padding:.65rem 1rem;background:rgba(15,30,35,.6);border:1px solid rgba(46,138,153,.2);border-radius:.75rem;color:#f0e8cc;font-family:inherit;font-size:.875rem;outline:none">
                    <option value="">اختر التصنيف</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id') <p style="margin-top:.35rem;font-size:.78rem;color:#f47c51">{{ $message }}</p> @enderror
            </div>
            <div style="grid-column:1/-1">
                <label style="display:flex;align-items:center;gap:.5rem;cursor:pointer">
                    <input type="checkbox" wire:model.live="is_auction" style="width:1rem;height:1rem;accent-color:#2e8a99">
                    <span style="font-size:.875rem;color:rgba(240,232,204,.7)">هل تريد جعل هذا المنتج في مزايدة؟</span>
                </label>
            </div>
            @if(!$is_auction)
                <div>
                    <label style="display:block;font-size:.78rem;font-weight:600;color:rgba(240,232,204,.5);margin-bottom:.4rem">السعر (ريال) *</label>
                    <input wire:model="price" type="number" step="0.01" max="999999999" placeholder="0.00"
                        style="width:100%;padding:.65rem 1rem;background:rgba(15,30,35,.6);border:1px solid rgba(46,138,153,.2);border-radius:.75rem;color:#f0e8cc;font-family:inherit;font-size:.875rem;outline:none;box-sizing:border-box"
                        onfocus="this.style.borderColor='rgba(46,138,153,.5)'" onblur="this.style.borderColor='rgba(46,138,153,.2)'">
                    @error('price') <p style="margin-top:.35rem;font-size:.78rem;color:#f47c51">{{ $message }}</p> @enderror
                </div>
            @else
                <div>
                    <label style="display:block;font-size:.78rem;font-weight:600;color:rgba(240,232,204,.5);margin-bottom:.4rem">سعر البداية (ريال) *</label>
                    <input wire:model="starting_price" type="number" step="0.01" max="999999999" placeholder="0.00"
                        style="width:100%;padding:.65rem 1rem;background:rgba(15,30,35,.6);border:1px solid rgba(46,138,153,.2);border-radius:.75rem;color:#f0e8cc;font-family:inherit;font-size:.875rem;outline:none;box-sizing:border-box"
                        onfocus="this.style.borderColor='rgba(46,138,153,.5)'" onblur="this.style.borderColor='rgba(46,138,153,.2)'">
                    @error('starting_price') <p style="margin-top:.35rem;font-size:.78rem;color:#f47c51">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label style="display:block;font-size:.78rem;font-weight:600;color:rgba(240,232,204,.5);margin-bottom:.4rem">مدة المزايدة (أيام) *</label>
                    <select wire:model="auction_days"
                        style="width:100%;padding:.65rem 1rem;background:rgba(15,30,35,.6);border:1px solid rgba(46,138,153,.2);border-radius:.75rem;color:#f0e8cc;font-family:inherit;font-size:.875rem;outline:none">
                        <option value="1">1 يوم</option>
                        <option value="3">3 أيام</option>
                        <option value="7">7 أيام</option>
                        <option value="14">14 يوم</option>
                        <option value="30">30 يوم</option>
                    </select>
                </div>
                <div>
                    <label style="display:block;font-size:.78rem;font-weight:600;color:rgba(240,232,204,.5);margin-bottom:.4rem">الحد الأدنى للزيادة (ريال) *</label>
                    <input wire:model="min_bid_increment" type="number" step="1" placeholder="10"
                        style="width:100%;padding:.65rem 1rem;background:rgba(15,30,35,.6);border:1px solid rgba(46,138,153,.2);border-radius:.75rem;color:#f0e8cc;font-family:inherit;font-size:.875rem;outline:none;box-sizing:border-box"
                        onfocus="this.style.borderColor='rgba(46,138,153,.5)'" onblur="this.style.borderColor='rgba(46,138,153,.2)'">
                    @error('min_bid_increment') <p style="margin-top:.35rem;font-size:.78rem;color:#f47c51">{{ $message }}</p> @enderror
                </div>
            @endif
            <div>
                <label style="display:block;font-size:.78rem;font-weight:600;color:rgba(240,232,204,.5);margin-bottom:.4rem">حالة المنتج *</label>
                <select wire:model="condition"
                    style="width:100%;padding:.65rem 1rem;background:rgba(15,30,35,.6);border:1px solid rgba(46,138,153,.2);border-radius:.75rem;color:#f0e8cc;font-family:inherit;font-size:.875rem;outline:none">
                    <option value="">اختر الحالة</option>
                    <option value="new">جديد</option>
                    <option value="like_new">شبه جديد</option>
                    <option value="good">جيد</option>
                    <option value="fair">مقبول</option>
                    <option value="poor">يحتاج إصلاح</option>
                </select>
                @error('condition') <p style="margin-top:.35rem;font-size:.78rem;color:#f47c51">{{ $message }}</p> @enderror
            </div>
            <div>
                <label style="display:block;font-size:.78rem;font-weight:600;color:rgba(240,232,204,.5);margin-bottom:.4rem">الموقع *</label>
                <input wire:model="location" type="text" placeholder="مثال: الرياض، حي النخيل"
                    style="width:100%;padding:.65rem 1rem;background:rgba(15,30,35,.6);border:1px solid rgba(46,138,153,.2);border-radius:.75rem;color:#f0e8cc;font-family:inherit;font-size:.875rem;outline:none;box-sizing:border-box"
                    onfocus="this.style.borderColor='rgba(46,138,153,.5)'" onblur="this.style.borderColor='rgba(46,138,153,.2)'">
                @error('location') <p style="margin-top:.35rem;font-size:.78rem;color:#f47c51">{{ $message }}</p> @enderror
            </div>
            <div style="grid-column:1/-1">
                <label style="display:block;font-size:.78rem;font-weight:600;color:rgba(240,232,204,.5);margin-bottom:.4rem">وصف المنتج *</label>
                <textarea wire:model="description" rows="5" placeholder="اكتب وصفاً مفصلاً عن المنتج..."
                    style="width:100%;padding:.65rem 1rem;background:rgba(15,30,35,.6);border:1px solid rgba(46,138,153,.2);border-radius:.75rem;color:#f0e8cc;font-family:inherit;font-size:.875rem;outline:none;resize:vertical;box-sizing:border-box"
                    onfocus="this.style.borderColor='rgba(46,138,153,.5)'" onblur="this.style.borderColor='rgba(46,138,153,.2)'"></textarea>
                @error('description') <p style="margin-top:.35rem;font-size:.78rem;color:#f47c51">{{ $message }}</p> @enderror
            </div>
            <div style="grid-column:1/-1">
                <label style="display:block;font-size:.78rem;font-weight:600;color:rgba(240,232,204,.5);margin-bottom:.5rem">حالة الإعلان</label>
                <div style="display:flex;gap:1.5rem">
                    <label style="display:flex;align-items:center;gap:.4rem;cursor:pointer">
                        <input type="radio" wire:model="status" value="1" style="accent-color:#2e8a99">
                        <span style="font-size:.875rem;color:rgba(240,232,204,.7)">نشط</span>
                    </label>
                    <label style="display:flex;align-items:center;gap:.4rem;cursor:pointer">
                        <input type="radio" wire:model="status" value="0" style="accent-color:#2e8a99">
                        <span style="font-size:.875rem;color:rgba(240,232,204,.7)">مسودة</span>
                    </label>
                </div>
            </div>
        </div>
    </div>

    {{-- Submit --}}
    <div style="background:rgba(26,46,53,.7);border:1px solid rgba(46,138,153,.15);border-radius:1.25rem;padding:1.5rem">
        <div style="display:flex;flex-wrap:wrap;gap:.75rem;justify-content:center">
            <button type="button" wire:click="update" wire:loading.attr="disabled"
                style="padding:.75rem 2rem;background:#f47c51;color:#fff;border:none;border-radius:.75rem;font-family:inherit;font-size:.9rem;font-weight:700;cursor:pointer;transition:all .2s"
                onmouseover="this.style.background='#c95f3a'" onmouseout="this.style.background='#f47c51'">
                <span wire:loading.remove wire:target="update">حفظ التغييرات</span>
                <span wire:loading wire:target="update">جاري الحفظ...</span>
            </button>
            <a href="{{ route('dashboard') }}"
                style="padding:.75rem 2rem;background:transparent;border:1px solid rgba(240,232,204,.15);color:rgba(240,232,204,.5);border-radius:.75rem;font-size:.9rem;font-weight:600;text-decoration:none;text-align:center">
                إلغاء
            </a>
        </div>
    </div>

    <style>
        .delete-btn { opacity: 0 !important; }
        div:hover > .delete-btn { opacity: 1 !important; }
    </style>
</div>
