
<div wire:poll.3s>
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="bg-purple-600 p-4 flex items-center gap-3">
            <a href="{{ route('chat.index') }}" class="text-white">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </a>
            <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center">
                <span class="text-purple-600 font-bold">{{ substr($user->name, 0, 1) }}</span>
            </div>
            <h2 class="text-xl font-bold text-white">{{ $user->name }}</h2>
        </div>

        <div class="p-6 h-96 overflow-y-auto space-y-4 custom-scrollbar" id="messages-container">
            @foreach($messages as $message)
                <div class="flex {{ $message->sender_id == auth()->id() ? 'justify-end' : 'justify-start' }} group">
                    <div class="max-w-xs {{ $message->sender_id == auth()->id() ? 'bg-purple-600 text-white' : 'bg-gray-200 text-gray-900' }} rounded-2xl px-4 py-2 relative">
                        <p class="{{ $message->message === 'تم حذف هذه الرسالة' ? 'italic text-gray-400' : '' }}">{{ $message->message }}</p>
                        <p class="text-xs mt-1 {{ $message->sender_id == auth()->id() ? 'text-purple-200' : 'text-gray-500' }}">
                            {{ $message->created_at->format('H:i') }}
                        </p>
                        @if($message->sender_id == auth()->id())
                            <div class="absolute -right-16 top-1/2 -translate-y-1/2 opacity-0 group-hover:opacity-100 transition flex gap-1">
                                <button wire:click="startEdit({{ $message->id }}, '{{ addslashes($message->message) }}')" class="p-1 bg-white rounded-full hover:bg-gray-100">
                                    <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </button>
                                <button wire:click="showDeleteOptions({{ $message->id }})" class="p-1 bg-white rounded-full hover:bg-red-50">
                                    <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        @if($editingMessageId)
            <div class="p-4 border-t bg-yellow-50">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-sm text-gray-600">تعديل الرسالة</span>
                    <button wire:click="cancelEdit" class="text-gray-500 hover:text-gray-700">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <div class="flex gap-3">
                    <input type="text" wire:model="editingMessageText" wire:keydown.enter="saveEdit" placeholder="عدل الرسالة..."
                           class="flex-1 px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-purple-600">
                    <button wire:click="saveEdit" class="px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700">
                        حفظ
                    </button>
                </div>
            </div>
        @else
            <form wire:submit.prevent="sendMessage" class="p-4 border-t">
                <div class="flex gap-3">
                    <input type="text" wire:model="message" placeholder="اكتب رسالتك..." required
                           class="flex-1 px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-purple-600">
                    <button type="submit" class="px-6 py-3 bg-purple-600 text-white rounded-lg hover:bg-purple-700">
                        إرسال
                    </button>
                </div>
            </form>
        @endif
    </div>

    <!-- Delete Options Modal -->
    @if($deletingMessageId)
        <div class="fixed inset-0 bg-black/50 flex items-center justify-center z-50" wire:click="cancelDelete">
            <div class="bg-white rounded-2xl p-6 max-w-sm w-full mx-4" wire:click.stop>
                <h3 class="text-lg font-bold text-gray-900 mb-4">حذف الرسالة؟</h3>
                <div class="space-y-2">
                    <button wire:click="deleteForMe({{ $deletingMessageId }})" class="w-full px-4 py-3 text-right hover:bg-gray-100 rounded-lg transition">
                        حذف لدي
                    </button>
                    <button wire:click="deleteForEveryone({{ $deletingMessageId }})" class="w-full px-4 py-3 text-right hover:bg-gray-100 rounded-lg transition">
                        حذف للجميع
                    </button>
                    <button wire:click="cancelDelete" class="w-full px-4 py-3 text-right hover:bg-gray-100 rounded-lg transition text-gray-600">
                        إلغاء
                    </button>
                </div>
            </div>
        </div>
    @endif

    <style>
        .custom-scrollbar::-webkit-scrollbar {
            width: 4px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #a855f7;
            border-radius: 10px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #9333ea;
        }
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
            container.scrollTop = container.scrollHeight;
        });
    </script>
</div>
