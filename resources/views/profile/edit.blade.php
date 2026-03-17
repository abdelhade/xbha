<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>الملف الشخصي - مزادي</title>
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Kufi+Arabic:wght@300;400;600;700;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body style="font-family:'Noto Kufi Arabic',sans-serif;background:#0f1e23;color:#f0e8cc;min-height:100vh">
    <x-navbar />

    <div style="max-width:1000px;margin:0 auto;padding:2rem 1rem">
        <!-- Profile Header -->
        <div style="background:rgba(26,46,53,.7);border:1px solid rgba(46,138,153,.15);border-radius:1.5rem;padding:2rem;margin-bottom:1.5rem">
            <div style="display:flex;flex-wrap:wrap;align-items:center;gap:2rem">
                <div style="position:relative;flex-shrink:0">
                    <div style="width:5rem;height:5rem;background:linear-gradient(135deg,#2e8a99,#3aa0b0);border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:2rem;font-weight:900;color:#fff">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <div style="position:absolute;bottom:0;right:0;width:1.25rem;height:1.25rem;background:#3aa0b0;border:2px solid #0f1e23;border-radius:50%"></div>
                </div>
                <div style="flex:1;min-width:200px">
                    <h2 style="font-size:1.5rem;font-weight:900;color:#f0e8cc;margin-bottom:.25rem">{{ Auth::user()->name }}</h2>
                    <p style="font-size:.875rem;color:rgba(240,232,204,.5);margin-bottom:.75rem">{{ Auth::user()->email }}</p>
                    <div style="display:flex;flex-wrap:wrap;gap:.5rem">
                        <span style="padding:.25rem .75rem;background:rgba(46,138,153,.15);color:#3aa0b0;border-radius:100px;font-size:.75rem;font-weight:700">عضو نشط</span>
                        <span style="padding:.25rem .75rem;background:rgba(46,138,153,.08);color:rgba(240,232,204,.5);border-radius:100px;font-size:.75rem">انضم {{ Auth::user()->created_at->format('Y/m/d') }}</span>
                    </div>
                </div>
                <div style="display:flex;gap:2rem;text-align:center">
                    <div>
                        <div style="font-size:1.5rem;font-weight:900;color:#f47c51">{{ Auth::user()->products()->count() }}</div>
                        <div style="font-size:.75rem;color:rgba(240,232,204,.45)">إعلان</div>
                    </div>
                    <div>
                        <div style="font-size:1.5rem;font-weight:900;color:#f47c51">{{ number_format(Auth::user()->products()->sum('views_count')) }}</div>
                        <div style="font-size:.75rem;color:rgba(240,232,204,.45)">مشاهدة</div>
                    </div>
                </div>
            </div>
        </div>

        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(300px,1fr));gap:1.5rem">
            <!-- Account Info -->
            <div style="background:rgba(26,46,53,.7);border:1px solid rgba(46,138,153,.15);border-radius:1.25rem;padding:1.5rem">
                <h3 style="font-size:1rem;font-weight:700;color:#f0e8cc;margin-bottom:1.25rem">معلومات الحساب</h3>
                <form method="post" action="{{ route('profile.update') }}">
                    @csrf @method('patch')
                    <div style="display:flex;flex-direction:column;gap:1rem">
                        <div>
                            <label style="display:block;font-size:.78rem;font-weight:600;color:rgba(240,232,204,.5);margin-bottom:.4rem">الاسم الكامل</label>
                            <input name="name" type="text" value="{{ old('name', $user->name) }}" required
                                style="width:100%;padding:.65rem 1rem;background:rgba(15,30,35,.6);border:1px solid rgba(46,138,153,.2);border-radius:.75rem;color:#f0e8cc;font-family:'Noto Kufi Arabic',sans-serif;font-size:.875rem;outline:none;box-sizing:border-box"
                                onfocus="this.style.borderColor='rgba(46,138,153,.5)'" onblur="this.style.borderColor='rgba(46,138,153,.2)'">
                            @error('name') <p style="margin-top:.35rem;font-size:.78rem;color:#f47c51">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label style="display:block;font-size:.78rem;font-weight:600;color:rgba(240,232,204,.5);margin-bottom:.4rem">البريد الإلكتروني</label>
                            <input name="email" type="email" value="{{ old('email', $user->email) }}" required
                                style="width:100%;padding:.65rem 1rem;background:rgba(15,30,35,.6);border:1px solid rgba(46,138,153,.2);border-radius:.75rem;color:#f0e8cc;font-family:'Noto Kufi Arabic',sans-serif;font-size:.875rem;outline:none;box-sizing:border-box"
                                onfocus="this.style.borderColor='rgba(46,138,153,.5)'" onblur="this.style.borderColor='rgba(46,138,153,.2)'">
                            @error('email') <p style="margin-top:.35rem;font-size:.78rem;color:#f47c51">{{ $message }}</p> @enderror
                        </div>
                        <button type="submit"
                            style="width:100%;padding:.7rem;background:#2e8a99;color:#fff;border:none;border-radius:.75rem;font-family:'Noto Kufi Arabic',sans-serif;font-size:.9rem;font-weight:700;cursor:pointer;transition:all .2s"
                            onmouseover="this.style.background='#1f6370'" onmouseout="this.style.background='#2e8a99'">
                            حفظ التغييرات
                        </button>
                        @if(session('status') === 'profile-updated')
                            <p style="font-size:.8rem;color:#3aa0b0;text-align:center">✓ تم حفظ التغييرات بنجاح</p>
                        @endif
                    </div>
                </form>
            </div>

            <!-- Password -->
            <div style="background:rgba(26,46,53,.7);border:1px solid rgba(46,138,153,.15);border-radius:1.25rem;padding:1.5rem">
                <h3 style="font-size:1rem;font-weight:700;color:#f0e8cc;margin-bottom:1.25rem">تغيير كلمة المرور</h3>
                <form method="post" action="{{ route('password.update') }}">
                    @csrf @method('put')
                    <div style="display:flex;flex-direction:column;gap:1rem">
                        <div>
                            <label style="display:block;font-size:.78rem;font-weight:600;color:rgba(240,232,204,.5);margin-bottom:.4rem">كلمة المرور الحالية</label>
                            <input name="current_password" type="password"
                                style="width:100%;padding:.65rem 1rem;background:rgba(15,30,35,.6);border:1px solid rgba(46,138,153,.2);border-radius:.75rem;color:#f0e8cc;font-family:'Noto Kufi Arabic',sans-serif;font-size:.875rem;outline:none;box-sizing:border-box"
                                onfocus="this.style.borderColor='rgba(46,138,153,.5)'" onblur="this.style.borderColor='rgba(46,138,153,.2)'">
                            @error('current_password', 'updatePassword') <p style="margin-top:.35rem;font-size:.78rem;color:#f47c51">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label style="display:block;font-size:.78rem;font-weight:600;color:rgba(240,232,204,.5);margin-bottom:.4rem">كلمة المرور الجديدة</label>
                            <input name="password" type="password"
                                style="width:100%;padding:.65rem 1rem;background:rgba(15,30,35,.6);border:1px solid rgba(46,138,153,.2);border-radius:.75rem;color:#f0e8cc;font-family:'Noto Kufi Arabic',sans-serif;font-size:.875rem;outline:none;box-sizing:border-box"
                                onfocus="this.style.borderColor='rgba(46,138,153,.5)'" onblur="this.style.borderColor='rgba(46,138,153,.2)'">
                            @error('password', 'updatePassword') <p style="margin-top:.35rem;font-size:.78rem;color:#f47c51">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label style="display:block;font-size:.78rem;font-weight:600;color:rgba(240,232,204,.5);margin-bottom:.4rem">تأكيد كلمة المرور</label>
                            <input name="password_confirmation" type="password"
                                style="width:100%;padding:.65rem 1rem;background:rgba(15,30,35,.6);border:1px solid rgba(46,138,153,.2);border-radius:.75rem;color:#f0e8cc;font-family:'Noto Kufi Arabic',sans-serif;font-size:.875rem;outline:none;box-sizing:border-box"
                                onfocus="this.style.borderColor='rgba(46,138,153,.5)'" onblur="this.style.borderColor='rgba(46,138,153,.2)'">
                        </div>
                        <button type="submit"
                            style="width:100%;padding:.7rem;background:#2e8a99;color:#fff;border:none;border-radius:.75rem;font-family:'Noto Kufi Arabic',sans-serif;font-size:.9rem;font-weight:700;cursor:pointer;transition:all .2s"
                            onmouseover="this.style.background='#1f6370'" onmouseout="this.style.background='#2e8a99'">
                            تحديث كلمة المرور
                        </button>
                        @if(session('status') === 'password-updated')
                            <p style="font-size:.8rem;color:#3aa0b0;text-align:center">✓ تم تحديث كلمة المرور بنجاح</p>
                        @endif
                    </div>
                </form>
            </div>
        </div>

        <!-- Danger Zone -->
        <div style="background:rgba(244,124,81,.04);border:1px solid rgba(244,124,81,.15);border-radius:1.25rem;padding:1.5rem;margin-top:1.5rem">
            <h3 style="font-size:1rem;font-weight:700;color:#f47c51;margin-bottom:.5rem">منطقة الخطر</h3>
            <p style="font-size:.85rem;color:rgba(240,232,204,.45);margin-bottom:1rem">حذف الحساب نهائياً لا يمكن التراجع عنه</p>
            <button onclick="document.getElementById('delete-modal').style.display='flex'"
                style="padding:.6rem 1.5rem;background:rgba(244,124,81,.1);border:1px solid rgba(244,124,81,.3);color:#f47c51;border-radius:.75rem;font-family:'Noto Kufi Arabic',sans-serif;font-size:.875rem;font-weight:700;cursor:pointer;transition:all .2s"
                onmouseover="this.style.background='rgba(244,124,81,.2)'" onmouseout="this.style.background='rgba(244,124,81,.1)'">
                حذف الحساب نهائياً
            </button>
        </div>

        <!-- Quick Actions -->
        <div style="display:flex;gap:.75rem;flex-wrap:wrap;margin-top:1.5rem">
            <a href="{{ route('dashboard') }}"
               style="padding:.65rem 1.5rem;background:#f47c51;color:#fff;border-radius:.75rem;font-weight:700;text-decoration:none;font-size:.875rem;transition:all .2s"
               onmouseover="this.style.background='#c95f3a'" onmouseout="this.style.background='#f47c51'">
                عرض إعلاناتي
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    style="padding:.65rem 1.5rem;background:transparent;border:1px solid rgba(240,232,204,.15);color:rgba(240,232,204,.5);border-radius:.75rem;font-family:'Noto Kufi Arabic',sans-serif;font-size:.875rem;font-weight:600;cursor:pointer;transition:all .2s"
                    onmouseover="this.style.borderColor='rgba(244,124,81,.3)';this.style.color='#f47c51'" onmouseout="this.style.borderColor='rgba(240,232,204,.15)';this.style.color='rgba(240,232,204,.5)'">
                    تسجيل الخروج
                </button>
            </form>
        </div>
    </div>

    <!-- Delete Modal -->
    <div id="delete-modal" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,.7);backdrop-filter:blur(8px);align-items:center;justify-content:center;z-index:1000;padding:1rem">
        <div style="background:#1a2e35;border:1px solid rgba(244,124,81,.25);border-radius:1.5rem;padding:2rem;max-width:420px;width:100%">
            <h3 style="font-size:1.1rem;font-weight:900;color:#f0e8cc;margin-bottom:.5rem">تأكيد حذف الحساب</h3>
            <p style="font-size:.85rem;color:rgba(240,232,204,.5);margin-bottom:1.5rem">هذا الإجراء لا يمكن التراجع عنه. أدخل كلمة المرور للتأكيد.</p>
            <form method="post" action="{{ route('profile.destroy') }}">
                @csrf @method('delete')
                <input type="password" name="password" placeholder="كلمة المرور" required
                    style="width:100%;padding:.65rem 1rem;background:rgba(15,30,35,.6);border:1px solid rgba(244,124,81,.3);border-radius:.75rem;color:#f0e8cc;font-family:'Noto Kufi Arabic',sans-serif;font-size:.875rem;outline:none;margin-bottom:1rem;box-sizing:border-box">
                <div style="display:flex;gap:.75rem">
                    <button type="submit"
                        style="flex:1;padding:.65rem;background:rgba(244,124,81,.15);border:1px solid rgba(244,124,81,.4);color:#f47c51;border-radius:.75rem;font-family:'Noto Kufi Arabic',sans-serif;font-weight:700;cursor:pointer">
                        حذف نهائي
                    </button>
                    <button type="button" onclick="document.getElementById('delete-modal').style.display='none'"
                        style="flex:1;padding:.65rem;background:rgba(46,138,153,.1);border:1px solid rgba(46,138,153,.2);color:#3aa0b0;border-radius:.75rem;font-family:'Noto Kufi Arabic',sans-serif;font-weight:700;cursor:pointer">
                        إلغاء
                    </button>
                </div>
            </form>
        </div>
    </div>

    @if($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
        <form id="send-verification" method="post" action="{{ route('verification.send') }}">@csrf</form>
    @endif
</body>
</html>
