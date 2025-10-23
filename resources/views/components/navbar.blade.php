<header class="bg-white/80 backdrop-blur-lg shadow-sm border-b border-white/20">
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
                        <h1 class="text-xl font-bold text-gray-900">إكسابها</h1>
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
                @auth
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
                    </a>
                    <a href="{{ route('dashboard') }}" class="px-4 py-2 text-gray-700 hover:text-purple-600 transition {{ request()->is('myAds') ? 'text-purple-600 font-semibold' : '' }}">
                        إعلاناتي
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