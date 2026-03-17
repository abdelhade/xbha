<div>
    @if(session()->has('message'))
        <div style="margin-bottom:1rem;padding:1rem;background:rgba(46,138,153,.15);border:1px solid rgba(46,138,153,.3);color:#3aa0b0;border-radius:.75rem">
            {{ session('message') }}
        </div>
    @endif

    @if($favorites->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($favorites as $favorite)
                @php
                    $product = auth()->check() ? $favorite->product : $favorite;
                    $favoriteId = auth()->check() ? $favorite->id : $product->id;
                @endphp
                <div style="background:rgba(46,138,153,.05);border:1px solid rgba(46,138,153,.12);border-radius:1.25rem;overflow:hidden;transition:all .3s" onmouseover="this.style.borderColor='rgba(46,138,153,.35)';this.style.transform='translateY(-4px)'" onmouseout="this.style.borderColor='rgba(46,138,153,.12)';this.style.transform='translateY(0)'">
                    @if($product->getFirstMediaUrl('images'))
                        <img src="{{ $product->getFirstMediaUrl('images') }}" alt="{{ $product->title }}" style="width:100%;height:200px;object-fit:cover">
                    @else
                        <div style="width:100%;height:200px;background:rgba(46,138,153,.08);display:flex;align-items:center;justify-content:center">
                            <svg style="width:4rem;height:4rem;color:rgba(46,138,153,.3)" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                    @endif
                    <div style="padding:1.25rem">
                        <h3 style="font-size:1rem;font-weight:700;color:#f0e8cc;margin-bottom:.5rem">{{ $product->title }}</h3>
                        <p style="color:#f47c51;font-weight:900;font-size:1.1rem;margin-bottom:1rem">{{ number_format($product->price) }} ج.م</p>
                        <div style="display:flex;gap:.5rem">
                            <a href="{{ route('products.show', $product) }}" style="flex:1;padding:.6rem 1rem;background:#2e8a99;color:#fff;border-radius:100px;font-size:.875rem;font-weight:700;text-decoration:none;text-align:center">عرض</a>
                            <button wire:click="removeFavorite({{ $favoriteId }})" wire:confirm="هل تريد إزالة هذا المنتج من المفضلة" style="padding:.6rem 1rem;background:rgba(244,124,81,.1);color:#f47c51;border:1px solid rgba(244,124,81,.2);border-radius:100px;cursor:pointer">
                                <svg style="width:1.1rem;height:1.1rem" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-8">{{ $favorites->links() }}</div>
    @else
        <div style="text-align:center;background:rgba(46,138,153,.04);border:1px solid rgba(46,138,153,.1);border-radius:1.5rem;padding:4rem 2rem">
            <svg style="width:5rem;height:5rem;margin:0 auto 1rem;color:rgba(46,138,153,.25)" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
            </svg>
            <h3 style="font-size:1.5rem;font-weight:900;color:#f0e8cc;margin-bottom:.5rem">لا توجد مفضلات</h3>
            <p style="color:rgba(240,232,204,.5);margin-bottom:1.5rem">لم تقم بإضافة أي منتجات للمفضلة</p>
            <a href="{{ route('products.index') }}" style="display:inline-block;padding:.75rem 2rem;background:#f47c51;color:#fff;border-radius:100px;font-weight:700;text-decoration:none">تصفح المنتجات</a>
        </div>
    @endif
</div>
