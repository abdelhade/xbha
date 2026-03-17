@php use Illuminate\Support\Str; @endphp
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>إعلاناتي - مزادي</title>
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Kufi+Arabic:wght@300;400;600;700;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        *{box-sizing:border-box}
        body{font-family:'Noto Kufi Arabic',sans-serif;background:#0f1e23;color:#f0e8cc;min-height:100vh}
        .page-bg{background:#0f1e23;min-height:100vh}
        .card{background:rgba(26,46,53,.7);border:1px solid rgba(46,138,153,.15);border-radius:1.25rem}
        .stat-card{background:rgba(26,46,53,.7);border:1px solid rgba(46,138,153,.15);border-radius:1.25rem;padding:1.5rem;display:flex;align-items:center;gap:1rem}
        .stat-icon{width:48px;height:48px;border-radius:.75rem;display:flex;align-items:center;justify-content:center;flex-shrink:0}
        .stat-label{font-size:.8rem;color:rgba(240,232,204,.5);margin-bottom:.25rem}
        .stat-value{font-size:1.5rem;font-weight:900;color:#f0e8cc}
        .product-card{background:rgba(26,46,53,.5);border:1px solid rgba(46,138,153,.12);border-radius:1rem;overflow:hidden;transition:all .3s}
        .product-card:hover{border-color:rgba(46,138,153,.35);transform:translateY(-3px)}
        .badge-active{background:rgba(46,138,153,.2);color:#3aa0b0;padding:.2rem .6rem;border-radius:100px;font-size:.72rem;font-weight:700}
        .badge-draft{background:rgba(240,232,204,.08);color:rgba(240,232,204,.5);padding:.2rem .6rem;border-radius:100px;font-size:.72rem;font-weight:700}
        .btn-teal{background:#2e8a99;color:#fff;padding:.5rem 1rem;border-radius:.6rem;font-size:.82rem;font-weight:700;text-decoration:none;transition:all .2s;display:inline-block}
        .btn-teal:hover{background:#3aa0b0}
        .btn-coral{background:#f47c51;color:#fff;padding:.75rem 1.5rem;border-radius:.75rem;font-weight:700;text-decoration:none;display:inline-flex;align-items:center;gap:.5rem;transition:all .2s}
        .btn-coral:hover{background:#c95f3a}
        .btn-danger{background:rgba(244,124,81,.1);color:#f47c51;padding:.5rem .75rem;border-radius:.6rem;font-size:.82rem;font-weight:600;border:none;cursor:pointer;transition:all .2s}
        .btn-danger:hover{background:rgba(244,124,81,.2)}
        .page-title{font-size:1.75rem;font-weight:900;color:#f0e8cc}
        .page-sub{font-size:.875rem;color:rgba(240,232,204,.5);margin-top:.25rem}
        .section-head{padding:1.25rem 1.5rem;border-bottom:1px solid rgba(46,138,153,.12)}
        .section-head h3{font-size:1rem;font-weight:700;color:#f0e8cc}
        .empty-state{text-align:center;padding:4rem 2rem}
        .empty-state svg{color:rgba(46,138,153,.3);margin:0 auto 1.5rem}
        .empty-state h3{font-size:1.1rem;font-weight:700;color:rgba(240,232,204,.6);margin-bottom:.5rem}
        .empty-state p{font-size:.875rem;color:rgba(240,232,204,.35);margin-bottom:1.5rem}
    </style>
</head>
<body class="page-bg">
    <x-navbar subtitle="إعلاناتي" />

    <div style="max-width:1200px;margin:0 auto;padding:2rem 1.5rem">
        <!-- Header -->
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:2rem;flex-wrap:wrap;gap:1rem">
            <div>
                <h2 class="page-title">إعلاناتي</h2>
                <p class="page-sub">إدارة جميع إعلاناتك من مكان واحد</p>
            </div>
            <a href="/products/create" class="btn-coral">
                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                إضافة إعلان جديد
            </a>
        </div>

        <!-- Stats -->
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:1rem;margin-bottom:2rem">
            <div class="stat-card">
                <div class="stat-icon" style="background:rgba(46,138,153,.15)">
                    <svg width="22" height="22" fill="none" stroke="#2e8a99" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                </div>
                <div>
                    <p class="stat-label">إجمالي الإعلانات</p>
                    <p class="stat-value">{{ $stats['total'] }}</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon" style="background:rgba(46,138,153,.15)">
                    <svg width="22" height="22" fill="none" stroke="#3aa0b0" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div>
                    <p class="stat-label">إعلانات نشطة</p>
                    <p class="stat-value">{{ $stats['active'] }}</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon" style="background:rgba(244,124,81,.1)">
                    <svg width="22" height="22" fill="none" stroke="#f47c51" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                </div>
                <div>
                    <p class="stat-label">إجمالي المشاهدات</p>
                    <p class="stat-value">{{ number_format($stats['views']) }}</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon" style="background:rgba(244,124,81,.1)">
                    <svg width="22" height="22" fill="none" stroke="#c95f3a" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/></svg>
                </div>
                <div>
                    <p class="stat-label">قيمة الإعلانات</p>
                    <p class="stat-value">{{ number_format($stats['revenue']) }} ج.م</p>
                </div>
            </div>
        </div>

        <!-- Products -->
        <div class="card">
            <div class="section-head">
                <h3>إعلاناتي الحديثة</h3>
            </div>
            <div style="padding:1.5rem">
                @if($products->count() > 0)
                    <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(260px,1fr));gap:1.25rem">
                        @foreach($products->take(6) as $product)
                            <div class="product-card">
                                <div style="position:relative;aspect-ratio:4/3;background:rgba(46,138,153,.08)">
                                    <div style="position:absolute;top:.75rem;right:.75rem;z-index:1">
                                        @if($product->status)
                                            <span class="badge-active">نشط</span>
                                        @else
                                            <span class="badge-draft">مسودة</span>
                                        @endif
                                    </div>
                                    @if($product->getFirstMediaUrl('images'))
                                        <img src="{{ $product->getFirstMediaUrl('images') }}" alt="{{ $product->title }}" style="width:100%;height:100%;object-fit:cover">
                                    @else
                                        <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;color:rgba(46,138,153,.3)">
                                            <svg width="48" height="48" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                        </div>
                                    @endif
                                </div>
                                <div style="padding:1rem">
                                    <h4 style="font-weight:700;font-size:.9rem;margin-bottom:.4rem;color:#f0e8cc">{{ Str::limit($product->title, 30) }}</h4>
                                    <p style="font-size:.78rem;color:rgba(240,232,204,.45);margin-bottom:.75rem">{{ $product->category->name }}</p>
                                    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:.75rem">
                                        <span style="font-size:1.1rem;font-weight:900;color:#f47c51">{{ number_format($product->price) }} ج.م</span>
                                        <span style="font-size:.75rem;color:rgba(240,232,204,.35)">{{ $product->views_count }} مشاهدة</span>
                                    </div>
                                    <div style="display:flex;gap:.5rem">
                                        <a href="{{ route('products.edit', $product->slug) }}" class="btn-teal" style="flex:1;text-align:center">تعديل</a>
                                        <form action="{{ route('products.destroy', $product->slug) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من حذف هذا الإعلان؟')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn-danger">حذف</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @if($products->count() > 6)
                        <div style="margin-top:1.5rem;text-align:center">
                            <a href="#" style="display:inline-flex;align-items:center;gap:.5rem;padding:.75rem 1.5rem;background:rgba(46,138,153,.1);border:1px solid rgba(46,138,153,.2);color:#3aa0b0;border-radius:.75rem;font-weight:600;text-decoration:none;transition:all .2s">
                                عرض جميع الإعلانات ({{ $products->count() }})
                            </a>
                        </div>
                    @endif
                @else
                    <div class="empty-state">
                        <svg width="80" height="80" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
                        <h3>لا توجد إعلانات بعد</h3>
                        <p>ابدأ بإضافة أول إعلان لك</p>
                        <a href="{{ route('products.create') }}" class="btn-coral" style="display:inline-flex">
                            <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                            إضافة إعلان جديد
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
    @livewireScripts
</body>
</html>
