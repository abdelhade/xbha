@hasrole('admin')
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $category->name }} - مزادي</title>
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Kufi+Arabic:wght@300;400;600;700;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body style="font-family:'Noto Kufi Arabic',sans-serif;background:#0f1e23;color:#f0e8cc;min-height:100vh">
    <x-navbar />
    <div style="max-width:1200px;margin:0 auto;padding:2rem 1.5rem 1rem">
        <div style="display:flex;align-items:center;gap:1rem;margin-bottom:1.5rem">
            @if($category->getFirstMediaUrl('icon'))
                <img src="{{ $category->getFirstMediaUrl('icon') }}" alt="{{ $category->name }}"
                    style="width:3.5rem;height:3.5rem;object-fit:cover;border-radius:.75rem;border:1px solid rgba(46,138,153,.2)">
            @else
                <div style="width:3.5rem;height:3.5rem;background:rgba(46,138,153,.15);border:1px solid rgba(46,138,153,.2);border-radius:.75rem;display:flex;align-items:center;justify-content:center">
                    <svg style="width:1.75rem;height:1.75rem;color:#2e8a99" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                    </svg>
                </div>
            @endif
            <div>
                <h1 style="font-size:1.75rem;font-weight:900;color:#f0e8cc">{{ $category->name }}</h1>
                @if($category->description)
                    <p style="font-size:.875rem;color:rgba(240,232,204,.5);margin-top:.2rem">{{ $category->description }}</p>
                @endif
            </div>
        </div>
        <nav style="display:flex;align-items:center;gap:.5rem;font-size:.82rem;color:rgba(240,232,204,.4);margin-bottom:1.5rem">
            <a href="{{ route('products.index') }}" style="color:rgba(240,232,204,.4);text-decoration:none">المنتجات</a>
            <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <span style="color:rgba(240,232,204,.7)">{{ $category->name }}</span>
        </nav>
        <p style="font-size:.875rem;color:rgba(240,232,204,.45);margin-bottom:1.5rem">{{ $products->count() }} منتج في هذا التصنيف</p>
    </div>
    <div style="max-width:1200px;margin:0 auto;padding:0 1.5rem 3rem">
        @if($products->count() > 0)
            <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(240px,1fr));gap:1.25rem">
                @foreach($products as $product)
                    <div style="background:rgba(26,46,53,.5);border:1px solid rgba(46,138,153,.12);border-radius:1rem;overflow:hidden;transition:all .3s"
                         onmouseover="this.style.borderColor='rgba(46,138,153,.35)';this.style.transform='translateY(-3px)'"
                         onmouseout="this.style.borderColor='rgba(46,138,153,.12)';this.style.transform='translateY(0)'">
                        <div style="position:relative;aspect-ratio:4/3;background:rgba(46,138,153,.08)">
                            @if($product->getFirstMediaUrl('images'))
                                <img src="{{ $product->getFirstMediaUrl('images') }}" alt="{{ $product->title }}" style="width:100%;height:100%;object-fit:cover">
                            @else
                                <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;color:rgba(46,138,153,.3)">
                                    <svg width="48" height="48" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                </div>
                            @endif
                            <div style="position:absolute;top:.75rem;left:.75rem;background:rgba(15,30,35,.8);border-radius:.5rem;padding:.2rem .6rem">
                                <span style="font-size:.85rem;font-weight:700;color:#f47c51">{{ number_format($product->price) }} ج.م</span>
                            </div>
                            <div style="position:absolute;top:.75rem;right:.75rem">
                                @if($product->status)
                                    <span style="background:rgba(46,138,153,.2);color:#3aa0b0;padding:.2rem .6rem;border-radius:100px;font-size:.72rem;font-weight:700">متاح</span>
                                @else
                                    <span style="background:rgba(244,124,81,.15);color:#f47c51;padding:.2rem .6rem;border-radius:100px;font-size:.72rem;font-weight:700">غير متاح</span>
                                @endif
                            </div>
                        </div>
                        <div style="padding:1rem">
                            <h3 style="font-weight:700;font-size:.9rem;color:#f0e8cc;margin-bottom:.35rem">{{ $product->title }}</h3>
                            <div style="display:flex;align-items:center;justify-content:space-between;font-size:.75rem;color:rgba(240,232,204,.35);margin-bottom:.75rem">
                                <span>{{ $product->views_count ?? 0 }} مشاهدة</span>
                                <span>{{ $product->created_at->diffForHumans() }}</span>
                            </div>
                            <a href="{{ route('products.show', $product) }}"
                                style="display:block;text-align:center;padding:.6rem;background:#2e8a99;color:#fff;border-radius:.75rem;font-size:.875rem;font-weight:700;text-decoration:none">
                                عرض التفاصيل
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
            @if($products->hasPages())
                <div style="margin-top:2rem;display:flex;justify-content:center">{{ $products->links() }}</div>
            @endif
        @else
            <div style="text-align:center;background:rgba(46,138,153,.04);border:1px solid rgba(46,138,153,.1);border-radius:1.5rem;padding:4rem 2rem">
                <svg style="width:5rem;height:5rem;margin:0 auto 1rem;color:rgba(46,138,153,.2)" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                <h3 style="font-size:1.25rem;font-weight:700;color:rgba(240,232,204,.6);margin-bottom:.5rem">لا توجد منتجات في هذا التصنيف</h3>
                <p style="font-size:.875rem;color:rgba(240,232,204,.35);margin-bottom:1.5rem">لم يتم إضافة أي منتجات في هذا التصنيف بعد</p>
                <a href="{{ route('products.create') }}"
                    style="display:inline-flex;align-items:center;gap:.5rem;padding:.75rem 1.5rem;background:#f47c51;color:#fff;border-radius:.75rem;font-weight:700;text-decoration:none">
                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    إضافة منتج جديد
                </a>
            </div>
        @endif
    </div>
    <footer style="background:rgba(26,46,53,.5);border-top:1px solid rgba(46,138,153,.1);padding:2rem 1.5rem;text-align:center">
        <p style="font-size:.8rem;color:rgba(240,232,204,.3)">© {{ date('Y') }} مزادي. جميع الحقوق محفوظة.</p>
    </footer>
    @livewireScripts
</body>
</html>
@endhasrole
