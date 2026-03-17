<div wire:poll.5s>
    @forelse($conversations as $conversation)
        @php
            $otherUser = $conversation->sender_id == auth()->id() ? $conversation->receiver : $conversation->sender;
            $unreadCount = \App\Models\Message::where('sender_id', $otherUser->id)->where('receiver_id', auth()->id())->where('is_read', false)->count();
        @endphp
        <a href="{{ route('chat.show', encrypt($otherUser->id)) }}"
           style="display:flex;align-items:center;gap:1rem;padding:1rem 1.25rem;border-bottom:1px solid rgba(46,138,153,.1);text-decoration:none;transition:background .2s;background:{{ $unreadCount > 0 ? 'rgba(46,138,153,.08)' : 'transparent' }}"
           onmouseover="this.style.background='rgba(46,138,153,.12)'"
           onmouseout="this.style.background='{{ $unreadCount > 0 ? 'rgba(46,138,153,.08)' : 'transparent' }}'">
            <div style="position:relative;flex-shrink:0">
                <div style="width:3rem;height:3rem;background:rgba(46,138,153,.2);border:1px solid rgba(46,138,153,.3);border-radius:50%;display:flex;align-items:center;justify-content:center">
                    <span style="color:#3aa0b0;font-weight:700;font-size:1.1rem">{{ substr($otherUser->name, 0, 1) }}</span>
                </div>
                @if($unreadCount > 0)
                    <span style="position:absolute;top:-.25rem;right:-.25rem;width:1.25rem;height:1.25rem;background:#f47c51;color:#fff;font-size:.7rem;border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:700">
                        {{ $unreadCount }}
                    </span>
                @endif
            </div>
            <div style="flex:1;min-width:0">
                <h3 style="font-weight:{{ $unreadCount > 0 ? '700' : '600' }};color:#f0e8cc;margin-bottom:.2rem">{{ $otherUser->name }}</h3>
                <p style="font-size:.875rem;color:rgba(240,232,204,.5);white-space:nowrap;overflow:hidden;text-overflow:ellipsis;font-weight:{{ $unreadCount > 0 ? '600' : '400' }}">{{ $conversation->message }}</p>
            </div>
            <div style="font-size:.75rem;color:rgba(240,232,204,.35);flex-shrink:0">{{ $conversation->created_at->diffForHumans() }}</div>
        </a>
    @empty
        <div style="text-align:center;padding:4rem 2rem">
            <svg style="width:5rem;height:5rem;margin:0 auto 1rem;color:rgba(46,138,153,.25)" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
            </svg>
            <h3 style="font-size:1.25rem;font-weight:700;color:#f0e8cc;margin-bottom:.5rem">لا توجد محادثات</h3>
            <p style="color:rgba(240,232,204,.5)">ابدأ محادثة جديدة من صفحة المنتج</p>
        </div>
    @endforelse
</div>
