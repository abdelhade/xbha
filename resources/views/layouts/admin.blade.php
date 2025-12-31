<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>مزادي - Admin</title>
<link rel="icon" href="/favicon.ico" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.12.0/dist/cdn.min.js"></script>

    <style>
        body {
            font-family: 'Tajawal', sans-serif;
            background-color: #f3f4f6;
            /* Light gray background */
            color: #1f2937;
            /* Dark text */
        }

        .sidebar {
            background-color: #111025;
            /* Dark sidebar */
            color: #fff;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            padding: 0.75rem 1rem;
            margin-bottom: 0.5rem;
            border-radius: 0.5rem;
            color: #d1d5db;
            transition: all 0.2s;
        }

        .sidebar-link:hover,
        .sidebar-link.active {
            background: rgba(124, 58, 237, 0.1);
            /* Purple tint */
            color: #a78bfa;
            /* Light purple */
        }

        .glass-panel {
            background: white;
            box-shadow: 0 1px 3px 0 rgb(0 0 0 / 0.1), 0 1px 2px -1px rgb(0 0 0 / 0.1);
            border: 1px solid #e5e7eb;
            border-radius: 1rem;
        }
    </style>
</head>

<body class="antialiased selection:bg-purple-600 selection:text-white">
    <div x-data="{ sidebarOpen: false }" class="min-h-screen flex">

        <!-- Mobile Sidebar Overlay -->
        <div x-show="sidebarOpen" @click="sidebarOpen = false" class="fixed inset-0 z-40 bg-black/50 lg:hidden"></div>

        <!-- Sidebar -->
        <aside :class="sidebarOpen ? 'translate-x-0' : 'translate-x-full lg:translate-x-0'"
            class="sidebar fixed inset-y-0 right-0 z-50 w-64 border-l border-white/5 transition-transform duration-300 lg:static lg:block">
            <div class="h-full flex flex-col p-6">
                <div class="flex items-center gap-3 mb-10">
                    <div
                        class="w-10 h-10 bg-gradient-to-br from-purple-600 to-indigo-600 rounded-lg flex items-center justify-center shadow-lg shadow-purple-900/50">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="font-bold text-xl tracking-wide text-white">لوحة التحكم</h1>
                        <p class="text-xs text-gray-400">إدارة الموقع</p>
                    </div>
                </div>

                <nav class="flex-1 space-y-2">
                    <a href="{{ route('admin.dashboard') }}"
                        class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <svg class="w-5 h-5 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                            </path>
                        </svg>
                        الرئيسية
                    </a>
                    <a href="{{ route('admin.products.approvals') }}"
                        class="sidebar-link {{ request()->routeIs('admin.products.approvals') ? 'active' : '' }}">
                        <svg class="w-5 h-5 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        الموافقات
                    </a>
                    <a href="{{ route('admin.products.index') }}"
                        class="sidebar-link {{ request()->routeIs('admin.products.index') ? 'active' : '' }}">
                        <svg class="w-5 h-5 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                        المنتجات
                    </a>
                    <a href="{{ route('admin.users.index') }}"
                        class="sidebar-link {{ request()->routeIs('admin.users.index') ? 'active' : '' }}">
                        <svg class="w-5 h-5 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                            </path>
                        </svg>
                        المستخدمين
                    </a>
                    <a href="{{ route('admin.orders.index') }}"
                        class="sidebar-link {{ request()->routeIs('admin.orders.index') ? 'active' : '' }}">
                        <svg class="w-5 h-5 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                        الطلبات
                    </a>
                    <a href="{{ route('admin.settings') }}"
                        class="sidebar-link {{ request()->routeIs('admin.settings') ? 'active' : '' }}">
                        <svg class="w-5 h-5 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                            </path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        الإعدادات
                    </a>
                </nav>

                <div class="mt-auto pt-6 border-t border-white/5">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="w-full flex items-center p-2 text-red-400 hover:text-red-300 transition text-sm">
                            <svg class="w-5 h-5 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                </path>
                            </svg>
                            تسجيل الخروج
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 flex flex-col h-screen overflow-hidden">
            <!-- Topbar -->
            <header
                class="h-16 flex items-center justify-between px-6 lg:px-10 border-b border-gray-200 bg-white/80 backdrop-blur-md z-30">
                <button @click="sidebarOpen = true" class="lg:hidden p-2 text-gray-400 hover:text-gray-900">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
                <div class="hidden lg:block">
                    <span class="text-sm text-gray-500">مرحباً بك،</span> <span
                        class="font-bold text-gray-900">{{ Auth::user()->name ?? 'Admin' }}</span>
                </div>
                <div class="flex items-center gap-4">
                    <a href="/" target="_blank"
                        class="text-sm text-purple-600 hover:text-purple-700 flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                        </svg>
                        زيارة الموقع
                    </a>
                    <!-- Avatar -->
                    <div
                        class="w-8 h-8 rounded-full bg-purple-600 flex items-center justify-center text-xs font-bold ring-2 ring-purple-100 text-white">
                        {{ substr(Auth::user()->name ?? 'A', 0, 1) }}
                    </div>
                </div>
            </header>

            <!-- Content Scroll Area -->
            <div class="flex-1 overflow-y-auto p-6 lg:p-10 text-gray-800">
                {{ $slot }}
            </div>
        </main>
    </div>
</body>

</html>
