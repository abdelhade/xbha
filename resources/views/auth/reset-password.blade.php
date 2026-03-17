<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>إعادة تعيين كلمة المرور - مزادي</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Kufi+Arabic:wght@300;400;600;700;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        *{box-sizing:border-box}
        body{font-family:'Noto Kufi Arabic',sans-serif;background:#0f1e23;color:#f0e8cc;min-height:100vh;display:flex;align-items:center;justify-content:center;padding:1rem}
        body::before{content:'';position:fixed;inset:0;background:radial-gradient(ellipse at 30% 20%,rgba(46,138,153,.12) 0%,transparent 60%);pointer-events:none}
        .auth-card{background:rgba(26,46,53,.8);backdrop-filter:blur(20px);border:1px solid rgba(46,138,153,.2);border-radius:1.5rem;padding:2.5rem;width:100%;max-width:420px;position:relative;z-index:1}
        .auth-logo{width:56px;height:56px;background:rgba(46,138,153,.15);border:1px solid rgba(46,138,153,.3);border-radius:1rem;display:flex;align-items:center;justify-content:center;margin:0 auto 1.5rem;font-size:1.5rem;font-weight:900;color:#2e8a99}
        .auth-title{font-size:1.5rem;font-weight:900;text-align:center;margin-bottom:.5rem}
        .auth-sub{font-size:.875rem;text-align:center;color:rgba(240,232,204,.5);margin-bottom:2rem}
        .form-label{display:block;font-size:.8rem;font-weight:600;color:rgba(240,232,204,.7);margin-bottom:.5rem}
        .form-input{width:100%;padding:.75rem 1rem;background:rgba(15,30,35,.6);border:1px solid rgba(46,138,153,.2);border-radius:.75rem;color:#f0e8cc;font-family:'Noto Kufi Arabic',sans-serif;font-size:.9rem;transition:all .3s;outline:none}
        .form-input::placeholder{color:rgba(240,232,204,.3)}
        .form-input:focus{border-color:rgba(46,138,153,.6);box-shadow:0 0 0 3px rgba(46,138,153,.1)}
        .form-error{font-size:.78rem;color:#f47c51;margin-top:.35rem}
        .btn-primary{width:100%;padding:.85rem;background:#f47c51;color:#fff;border:none;border-radius:.75rem;font-family:'Noto Kufi Arabic',sans-serif;font-size:.95rem;font-weight:700;cursor:pointer;transition:all .3s}
        .btn-primary:hover{background:#c95f3a;transform:translateY(-1px)}
    </style>
</head>
<body>
    <div style="position:relative;z-index:1;width:100%;max-width:420px">
        <div class="auth-card">
            <div class="auth-logo">🔒</div>
            <h1 class="auth-title">إعادة تعيين كلمة المرور</h1>
            <p class="auth-sub">أدخل كلمة المرور الجديدة</p>

            <form method="POST" action="{{ route('password.store') }}" style="display:flex;flex-direction:column;gap:1.25rem">
                @csrf
                <input type="hidden" name="token" value="{{ $request->route('token') }}">
                <div>
                    <label for="email" class="form-label">البريد الإلكتروني</label>
                    <input id="email" type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus autocomplete="username" class="form-input">
                    @error('email')<p class="form-error">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="password" class="form-label">كلمة المرور الجديدة</label>
                    <input id="password" type="password" name="password" required autocomplete="new-password" class="form-input" placeholder="أدخل كلمة مرور قوية">
                    @error('password')<p class="form-error">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="password_confirmation" class="form-label">تأكيد كلمة المرور</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" class="form-input" placeholder="أعد إدخال كلمة المرور">
                    @error('password_confirmation')<p class="form-error">{{ $message }}</p>@enderror
                </div>
                <button type="submit" class="btn-primary">تعيين كلمة المرور</button>
            </form>
        </div>
    </div>
</body>
</html>
