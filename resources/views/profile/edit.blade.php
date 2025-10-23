<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>الملف الشخصي - إكسابها</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <style>
        body { font-family: 'Tajawal', sans-serif; }
        .gradient-bg {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 50%, #cbd5e1 100%);
            position: relative;
        }
        .gradient-bg::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: 
                radial-gradient(circle at 30% 20%, rgba(139, 92, 246, 0.05) 0%, transparent 50%),
                radial-gradient(circle at 70% 80%, rgba(59, 130, 246, 0.05) 0%, transparent 50%);
        }
        .elegant-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.5);
        }
    </style>
</head>
<body class="gradient-bg min-h-screen" dir="rtl">
    
    <!-- Header -->
    <header class="bg-white/80 backdrop-blur-lg shadow-sm border-b border-white/20">
        <div class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-indigo-600 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold text-gray-900">إكسابها</h1>
                        <p class="text-xs text-gray-500">الملف الشخصي</p>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <a href="{{ route('dashboard') }}" class="px-4 py-2 text-gray-700 hover:text-purple-600 transition">
                        إعلاناتي
                    </a>
                    <a href="/" class="px-4 py-2 text-gray-700 hover:text-purple-600 transition">
                        الرئيسية
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-12 relative z-10">
        <div class="max-w-4xl mx-auto">
            <!-- Profile Header -->
            <div class="elegant-card rounded-3xl shadow-2xl p-8 mb-8">
                <div class="flex flex-col md:flex-row items-center gap-8">
                    <!-- Avatar -->
                    <div class="relative">
                        <div class="w-32 h-32 bg-gradient-to-br from-purple-500 to-indigo-600 rounded-full flex items-center justify-center shadow-2xl">
                            <span class="text-4xl font-bold text-white">{{ substr(Auth::user()->name, 0, 1) }}</span>
                        </div>
                        <div class="absolute -bottom-2 -right-2 w-8 h-8 bg-green-500 rounded-full border-4 border-white flex items-center justify-center">
                            <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    </div>

                    <!-- Profile Info -->
                    <div class="flex-1 text-center md:text-right">
                        <h2 class="text-3xl font-bold text-gray-900 mb-2">{{ Auth::user()->name }}</h2>
                        <p class="text-lg text-gray-600 mb-4">{{ Auth::user()->email }}</p>
                        <div class="flex flex-wrap gap-3 justify-center md:justify-start">
                            <span class="px-4 py-2 bg-green-100 text-green-800 rounded-full text-sm font-medium">
                                عضو نشط
                            </span>
                            <span class="px-4 py-2 bg-blue-100 text-blue-800 rounded-full text-sm font-medium">
                                انضم في {{ Auth::user()->created_at->format('Y/m/d') }}
                            </span>
                        </div>
                    </div>

                    <!-- Quick Stats -->
                    <div class="grid grid-cols-3 gap-6 text-center">
                        <div>
                            <div class="text-2xl font-bold text-purple-600">12</div>
                            <div class="text-sm text-gray-600">إعلان</div>
                        </div>
                        <div>
                            <div class="text-2xl font-bold text-blue-600">1.2K</div>
                            <div class="text-sm text-gray-600">مشاهدة</div>
                        </div>
                        <div>
                            <div class="text-2xl font-bold text-green-600">8</div>
                            <div class="text-sm text-gray-600">مبيعة</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Profile Settings -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Account Information -->
                <div class="elegant-card rounded-3xl shadow-xl p-8">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900">معلومات الحساب</h3>
                            <p class="text-gray-600 text-sm">تحديث بياناتك الشخصية</p>
                        </div>
                    </div>

                    <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
                        @csrf
                        @method('patch')

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">الاسم الكامل</label>
                            <input name="name" 
                                   type="text" 
                                   value="{{ old('name', $user->name) }}" 
                                   required
                                   class="w-full px-4 py-3 bg-white/70 border border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all">
                            @error('name')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">البريد الإلكتروني</label>
                            <input name="email" 
                                   type="email" 
                                   value="{{ old('email', $user->email) }}" 
                                   required
                                   class="w-full px-4 py-3 bg-white/70 border border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all">
                            @error('email')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit" class="w-full py-3 bg-gradient-to-r from-purple-600 to-indigo-600 text-white rounded-xl font-semibold hover:from-purple-700 hover:to-indigo-700 transition-all shadow-lg">
                            حفظ التغييرات
                        </button>

                        @if (session('status') === 'profile-updated')
                            <div class="p-4 bg-green-50 border border-green-200 rounded-xl">
                                <p class="text-green-800 text-sm font-medium">✓ تم حفظ التغييرات بنجاح</p>
                            </div>
                        @endif
                    </form>
                </div>

                <!-- Security Settings -->
                <div class="elegant-card rounded-3xl shadow-xl p-8">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900">الأمان</h3>
                            <p class="text-gray-600 text-sm">تغيير كلمة المرور</p>
                        </div>
                    </div>

                    <form method="post" action="{{ route('password.update') }}" class="space-y-6">
                        @csrf
                        @method('put')

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">كلمة المرور الحالية</label>
                            <input name="current_password" 
                                   type="password"
                                   class="w-full px-4 py-3 bg-white/70 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                            @error('current_password', 'updatePassword')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">كلمة المرور الجديدة</label>
                            <input name="password" 
                                   type="password"
                                   class="w-full px-4 py-3 bg-white/70 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                            @error('password', 'updatePassword')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">تأكيد كلمة المرور</label>
                            <input name="password_confirmation" 
                                   type="password"
                                   class="w-full px-4 py-3 bg-white/70 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                        </div>

                        <button type="submit" class="w-full py-3 bg-gradient-to-r from-blue-600 to-cyan-600 text-white rounded-xl font-semibold hover:from-blue-700 hover:to-cyan-700 transition-all shadow-lg">
                            تحديث كلمة المرور
                        </button>

                        @if (session('status') === 'password-updated')
                            <div class="p-4 bg-green-50 border border-green-200 rounded-xl">
                                <p class="text-green-800 text-sm font-medium">✓ تم تحديث كلمة المرور بنجاح</p>
                            </div>
                        @endif
                    </form>
                </div>
            </div>

            <!-- Danger Zone -->
            <div class="elegant-card rounded-3xl shadow-xl p-8 mt-8 border-red-200">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-red-900">منطقة الخطر</h3>
                        <p class="text-red-600 text-sm">حذف الحساب نهائياً</p>
                    </div>
                </div>

                <div class="bg-red-50 border border-red-200 rounded-xl p-4 mb-6">
                    <p class="text-red-800 text-sm">
                        ⚠️ تحذير: حذف الحساب سيؤدي إلى فقدان جميع بياناتك وإعلاناتك نهائياً ولا يمكن التراجع عن هذا الإجراء.
                    </p>
                </div>

                <button onclick="document.getElementById('delete-modal').classList.remove('hidden')"
                        class="px-6 py-3 bg-red-600 text-white rounded-xl font-semibold hover:bg-red-700 transition-all shadow-lg">
                    حذف الحساب نهائياً
                </button>
            </div>

            <!-- Quick Actions -->
            <div class="flex justify-center gap-4 mt-8">
                <a href="{{ route('dashboard') }}" class="px-8 py-3 bg-gradient-to-r from-purple-600 to-indigo-600 text-white rounded-xl font-semibold hover:from-purple-700 hover:to-indigo-700 transition-all shadow-lg">
                    عرض إعلاناتي
                </a>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="px-8 py-3 bg-gray-600 text-white rounded-xl font-semibold hover:bg-gray-700 transition-all shadow-lg">
                        تسجيل الخروج
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Modal -->
    <div id="delete-modal" class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center z-50 p-4">
        <div class="bg-white rounded-3xl shadow-2xl max-w-md w-full p-8">
            <div class="text-center mb-6">
                <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">تأكيد حذف الحساب</h3>
                <p class="text-gray-600">هذا الإجراء لا يمكن التراجع عنه. أدخل كلمة المرور للتأكيد.</p>
            </div>

            <form method="post" action="{{ route('profile.destroy') }}">
                @csrf
                @method('delete')
                
                <input type="password" 
                       name="password" 
                       placeholder="كلمة المرور"
                       required
                       class="w-full px-4 py-3 border border-gray-300 rounded-xl mb-6 focus:ring-2 focus:ring-red-500 focus:border-red-500">
                
                <div class="flex gap-3">
                    <button type="submit" class="flex-1 py-3 bg-red-600 text-white rounded-xl font-semibold hover:bg-red-700 transition">
                        حذف نهائي
                    </button>
                    <button type="button" 
                            onclick="document.getElementById('delete-modal').classList.add('hidden')"
                            class="flex-1 py-3 bg-gray-300 text-gray-700 rounded-xl font-semibold hover:bg-gray-400 transition">
                        إلغاء
                    </button>
                </div>
            </form>
        </div>
    </div>

    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
        <form id="send-verification" method="post" action="{{ route('verification.send') }}">
            @csrf
        </form>
    @endif

</body>
</html>