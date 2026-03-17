<div>
    <!-- Images -->
    <div style="background:rgba(26,46,53,.7);border:1px solid rgba(46,138,153,.15);border-radius:1.25rem;padding:1.5rem;margin-bottom:1.5rem">
        <h3 style="font-size:1rem;font-weight:700;color:#f0e8cc;margin-bottom:1.25rem">صور المنتج</h3>
        <input type="file" wire:model="images" multiple accept="image/*" class="hidden" id="images">
        <label for="images" style="cursor:pointer;display:block">
            <div style="border:2px dashed rgba(46,138,153,.3);border-radius:1rem;padding:2.5rem;text-align:center;transition:border-color .2s"
                 onmouseover="this.style.borderColor='rgba(46,138,153,.6)'" onmouseout="this.style.borderColor='rgba(46,138,153,.3)'">
                <svg style="width:3rem;height:3rem;margin:0 auto .75rem;color:rgba(46,138,153,.4)" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <p style="color:rgba(240,232,204,.6);font-size:.9rem;margin-bottom:.75rem">اضغط لإضافة الصور (حد أقصى 5 صور)</p>
                <span style="display:inline-block;padding:.5rem 1.25rem;background:#2e8a99;color:#fff;border-radius:.65rem;font-size:.85rem;font-weight:700">اختر الصور</span>
            </div>
        </label>
        @error('images.*') <p style="margin-top:.5rem;font-size:.8rem;color:#f47c51">{{ $message }}</p> @enderror
        @if($images)
            <div style="margin-top:1.25rem">
                <p style="font-size:.8rem;color:rgba(240,232,204,.5);margin-bottom:.75rem">تم اختيار {{ count($images) }} صورة</p>
                <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(100px,1fr));gap:.75rem">
                    @foreach($images as $index => $image)
                        <div style="position:relative">
                            <div style="background:rgba(46,138,153,.1);border:1px solid rgba(46,138,153,.2);border-radius:.75rem;padding:.75rem;text-align:center">
                                <svg style="width:2rem;height:2rem;margin:0 auto .4rem;color:#2e8a99" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <p style="font-size:.7rem;color:rgba(240,232,204,.5);overflow:hidden;text-overflow:ellipsis;white-space:nowrap">{{ $image->getClientOriginalName() }}</p>
                            </div>
                            <button type="button" wire:click="removeImage({{ $index }})"
                                style="position:absolute;top:-.4rem;right:-.4rem;width:1.4rem;height:1.4rem;background:#f47c51;color:#fff;border:none;border-radius:50%;cursor:pointer;font-size:.75rem;display:flex;align-items:center;justify-content:center">✕</button>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>

    <!-- Basic Info -->
    <div style="background:rgba(26,46,53,.7);border:1px solid rgba(46,138,153,.15);border-radius:1.25rem;padding:1.5rem;margin-bottom:1.5rem">
        <h3 style="font-size:1rem;font-weight:700;color:#f0e8cc;margin-bottom:1.25rem">المعلومات الأساسية</h3>
        <div style="display:grid;grid-template-columns:1fr;gap:1rem">
            <div>
                <label style="display:block;font-size:.78rem;font-weight:600;color:rgba(240,232,204,.5);margin-bottom:.4rem">عنوان الإعلان *</label>
                <input wire:model="title" type="text" placeholder="مثال: آيفون 14 برو ماكس 256 جيجا"
                    style="width:100%;padding:.65rem 1rem;background:rgba(15,30,35,.6);border:1px solid rgba(46,138,153,.2);border-radius:.75rem;color:#f0e8cc;font-family:'Noto Kufi Arabic',sans-serif;font-size:.875rem;outline:none;transition:all .3s"
                    onfocus="this.style.borderColor='rgba(46,138,153,.5)'" onblur="this.style.borderColor='rgba(46,138,153,.2)'">
                @error('title') <p style="margin-top:.35rem;font-size:.78rem;color:#f47c51">{{ $message }}</p> @enderror
            </div>

            <div>
                <label style="display:block;font-size:.78rem;font-weight:600;color:rgba(240,232,204,.5);margin-bottom:.4rem">التصنيف *</label>
                <div style="display:flex;gap:.5rem">
                    <select wire:model="category_id"
                        style="flex:1;padding:.65rem 1rem;background:rgba(15,30,35,.6);border:1px solid rgba(46,138,153,.2);border-radius:.75rem;color:#f0e8cc;font-family:'Noto Kufi Arabic',sans-serif;font-size:.875rem;outline:none">
                        <option value="">اختر التصنيف</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @hasrole('admin')
                    <a href="{{ route('categories.create') }}" target="_blank"
                        style="padding:.65rem .9rem;background:rgba(46,138,153,.2);border:1px solid rgba(46,138,153,.3);color:#3aa0b0;border-radius:.75rem;text-decoration:none;display:flex;align-items:center">
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                    </a>
                    @endhasrole
                </div>
                @error('category_id') <p style="margin-top:.35rem;font-size:.78rem;color:#f47c51">{{ $message }}</p> @enderror
            </div>

            <div>
                <label style="display:flex;align-items:center;gap:.5rem;cursor:pointer">
                    <input type="checkbox" wire:model.live="is_auction" style="width:1.1rem;height:1.1rem;accent-color:#2e8a99">
                    <span style="font-size:.875rem;color:rgba(240,232,204,.7)">جعل هذا المنتج في مزايدة</span>
                </label>
            </div>

            @if(!$is_auction)
                <div>
                    <label style="display:block;font-size:.78rem;font-weight:600;color:rgba(240,232,204,.5);margin-bottom:.4rem">السعر (ج.م) *</label>
                    <input wire:model="price" type="number" step="0.01" placeholder="0.00"
                        style="width:100%;padding:.65rem 1rem;background:rgba(15,30,35,.6);border:1px solid rgba(46,138,153,.2);border-radius:.75rem;color:#f0e8cc;font-family:'Noto Kufi Arabic',sans-serif;font-size:.875rem;outline:none;transition:all .3s"
                        onfocus="this.style.borderColor='rgba(46,138,153,.5)'" onblur="this.style.borderColor='rgba(46,138,153,.2)'">
                    @error('price') <p style="margin-top:.35rem;font-size:.78rem;color:#f47c51">{{ $message }}</p> @enderror
                </div>
            @else
                <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(180px,1fr));gap:1rem">
                    <div>
                        <label style="display:block;font-size:.78rem;font-weight:600;color:rgba(240,232,204,.5);margin-bottom:.4rem">سعر البداية (ج.م) *</label>
                        <input wire:model="starting_price" type="number" step="0.01" placeholder="0.00"
                            style="width:100%;padding:.65rem 1rem;background:rgba(15,30,35,.6);border:1px solid rgba(46,138,153,.2);border-radius:.75rem;color:#f0e8cc;font-family:'Noto Kufi Arabic',sans-serif;font-size:.875rem;outline:none"
                            onfocus="this.style.borderColor='rgba(46,138,153,.5)'" onblur="this.style.borderColor='rgba(46,138,153,.2)'">
                        @error('starting_price') <p style="margin-top:.35rem;font-size:.78rem;color:#f47c51">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label style="display:block;font-size:.78rem;font-weight:600;color:rgba(240,232,204,.5);margin-bottom:.4rem">مدة المزايدة *</label>
                        <select wire:model="auction_days"
                            style="width:100%;padding:.65rem 1rem;background:rgba(15,30,35,.6);border:1px solid rgba(46,138,153,.2);border-radius:.75rem;color:#f0e8cc;font-family:'Noto Kufi Arabic',sans-serif;font-size:.875rem;outline:none">
                            <option value="1">1 يوم</option>
                            <option value="3">3 أيام</option>
                            <option value="7" selected>7 أيام</option>
                            <option value="14">14 يوم</option>
                            <option value="30">30 يوم</option>
                        </select>
                    </div>
                    <div>
                        <label style="display:block;font-size:.78rem;font-weight:600;color:rgba(240,232,204,.5);margin-bottom:.4rem">الحد الأدنى للزيادة *</label>
                        <input wire:model="min_bid_increment" type="number" step="1" placeholder="10"
                            style="width:100%;padding:.65rem 1rem;background:rgba(15,30,35,.6);border:1px solid rgba(46,138,153,.2);border-radius:.75rem;color:#f0e8cc;font-family:'Noto Kufi Arabic',sans-serif;font-size:.875rem;outline:none"
                            onfocus="this.style.borderColor='rgba(46,138,153,.5)'" onblur="this.style.borderColor='rgba(46,138,153,.2)'">
                    </div>
                </div>
            @endif

            <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(180px,1fr));gap:1rem">
                <div>
                    <label style="display:block;font-size:.78rem;font-weight:600;color:rgba(240,232,204,.5);margin-bottom:.4rem">حالة المنتج *</label>
                    <select wire:model="condition"
                        style="width:100%;padding:.65rem 1rem;background:rgba(15,30,35,.6);border:1px solid rgba(46,138,153,.2);border-radius:.75rem;color:#f0e8cc;font-family:'Noto Kufi Arabic',sans-serif;font-size:.875rem;outline:none">
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
                    <input wire:model="location" type="text" placeholder="مثال: القاهرة، المعادي"
                        style="width:100%;padding:.65rem 1rem;background:rgba(15,30,35,.6);border:1px solid rgba(46,138,153,.2);border-radius:.75rem;color:#f0e8cc;font-family:'Noto Kufi Arabic',sans-serif;font-size:.875rem;outline:none"
                        onfocus="this.style.borderColor='rgba(46,138,153,.5)'" onblur="this.style.borderColor='rgba(46,138,153,.2)'">
                    @error('location') <p style="margin-top:.35rem;font-size:.78rem;color:#f47c51">{{ $message }}</p> @enderror
                </div>
            </div>

            <div>
                <label style="display:block;font-size:.78rem;font-weight:600;color:rgba(240,232,204,.5);margin-bottom:.4rem">وصف المنتج *</label>
                <textarea wire:model="description" rows="5" placeholder="اكتب وصفاً مفصلاً عن المنتج، حالته، مميزاته..."
                    style="width:100%;padding:.65rem 1rem;background:rgba(15,30,35,.6);border:1px solid rgba(46,138,153,.2);border-radius:.75rem;color:#f0e8cc;font-family:'Noto Kufi Arabic',sans-serif;font-size:.875rem;outline:none;resize:vertical;transition:all .3s"
                    onfocus="this.style.borderColor='rgba(46,138,153,.5)'" onblur="this.style.borderColor='rgba(46,138,153,.2)'"></textarea>
                @error('description') <p style="margin-top:.35rem;font-size:.78rem;color:#f47c51">{{ $message }}</p> @enderror
            </div>
        </div>
    </div>

    <!-- Actions -->
    <div style="display:flex;gap:.75rem;flex-wrap:wrap">
        <button type="button" wire:click="save" wire:loading.attr="disabled"
            style="flex:1;min-width:140px;padding:.75rem 1.5rem;background:#f47c51;color:#fff;border:none;border-radius:.75rem;font-family:'Noto Kufi Arabic',sans-serif;font-size:.9rem;font-weight:700;cursor:pointer;transition:all .2s"
            onmouseover="this.style.background='#c95f3a'" onmouseout="this.style.background='#f47c51'">
            <span wire:loading.remove wire:target="save">نشر الإعلان</span>
            <span wire:loading wire:target="save">جاري النشر...</span>
        </button>
        <button type="button" wire:click="saveDraft" wire:loading.attr="disabled"
            style="flex:1;min-width:140px;padding:.75rem 1.5rem;background:rgba(46,138,153,.15);color:#3aa0b0;border:1px solid rgba(46,138,153,.3);border-radius:.75rem;font-family:'Noto Kufi Arabic',sans-serif;font-size:.9rem;font-weight:700;cursor:pointer;transition:all .2s"
            onmouseover="this.style.background='rgba(46,138,153,.25)'" onmouseout="this.style.background='rgba(46,138,153,.15)'">
            <span wire:loading.remove wire:target="saveDraft">حفظ كمسودة</span>
            <span wire:loading wire:target="saveDraft">جاري الحفظ...</span>
        </button>
        <a href="{{ route('dashboard') }}"
            style="flex:1;min-width:140px;padding:.75rem 1.5rem;background:transparent;color:rgba(240,232,204,.5);border:1px solid rgba(240,232,204,.15);border-radius:.75rem;font-size:.9rem;font-weight:600;text-decoration:none;text-align:center;transition:all .2s"
            onmouseover="this.style.borderColor='rgba(240,232,204,.3)';this.style.color='rgba(240,232,204,.8)'" onmouseout="this.style.borderColor='rgba(240,232,204,.15)';this.style.color='rgba(240,232,204,.5)'">
            إلغاء
        </a>
    </div>
</div>
