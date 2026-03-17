<div>
    <!-- Status Filters -->
    <div style="display:flex;gap:.5rem;flex-wrap:wrap;margin-bottom:1.5rem">
        @foreach(['all' => 'الكل', 'pending' => 'قيد الانتظار', 'completed' => 'مكتمل', 'cancelled' => 'ملغي'] as $val => $label)
            <button wire:click="$set('statusFilter', '{{ $val }}')"
                style="padding:.5rem 1.1rem;border-radius:100px;font-family:'Noto Kufi Arabic',sans-serif;font-size:.82rem;font-weight:700;cursor:pointer;transition:all .2s;border:1px solid;
                    {{ $statusFilter === $val
                        ? 'background:#2e8a99;color:#fff;border-color:#2e8a99'
                        : 'background:transparent;color:rgba(240,232,204,.55);border-color:rgba(46,138,153,.2)' }}">
                {{ $label }}
            </button>
        @endforeach
    </div>

    @if($orders->count() > 0)
        <div style="display:flex;flex-direction:column;gap:1rem">
            @foreach($orders as $order)
                <div style="background:rgba(26,46,53,.7);border:1px solid rgba(46,138,153,.15);border-radius:1.25rem;padding:1.25rem;transition:all .3s"
                     onmouseover="this.style.borderColor='rgba(46,138,153,.35)'" onmouseout="this.style.borderColor='rgba(46,138,153,.15)'">
                    <div style="display:flex;justify-content:space-between;align-items:flex-start;flex-wrap:wrap;gap:.75rem;margin-bottom:1rem">
                        <div>
                            <h3 style="font-size:1rem;font-weight:700;color:#f0e8cc;margin-bottom:.2rem">طلب #{{ $order->id }}</h3>
                            <p style="font-size:.8rem;color:rgba(240,232,204,.4)">{{ $order->created_at->diffForHumans() }}</p>
                        </div>
                        <span style="padding:.3rem .85rem;border-radius:100px;font-size:.78rem;font-weight:700;
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

                    <div style="border-top:1px solid rgba(46,138,153,.1);padding-top:1rem;display:flex;flex-direction:column;gap:.4rem;margin-bottom:1rem">
                        <p style="font-size:.875rem;color:rgba(240,232,204,.65)">
                            <span style="color:rgba(240,232,204,.4)">المنتج: </span>{{ $order->product->title }}
                        </p>
                        <p style="font-size:.875rem;color:rgba(240,232,204,.65)">
                            <span style="color:rgba(240,232,204,.4)">السعر: </span>
                            <span style="color:#f47c51;font-weight:700">{{ number_format($order->total_amount) }} ج.م</span>
                        </p>
                        <p style="font-size:.875rem;color:rgba(240,232,204,.65)">
                            <span style="color:rgba(240,232,204,.4)">المشتري: </span>{{ $order->buyer_name }}
                        </p>
                        <p style="font-size:.875rem;color:rgba(240,232,204,.65)">
                            <span style="color:rgba(240,232,204,.4)">الهاتف: </span>{{ $order->buyer_phone }}
                        </p>
                    </div>

                    <a href="{{ route('orders.show', $order) }}"
                       style="display:inline-flex;align-items:center;gap:.4rem;padding:.5rem 1.1rem;background:rgba(46,138,153,.15);border:1px solid rgba(46,138,153,.3);color:#3aa0b0;border-radius:.65rem;font-size:.82rem;font-weight:700;text-decoration:none;transition:all .2s"
                       onmouseover="this.style.background='rgba(46,138,153,.25)'" onmouseout="this.style.background='rgba(46,138,153,.15)'">
                        عرض التفاصيل
                        <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>
                </div>
            @endforeach
        </div>

        <div style="margin-top:2rem">{{ $orders->links() }}</div>
    @else
        <div style="text-align:center;background:rgba(46,138,153,.04);border:1px solid rgba(46,138,153,.1);border-radius:1.5rem;padding:4rem 2rem">
            <svg style="width:5rem;height:5rem;margin:0 auto 1rem;color:rgba(46,138,153,.25)" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
            </svg>
            <h3 style="font-size:1.25rem;font-weight:900;color:#f0e8cc;margin-bottom:.5rem">لا توجد مبيعات</h3>
            <p style="color:rgba(240,232,204,.45)">لم يتم طلب أي من منتجاتك حتى الآن</p>
        </div>
    @endif
</div>
