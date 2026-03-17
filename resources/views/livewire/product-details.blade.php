<div>
    <!-- Product Images & Info -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-12">
        <!-- Image Gallery -->
        <div>
            @if ($product->getMedia('images')->count() > 0)
                <!-- Main Image -->
                <div class="relative mb-4">
                    <img src="{{ $product->getMedia('images')[$currentImageIndex]->getUrl() }}"
                        alt="{{ $product->title }}" class="w-full h-96 object-cover rounded-2xl shadow-lg">

                    @if ($product->getMedia('images')->count() > 1)
                        <!-- Navigation Arrows -->
                        <button wire:click="previousImage"
                            class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-black/50 text-white p-2 rounded-full hover:bg-black/70 transition">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 19l-7-7 7-7"></path>
                            </svg>
                        </button>
                        <button wire:click="nextImage"
                            class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-black/50 text-white p-2 rounded-full hover:bg-black/70 transition">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                </path>
                            </svg>
                        </button>
                    @endif
                </div>

                <!-- Thumbnail Images -->
                @if ($product->getMedia('images')->count() > 1)
                    <div class="grid grid-cols-4 gap-2">
                        @foreach ($product->getMedia('images') as $index => $image)
                            <button wire:click="selectImage({{ $index }})"
                                style="position:relative;overflow:hidden;border-radius:.5rem;border:2px solid {{ $currentImageIndex === $index ? '#2e8a99' : 'transparent' }};transition:border-color .2s">
                                <img src="{{ $image->getUrl() }}" alt="{{ $product->title }}"
                                    style="width:100%;height:80px;object-fit:cover">
                            </button>
                        @endforeach
                    </div>
                @endif
            @else
                <!-- No Image Placeholder -->
                <div
                    class="w-full h-96 bg-gradient-to-br from-gray-100 to-gray-200 rounded-2xl flex items-center justify-center">
                    <svg class="w-24 h-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                        </path>
                    </svg>
                </div>
            @endif
        </div>

        <!-- Product Info -->
        <div>
            <!-- Title & Price -->
            <div class="mb-6">
                <h1 style="font-size:1.75rem;font-weight:900;color:#f0e8cc;margin-bottom:1rem;line-height:1.2">{{ $product->title }}</h1>
                @if ($product->is_auction)
                    <div style="background:rgba(244,124,81,.08);border:1px solid rgba(244,124,81,.25);border-radius:1rem;padding:1.25rem;margin-bottom:1rem">
                        <div style="display:flex;align-items:center;gap:.5rem;margin-bottom:.75rem">
                            <svg width="20" height="20" fill="none" stroke="#f47c51" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <span style="font-weight:700;color:#f47c51;font-size:.9rem">مزايدة نشطة</span>
                        </div>
                        <div style="margin-bottom:.75rem">
                            <p style="font-size:.75rem;color:rgba(240,232,204,.45);margin-bottom:.25rem">المزايدة الحالية</p>
                            <span style="font-size:2.25rem;font-weight:900;color:#f47c51">{{ number_format($product->current_bid) }} ج.م</span>
                        </div>
                        <div style="font-size:.8rem;color:rgba(240,232,204,.45)">
                            <p>تنتهي في: {{ $product->auction_ends_at->format('Y-m-d H:i') }}</p>
                            <p>عدد المزايدات: {{ $product->bids->count() }}</p>
                        </div>

                        @auth
                            @if (auth()->id() === $product->user_id || auth()->user()->hasRole('admin'))
                                <div style="margin-top:1rem;padding-top:1rem;border-top:1px solid rgba(244,124,81,.2)">
                                    <h4 style="font-weight:700;color:#f47c51;font-size:.85rem;margin-bottom:.75rem">سجل المزايدات</h4>
                                    <div style="display:flex;flex-direction:column;gap:.5rem;max-height:240px;overflow-y:auto">
                                        @foreach ($product->bids()->with('user')->orderBy('amount', 'desc')->get() as $bid)
                                            <div style="background:rgba(15,30,35,.5);border:1px solid rgba(46,138,153,.12);border-radius:.75rem;padding:.75rem;display:flex;justify-content:space-between;align-items:center">
                                                <div>
                                                    <span style="font-weight:700;color:#f0e8cc;font-size:.85rem">{{ $bid->user->name }}</span>
                                                    <div style="color:#f47c51;font-weight:700;font-size:.9rem">{{ number_format($bid->amount) }} ج.م</div>
                                                    <div style="font-size:.72rem;color:rgba(240,232,204,.35)">{{ $bid->created_at->diffForHumans() }}</div>
                                                </div>
                                                @if (auth()->id() === $product->user_id)
                                                    <button wire:click="acceptBid({{ $bid->id }})"
                                                        style="background:rgba(46,138,153,.15);color:#3aa0b0;border:1px solid rgba(46,138,153,.3);padding:.35rem .75rem;border-radius:.5rem;font-size:.78rem;font-weight:700;cursor:pointer;font-family:'Noto Kufi Arabic',sans-serif"
                                                        onclick="confirm('هل أنت متأكد من قبول هذه المزايدة وإنهاء المزاد؟') || event.stopImmediatePropagation()">
                                                        قبول وإنهاء
                                                    </button>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        @endauth
                    </div>
                    @else
                    <div style="display:flex;align-items:center;gap:1rem;margin-bottom:1rem">
                        <span style="font-size:2.5rem;font-weight:900;color:#f47c51">{{ number_format($product->price) }} ج.م</span>
                        <span style="padding:.3rem .75rem;font-size:.78rem;font-weight:700;border-radius:100px;
                            @if ($product->condition === 'new') background:rgba(46,138,153,.15);color:#3aa0b0
                            @elseif($product->condition === 'like_new') background:rgba(46,138,153,.1);color:#2e8a99
                            @elseif($product->condition === 'good') background:rgba(244,124,81,.1);color:#f47c51
                            @elseif($product->condition === 'fair') background:rgba(201,95,58,.1);color:#c95f3a
                            @else background:rgba(240,232,204,.08);color:rgba(240,232,204,.5) @endif">
                            @switch($product->condition)
                                @case('new') جديد @break
                                @case('like_new') شبه جديد @break
                                @case('good') جيد @break
                                @case('fair') مقبول @break
                                @case('poor') يحتاج إصلاح @break
                            @endswitch
                        </span>
                    </div>
                @endif
            </div>

            <!-- Product Details -->
            <div style="display:flex;flex-direction:column;gap:.75rem;margin-bottom:1.5rem">
                <div style="display:flex;align-items:center;gap:.75rem">
                    <svg width="18" height="18" fill="none" stroke="rgba(46,138,153,.7)" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                    <span style="color:rgba(240,232,204,.7);font-size:.875rem">{{ $product->category->name }}</span>
                </div>
                <div style="display:flex;align-items:center;gap:.75rem">
                    <svg width="18" height="18" fill="none" stroke="rgba(46,138,153,.7)" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    <span style="color:rgba(240,232,204,.7);font-size:.875rem">{{ $product->location }}</span>
                </div>
                <div style="display:flex;align-items:center;gap:.75rem">
                    <svg width="18" height="18" fill="none" stroke="rgba(46,138,153,.7)" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    <span style="color:rgba(240,232,204,.7);font-size:.875rem">{{ $product->views_count }} مشاهدة</span>
                </div>
                <div style="display:flex;align-items:center;gap:.75rem">
                    <svg width="18" height="18" fill="none" stroke="rgba(46,138,153,.7)" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span style="color:rgba(240,232,204,.7);font-size:.875rem">{{ $product->created_at->diffForHumans() }}</span>
                </div>
            </div>

        <!-- Seller Info -->
        <div style="background:rgba(15,30,35,.5);border:1px solid rgba(46,138,153,.15);border-radius:1rem;padding:1.5rem;margin-bottom:1.5rem">
            <h3 style="font-size:1rem;font-weight:700;color:#f0e8cc;margin-bottom:1rem">معلومات البائع</h3>
            <div style="display:flex;align-items:center;gap:1rem;margin-bottom:1rem">
                <div style="width:48px;height:48px;background:rgba(46,138,153,.2);border:1px solid rgba(46,138,153,.3);border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:1.1rem;font-weight:900;color:#2e8a99;flex-shrink:0">
                    {{ substr($product->user->name, 0, 1) }}
                </div>
                <div>
                    <h4 style="font-weight:700;color:#f0e8cc;font-size:.9rem">{{ $product->user->name }}</h4>
                    <p style="font-size:.78rem;color:rgba(240,232,204,.4)">عضو منذ {{ $product->user->created_at->format('Y') }}</p>
                </div>
            </div>
            @if ($showContactInfo)
                <div style="background:rgba(46,138,153,.08);border:1px solid rgba(46,138,153,.2);border-radius:.75rem;padding:1rem">
                    <p style="font-size:.78rem;color:rgba(240,232,204,.5);margin-bottom:.25rem">معلومات التواصل:</p>
                    <p style="font-weight:600;color:#f0e8cc;font-size:.875rem">{{ $product->user->email }}</p>
                </div>
            @endif
        </div>

            <!-- Action Buttons -->
            <div style="display:flex;flex-direction:column;gap:.75rem">
                @if ($product->is_auction && $product->auction_ends_at > now())
                    @auth
                        @if (auth()->id() !== $product->user_id)
                            <div style="background:rgba(244,124,81,.08);border:1px solid rgba(244,124,81,.25);border-radius:1rem;padding:1rem">
                                <label style="display:block;font-size:.8rem;font-weight:600;color:rgba(240,232,204,.6);margin-bottom:.5rem">مبلغ مزايدتك</label>
                                <div style="display:flex;gap:.5rem">
                                    <input id="bid-input" type="number" wire:model="bidAmount"
                                        placeholder="{{ number_format($product->current_bid + ($product->min_bid_increment ?? 1)) }}"
                                        style="flex:1;padding:.75rem 1rem;background:rgba(15,30,35,.6);border:1px solid rgba(244,124,81,.3);border-radius:.65rem;color:#f0e8cc;font-family:'Noto Kufi Arabic',sans-serif;outline:none">
                                    <button wire:click="placeBid"
                                        style="padding:.75rem 1.25rem;background:#f47c51;color:#fff;border:none;border-radius:.65rem;font-family:'Noto Kufi Arabic',sans-serif;font-weight:700;cursor:pointer;transition:all .2s"
                                        onmouseover="this.style.background='#c95f3a'" onmouseout="this.style.background='#f47c51'">
                                        زايد
                                    </button>
                                </div>
                                @error('bidAmount')<p style="font-size:.78rem;color:#f47c51;margin-top:.35rem">{{ $message }}</p>@enderror
                                @if (session()->has('message'))<p style="font-size:.78rem;color:#3aa0b0;margin-top:.35rem">{{ session('message') }}</p>@endif
                            </div>
                        @endif
                    @else
                        <a href="{{ route('login') }}"
                            style="display:block;width:100%;padding:1rem;background:#f47c51;color:#fff;border-radius:.75rem;font-weight:700;text-align:center;text-decoration:none;transition:all .2s">
                            سجل دخول للمزايدة
                        </a>
                    @endauth
                @else
                    @auth
                        @if (auth()->id() !== $product->user_id)
                            <a href="{{ route('chat.show', encrypt($product->user_id)) }}"
                                style="display:block;width:100%;padding:1rem;background:#2e8a99;color:#fff;border-radius:.75rem;font-weight:700;text-align:center;text-decoration:none;transition:all .2s"
                                onmouseover="this.style.background='#3aa0b0'" onmouseout="this.style.background='#2e8a99'">
                                راسل البائع
                            </a>
                            <a href="{{ route('orders.create', $product) }}"
                                style="display:block;width:100%;padding:1rem;background:#f47c51;color:#fff;border-radius:.75rem;font-weight:700;text-align:center;text-decoration:none;transition:all .2s"
                                onmouseover="this.style.background='#c95f3a'" onmouseout="this.style.background='#f47c51'">
                                طلب الشراء الآن
                            </a>
                        @endif
                    @else
                        <a href="{{ route('login') }}"
                            style="display:block;width:100%;padding:1rem;background:#2e8a99;color:#fff;border-radius:.75rem;font-weight:700;text-align:center;text-decoration:none">
                            سجل دخول للشراء
                        </a>
                    @endauth
                @endif

                <button wire:click="toggleContactInfo"
                    style="width:100%;padding:1rem;background:rgba(46,138,153,.1);border:1px solid rgba(46,138,153,.2);color:#3aa0b0;border-radius:.75rem;font-family:'Noto Kufi Arabic',sans-serif;font-weight:600;cursor:pointer;transition:all .2s">
                    @if ($showContactInfo) إخفاء معلومات التواصل @else عرض معلومات التواصل @endif
                </button>

                <form action="{{ route('favorites.toggle', $product) }}" method="POST">
                    @csrf
                    <button type="submit"
                        style="width:100%;padding:1rem;background:rgba(240,232,204,.06);border:1px solid rgba(240,232,204,.12);color:rgba(240,232,204,.7);border-radius:.75rem;font-family:'Noto Kufi Arabic',sans-serif;font-weight:600;cursor:pointer;display:flex;align-items:center;justify-content:center;gap:.5rem;transition:all .2s">
                        <svg width="18" height="18" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/></svg>
                        إضافة للمفضلة
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Product Description -->
    <div style="background:rgba(26,46,53,.7);border:1px solid rgba(46,138,153,.15);border-radius:1.5rem;padding:2rem;margin-bottom:2rem">
        <h2 style="font-size:1.25rem;font-weight:900;color:#f0e8cc;margin-bottom:1.25rem">وصف المنتج</h2>
        <div style="color:rgba(240,232,204,.7);line-height:1.8;font-size:.9rem">
            <p class="whitespace-pre-line">{{ $product->description }}</p>
        </div>
    </div>

    <!-- Related Products -->
    @if ($relatedProducts->count() > 0)
        <div style="background:rgba(26,46,53,.7);border:1px solid rgba(46,138,153,.15);border-radius:1.5rem;padding:2rem">
            <h2 style="font-size:1.25rem;font-weight:900;color:#f0e8cc;margin-bottom:1.25rem">منتجات مشابهة</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                @foreach ($relatedProducts as $relatedProduct)
                    <a href="{{ route('products.show', $relatedProduct->slug) }}"
                        style="display:block;background:rgba(15,30,35,.5);border:1px solid rgba(46,138,153,.12);border-radius:1rem;overflow:hidden;text-decoration:none;transition:all .3s"
                        onmouseover="this.style.borderColor='rgba(46,138,153,.35)';this.style.transform='translateY(-3px)'" onmouseout="this.style.borderColor='rgba(46,138,153,.12)';this.style.transform='translateY(0)'">
                        <div style="position:relative;height:160px;background:rgba(46,138,153,.08)">
                            @if ($relatedProduct->getFirstMediaUrl('images'))
                                <img src="{{ $relatedProduct->getFirstMediaUrl('images') }}"
                                    alt="{{ $relatedProduct->title }}"
                                    style="width:100%;height:100%;object-fit:cover">
                            @else
                                <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;color:rgba(46,138,153,.3)">
                                    <svg width="40" height="40" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                </div>
                            @endif
                            <div style="position:absolute;bottom:.5rem;left:.5rem;background:#f47c51;color:#fff;padding:.2rem .6rem;border-radius:100px;font-size:.75rem;font-weight:800">
                                {{ number_format($relatedProduct->price) }} ج.م
                            </div>
                        </div>
                        <div style="padding:.85rem">
                            <h3 style="font-weight:600;color:#f0e8cc;font-size:.85rem;margin-bottom:.25rem" class="line-clamp-2">{{ $relatedProduct->title }}</h3>
                            <p style="font-size:.75rem;color:rgba(240,232,204,.4)">{{ $relatedProduct->location }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    @endif

    <style>
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
</div>
