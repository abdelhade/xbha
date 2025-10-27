
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

        <div class="p-6 h-96 overflow-y-auto space-y-4" id="messages-container" wire:ignore.self>
            @foreach($messages as $message)
                <div class="flex {{ $message->sender_id == auth()->id() ? 'justify-end' : 'justify-start' }}">
                    <div class="max-w-xs {{ $message->sender_id == auth()->id() ? 'bg-purple-600 text-white' : 'bg-gray-200 text-gray-900' }} rounded-2xl px-4 py-2">
                        <p>{{ $message->message }}</p>
                        <p class="text-xs mt-1 {{ $message->sender_id == auth()->id() ? 'text-purple-200' : 'text-gray-500' }}">
                            {{ $message->created_at->format('H:i') }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>

        <form wire:submit.prevent="sendMessage" class="p-4 border-t">
            <div class="flex gap-3">
                <input type="text" wire:model="message" placeholder="اكتب رسالتك..." required
                       class="flex-1 px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-purple-600">
                <button type="submit" class="px-6 py-3 bg-purple-600 text-white rounded-lg hover:bg-purple-700">
                    إرسال
                </button>
            </div>
        </form>
    </div>

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
