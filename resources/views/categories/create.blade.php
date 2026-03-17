@hasrole('admin')
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>إضافة تصنيف جديد - مزادي</title>
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Kufi+Arabic:wght@300;400;600;700;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body style="font-family:'Noto Kufi Arabic',sans-serif;background:#0f1e23;color:#f0e8cc;min-height:100vh">
    <x-navbar />

    <div style="max-width:700px;margin:0 auto;padding:2rem 1rem">
        <div style="margin-bottom:2rem">
            <h2 style="font-size:1.75rem;font-weight:900;color:#f0e8cc">إضافة تصنيف جديد</h2>
        </div>

        <div style="background:rgba(26,46,53,.7);border:1px solid rgba(46,138,153,.15);border-radius:1.25rem;padding:1.5rem">
            <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div style="display:flex;flex-direction:column;gap:1rem">
                    <div>
                        <label style="display:block;font-size:.78rem;font-weight:600;color:rgba(240,232,204,.5);margin-bottom:.4rem">اسم التصنيف *</label>
                        <input type="text" name="name" value="{{ old('name') }}" required placeholder="أدخل اسم التصنيف"
                            style="width:100%;padding:.65rem 1rem;background:rgba(15,30,35,.6);border:1px solid rgba(46,138,153,.2);border-radius:.75rem;color:#f0e8cc;font-family:'Noto Kufi Arabic',sans-serif;font-size:.875rem;outline:none;box-sizing:border-box"
                            onfocus="this.style.borderColor='rgba(46,138,153,.5)'" onblur="this.style.borderColor='rgba(46,138,153,.2)'">
                        @error('name') <p style="margin-top:.35rem;font-size:.78rem;color:#f47c51">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label style="display:block;font-size:.78rem;font-weight:600;color:rgba(240,232,204,.5);margin-bottom:.4rem">التصنيف الأب (اختياري)</label>
                        <select name="parent_id"
                            style="width:100%;padding:.65rem 1rem;background:rgba(15,30,35,.6);border:1px solid rgba(46,138,153,.2);border-radius:.75rem;color:#f0e8cc;font-family:'Noto Kufi Arabic',sans-serif;font-size:.875rem;outline:none">
                            <option value="">بدون تصنيف أب</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('parent_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label style="display:block;font-size:.78rem;font-weight:600;color:rgba(240,232,204,.5);margin-bottom:.4rem">الوصف</label>
                        <textarea name="description" rows="4" placeholder="أدخل وصف التصنيف"
                            style="width:100%;padding:.65rem 1rem;background:rgba(15,30,35,.6);border:1px solid rgba(46,138,153,.2);border-radius:.75rem;color:#f0e8cc;font-family:'Noto Kufi Arabic',sans-serif;font-size:.875rem;outline:none;resize:vertical;box-sizing:border-box"
                            onfocus="this.style.borderColor='rgba(46,138,153,.5)'" onblur="this.style.borderColor='rgba(46,138,153,.2)'">{{ old('description') }}</textarea>
                    </div>
                    <div>
                        <label style="display:block;font-size:.78rem;font-weight:600;color:rgba(240,232,204,.5);margin-bottom:.4rem">ترتيب العرض</label>
                        <input type="number" name="order" value="{{ old('order', 0) }}" min="0"
                            style="width:100%;padding:.65rem 1rem;background:rgba(15,30,35,.6);border:1px solid rgba(46,138,153,.2);border-radius:.75rem;color:#f0e8cc;font-family:'Noto Kufi Arabic',sans-serif;font-size:.875rem;outline:none;box-sizing:border-box"
                            onfocus="this.style.borderColor='rgba(46,138,153,.5)'" onblur="this.style.borderColor='rgba(46,138,153,.2)'">
                        <p style="margin-top:.3rem;font-size:.75rem;color:rgba(240,232,204,.35)">الأرقام الأقل تظهر أولاً</p>
                    </div>
                    <div>
                        <label style="display:block;font-size:.78rem;font-weight:600;color:rgba(240,232,204,.5);margin-bottom:.4rem">أيقونة التصنيف</label>
                        <input type="file" name="icon" accept="image/*"
                            style="width:100%;padding:.65rem 1rem;background:rgba(15,30,35,.6);border:1px solid rgba(46,138,153,.2);border-radius:.75rem;color:rgba(240,232,204,.6);font-family:'Noto Kufi Arabic',sans-serif;font-size:.875rem;outline:none;box-sizing:border-box">
                        @error('icon') <p style="margin-top:.35rem;font-size:.78rem;color:#f47c51">{{ $message }}</p> @enderror
                    </div>
                    <div style="display:flex;gap:.75rem;flex-wrap:wrap;padding-top:.5rem">
                        <button type="submit"
                            style="flex:1;min-width:140px;padding:.75rem;background:#f47c51;color:#fff;border:none;border-radius:.75rem;font-family:'Noto Kufi Arabic',sans-serif;font-size:.9rem;font-weight:700;cursor:pointer;transition:all .2s"
                            onmouseover="this.style.background='#c95f3a'" onmouseout="this.style.background='#f47c51'">
                            إضافة التصنيف
                        </button>
                        <a href="{{ route('categories.index') }}"
                            style="flex:1;min-width:140px;padding:.75rem;background:transparent;border:1px solid rgba(240,232,204,.15);color:rgba(240,232,204,.5);border-radius:.75rem;font-size:.9rem;font-weight:600;text-decoration:none;text-align:center;transition:all .2s"
                            onmouseover="this.style.borderColor='rgba(240,232,204,.3)'" onmouseout="this.style.borderColor='rgba(240,232,204,.15)'">
                            إلغاء
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
@endhasrole
