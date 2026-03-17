<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>إتمام الطلب - مزادي</title>
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Kufi+Arabic:wght@300;400;600;700;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body style="font-family:'Noto Kufi Arabic',sans-serif;background:#0f1e23;color:#f0e8cc;min-height:100vh">
    <x-navbar />

    <div style="max-width:700px;margin:0 auto;padding:2rem 1rem">
        <div style="margin-bottom:1.5rem">
            <h2 style="font-size:1.75rem;font-weight:900;color:#f0e8cc">إتمام الطلب</h2>
        </div>

        <!-- Product Summary -->
        <div style="background:rgba(46,138,153,.06);border:1px solid rgba(46,138,153,.2);border-radius:1.25rem;padding:1.25rem;margin-bottom:1.5rem;display:flex;gap:1rem;align-items:center">
            @if($product->getFirstMediaUrl('images'))
                <img src="{{ $product->getFirstMediaUrl('images') }}" alt="{{ $product->title }}"
                     style="width:5rem;height:5rem;border-radius:.75rem;object-fit:cover;border:1px solid rgba(46,138,153,.2);flex-shrink:0">
            @endif
            <div>
                <h3 style="font-weight:700;color:#f0e8cc;margin-bottom:.25rem">{{ $product->title }}</h3>
                <p style="font-size:.8rem;color:rgba(240,232,204,.45);margin-bottom:.4rem">{{ $product->category->name }}</p>
                <span style="font-size:1.25rem;font-weight:900;color:#f47c51">{{ number_format($product->price) }} ج.م</span>
            </div>
        </div>

        <!-- Form -->
        <div style="background:rgba(26,46,53,.7);border:1px solid rgba(46,138,153,.15);border-radius:1.25rem;padding:1.5rem">
            <form action="{{ route('orders.store', $product) }}" method="POST">
                @csrf
                <div style="display:flex;flex-direction:column;gap:1rem">
                    <div>
                        <label style="display:block;font-size:.78rem;font-weight:600;color:rgba(240,232,204,.5);margin-bottom:.4rem">الاسم الكامل *</label>
                        <input type="text" name="buyer_name" value="{{ old('buyer_name', auth()->user()->name) }}" required
                            style="width:100%;padding:.65rem 1rem;background:rgba(15,30,35,.6);border:1px solid rgba(46,138,153,.2);border-radius:.75rem;color:#f0e8cc;font-family:'Noto Kufi Arabic',sans-serif;font-size:.875rem;outline:none;box-sizing:border-box"
                            onfocus="this.style.borderColor='rgba(46,138,153,.5)'" onblur="this.style.borderColor='rgba(46,138,153,.2)'">
                        @error('buyer_name') <p style="margin-top:.35rem;font-size:.78rem;color:#f47c51">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label style="display:block;font-size:.78rem;font-weight:600;color:rgba(240,232,204,.5);margin-bottom:.4rem">البريد الإلكتروني *</label>
                        <input type="email" name="buyer_email" value="{{ old('buyer_email', auth()->user()->email) }}" required
                            style="width:100%;padding:.65rem 1rem;background:rgba(15,30,35,.6);border:1px solid rgba(46,138,153,.2);border-radius:.75rem;color:#f0e8cc;font-family:'Noto Kufi Arabic',sans-serif;font-size:.875rem;outline:none;box-sizing:border-box"
                            onfocus="this.style.borderColor='rgba(46,138,153,.5)'" onblur="this.style.borderColor='rgba(46,138,153,.2)'">
                        @error('buyer_email') <p style="margin-top:.35rem;font-size:.78rem;color:#f47c51">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label style="display:block;font-size:.78rem;font-weight:600;color:rgba(240,232,204,.5);margin-bottom:.4rem">رقم الهاتف *</label>
                        <input type="tel" name="buyer_phone" value="{{ old('buyer_phone') }}" required
                            style="width:100%;padding:.65rem 1rem;background:rgba(15,30,35,.6);border:1px solid rgba(46,138,153,.2);border-radius:.75rem;color:#f0e8cc;font-family:'Noto Kufi Arabic',sans-serif;font-size:.875rem;outline:none;box-sizing:border-box"
                            onfocus="this.style.borderColor='rgba(46,138,153,.5)'" onblur="this.style.borderColor='rgba(46,138,153,.2)'">
                        @error('buyer_phone') <p style="margin-top:.35rem;font-size:.78rem;color:#f47c51">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label style="display:block;font-size:.78rem;font-weight:600;color:rgba(240,232,204,.5);margin-bottom:.4rem">العنوان</label>
                        <textarea name="buyer_address" rows="3"
                            style="width:100%;padding:.65rem 1rem;background:rgba(15,30,35,.6);border:1px solid rgba(46,138,153,.2);border-radius:.75rem;color:#f0e8cc;font-family:'Noto Kufi Arabic',sans-serif;font-size:.875rem;outline:none;resize:vertical;box-sizing:border-box"
                            onfocus="this.style.borderColor='rgba(46,138,153,.5)'" onblur="this.style.borderColor='rgba(46,138,153,.2)'">{{ old('buyer_address') }}</textarea>
                    </div>
                    <div>
                        <label style="display:block;font-size:.78rem;font-weight:600;color:rgba(240,232,204,.5);margin-bottom:.4rem">ملاحظات إضافية</label>
                        <textarea name="notes" rows="3" placeholder="أي ملاحظات أو طلبات خاصة..."
                            style="width:100%;padding:.65rem 1rem;background:rgba(15,30,35,.6);border:1px solid rgba(46,138,153,.2);border-radius:.75rem;color:#f0e8cc;font-family:'Noto Kufi Arabic',sans-serif;font-size:.875rem;outline:none;resize:vertical;box-sizing:border-box"
                            onfocus="this.style.borderColor='rgba(46,138,153,.5)'" onblur="this.style.borderColor='rgba(46,138,153,.2)'">{{ old('notes') }}</textarea>
                    </div>

                    <div style="background:rgba(46,138,153,.06);border:1px solid rgba(46,138,153,.15);border-radius:1rem;padding:1rem;display:flex;justify-content:space-between;align-items:center">
                        <span style="font-weight:700;color:#f0e8cc">المجموع الكلي</span>
                        <span style="font-size:1.5rem;font-weight:900;color:#f47c51">{{ number_format($product->price) }} ج.م</span>
                    </div>

                    <div style="display:flex;gap:.75rem;flex-wrap:wrap">
                        <button type="submit"
                            style="flex:1;min-width:140px;padding:.75rem;background:#f47c51;color:#fff;border:none;border-radius:.75rem;font-family:'Noto Kufi Arabic',sans-serif;font-size:.9rem;font-weight:700;cursor:pointer;transition:all .2s"
                            onmouseover="this.style.background='#c95f3a'" onmouseout="this.style.background='#f47c51'">
                            تأكيد الطلب
                        </button>
                        <a href="{{ route('products.show', $product) }}"
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
