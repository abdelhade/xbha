@hasrole('admin')
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>التصنيفات - مزادي</title>
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Kufi+Arabic:wght@300;400;600;700;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body style="font-family:'Noto Kufi Arabic',sans-serif;background:#0f1e23;color:#f0e8cc;min-height:100vh">
    <x-navbar />

    <div style="max-width:1100px;margin:0 auto;padding:2rem 1rem">
        <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:1rem;margin-bottom:2rem">
            <div>
                <h2 style="font-size:1.75rem;font-weight:900;color:#f0e8cc">التصنيفات</h2>
                <p style="font-size:.875rem;color:rgba(240,232,204,.45);margin-top:.25rem">إدارة تصنيفات المنتجات</p>
            </div>
            <a href="{{ route('categories.create') }}"
               style="display:inline-flex;align-items:center;gap:.5rem;padding:.65rem 1.25rem;background:#f47c51;color:#fff;border-radius:.75rem;font-weight:700;font-size:.875rem;text-decoration:none;transition:all .2s"
               onmouseover="this.style.background='#c95f3a'" onmouseout="this.style.background='#f47c51'">
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                إضافة تصنيف
            </a>
        </div>

        @if($categories->count() > 0)
            <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:1.25rem">
                @foreach($categories as $category)
                    <div style="background:rgba(26,46,53,.7);border:1px solid rgba(46,138,153,.15);border-radius:1.25rem;padding:1.25rem;transition:all .3s"
                         onmouseover="this.style.borderColor='rgba(46,138,153,.35)'" onmouseout="this.style.borderColor='rgba(46,138,153,.15)'">
                        <div style="display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:1rem">
                            <div style="display:flex;align-items:center;gap:.75rem">
                                @if($category->getFirstMediaUrl('icon'))
                                    <img src="{{ $category->getFirstMediaUrl('icon') }}" alt="{{ $category->name }}"
                                         style="width:2.75rem;height:2.75rem;border-radius:.65rem;object-fit:cover">
                                @else
                                    <div style="width:2.75rem;height:2.75rem;background:rgba(46,138,153,.15);border:1px solid rgba(46,138,153,.25);border-radius:.65rem;display:flex;align-items:center;justify-content:center">
                                        <svg width="18" height="18" fill="none" stroke="#2e8a99" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                                    </div>
                                @endif
                                <div>
                                    <h3 style="font-weight:700;color:#f0e8cc;margin-bottom:.15rem">{{ $category->name }}</h3>
                                    <p style="font-size:.78rem;color:rgba(240,232,204,.4)">{{ $category->products->count() }} منتج</p>
                                </div>
                            </div>
                            <div x-data="{ open: false }" style="position:relative">
                                <button @click="open = !open" style="padding:.35rem;color:rgba(240,232,204,.4);background:transparent;border:none;cursor:pointer;border-radius:.4rem"
                                    onmouseover="this.style.color='#f0e8cc'" onmouseout="this.style.color='rgba(240,232,204,.4)'">
                                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"/></svg>
                                </button>
                                <div x-show="open" @click.away="open=false" x-transition
                                     style="position:absolute;left:0;top:calc(100% + .25rem);min-width:160px;background:#1a2e35;border:1px solid rgba(46,138,153,.2);border-radius:.85rem;padding:.4rem;z-index:50;box-shadow:0 10px 30px rgba(0,0,0,.4)">
                                    <a href="{{ route('categories.show', $category) }}"
                                       style="display:flex;align-items:center;gap:.5rem;padding:.55rem .75rem;color:rgba(240,232,204,.7);text-decoration:none;border-radius:.5rem;font-size:.82rem;transition:background .2s"
                                       onmouseover="this.style.background='rgba(46,138,153,.1)'" onmouseout="this.style.background='transparent'">عرض المنتجات</a>
                                    <a href="{{ route('categories.edit', $category) }}"
                                       style="display:flex;align-items:center;gap:.5rem;padding:.55rem .75rem;color:rgba(240,232,204,.7);text-decoration:none;border-radius:.5rem;font-size:.82rem;transition:background .2s"
                                       onmouseover="this.style.background='rgba(46,138,153,.1)'" onmouseout="this.style.background='transparent'">تعديل</a>
                                    <form action="{{ route('categories.destroy', $category) }}" method="POST" onsubmit="return confirm('هل أنت متأكد؟')">
                                        @csrf @method('DELETE')
                                        <button type="submit" style="display:flex;align-items:center;gap:.5rem;width:100%;padding:.55rem .75rem;color:rgba(244,124,81,.7);background:transparent;border:none;border-radius:.5rem;font-family:'Noto Kufi Arabic',sans-serif;font-size:.82rem;cursor:pointer;transition:background .2s;text-align:right"
                                            onmouseover="this.style.background='rgba(244,124,81,.08)'" onmouseout="this.style.background='transparent'">حذف</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @if($category->description)
                            <p style="font-size:.82rem;color:rgba(240,232,204,.45);margin-bottom:.75rem;line-height:1.5">{{ Str::limit($category->description, 80) }}</p>
                        @endif
                        @if($category->children->count() > 0)
                            <div style="display:flex;flex-wrap:wrap;gap:.35rem;margin-bottom:.75rem">
                                @foreach($category->children as $child)
                                    <span style="padding:.2rem .6rem;background:rgba(46,138,153,.1);color:#3aa0b0;border-radius:100px;font-size:.72rem;font-weight:600">{{ $child->name }}</span>
                                @endforeach
                            </div>
                        @endif
                        <div style="border-top:1px solid rgba(46,138,153,.1);padding-top:.75rem">
                            <a href="{{ route('categories.show', $category) }}"
                               style="display:inline-flex;align-items:center;gap:.35rem;color:#2e8a99;font-size:.82rem;font-weight:600;text-decoration:none;transition:color .2s"
                               onmouseover="this.style.color='#3aa0b0'" onmouseout="this.style.color='#2e8a99'">
                                عرض المنتجات
                                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div style="text-align:center;background:rgba(46,138,153,.04);border:1px solid rgba(46,138,153,.1);border-radius:1.5rem;padding:4rem 2rem">
                <svg style="width:5rem;height:5rem;margin:0 auto 1rem;color:rgba(46,138,153,.25)" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                </svg>
                <h3 style="font-size:1.25rem;font-weight:900;color:#f0e8cc;margin-bottom:.5rem">لا توجد تصنيفات</h3>
                <p style="color:rgba(240,232,204,.45);margin-bottom:1.5rem">ابدأ بإضافة تصنيف جديد</p>
                <a href="{{ route('categories.create') }}" style="display:inline-block;padding:.75rem 2rem;background:#f47c51;color:#fff;border-radius:100px;font-weight:700;text-decoration:none">إضافة تصنيف</a>
            </div>
        @endif
    </div>
</body>
</html>
@endhasrole
