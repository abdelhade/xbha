<header class="bg-white/80 backdrop-blur-lg shadow-sm border-b border-white/20 sticky top-0 z-50">
    <div class="container mx-auto px-4 py-4">
        <div class="flex items-center justify-between">
            <!-- Logo -->
            <div class="flex items-center gap-2">
                <a href="/" class="flex items-center gap-2">
                    <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-indigo-600 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold text-gray-900">Mazadi</h1>
                        <p class="text-xs text-gray-500">{{ $subtitle ?? 'سوق الإعلانات المبوبة' }}</p>
                    </div>
                </a>
            </div>

            <!-- Navigation -->
            <nav class="hidden md:flex items-center gap-6">
                <a href="/" class="text-gray-700 hover:text-purple-600 transition {{ request()->is('/') ? 'text-purple-600 font-semibold' : '' }}">
                    الرئيسية
                </a>
                <a href="{{ route('products.index') }}" class="text-gray-700 hover:text-purple-600 transition {{ request()->is('products') ? 'text-purple-600 font-semibold' : '' }}">
                    تصفح المنتجات
                </a>
                @auth
                    <a href="{{ route('products.create') }}" class="text-gray-700 hover:text-purple-600 transition {{ request()->is('products/create') ? 'text-purple-600 font-semibold' : '' }}">
                        إضافة إعلان
                    </a>
                @endauth
            </nav>

            <!-- Auth Buttons -->
            <div class="flex items-center gap-3">
                <a href="{{ route('favorites.index') }}" class="relative p-2 text-gray-700 hover:text-purple-600 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                    </svg>
                    @php
                        $favCount = auth()->check() ? auth()->user()->favorites()->count() : count(session()->get('favorites', []));
                    @endphp
                    @if($favCount > 0)
                        <span class="absolute -top-1 -right-1 w-5 h-5 bg-red-500 text-white text-xs rounded-full flex items-center justify-center">
                            {{ $favCount }}
                        </span>
                    @endif
                </a>
                @auth
                    @if(auth()->user()->hasRole('admin'))
                        <a href="{{ route('admin.dashboard') }}" class="text-gray-700 hover:text-purple-600 transition {{ request()->is('admin*') ? 'text-purple-600 font-semibold' : '' }} mr-4">
                            لوحة التحكم
                        </a>
                    @endif
                    <!-- Chat -->
                    <a href="{{ route('chat.index') }}" class="relative p-2 text-gray-700 hover:text-purple-600 transition" id="chat-icon">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                        @php
                            $unreadCount = \App\Models\Message::where('receiver_id', auth()->id())->where('is_read', false)->count();
                        @endphp
                        <span id="chat-badge" class="absolute -top-1 -right-1 w-5 h-5 bg-red-500 text-white text-xs rounded-full items-center justify-center {{ $unreadCount > 0 ? 'flex' : 'hidden' }}">
                            {{ $unreadCount }}
                        </span>
                    </a>
                    <script>
                        setInterval(() => {
                            fetch('/chat-unread-count')
                                .then(response => response.json())
                                .then(data => {
                                    const badge = document.getElementById('chat-badge');
                                    if (data.count > 0) {
                                        badge.textContent = data.count;
                                        badge.classList.remove('hidden');
                                        badge.classList.add('flex');
                                    } else {
                                        badge.classList.add('hidden');
                                        badge.classList.remove('flex');
                                    }
                                });
                        }, 10000);
                    </script>
                    <!-- Notifications -->
                    <a href="{{ route('notifications.index') }}" class="relative p-2 text-gray-700 hover:text-purple-600 transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                        </svg>
                        @if(auth()->user()->unreadNotifications->count() > 0)
                            <span class="absolute -top-1 -right-1 w-5 h-5 bg-red-500 text-white text-xs rounded-full flex items-center justify-center">
                                {{ auth()->user()->unreadNotifications->count() }}
                            </span>
                        @endif
                    </a>
                    
                    <!-- User Dropdown -->
                    <div class="relative group">
                        <button class="flex items-center gap-2 px-4 py-2 text-gray-700 hover:text-purple-600 transition">
                            <div class="w-8 h-8 bg-purple-600 rounded-full flex items-center justify-center">
                                <span class="text-white text-sm font-semibold">{{ substr(Auth::user()->name, 0, 1) }}</span>
                            </div>
                            <span class="hidden md:block">{{ Auth::user()->name }}</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        
                        <!-- Dropdown Menu -->
                        <div class="absolute left-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                            <div class="py-2">
                                <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-2 text-gray-700 hover:bg-purple-50 hover:text-purple-600 transition {{ request()->is('myAds') ? 'bg-purple-50 text-purple-600' : '' }}">
                                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2 2v0"></path>
                                    </svg>
                                    إعلاناتي
                                </a>
                                <a href="{{ route('orders.index') }}" class="flex items-center px-4 py-2 text-gray-700 hover:bg-purple-50 hover:text-purple-600 transition {{ request()->is('orders') ? 'bg-purple-50 text-purple-600' : '' }}">
                                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                    </svg>
                                    طلباتي
                                </a>
                                <a href="{{ route('orders.sales') }}" class="flex items-center px-4 py-2 text-gray-700 hover:bg-purple-50 hover:text-purple-600 transition {{ request()->is('sales') ? 'bg-purple-50 text-purple-600' : '' }}">
                                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    المبيعات
                                </a>

                                <a href="{{ route('products.create') }}" class="flex items-center px-4 py-2 text-gray-700 hover:bg-purple-50 hover:text-purple-600 transition {{ request()->is('products/create') ? 'bg-purple-50 text-purple-600' : '' }}">
                                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                    إضافة إعلان
                                </a>
                                <a href="{{ route('profile.edit') }}" class="flex items-center px-4 py-2 text-gray-700 hover:bg-purple-50 hover:text-purple-600 transition {{ request()->is('profile') ? 'bg-purple-50 text-purple-600' : '' }}">
                                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    الملف الشخصي
                                </a>
                                <div class="border-t border-gray-100 my-1"></div>
                                <form method="POST" action="{{ route('logout') }}" class="block">
                                    @csrf
                                    <button type="submit" class="flex items-center w-full px-4 py-2 text-gray-700 hover:bg-red-50 hover:text-red-600 transition text-right">
                                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                        </svg>
                                        تسجيل خروج
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="px-4 py-2 text-gray-700 hover:text-purple-600 transition">
                        تسجيل دخول
                    </a>
                    <a href="{{ route('register') }}" class="px-6 py-2 bg-gradient-to-r from-purple-600 to-indigo-600 text-white rounded-lg hover:from-purple-700 hover:to-indigo-700 transition shadow-md">
                        إنشاء حساب
                    </a>
                @endauth

                <!-- Mobile Menu Button -->
                <button class="md:hidden p-2 text-gray-700 hover:text-purple-600" onclick="toggleMobileMenu()">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobileMenu" class="hidden md:hidden mt-4 pb-4 border-t border-gray-200">
            <div class="flex flex-col space-y-2 pt-4">
                <a href="/" class="px-4 py-2 text-gray-700 hover:text-purple-600 transition {{ request()->is('/') ? 'text-purple-600 font-semibold' : '' }}">
                    الرئيسية
                </a>
                <a href="{{ route('products.index') }}" class="px-4 py-2 text-gray-700 hover:text-purple-600 transition {{ request()->is('products') ? 'text-purple-600 font-semibold' : '' }}">
                    تصفح المنتجات
                </a>
                @auth
                    <a href="{{ route('products.create') }}" class="px-4 py-2 text-gray-700 hover:text-purple-600 transition {{ request()->is('products/create') ? 'text-purple-600 font-semibold' : '' }}">
                        إضافة إعلان
                    </a>                    @if(auth()->user()->hasRole('admin'))
                        <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 text-gray-700 hover:text-purple-600 transition {{ request()->is('admin*') ? 'text-purple-600 font-semibold' : '' }}">
                            لوحة التحكم
                        </a>
                    @endif                    <a href="{{ route('dashboard') }}" class="px-4 py-2 text-gray-700 hover:text-purple-600 transition {{ request()->is('myAds') ? 'text-purple-600 font-semibold' : '' }}">
                        إعلاناتي
                    </a>
                    <a href="{{ route('orders.index') }}" class="px-4 py-2 text-gray-700 hover:text-purple-600 transition {{ request()->is('orders') ? 'text-purple-600 font-semibold' : '' }}">
                        طلباتي
                    </a>
                    <a href="{{ route('orders.sales') }}" class="px-4 py-2 text-gray-700 hover:text-purple-600 transition {{ request()->is('sales') ? 'text-purple-600 font-semibold' : '' }}">
                        المبيعات
                    </a>
                    <a href="{{ route('favorites.index') }}" class="px-4 py-2 text-gray-700 hover:text-purple-600 transition {{ request()->is('favorites*') ? 'text-purple-600 font-semibold' : '' }}">
                        المفضلة
                    </a>
                @endauth
            </div>
        </div>
    </div>
</header>

<script>
    function toggleMobileMenu() {
        const menu = document.getElementById('mobileMenu');
        menu.classList.toggle('hidden');
    }
</script>