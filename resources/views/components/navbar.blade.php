<header style="background:rgba(15,30,35,.92);backdrop-filter:blur(20px);border-bottom:1px solid rgba(46,138,153,.15);position:sticky;top:0;z-index:50">
    <div style="max-width:1280px;margin:0 auto;padding:.85rem 1.5rem;display:flex;align-items:center;justify-content:space-between">
        <!-- Logo -->
        <a href="/" style="display:flex;align-items:center;gap:.6rem;text-decoration:none">
            <div style="width:38px;height:38px;background:rgba(46,138,153,.2);border:1px solid rgba(46,138,153,.35);border-radius:.65rem;display:flex;align-items:center;justify-content:center;font-size:1rem;font-weight:900;color:#2e8a99">م</div>
            <div class="hidden md:block">
                <div style="font-size:1.1rem;font-weight:900;color:#f0e8cc;letter-spacing:0">مزادي</div>
                <div style="font-size:.65rem;color:rgba(240,232,204,.4);letter-spacing:.05em">سوق الإعلانات المبوبة</div>
            </div>
        </a>

        <!-- Desktop Nav -->
        <nav class="hidden md:flex" style="align-items:center;gap:2rem">
            <a href="/" style="color:rgba(240,232,204,.6);font-size:.875rem;font-weight:500;text-decoration:none;transition:color .2s" onmouseover="this.style.color='#f0e8cc'" onmouseout="this.style.color='rgba(240,232,204,.6)'">الرئيسية</a>
            <a href="{{ route('products.index') }}" style="color:rgba(240,232,204,.6);font-size:.875rem;font-weight:500;text-decoration:none;transition:color .2s" onmouseover="this.style.color='#f0e8cc'" onmouseout="this.style.color='rgba(240,232,204,.6)'">تصفح المنتجات</a>
            @auth
                <a href="{{ route('products.create') }}" style="color:rgba(240,232,204,.6);font-size:.875rem;font-weight:500;text-decoration:none;transition:color .2s" onmouseover="this.style.color='#f0e8cc'" onmouseout="this.style.color='rgba(240,232,204,.6)'">إضافة إعلان</a>
                @if (auth()->user()->hasRole('admin'))
                    <a href="{{ route('admin.dashboard') }}" style="color:rgba(240,232,204,.6);font-size:.875rem;font-weight:500;text-decoration:none;transition:color .2s" onmouseover="this.style.color='#f0e8cc'" onmouseout="this.style.color='rgba(240,232,204,.6)'">لوحة التحكم</a>
                @endif
            @endauth
        </nav>

        <!-- Desktop Actions -->
        <div class="hidden md:flex" style="align-items:center;gap:.5rem">
            @php
                $favCount = auth()->check() ? auth()->user()->favorites()->count() : count(session()->get('favorites', []));
            @endphp
            <a href="{{ route('favorites.index') }}" style="position:relative;padding:.5rem;color:rgba(240,232,204,.5);text-decoration:none;transition:color .2s;border-radius:.5rem" onmouseover="this.style.color='#f47c51'" onmouseout="this.style.color='rgba(240,232,204,.5)'">
                <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                @if ($favCount > 0)
                    <span style="position:absolute;top:-2px;right:-2px;width:16px;height:16px;background:#f47c51;color:#fff;font-size:9px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:700">{{ $favCount }}</span>
                @endif
            </a>

            @auth
                @php
                    $unreadCount = \App\Models\Message::where('receiver_id', auth()->id())->where('is_read', false)->count();
                    $notificationCount = auth()->user()->unreadNotifications->count();
                @endphp
                <a href="{{ route('chat.index') }}" style="position:relative;padding:.5rem;color:rgba(240,232,204,.5);text-decoration:none;transition:color .2s;border-radius:.5rem" onmouseover="this.style.color='#2e8a99'" onmouseout="this.style.color='rgba(240,232,204,.5)'" id="chat-icon">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                    <span id="chat-badge" style="position:absolute;top:-2px;right:-2px;width:16px;height:16px;background:#f47c51;color:#fff;font-size:9px;border-radius:50%;align-items:center;justify-content:center;font-weight:700;{{ $unreadCount > 0 ? 'display:flex' : 'display:none' }}">{{ $unreadCount }}</span>
                </a>

                <a href="{{ route('notifications.index') }}" style="position:relative;padding:.5rem;color:rgba(240,232,204,.5);text-decoration:none;transition:color .2s;border-radius:.5rem" onmouseover="this.style.color='#2e8a99'" onmouseout="this.style.color='rgba(240,232,204,.5)'">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                    @if ($notificationCount > 0)
                        <span style="position:absolute;top:-2px;right:-2px;width:16px;height:16px;background:#f47c51;color:#fff;font-size:9px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:700">{{ $notificationCount }}</span>
                    @endif
                </a>

                <!-- User Dropdown -->
                <div style="position:relative">
                    <button id="user-menu-btn" onclick="toggleUserMenu()" style="display:flex;align-items:center;gap:.5rem;padding:.4rem .75rem;background:rgba(46,138,153,.1);border:1px solid rgba(46,138,153,.2);border-radius:.65rem;color:#f0e8cc;font-family:'Noto Kufi Arabic',sans-serif;font-size:.82rem;font-weight:600;cursor:pointer;transition:all .2s">
                        <div style="width:26px;height:26px;background:#2e8a99;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:.75rem;font-weight:900;color:#fff">{{ substr(Auth::user()->name, 0, 1) }}</div>
                        {{ Auth::user()->name }}
                        <svg id="user-menu-chevron" width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="transition:transform .2s"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div id="user-menu-dropdown" style="position:absolute;left:0;top:calc(100% + .5rem);width:200px;background:#1a2e35;border:1px solid rgba(46,138,153,.2);border-radius:.85rem;padding:.5rem;display:none;z-index:100;box-shadow:0 8px 32px rgba(0,0,0,.4)">
                        <a href="{{ route('dashboard') }}" style="display:flex;align-items:center;gap:.6rem;padding:.6rem .75rem;color:rgba(240,232,204,.7);text-decoration:none;border-radius:.5rem;font-size:.82rem;transition:all .2s" onmouseover="this.style.background='rgba(46,138,153,.1)';this.style.color='#f0e8cc'" onmouseout="this.style.background='transparent';this.style.color='rgba(240,232,204,.7)'">
                            <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                            إعلاناتي
                        </a>
                        <a href="{{ route('orders.index') }}" style="display:flex;align-items:center;gap:.6rem;padding:.6rem .75rem;color:rgba(240,232,204,.7);text-decoration:none;border-radius:.5rem;font-size:.82rem;transition:all .2s" onmouseover="this.style.background='rgba(46,138,153,.1)';this.style.color='#f0e8cc'" onmouseout="this.style.background='transparent';this.style.color='rgba(240,232,204,.7)'">
                            <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                            طلباتي
                        </a>
                        <a href="{{ route('orders.sales') }}" style="display:flex;align-items:center;gap:.6rem;padding:.6rem .75rem;color:rgba(240,232,204,.7);text-decoration:none;border-radius:.5rem;font-size:.82rem;transition:all .2s" onmouseover="this.style.background='rgba(46,138,153,.1)';this.style.color='#f0e8cc'" onmouseout="this.style.background='transparent';this.style.color='rgba(240,232,204,.7)'">
                            <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            المبيعات
                        </a>
                        <a href="{{ route('profile.edit') }}" style="display:flex;align-items:center;gap:.6rem;padding:.6rem .75rem;color:rgba(240,232,204,.7);text-decoration:none;border-radius:.5rem;font-size:.82rem;transition:all .2s" onmouseover="this.style.background='rgba(46,138,153,.1)';this.style.color='#f0e8cc'" onmouseout="this.style.background='transparent';this.style.color='rgba(240,232,204,.7)'">
                            <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            الملف الشخصي
                        </a>
                        <div style="border-top:1px solid rgba(46,138,153,.12);margin:.35rem 0"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" style="display:flex;align-items:center;gap:.6rem;width:100%;padding:.6rem .75rem;color:rgba(244,124,81,.7);background:transparent;border:none;border-radius:.5rem;font-family:'Noto Kufi Arabic',sans-serif;font-size:.82rem;cursor:pointer;transition:all .2s;text-align:right" onmouseover="this.style.background='rgba(244,124,81,.08)';this.style.color='#f47c51'" onmouseout="this.style.background='transparent';this.style.color='rgba(244,124,81,.7)'">
                                <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                                تسجيل خروج
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}" style="padding:.5rem .85rem;color:rgba(240,232,204,.6);font-size:.875rem;text-decoration:none;transition:color .2s" onmouseover="this.style.color='#f0e8cc'" onmouseout="this.style.color='rgba(240,232,204,.6)'">تسجيل دخول</a>
                <a href="{{ route('register') }}" style="padding:.55rem 1.1rem;background:#f47c51;color:#fff;border-radius:.65rem;font-size:.875rem;font-weight:700;text-decoration:none;transition:all .2s" onmouseover="this.style.background='#c95f3a'" onmouseout="this.style.background='#f47c51'">إنشاء حساب</a>
            @endauth
        </div>

        <!-- Mobile Icons -->
        <div class="md:hidden" style="display:flex;align-items:center;gap:.25rem">
            @auth
                @php $unreadCount = \App\Models\Message::where('receiver_id', auth()->id())->where('is_read', false)->count(); @endphp
                <a href="{{ route('chat.index') }}" style="position:relative;padding:.5rem;color:rgba(240,232,204,.5);text-decoration:none">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                    @if ($unreadCount > 0)<span style="position:absolute;top:0;right:0;width:14px;height:14px;background:#f47c51;color:#fff;font-size:8px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:700">{{ $unreadCount }}</span>@endif
                </a>
            @else
                <a href="{{ route('login') }}" style="padding:.5rem .85rem;background:#f47c51;color:#fff;border-radius:.6rem;font-size:.8rem;font-weight:700;text-decoration:none">دخول</a>
            @endauth
        </div>
    </div>
</header>

<!-- Mobile Bottom Nav -->
<div class="md:hidden" style="position:fixed;bottom:0;left:0;right:0;background:rgba(15,30,35,.95);backdrop-filter:blur(20px);border-top:1px solid rgba(46,138,153,.15);z-index:50;padding:.5rem 0 calc(.5rem + env(safe-area-inset-bottom))">
    <div style="display:flex;align-items:center;justify-content:space-around;padding:0 .5rem">
        <a href="/" style="display:flex;flex-direction:column;align-items:center;gap:.2rem;padding:.4rem .6rem;color:rgba(240,232,204,.5);text-decoration:none;font-size:.6rem;font-weight:600">
            <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
            الرئيسية
        </a>
        <a href="{{ route('products.index') }}" style="display:flex;flex-direction:column;align-items:center;gap:.2rem;padding:.4rem .6rem;color:rgba(240,232,204,.5);text-decoration:none;font-size:.6rem;font-weight:600">
            <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
            المنتجات
        </a>
        @auth
            <a href="{{ route('products.create') }}" style="display:flex;flex-direction:column;align-items:center;margin-top:-1.5rem">
                <div style="width:52px;height:52px;background:#f47c51;border-radius:50%;display:flex;align-items:center;justify-content:center;box-shadow:0 4px 20px rgba(244,124,81,.4)">
                    <svg width="24" height="24" fill="none" stroke="#fff" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                </div>
                <span style="font-size:.6rem;font-weight:600;color:rgba(240,232,204,.5);margin-top:.2rem">إضافة</span>
            </a>
            <a href="{{ route('favorites.index') }}" style="display:flex;flex-direction:column;align-items:center;gap:.2rem;padding:.4rem .6rem;color:rgba(240,232,204,.5);text-decoration:none;font-size:.6rem;font-weight:600">
                <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                المفضلة
            </a>
            <a href="{{ route('dashboard') }}" style="display:flex;flex-direction:column;align-items:center;gap:.2rem;padding:.4rem .6rem;color:rgba(240,232,204,.5);text-decoration:none;font-size:.6rem;font-weight:600">
                <div style="width:26px;height:26px;background:rgba(46,138,153,.2);border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:.75rem;font-weight:900;color:#2e8a99">{{ substr(Auth::user()->name, 0, 1) }}</div>
                حسابي
            </a>
        @else
            <a href="{{ route('favorites.index') }}" style="display:flex;flex-direction:column;align-items:center;gap:.2rem;padding:.4rem .6rem;color:rgba(240,232,204,.5);text-decoration:none;font-size:.6rem;font-weight:600">
                <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                المفضلة
            </a>
            <a href="{{ route('register') }}" style="display:flex;flex-direction:column;align-items:center;gap:.2rem;padding:.4rem .6rem;color:rgba(240,232,204,.5);text-decoration:none;font-size:.6rem;font-weight:600">
                <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                حساب
            </a>
        @endauth
    </div>
</div>

<script>
    @auth
    setInterval(() => {
        fetch('/chat-unread-count').then(r => r.json()).then(data => {
            const badge = document.getElementById('chat-badge');
            if (badge) {
                badge.textContent = data.count;
                badge.style.display = data.count > 0 ? 'flex' : 'none';
            }
        }).catch(()=>{});
    }, 10000);
    @endauth

    function toggleUserMenu() {
        const dropdown = document.getElementById('user-menu-dropdown');
        const chevron  = document.getElementById('user-menu-chevron');
        const isOpen   = dropdown.style.display === 'block';
        dropdown.style.display = isOpen ? 'none' : 'block';
        chevron.style.transform = isOpen ? 'rotate(0deg)' : 'rotate(180deg)';
    }

    // Close when clicking outside
    document.addEventListener('click', function(e) {
        const btn      = document.getElementById('user-menu-btn');
        const dropdown = document.getElementById('user-menu-dropdown');
        if (btn && dropdown && !btn.contains(e.target) && !dropdown.contains(e.target)) {
            dropdown.style.display = 'none';
            const chevron = document.getElementById('user-menu-chevron');
            if (chevron) chevron.style.transform = 'rotate(0deg)';
        }
    });
</script>
