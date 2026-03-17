<div wire:poll.3s>
    {{-- Header --}}
    <div style="background:rgba(46,138,153,.15);border-bottom:1px solid rgba(46,138,153,.2);padding:1rem 1.25rem;display:flex;align-items:center;gap:.75rem">
        <a href="{{ route('chat.index') }}" style="color:#3aa0b0;display:flex;align-items:center">
            <svg style="width:1.5rem;height:1.5rem" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
        </a>
        <div style="width:2.5rem;height:2.5rem;background:rgba(46,138,153,.2);border:1px solid rgba(46,138,153,.3);border-radius:50%;display:flex;align-items:center;justify-content:center">
            <span style="color:#3aa0b0;font-weight:700">{{ substr($user->name, 0, 1) }}</span>
        </div>
        <h2 style="font-size:1.1rem;font-weight:700;color:#f0e8cc">{{ $user->name }}</h2>
    </div>

    {{-- Messages --}}
    <div style="padding:1.5rem;height:24rem;overflow-y:auto;display:flex;flex-direction:column;gap:1rem" id="messages-container" class="custom-scrollbar">
        @foreach($messages as $message)
            <div style="display:flex;justify-content:{{ $message->sender_id == auth()->id() ? 'flex-end' : 'flex-start' }}" class="group">
                <div style="max-width:18rem;position:relative">
                    <div style="background:{{ $message->sender_id == auth()->id() ? '#2e8a99' : 'rgba(46,138,153,.12)' }};border:1px solid {{ $message->sender_id == auth()->id() ? 'rgba(46,138,153,.4)' : 'rgba(46,138,153,.2)' }};border-radius:1.25rem;padding:.6rem 1rem">
                        <p style="color:{{ $message->sender_id == auth()->id() ? '#fff' : '#f0e8cc' }};{{ $message->message === 'تم حذف هذه الرسالة' ? 'font-style:italic;opacity:.5' : '' }}">{{ $message->message }}</p>
                        <p style="font-size:.7rem;margin-top:.25rem;color:{{ $message->sender_id == auth()->id() ? 'rgba(255,255,255,.6)' : 'rgba(240,232,204,.4)' }}">{{ $message->created_at->format('H:i') }}</p>
                    </div>
                    @if($message->sender_id == auth()->id())
                        <div style="position:absolute;left:-4.5rem;top:50%;transform:translateY(-50%);display:none;gap:.25rem" class="group-hover-actions">
                            <button wire:click="startEdit({{ $message->id }}, '{{ addslashes($message->message) }}')"
                                    style="padding:.3rem;background:rgba(46,138,153,.15);border:1px solid rgba(46,138,153,.2);border-radius:.5rem;cursor:pointer;color:#3aa0b0">
                                <svg style="width:1rem;height:1rem" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </button>
                            <button wire:click="showDeleteOptions({{ $message->id }})"
                                    style="padding:.3rem;background:rgba(244,124,81,.1);border:1px solid rgba(244,124,81,.2);border-radius:.5rem;cursor:pointer;color:#f47c51">
                                <svg style="width:1rem;height:1rem" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

    {{-- Edit bar --}}
    @if($editingMessageId)
        <div style="padding:1rem 1.25rem;border-top:1px solid rgba(46,138,153,.15);background:rgba(46,138,153,.06)">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:.5rem">
                <span style="font-size:.875rem;color:#3aa0b0">تعديل الرسالة</span>
                <button wire:click="cancelEdit" style="color:rgba(240,232,204,.5);background:transparent;border:none;cursor:pointer">
                    <svg style="width:1.25rem;height:1.25rem" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <div style="display:flex;gap:.75rem">
                <input type="text" wire:model="editingMessageText" wire:keydown.enter="saveEdit" placeholder="عدل الرسالة..."
                       style="flex:1;padding:.75rem 1rem;background:rgba(15,30,35,.6);border:1px solid rgba(46,138,153,.25);border-radius:.75rem;color:#f0e8cc;outline:none;font-family:inherit">
                <button wire:click="saveEdit"
                        style="padding:.75rem 1.5rem;background:#2e8a99;color:#fff;border:none;border-radius:.75rem;cursor:pointer;font-weight:600;font-family:inherit">
                    حفظ
                </button>
            </div>
        </div>
    @else
        <form wire:submit.prevent="sendMessage" style="padding:1rem 1.25rem;border-top:1px solid rgba(46,138,153,.15)">
            <div style="display:flex;gap:.75rem">
                <input type="text" wire:model="message" placeholder="اكتب رسالتك..." required
                       style="flex:1;padding:.75rem 1rem;background:rgba(15,30,35,.6);border:1px solid rgba(46,138,153,.25);border-radius:.75rem;color:#f0e8cc;outline:none;font-family:inherit">
                <button type="submit"
                        style="padding:.75rem 1.5rem;background:#2e8a99;color:#fff;border:none;border-radius:.75rem;cursor:pointer;font-weight:700;font-family:inherit">
                    إرسال
                </button>
            </div>
        </form>
    @endif

    {{-- Delete Modal --}}
    @if($deletingMessageId)
        <div style="position:fixed;inset:0;background:rgba(0,0,0,.6);display:flex;align-items:center;justify-content:center;z-index:50" wire:click="cancelDelete">
            <div style="background:#1a2e35;border:1px solid rgba(46,138,153,.2);border-radius:1.25rem;padding:1.5rem;max-width:22rem;width:100%;margin:1rem" wire:click.stop>
                <h3 style="font-size:1.1rem;font-weight:700;color:#f0e8cc;margin-bottom:1rem">حذف الرسالة؟</h3>
                <div style="display:flex;flex-direction:column;gap:.5rem">
                    <button wire:click="deleteForMe({{ $deletingMessageId }})"
                            style="width:100%;padding:.75rem 1rem;text-align:right;background:rgba(46,138,153,.08);border:1px solid rgba(46,138,153,.15);border-radius:.75rem;color:#f0e8cc;cursor:pointer;font-family:inherit;transition:background .2s"
                            onmouseover="this.style.background='rgba(46,138,153,.15)'" onmouseout="this.style.background='rgba(46,138,153,.08)'">
                        حذف لدي
                    </button>
                    <button wire:click="deleteForEveryone({{ $deletingMessageId }})"
                            style="width:100%;padding:.75rem 1rem;text-align:right;background:rgba(244,124,81,.08);border:1px solid rgba(244,124,81,.15);border-radius:.75rem;color:#f47c51;cursor:pointer;font-family:inherit;transition:background .2s"
                            onmouseover="this.style.background='rgba(244,124,81,.15)'" onmouseout="this.style.background='rgba(244,124,81,.08)'">
                        حذف للجميع
                    </button>
                    <button wire:click="cancelDelete"
                            style="width:100%;padding:.75rem 1rem;text-align:right;background:transparent;border:1px solid rgba(240,232,204,.1);border-radius:.75rem;color:rgba(240,232,204,.5);cursor:pointer;font-family:inherit">
                        إلغاء
                    </button>
                </div>
            </div>
        </div>
    @endif

    <style>
        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: rgba(46,138,153,.05); border-radius: 10px; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: rgba(46,138,153,.3); border-radius: 10px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: rgba(46,138,153,.5); }
        .group:hover .group-hover-actions { display: flex !important; }
    </style>

    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('messageSent', () => {
                setTimeout(() => {
                    const container = document.getElementById('messages-container');
                    container.scrollTop = container.scrollHeight;
                }, 100);
            });
        });
        window.addEventListener('load', () => {
            const container = document.getElementById('messages-container');
            if (container) container.scrollTop = container.scrollHeight;
        });
    </script>
</div>
