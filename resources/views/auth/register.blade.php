<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>إنشاء حساب - مزادي</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Kufi+Arabic:wght@300;400;600;700;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        *{box-sizing:border-box}
        body{font-family:'Noto Kufi Arabic',sans-serif;background:#0f1e23;color:#f0e8cc;min-height:100vh;display:flex;align-items:center;justify-content:center;padding:1.5rem;position:relative;overflow-x:hidden}
        body::before{content:'';position:fixed;inset:0;background:radial-gradient(ellipse at 30% 20%,rgba(46,138,153,.12) 0%,transparent 60%),radial-gradient(ellipse at 70% 80%,rgba(244,124,81,.06) 0%,transparent 60%);pointer-events:none}
        .auth-card{background:rgba(26,46,53,.8);backdrop-filter:blur(20px);border:1px solid rgba(46,138,153,.2);border-radius:1.5rem;padding:2.5rem;width:100%;max-width:440px;position:relative;z-index:1}
        .auth-logo{width:56px;height:56px;background:rgba(46,138,153,.15);border:1px solid rgba(46,138,153,.3);border-radius:1rem;display:flex;align-items:center;justify-content:center;margin:0 auto 1.5rem;font-size:1.5rem;font-weight:900;color:#2e8a99}
        .auth-title{font-size:1.5rem;font-weight:900;text-align:center;margin-bottom:.5rem;color:#f0e8cc}
        .auth-sub{font-size:.875rem;text-align:center;color:rgba(240,232,204,.5);margin-bottom:2rem}
        .form-label{display:block;font-size:.8rem;font-weight:600;color:rgba(240,232,204,.7);margin-bottom:.5rem;letter-spacing:.03em}
        .form-input{width:100%;padding:.75rem 1rem;background:rgba(15,30,35,.6);border:1px solid rgba(46,138,153,.2);border-radius:.75rem;color:#f0e8cc;font-family:'Noto Kufi Arabic',sans-serif;font-size:.9rem;transition:all .3s;outline:none}
        .form-input::placeholder{color:rgba(240,232,204,.3)}
        .form-input:focus{border-color:rgba(46,138,153,.6);background:rgba(15,30,35,.8);box-shadow:0 0 0 3px rgba(46,138,153,.1)}
        .form-error{font-size:.78rem;color:#f47c51;margin-top:.35rem}
        .btn-primary{width:100%;padding:.85rem;background:#f47c51;color:#fff;border:none;border-radius:.75rem;font-family:'Noto Kufi Arabic',sans-serif;font-size:.95rem;font-weight:700;cursor:pointer;transition:all .3s}
        .btn-primary:hover{background:#c95f3a;transform:translateY(-1px)}
        .auth-link{color:#2e8a99;text-decoration:none;font-weight:600;transition:color .2s}
        .auth-link:hover{color:#3aa0b0}
        .divider{border:none;border-top:1px solid rgba(46,138,153,.15);margin:1.5rem 0}
        .checkbox-wrap{display:flex;align-items:flex-start;gap:.5rem;font-size:.82rem;color:rgba(240,232,204,.6);cursor:pointer}
        .checkbox-wrap input[type=checkbox]{width:16px;height:16px;accent-color:#2e8a99;margin-top:2px;flex-shrink:0}
        .back-link{display:flex;align-items:center;justify-content:center;gap:.4rem;color:rgba(240,232,204,.4);font-size:.82rem;text-decoration:none;margin-top:1.5rem;transition:color .2s}
        .back-link:hover{color:rgba(240,232,204,.7)}
    </style>
</head>
<body>
    <div style="position:relative;z-index:1;width:100%;max-width:440px">
        <div class="auth-card">
            <div class="auth-logo">م</div>
            <h1 class="auth-title">إنشاء حساب جديد</h1>
            <p class="auth-sub">انضم إلى مزادي وابدأ رحلتك</p>

            <form method="POST" action="{{ route('register') }}" style="display:flex;flex-direction:column;gap:1.25rem">
                @csrf
                <div>
                    <label for="name" class="form-label">الاسم الكامل</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" class="form-input" placeholder="أدخل اسمك الكامل">
                    @error('name')<p class="form-error">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="email" class="form-label">البريد الإلكتروني</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" class="form-input" placeholder="example@email.com">
                    @error('email')<p class="form-error">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="password" class="form-label">كلمة المرور</label>
                    <input id="password" type="password" name="password" required autocomplete="new-password" class="form-input" placeholder="أدخل كلمة مرور قوية">
                    @error('password')<p class="form-error">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="password_confirmation" class="form-label">تأكيد كلمة المرور</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" class="form-input" placeholder="أعد إدخال كلمة المرور">
                    @error('password_confirmation')<p class="form-error">{{ $message }}</p>@enderror
                </div>
                <label class="checkbox-wrap">
                    <input type="checkbox" id="terms" name="terms" required>
                    <span>أوافق على <a href="{{ route('terms') }}" target="_blank" class="auth-link">الشروط والأحكام</a></span>
                </label>
                <button type="submit" class="btn-primary">إنشاء حساب جديد</button>
                <hr class="divider">
                <p style="text-align:center;font-size:.85rem;color:rgba(240,232,204,.5)">
                    لديك حساب بالفعل؟ <a href="{{ route('login') }}" class="auth-link">سجل دخول</a>
                </p>
            </form>
        </div>
        <a href="/" class="back-link">
            <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            العودة للرئيسية
        </a>
    </div>
</body>
</html>
