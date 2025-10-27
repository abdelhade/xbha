<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>المحادثات - إكسابها</title>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Tajawal', sans-serif; }
        .gradient-bg { background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 50%, #cbd5e1 100%); }
    </style>
</head>
<body class="gradient-bg min-h-screen">
    <x-navbar />

    <section class="py-12">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                <h2 class="text-3xl font-bold text-gray-900 mb-8">المحادثات</h2>

                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    @forelse($conversations as $conversation)
                        @php
                            $otherUser = $conversation->sender_id == auth()->id() ? $conversation->receiver : $conversation->sender;
                            $unreadCount = \App\Models\Message::where('sender_id', $otherUser->id)->where('receiver_id', auth()->id())->where('is_read', false)->count();
                        @endphp
                        <a href="{{ route('chat.show', encrypt($otherUser->id)) }}" class="flex items-center gap-4 p-4 hover:bg-gray-50 transition border-b {{ $unreadCount > 0 ? 'bg-purple-50' : '' }}">
                            <div class="w-12 h-12 bg-purple-600 rounded-full flex items-center justify-center relative">
                                <span class="text-white font-bold">{{ substr($otherUser->name, 0, 1) }}</span>
                                @if($unreadCount > 0)
                                    <span class="absolute -top-1 -right-1 w-5 h-5 bg-red-500 text-white text-xs rounded-full flex items-center justify-center">
                                        {{ $unreadCount }}
                                    </span>
                                @endif
                            </div>
                            <div class="flex-1">
                                <h3 class="font-semibold text-gray-900 {{ $unreadCount > 0 ? 'font-bold' : '' }}">{{ $otherUser->name }}</h3>
                                <p class="text-sm text-gray-600 truncate {{ $unreadCount > 0 ? 'font-semibold' : '' }}">{{ $conversation->message }}</p>
                            </div>
                            <div class="text-xs text-gray-400">{{ $conversation->created_at->diffForHumans() }}</div>
                        </a>
                    @empty
                        <div class="p-12 text-center">
                            <p class="text-gray-500">لا توجد محادثات</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>
</body>
</html>
