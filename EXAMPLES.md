# أمثلة عملية - Multi-Tenancy

## 📚 أمثلة شاملة لاستخدام النظام

---

## 1️⃣ إنشاء متجر كامل

### المثال الكامل

```php
use App\Models\{Tenant, User, Category, Product};
use Illuminate\Support\Facades\Hash;

// 1. إنشاء المتجر
$tenant = Tenant::create([
    'name' => 'متجر الإلكترونيات الحديثة',
    'slug' => 'modern-electronics',
    'domain' => 'electronics.example.com',
    'email' => 'info@electronics.com',
    'phone' => '0501234567',
    'status' => true,
    'settings' => [
        'theme' => 'blue',
        'currency' => 'SAR',
        'products_per_page' => 20,
        'max_images_per_product' => 5,
    ],
]);

// 2. ضبط المتجر الحالي
Tenant::setCurrent($tenant);

// 3. إنشاء مالك المتجر
$owner = User::create([
    'name' => 'أحمد محمد',
    'email' => 'ahmed@electronics.com',
    'password' => Hash::make('secure-password'),
]);

// 4. إنشاء تصنيفات
$electronics = Category::create([
    'name' => 'إلكترونيات',
    'slug' => 'electronics',
    'description' => 'جميع المنتجات الإلكترونية',
]);

$phones = Category::create([
    'parent_id' => $electronics->id,
    'name' => 'هواتف ذكية',
    'slug' => 'smartphones',
    'description' => 'هواتف ذكية مستعملة',
]);

$laptops = Category::create([
    'parent_id' => $electronics->id,
    'name' => 'أجهزة كمبيوتر',
    'slug' => 'laptops',
    'description' => 'أجهزة لابتوب مستعملة',
]);

// 5. إضافة منتجات
$product1 = Product::create([
    'category_id' => $phones->id,
    'user_id' => $owner->id,
    'title' => 'آيفون 13 برو ماكس',
    'slug' => 'iphone-13-pro-max',
    'description' => 'آيفون 13 برو ماكس بحالة ممتازة جداً، 256 جيجا، لون أزرق سييرا، مع جميع الملحقات الأصلية.',
    'price' => 3800.00,
    'condition' => 'like_new',
    'location' => 'الرياض - حي الملقا',
    'is_featured' => true,
    'featured_until' => now()->addDays(7),
]);

echo "✅ تم إنشاء متجر '{$tenant->name}' بنجاح!\n";
echo "📦 المنتجات: " . Product::count() . "\n";
echo "📂 التصنيفات: " . Category::count() . "\n";
```

---

## 2️⃣ رفع وإدارة الصور

### رفع صور متعددة

```php
use App\Models\Product;

$product = Product::find(1);

// رفع صور متعددة
$images = [
    'storage/temp/image1.jpg',
    'storage/temp/image2.jpg',
    'storage/temp/image3.jpg',
];

foreach ($images as $index => $imagePath) {
    $product->addMedia($imagePath)
        ->toMediaCollection('images');
    
    // الصورة الأولى كصورة مميزة
    if ($index === 0) {
        $product->addMedia($imagePath)
            ->toMediaCollection('featured');
    }
}

echo "✅ تم رفع " . $product->getMedia('images')->count() . " صور\n";
```

### من Request في Controller

```php
public function store(Request $request)
{
    $validated = $request->validate([
        'title' => 'required',
        'images.*' => 'image|mimes:jpeg,png,jpg|max:2048',
    ]);

    $product = Product::create($validated);

    // رفع الصور
    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $key => $image) {
            $product->addMedia($image)
                ->toMediaCollection('images');
            
            if ($key === 0) {
                $product->addMedia($image)
                    ->toMediaCollection('featured');
            }
        }
    }

    return redirect()->route('products.show', $product);
}
```

### جلب وعرض الصور

```php
$product = Product::find(1);

// جلب جميع الصور
$images = $product->getMedia('images');

// عرض URLs
foreach ($images as $image) {
    echo $image->getUrl() . "\n";
}

// الصورة المميزة
$featuredUrl = $product->getFirstMediaUrl('featured');
echo "Featured: $featuredUrl\n";

// في Blade View
// <img src="{{ $product->getFirstMediaUrl('featured') }}" alt="{{ $product->title }}">
```

### حذف صور

```php
$product = Product::find(1);

// حذف صورة معينة
$media = $product->getMedia('images')->first();
$media->delete();

// حذف جميع صور المجموعة
$product->clearMediaCollection('images');

// حذف جميع الصور
$product->clearMediaCollection();
```

---

## 3️⃣ البحث والفلترة المتقدمة

### بحث شامل

```php
use App\Models\Product;
use Illuminate\Http\Request;

public function search(Request $request)
{
    $query = Product::query();

    // البحث في العنوان والوصف
    if ($search = $request->get('q')) {
        $query->where(function($q) use ($search) {
            $q->where('title', 'like', "%{$search}%")
              ->orWhere('description', 'like', "%{$search}%");
        });
    }

    // فلترة بالتصنيف
    if ($categoryId = $request->get('category')) {
        $query->where('category_id', $categoryId);
    }

    // فلترة بالحالة
    if ($condition = $request->get('condition')) {
        $query->where('condition', $condition);
    }

    // نطاق السعر
    if ($minPrice = $request->get('min_price')) {
        $query->where('price', '>=', $minPrice);
    }
    if ($maxPrice = $request->get('max_price')) {
        $query->where('price', '<=', $maxPrice);
    }

    // فلترة بالموقع
    if ($location = $request->get('location')) {
        $query->where('location', 'like', "%{$location}%");
    }

    // الترتيب
    $sortBy = $request->get('sort', 'latest');
    switch ($sortBy) {
        case 'price_asc':
            $query->orderBy('price', 'asc');
            break;
        case 'price_desc':
            $query->orderBy('price', 'desc');
            break;
        case 'popular':
            $query->orderBy('views_count', 'desc');
            break;
        default:
            $query->latest();
    }

    // المنتجات النشطة فقط
    $query->active();

    // مع العلاقات
    $query->with(['category', 'user', 'media']);

    // النتائج مع Pagination
    $products = $query->paginate(20);

    return view('products.search', compact('products'));
}
```

### استخدام URL

```
/products?q=آيفون&category=2&condition=like_new&min_price=2000&max_price=5000&location=الرياض&sort=price_asc
```

---

## 4️⃣ إدارة الطلبات

### إنشاء طلب كامل

```php
use App\Models\{Product, Order};

$product = Product::find(1);

// التحقق من توفر المنتج
if (!$product->status) {
    return back()->with('error', 'المنتج غير متوفر');
}

// إنشاء الطلب
$order = Order::create([
    'product_id' => $product->id,
    'seller_id' => $product->user_id,
    'buyer_id' => auth()->id(),
    'total_amount' => $product->price,
    'buyer_name' => auth()->user()->name,
    'buyer_email' => auth()->user()->email,
    'buyer_phone' => request('phone'),
    'buyer_address' => request('address'),
    'notes' => request('notes'),
    'status' => Order::STATUS_PENDING,
]);

// إرسال إشعارات (اختياري)
// $product->user->notify(new NewOrderNotification($order));
// auth()->user()->notify(new OrderCreatedNotification($order));

return redirect()
    ->route('orders.show', $order)
    ->with('success', 'تم إرسال طلبك بنجاح!');
```

### تحديث حالة الطلب

```php
$order = Order::find(1);

// تأكيد الطلب
$order->update(['status' => Order::STATUS_CONFIRMED]);

// إكمال الطلب
$order->markAsCompleted();

// إلغاء الطلب
$order->cancel('المنتج تم بيعه لشخص آخر');

// طلبات البائع
$myOrders = Order::where('seller_id', auth()->id())->latest()->get();

// طلبات المشتري
$myPurchases = Order::where('buyer_id', auth()->id())->latest()->get();
```

---

## 5️⃣ التعامل مع المتاجر المتعددة

### التبديل بين المتاجر

```php
use App\Models\Tenant;
use App\Helpers\TenantHelper;

// جلب متجرين
$tenant1 = Tenant::find(1);
$tenant2 = Tenant::find(2);

// العمل مع المتجر الأول
TenantHelper::run($tenant1, function($tenant) {
    echo "متجر: {$tenant->name}\n";
    echo "المنتجات: " . Product::count() . "\n";
});

// العمل مع المتجر الثاني
TenantHelper::run($tenant2, function($tenant) {
    echo "متجر: {$tenant->name}\n";
    echo "المنتجات: " . Product::count() . "\n";
});

// تنفيذ عملية على جميع المتاجر
TenantHelper::each(function($tenant) {
    // حذف المنتجات القديمة
    Product::where('created_at', '<', now()->subMonths(6))
        ->where('status', false)
        ->delete();
    
    echo "✅ تنظيف متجر: {$tenant->name}\n";
});
```

### إحصائيات المتجر

```php
use App\Services\TenantService;

$tenantService = new TenantService();
$tenant = Tenant::find(1);

$stats = $tenantService->getStatistics($tenant);

/*
Array (
    'products_count' => 25,
    'active_products' => 20,
    'categories_count' => 7,
    'orders_count' => 15,
    'pending_orders' => 3,
    'completed_orders' => 10,
    'total_revenue' => 45000.00
)
*/

foreach ($stats as $key => $value) {
    echo "$key: $value\n";
}
```

---

## 6️⃣ التصنيفات الهرمية

### إنشاء تصنيف بـ Children

```php
use App\Models\Category;

// التصنيف الرئيسي
$electronics = Category::create([
    'name' => 'إلكترونيات',
    'slug' => 'electronics',
]);

// تصنيفات فرعية
$phones = Category::create([
    'parent_id' => $electronics->id,
    'name' => 'هواتف',
    'slug' => 'phones',
]);

$laptops = Category::create([
    'parent_id' => $electronics->id,
    'name' => 'لابتوب',
    'slug' => 'laptops',
]);

// تصنيف فرعي من المستوى الثاني
$iphones = Category::create([
    'parent_id' => $phones->id,
    'name' => 'آيفون',
    'slug' => 'iphones',
]);
```

### جلب التصنيفات الهرمية

```php
// جميع التصنيفات الرئيسية مع أطفالها
$categories = Category::root()
    ->with('children')
    ->orderBy('order')
    ->get();

foreach ($categories as $category) {
    echo $category->name . "\n";
    
    foreach ($category->children as $child) {
        echo "  - " . $child->name . "\n";
    }
}

// جلب تصنيف مع جميع منتجاته
$category = Category::with(['products' => function($q) {
    $q->active()->latest();
}])->find(1);

echo "تصنيف: {$category->name}\n";
echo "المنتجات: " . $category->products->count() . "\n";
```

---

## 7️⃣ المنتجات المميزة

### تمييز منتج

```php
$product = Product::find(1);

// جعل المنتج مميز لمدة أسبوع
$product->update([
    'is_featured' => true,
    'featured_until' => now()->addWeek(),
]);

// جعل المنتج مميز لمدة شهر
$product->update([
    'is_featured' => true,
    'featured_until' => now()->addMonth(),
]);

// إلغاء التمييز
$product->update([
    'is_featured' => false,
    'featured_until' => null,
]);
```

### جلب المنتجات المميزة

```php
// المنتجات المميزة النشطة
$featured = Product::featured()
    ->with(['category', 'user', 'media'])
    ->limit(10)
    ->get();

// عرضها في الصفحة الرئيسية
foreach ($featured as $product) {
    echo "⭐ {$product->title} - {$product->price} ريال\n";
}
```

---

## 8️⃣ التقارير والإحصائيات

### تقرير شامل للمتجر

```php
use App\Models\{Tenant, Product, Order};

$tenant = Tenant::find(1);
Tenant::setCurrent($tenant);

// إحصائيات المنتجات
$productsStats = [
    'total' => Product::count(),
    'active' => Product::where('status', true)->count(),
    'inactive' => Product::where('status', false)->count(),
    'featured' => Product::featured()->count(),
    'by_condition' => [
        'new' => Product::where('condition', 'new')->count(),
        'like_new' => Product::where('condition', 'like_new')->count(),
        'good' => Product::where('condition', 'good')->count(),
        'fair' => Product::where('condition', 'fair')->count(),
        'poor' => Product::where('condition', 'poor')->count(),
    ],
];

// إحصائيات الطلبات
$ordersStats = [
    'total' => Order::count(),
    'pending' => Order::where('status', 'pending')->count(),
    'confirmed' => Order::where('status', 'confirmed')->count(),
    'completed' => Order::where('status', 'completed')->count(),
    'cancelled' => Order::where('status', 'cancelled')->count(),
    'total_revenue' => Order::where('status', 'completed')->sum('total_amount'),
    'today_orders' => Order::whereDate('created_at', today())->count(),
    'this_month_orders' => Order::whereMonth('created_at', now()->month)->count(),
];

// أكثر المنتجات مشاهدة
$mostViewed = Product::orderBy('views_count', 'desc')->limit(10)->get();

// أحدث المنتجات
$latest = Product::latest()->limit(10)->get();

echo "📊 تقرير متجر: {$tenant->name}\n\n";
echo "المنتجات:\n";
print_r($productsStats);
echo "\nالطلبات:\n";
print_r($ordersStats);
```

### تقرير المبيعات الشهري

```php
$monthlySales = Order::where('status', 'completed')
    ->whereMonth('completed_at', now()->month)
    ->whereYear('completed_at', now()->year)
    ->selectRaw('DATE(completed_at) as date, COUNT(*) as count, SUM(total_amount) as total')
    ->groupBy('date')
    ->get();

foreach ($monthlySales as $sale) {
    echo "{$sale->date}: {$sale->count} طلبات - {$sale->total} ريال\n";
}
```

---

## 9️⃣ التحقق والـ Validation

### في Controller

```php
public function store(Request $request)
{
    $validated = $request->validate([
        'category_id' => 'required|exists:categories,id',
        'title' => 'required|string|max:255|unique:products,title',
        'description' => 'required|string|min:50',
        'price' => 'required|numeric|min:1|max:999999',
        'condition' => 'required|in:new,like_new,good,fair,poor',
        'location' => 'required|string|max:255',
        'images' => 'required|array|min:1|max:5',
        'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
    ], [
        'title.required' => 'عنوان المنتج مطلوب',
        'title.unique' => 'هذا العنوان مستخدم من قبل',
        'price.min' => 'السعر يجب أن يكون على الأقل 1 ريال',
        'images.required' => 'يجب رفع صورة واحدة على الأقل',
        'images.max' => 'الحد الأقصى 5 صور',
    ]);

    $product = Product::create($validated);
    
    // رفع الصور...
    
    return redirect()->route('products.show', $product);
}
```

---

## 🔟 أمثلة متقدمة

### Command للتنظيف التلقائي

```php
// app/Console/Commands/CleanOldProducts.php

namespace App\Console\Commands;

use App\Models\{Tenant, Product};
use App\Helpers\TenantHelper;
use Illuminate\Console\Command;

class CleanOldProducts extends Command
{
    protected $signature = 'products:clean';
    protected $description = 'حذف المنتجات القديمة غير النشطة';

    public function handle()
    {
        $this->info('بدء التنظيف...');
        
        TenantHelper::each(function($tenant) {
            $deleted = Product::where('status', false)
                ->where('created_at', '<', now()->subMonths(6))
                ->delete();
            
            $this->info("✅ {$tenant->name}: تم حذف {$deleted} منتج");
        });
        
        $this->info('✅ اكتمل التنظيف!');
    }
}
```

### Scheduled Task

```php
// app/Console/Kernel.php

protected function schedule(Schedule $schedule)
{
    // تنظيف يومي
    $schedule->command('products:clean')->daily();
    
    // تقرير أسبوعي
    $schedule->call(function () {
        // إرسال تقرير للمتاجر
    })->weekly();
}
```

---

**💡 نصيحة:** استخدم هذه الأمثلة كنقطة انطلاق وقم بتخصيصها حسب احتياجاتك!

