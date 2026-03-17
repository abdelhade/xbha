<nav x-data="{ open: false }" style="background:rgba(15,30,35,.85);border-bottom:1px solid rgba(46,138,153,.15);position:sticky;top:0;z-index:50;backdrop-filter:blur(12px)" dir="rtl">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">

            <!-- Logo -->
            <a href="/" style="font-size:1.3rem;font-weight:900;color:#f0e8cc;text-decoration:none;letter-spacing:0">
                Mazadi <span style="color:#f47c51">✦</span>
            </a>

            <!-- Desktop Links -->
            <div class="hidden sm:flex items-center gap-6">
                <a href="{{ route('products.index') }}" style="color:rgba(240,232,204,.55);font-size:.875rem;font-weight:500;text-decoration:none;transition:color .2s" onmouseover="this.style.color='#3aa0b0'" onmouseout="this.style.color='rgba(240,232,204,.55)'">المنتجات</a>
                <a href="{{ route('categories.index') }}" style="color:rgba(240,232,204,.55);font-size:.875rem;font-weight:500;text-decoration:none;transition:color .2s" onmouseover="this.style.color='#3aa0b0'" onmouseout="this.style.color='rgba(240,232,204,.55)'">التصنيفات</a>
                @auth
                    <a href="{{ route('dashboard') }}" style="color:rgba(240,232,204,.55);font-size:.875rem;font-weight:500;text-decoration:none" onmouseover="this.style.color='#3aa0b0'" onmouseout="this.style.color='rgba(240,232,204,.55)'">إعلاناتي</a>
                    <a href="{{ route('orders.index') }}" style="color:rgba(240,232,204,.55);font-size:.875rem;font-weight:500;text-decoration:none" onmouseover="this.style.color='#3aa0b0'" onmouseout="this.style.color='rgba(240,232,204,.55)'">طلباتي</a>
                @endauth
            </div>

            <!-- Right side -->
            <div class="hidden sm:flex items-center gap-3">
                @auth
                    <!-- Notifications -->
                    <a href="{{ route('notifications.index') }}" style="color:rgba(240,232,204,.45);padding:.5rem;border-radius:.5rem;transition:all .2s;text-decoration:none" onmouseover="this.style.color='#3aa0b0'" onmouseout="this.style.color='rgba(240,232,204,.45)'">
                        <svg style="width:1.25rem;height:1.25rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                    </a>
                    <!-- Favorites -->
                    <a href="{{ route('favorites.index') }}" style="color:rgba(240,232,204,.45);padding:.5rem;border-radius:.5rem;transition:all .2s;text-decoration:none" onmouseover="this.style.color='#f47c51'" onmouseout="this.style.color='rgba(240,232,204,.45)'">
                        <svg style="width:1.25rem;height:1.25rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                    </a>
                    <!-- User dropdown -->
                    <div x-data="{ userOpen: false }" class="relative">
                        <button @click="userOpen = !userOpen" style="display:flex;align-items:center;gap:.5rem;padding:.4rem .75rem;border-radius:.75rem;border:1px solid rgba(46,138,153,.25);background:rgba(46,138,153,.08);cursor:pointer;font-size:.875rem;color:#f0e8cc;font-weight:600">
                            <div style="width:1.75rem;height:1.75rem;border-radius:50%;background:linear-gradient(135deg,#2e8a99,#3aa0b0);display:flex;align-items:center;justify-content:center;color:#fff;font-size:.75rem;font-weight:700">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                            {{ Auth::user()->name }}
                            <svg style="width:.875rem;height:.875rem;color:rgba(240,232,204,.4)" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
                        </button>
                        <div x-show="userOpen" @click.away="userOpen=false" x-transition style="position:absolute;top:calc(100% + .5rem);right:0;min-width:180px;background:#1a2e35;border:1px solid rgba(46,138,153,.2);border-radius:1rem;box-shadow:0 10px 40px rgba(0,0,0,.4);padding:.5rem;z-index:100">
                            <a href="{{ route('profile.edit') }}" style="display:flex;align-items:center;gap:.5rem;padding:.6rem .75rem;border-radius:.5rem;color:#f0e8cc;font-size:.875rem;text-decoration:none;transition:background .2s" onmouseover="this.style.background='rgba(46,138,153,.12)'" onmouseout="this.style.background='transparent'">الملف الشخصي</a>
                            <a href="{{ route('dashboard') }}" style="display:flex;align-items:center;gap:.5rem;padding:.6rem .75rem;border-radius:.5rem;color:#f0e8cc;font-size:.875rem;text-decoration:none;transition:background .2s" onmouseover="this.style.background='rgba(46,138,153,.12)'" onmouseout="this.style.background='transparent'">إعلاناتي</a>
                            <a href="{{ route('chat.index') }}" style="display:flex;align-items:center;gap:.5rem;padding:.6rem .75rem;border-radius:.5rem;color:#f0e8cc;font-size:.875rem;text-decoration:none;transition:background .2s" onmouseover="this.style.background='rgba(46,138,153,.12)'" onmouseout="this.style.background='transparent'">المحادثات</a>
                            <div style="height:1px;background:rgba(46,138,153,.15);margin:.25rem 0"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" style="width:100%;text-align:right;padding:.6rem .75rem;border-radius:.5rem;color:#f47c51;font-size:.875rem;background:transparent;border:none;cursor:pointer;transition:background .2s" onmouseover="this.style.background='rgba(244,124,81,.08)'" onmouseout="this.style.background='transparent'">تسجيل الخروج</button>
                            </form>
                        </div>
                    </div>
                    <a href="{{ route('products.create') }}" style="background:#f47c51;color:#fff;padding:.5rem 1.25rem;border-radius:100px;font-size:.875rem;font-weight:700;text-decoration:none;transition:all .3s" onmouseover="this.style.background='#c95f3a'" onmouseout="this.style.background='#f47c51'">+ إعلان</a>
                @else
                    <a href="{{ route('login') }}" style="color:#3aa0b0;font-size:.875rem;font-weight:600;text-decoration:none">دخول</a>
                    <a href="{{ route('register') }}" style="background:#2e8a99;color:#fff;padding:.5rem 1.25rem;border-radius:100px;font-size:.875rem;font-weight:700;text-decoration:none;transition:all .3s" onmouseover="this.style.background='#1f6370'" onmouseout="this.style.background='#2e8a99'">سجل مجاناً</a>
                @endauth
            </div>

            <!-- Mobile hamburger -->
            <button @click="open = !open" class="sm:hidden" style="padding:.5rem;color:rgba(240,232,204,.6);background:transparent;border:none;cursor:pointer">
                <svg style="width:1.5rem;height:1.5rem" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path :class="{'hidden': open}" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    <path :class="{'hidden': !open}" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile menu -->
    <div :class="{'block': open, 'hidden': !open}" class="hidden sm:hidden" style="border-top:1px solid rgba(46,138,153,.12);padding:1rem;background:rgba(15,30,35,.95)">
        <div style="display:flex;flex-direction:column;gap:.5rem">
            <a href="{{ route('products.index') }}" style="padding:.6rem .75rem;border-radius:.5rem;color:#f0e8cc;font-size:.875rem;text-decoration:none">المنتجات</a>
            <a href="{{ route('categories.index') }}" style="padding:.6rem .75rem;border-radius:.5rem;color:#f0e8cc;font-size:.875rem;text-decoration:none">التصنيفات</a>
            @auth
                <a href="{{ route('dashboard') }}" style="padding:.6rem .75rem;border-radius:.5rem;color:#f0e8cc;font-size:.875rem;text-decoration:none">إعلاناتي</a>
                <a href="{{ route('orders.index') }}" style="padding:.6rem .75rem;border-radius:.5rem;color:#f0e8cc;font-size:.875rem;text-decoration:none">طلباتي</a>
                <a href="{{ route('favorites.index') }}" style="padding:.6rem .75rem;border-radius:.5rem;color:#f0e8cc;font-size:.875rem;text-decoration:none">المفضلة</a>
                <a href="{{ route('notifications.index') }}" style="padding:.6rem .75rem;border-radius:.5rem;color:#f0e8cc;font-size:.875rem;text-decoration:none">الإشعارات</a>
                <a href="{{ route('chat.index') }}" style="padding:.6rem .75rem;border-radius:.5rem;color:#f0e8cc;font-size:.875rem;text-decoration:none">المحادثات</a>
                <a href="{{ route('profile.edit') }}" style="padding:.6rem .75rem;border-radius:.5rem;color:#f0e8cc;font-size:.875rem;text-decoration:none">الملف الشخصي</a>
                <a href="{{ route('products.create') }}" style="padding:.6rem .75rem;border-radius:.5rem;background:#f47c51;color:#fff;font-size:.875rem;font-weight:700;text-decoration:none;text-align:center">+ إضافة إعلان</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" style="width:100%;text-align:right;padding:.6rem .75rem;border-radius:.5rem;color:#f47c51;font-size:.875rem;background:transparent;border:none;cursor:pointer">تسجيل الخروج</button>
                </form>
            @else
                <a href="{{ route('login') }}" style="padding:.6rem .75rem;border-radius:.5rem;color:#3aa0b0;font-size:.875rem;font-weight:600;text-decoration:none">دخول</a>
                <a href="{{ route('register') }}" style="padding:.6rem .75rem;border-radius:.5rem;background:#f47c51;color:#fff;font-size:.875rem;font-weight:700;text-decoration:none;text-align:center">سجل مجاناً</a>
            @endauth
        </div>
    </div>
</nav>
