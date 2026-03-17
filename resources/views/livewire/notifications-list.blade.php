<div>
    @if (session()->has('message'))
        <div style="margin-bottom:1rem;padding:1rem;background:rgba(46,138,153,.15);border:1px solid rgba(46,138,153,.3);color:#3aa0b0;border-radius:.75rem">
            {{ session('message') }}
        </div>
    @endif

    @if (auth()->user()->hasRole('admin'))
        @php $pendingApprovals = \App\Models\Product::where('status', 0)->orderBy('created_at', 'desc')->take(5)->get(); @endphp
        @if ($pendingApprovals->count() > 0)
            <div style="margin-bottom:2rem;background:rgba(244,124,81,.06);border:1px solid rgba(244,124,81,.2);border-radius:1.25rem;padding:1.5rem">
                <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1rem">
                    <h3 style="font-size:1rem;font-weight:700;color:#f47c51;display:flex;align-items:center;gap:.5rem">
                        <svg style="width:1.1rem;height:1.1rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        طلبات الموافقة المعلقة
                    </h3>
                    <a href="{{ route('admin.products.approvals') }}" style="font-size:.8rem;background:#f47c51;color:#fff;padding:.4rem 1rem;border-radius:100px;text-decoration:none">
                        عرض الكل ({{ \App\Models\Product::where('status', 0)->count() }})
                    </a>
                </div>
                <div style="display:flex;flex-direction:column;gap:.75rem">
                    @foreach ($pendingApprovals as $product)
                        <div style="background:rgba(15,30,35,.5);border:1px solid rgba(244,124,81,.15);border-radius:1rem;padding:1rem;display:flex;align-items:start;gap:1rem">
                            @if ($product->getMedia('images')->count() > 0)
                                <img src="{{ $product->getMedia('images')->first()->getUrl() }}" style="width:4rem;height:4rem;object-fit:cover;border-radius:.75rem;border:1px solid rgba(46,138,153,.2)">
                            @else
                                <div style="width:4rem;height:4rem;background:rgba(46,138,153,.08);border-radius:.75rem;display:flex;align-items:center;justify-content:center">
                                    <svg style="width:2rem;height:2rem;color:rgba(46,138,153,.3)" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                                </div>
                            @endif
                            <div style="flex:1">
                                <h4 style="font-weight:600;color:#f0e8cc;margin-bottom:.25rem">{{ $product->title }}</h4>
                                <p style="font-size:.8rem;color:rgba(240,232,204,.5);margin-bottom:.5rem">{{ Str::limit($product->description, 100) }}</p>
                                <span style="font-size:.8rem;color:rgba(240,232,204,.4)">{{ number_format($product->price) }} ج.م  {{ $product->created_at->diffForHumans() }}</span>
                            </div>
                            <div style="display:flex;gap:.5rem">
                                <a href="{{ route('admin.products.edit', $product) }}" style="padding:.4rem;color:#3aa0b0;border-radius:.5rem;text-decoration:none">
                                    <svg style="width:1rem;height:1rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                </a>
                                <form action="{{ route('admin.products.approve', $product) }}" method="POST" style="display:inline">
                                    @csrf
                                    <button type="submit" style="padding:.4rem;color:#3aa0b0;background:transparent;border:none;cursor:pointer" onclick="return confirm('هل أنت متأكد')">
                                        <svg style="width:1rem;height:1rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    @endif

    <div style="display:flex;justify-content:flex-end;margin-bottom:1.5rem">
        @if ($notifications->where('read_at', null)->count() > 0)
            <button wire:click="markAllAsRead" style="padding:.5rem 1.25rem;background:rgba(46,138,153,.15);border:1px solid rgba(46,138,153,.3);color:#3aa0b0;border-radius:100px;font-size:.875rem;font-weight:600;cursor:pointer">
                تحديد الكل كمقروء
            </button>
        @endif
    </div>

    @if ($notifications->count() > 0)
        <div style="display:flex;flex-direction:column;gap:.75rem">
            @foreach ($notifications as $notification)
                <button wire:click="markAsRead('{{ $notification->id }}')" style="display:block;width:100%;text-align:right;background:rgba(46,138,153,.05);border:1px solid {{ $notification->read_at ? 'rgba(46,138,153,.08)' : 'rgba(46,138,153,.25)' }};border-right:{{ $notification->read_at ? '1px solid rgba(46,138,153,.08)' : '3px solid #2e8a99' }};border-radius:1rem;padding:1.25rem;cursor:pointer;transition:all .2s;opacity:{{ $notification->read_at ? '.6' : '1' }}" onmouseover="this.style.background='rgba(46,138,153,.1)'" onmouseout="this.style.background='rgba(46,138,153,.05)'">
                    <div style="display:flex;align-items:start;gap:1rem">
                        <div style="width:2.75rem;height:2.75rem;background:rgba(46,138,153,.12);border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0">
                            <svg style="width:1.25rem;height:1.25rem;color:#3aa0b0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                        </div>
                        <div style="flex:1">
                            <p style="color:#f0e8cc;font-weight:500;margin-bottom:.25rem">{{ $notification->data['message'] }}</p>
                            <div style="display:flex;align-items:center;gap:1rem;font-size:.8rem;color:rgba(240,232,204,.45)">
                                @if (isset($notification->data['order_number']))
                                    <span>رقم الطلب: {{ $notification->data['order_number'] }}</span>
                                @elseif(isset($notification->data['amount']))
                                    <span>المبلغ: {{ number_format($notification->data['amount']) }} ج.م</span>
                                @endif
                                <span></span>
                                <span>{{ $notification->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                        @if (!$notification->read_at)
                            <div style="width:.6rem;height:.6rem;background:#2e8a99;border-radius:50%;flex-shrink:0;margin-top:.3rem"></div>
                        @endif
                    </div>
                </button>
            @endforeach
        </div>
        <div class="mt-8">{{ $notifications->links() }}</div>
    @else
        <div style="text-align:center;background:rgba(46,138,153,.04);border:1px solid rgba(46,138,153,.1);border-radius:1.5rem;padding:4rem 2rem">
            <svg style="width:5rem;height:5rem;margin:0 auto 1rem;color:rgba(46,138,153,.2)" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
            <h3 style="font-size:1.5rem;font-weight:900;color:#f0e8cc;margin-bottom:.5rem">لا توجد إشعارات</h3>
            <p style="color:rgba(240,232,204,.5)">ليس لديك أي إشعارات حاليا</p>
        </div>
    @endif
</div>
