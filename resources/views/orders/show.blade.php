<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>تفاصيل الطلب - مزادي</title>
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Kufi+Arabic:wght@300;400;600;700;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body style="font-family:'Noto Kufi Arabic',sans-serif;background:#0f1e23;color:#f0e8cc;min-height:100vh">
    <x-navbar />

    <div style="max-width:800px;margin:0 auto;padding:2rem 1rem">
        <!-- Back -->
        <a href="{{ auth()->id() === $order->seller_id ? route('orders.sales') : route('orders.index') }}"
           style="display:inline-flex;align-items:center;gap:.5rem;color:rgba(240,232,204,.5);text-decoration:none;font-size:.875rem;margin-bottom:1.5rem;transition:color .2s"
           onmouseover="this.style.color='#3aa0b0'" onmouseout="this.style.color='rgba(240,232,204,.5)'">
            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            العودة
        </a>

        <!-- Order Card -->
        <div style="background:rgba(26,46,53,.7);border:1px solid rgba(46,138,153,.15);border-radius:1.5rem;overflow:hidden">
            <!-- Header -->
            <div style="background:linear-gradient(135deg,rgba(46,138,153,.3),rgba(46,138,153,.1));border-bottom:1px solid rgba(46,138,153,.2);padding:1.5rem">
                <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:1rem">
                    <div>
                        <h2 style="font-size:1.5rem;font-weight:900;color:#f0e8cc">طلب #{{ $order->id }}</h2>
                        <p style="font-size:.8rem;color:rgba(240,232,204,.45);margin-top:.25rem">{{ $order->created_at->format('Y-m-d H:i') }}</p>
                    </div>
                    @if(auth()->id() === $order->buyer_id)
                        <a href="{{ route('chat.show', encrypt($order->seller_id)) }}"
                           style="display:inline-flex;align-items:center;gap:.5rem;padding:.6rem 1.25rem;background:rgba(46,138,153,.2);border:1px solid rgba(46,138,153,.35);color:#3aa0b0;border-radius:.75rem;text-decoration:none;font-size:.875rem;font-weight:700;transition:all .2s"
                           onmouseover="this.style.background='rgba(46,138,153,.3)'" onmouseout="this.style.background='rgba(46,138,153,.2)'">
                            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                            مراسلة البائع
                        </a>
                    @elseif(auth()->id() === $order->seller_id)
                        <a href="{{ route('chat.show', encrypt($order->buyer_id)) }}"
                           style="display:inline-flex;align-items:center;gap:.5rem;padding:.6rem 1.25rem;background:rgba(46,138,153,.2);border:1px solid rgba(46,138,153,.35);color:#3aa0b0;border-radius:.75rem;text-decoration:none;font-size:.875rem;font-weight:700;transition:all .2s"
                           onmouseover="this.style.background='rgba(46,138,153,.3)'" onmouseout="this.style.background='rgba(46,138,153,.2)'">
                            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                            مراسلة المشتري
                        </a>
                    @endif
                </div>
            </div>

            <div style="padding:1.5rem;display:flex;flex-direction:column;gap:1.5rem">
                <!-- Status -->
                <div style="display:flex;align-items:center;justify-content:space-between;padding-bottom:1.25rem;border-bottom:1px solid rgba(46,138,153,.1)">
                    <span style="font-size:.9rem;font-weight:600;color:rgba(240,232,204,.7)">حالة الطلب</span>
                    <span style="padding:.35rem .9rem;border-radius:100px;font-size:.8rem;font-weight:700;
                        @if($order->status === 'pending') background:rgba(251,191,36,.12);color:#fbbf24
                        @elseif($order->status === 'completed') background:rgba(46,138,153,.15);color:#3aa0b0
                        @elseif($order->status === 'cancelled') background:rgba(244,124,81,.12);color:#f47c51
                        @else background:rgba(46,138,153,.1);color:#2e8a99 @endif">
                        @if($order->status === 'pending') قيد الانتظار
                        @elseif($order->status === 'completed') مكتمل
                        @elseif($order->status === 'cancelled') ملغي
                        @else {{ $order->status }} @endif
                    </span>
                </div>

                <!-- Product -->
                <div style="padding-bottom:1.25rem;border-bottom:1px solid rgba(46,138,153,.1)">
                    <h3 style="font-size:.85rem;font-weight:700;color:rgba(240,232,204,.5);margin-bottom:.75rem;text-transform:uppercase;letter-spacing:.05em">المنتج</h3>
                    <div style="display:flex;gap:1rem;align-items:center">
                        @if($order->product->getFirstMediaUrl('images'))
                            <img src="{{ $order->product->getFirstMediaUrl('images') }}" alt="{{ $order->product->title }}"
                                 style="width:5rem;height:5rem;border-radius:.75rem;object-fit:cover;border:1px solid rgba(46,138,153,.2);flex-shrink:0">
                        @endif
                        <div>
                            <h4 style="font-weight:700;color:#f0e8cc;margin-bottom:.25rem">{{ $order->product->title }}</h4>
                            <p style="font-size:.8rem;color:rgba(240,232,204,.45);margin-bottom:.4rem">{{ $order->product->category->name }}</p>
                            <span style="font-size:1.1rem;font-weight:900;color:#f47c51">{{ number_format($order->total_amount) }} ج.م</span>
                        </div>
                    </div>
                </div>

                <!-- Seller -->
                <div style="padding-bottom:1.25rem;border-bottom:1px solid rgba(46,138,153,.1)">
                    <h3 style="font-size:.85rem;font-weight:700;color:rgba(240,232,204,.5);margin-bottom:.75rem;text-transform:uppercase;letter-spacing:.05em">البائع</h3>
                    <p style="color:rgba(240,232,204,.7);font-size:.9rem;margin-bottom:.3rem">{{ $order->seller->name }}</p>
                    <p style="color:rgba(240,232,204,.45);font-size:.85rem">{{ $order->seller->email }}</p>
                </div>

                <!-- Buyer -->
                <div style="padding-bottom:1.25rem;border-bottom:1px solid rgba(46,138,153,.1)">
                    <h3 style="font-size:.85rem;font-weight:700;color:rgba(240,232,204,.5);margin-bottom:.75rem;text-transform:uppercase;letter-spacing:.05em">المشتري</h3>
                    <div style="display:flex;flex-direction:column;gap:.4rem">
                        <p style="color:rgba(240,232,204,.7);font-size:.9rem">{{ $order->buyer_name }}</p>
                        <p style="color:rgba(240,232,204,.5);font-size:.85rem">{{ $order->buyer_phone }}</p>
                        @if($order->buyer_address)
                            <p style="color:rgba(240,232,204,.5);font-size:.85rem">{{ $order->buyer_address }}</p>
                        @endif
                    </div>
                </div>

                <!-- Total -->
                <div style="background:rgba(46,138,153,.06);border:1px solid rgba(46,138,153,.15);border-radius:1rem;padding:1.25rem;display:flex;justify-content:space-between;align-items:center">
                    <span style="font-size:1rem;font-weight:700;color:#f0e8cc">المجموع الكلي</span>
                    <span style="font-size:1.5rem;font-weight:900;color:#f47c51">{{ number_format($order->total_amount) }} ج.م</span>
                </div>

                @if($order->notes)
                    <div>
                        <h3 style="font-size:.85rem;font-weight:700;color:rgba(240,232,204,.5);margin-bottom:.75rem">ملاحظات</h3>
                        <p style="color:rgba(240,232,204,.65);background:rgba(46,138,153,.05);border:1px solid rgba(46,138,153,.1);border-radius:.75rem;padding:1rem;font-size:.9rem;line-height:1.6">{{ $order->notes }}</p>
                    </div>
                @endif

                @if($order->status === 'pending')
                    @if(auth()->id() === $order->seller_id)
                        <div style="background:rgba(46,138,153,.06);border:1px solid rgba(46,138,153,.2);border-radius:1rem;padding:1.25rem">
                            <h3 style="font-size:.9rem;font-weight:700;color:#f0e8cc;margin-bottom:1rem">تغيير حالة الطلب</h3>
                            <div style="display:flex;gap:.75rem;flex-wrap:wrap">
                                <form action="{{ route('orders.updateStatus', $order) }}" method="POST">
                                    @csrf @method('PATCH')
                                    <input type="hidden" name="status" value="completed">
                                    <button type="submit" style="padding:.65rem 1.5rem;background:rgba(46,138,153,.2);border:1px solid rgba(46,138,153,.4);color:#3aa0b0;border-radius:.75rem;font-family:'Noto Kufi Arabic',sans-serif;font-weight:700;cursor:pointer;transition:all .2s"
                                        onmouseover="this.style.background='rgba(46,138,153,.35)'" onmouseout="this.style.background='rgba(46,138,153,.2)'">
                                        ✓ تم التسليم
                                    </button>
                                </form>
                                <form action="{{ route('orders.updateStatus', $order) }}" method="POST">
                                    @csrf @method('PATCH')
                                    <input type="hidden" name="status" value="cancelled">
                                    <button type="submit" onclick="return confirm('هل أنت متأكد من إلغاء الطلب؟')"
                                        style="padding:.65rem 1.5rem;background:rgba(244,124,81,.1);border:1px solid rgba(244,124,81,.3);color:#f47c51;border-radius:.75rem;font-family:'Noto Kufi Arabic',sans-serif;font-weight:700;cursor:pointer;transition:all .2s"
                                        onmouseover="this.style.background='rgba(244,124,81,.2)'" onmouseout="this.style.background='rgba(244,124,81,.1)'">
                                        ✕ إلغاء الطلب
                                    </button>
                                </form>
                            </div>
                        </div>
                    @elseif(auth()->id() === $order->buyer_id)
                        <div style="background:rgba(244,124,81,.05);border:1px solid rgba(244,124,81,.15);border-radius:1rem;padding:1.25rem">
                            <h3 style="font-size:.9rem;font-weight:700;color:#f0e8cc;margin-bottom:.5rem">إلغاء الطلب</h3>
                            <p style="font-size:.8rem;color:rgba(240,232,204,.45);margin-bottom:1rem">يمكنك إلغاء الطلب إذا لم يتم التسليم بعد</p>
                            <form action="{{ route('orders.updateStatus', $order) }}" method="POST">
                                @csrf @method('PATCH')
                                <input type="hidden" name="status" value="cancelled">
                                <button type="submit" onclick="return confirm('هل أنت متأكد من إلغاء الطلب؟')"
                                    style="padding:.65rem 1.5rem;background:rgba(244,124,81,.1);border:1px solid rgba(244,124,81,.3);color:#f47c51;border-radius:.75rem;font-family:'Noto Kufi Arabic',sans-serif;font-weight:700;cursor:pointer;transition:all .2s"
                                    onmouseover="this.style.background='rgba(244,124,81,.2)'" onmouseout="this.style.background='rgba(244,124,81,.1)'">
                                    ✕ إلغاء الطلب
                                </button>
                            </form>
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
</body>
</html>
