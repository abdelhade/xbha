# دليل Multi-Tenancy لموقع بيع المستعمل

## نظرة عامة

تم تحويل المشروع إلى نظام **Multi-Tenancy** بنظام **Single Database** حيث:
- كل متجر (Tenant) له بياناته الخاصة في نفس قاعدة البيانات
- الفصل بين المتاجر يتم عن طريق `tenant_id`
- مكتبة Media متكاملة باستخدام Spatie Media Library

## الهيكل المعماري

```
┌─────────────────────────────────────────┐
│         Central Domain                   │
│      (app.exabha.com)                   │
│  - إدارة المتاجر                        │
│  - لوحة تحكم مركزية                    │
└─────────────────────────────────────────┘
                    │
        ┌───────────┴───────────┐
        │                       │
┌───────▼────────┐    ┌────────▼────────┐
│ Tenant Domain 1│    │ Tenant Domain 2 │
│ store1.com     │    │ store2.com      │
│ - المنتجات    │    │ - المنتجات     │
│ - الطلبات      │    │ - الطلبات       │
└────────────────┘    └─────────────────┘
```

## المكونات الأساسية

### 1. Models

#### Tenant Model
```php
App\Models\Tenant
- إدارة المتاجر
- slug, domain, email, settings
```

#### Product Model
```php
App\Models\Product
- المنتجات المستعملة
- دعم الصور باستخدام Media Library
- TenantScoped Trait
```

#### Category Model
```php
App\Models\Category
- التصنيفات الهرمية (Parent/Child)
- TenantScoped Trait
```

#### Order Model
```php
App\Models\Order
- الطلبات والمبيعات
- حالات متعددة (pending, confirmed, completed, cancelled)
- TenantScoped Trait
```

### 2. Traits

#### TenantScoped
```php
app/Traits/TenantScoped.php
```
- يضيف تلقائياً `tenant_id` عند إنشاء السجلات
- يطبق Global Scope على جميع الاستعلامات
- يمنع الوصول للبيانات بين المتاجر

### 3. Middleware

#### InitializeTenant
```php
app/Http/Middleware/InitializeTenant.php
```
- يتعرف على المتجر من الدومين
- يضبط المتجر الحالي في النظام

#### EnsureTenantExists
```php
app/Http/Middleware/EnsureTenantExists.php
```
- يتأكد من وجود متجر
- يرجع 404 إذا لم يوجد

### 4. Controllers

- **TenantController**: إدارة المتاجر
- **ProductController**: إدارة المنتجات
- **CategoryController**: إدارة التصنيفات
- **OrderController**: إدارة الطلبات

## التثبيت والإعداد

### 1. تثبيت الـ Dependencies

```bash
# تثبيت Tenancy Package
composer require stancl/tenancy

# تثبيت Media Library
composer require spatie/laravel-medialibrary
```

### 2. تشغيل Migrations

```bash
php artisan migrate
```

الجداول التي سيتم إنشاؤها:
- `tenants` - جدول المتاجر
- `users` - المستخدمين (مع tenant_id)
- `categories` - التصنيفات (مع tenant_id)
- `products` - المنتجات (مع tenant_id)
- `orders` - الطلبات (مع tenant_id)
- `media` - مكتبة الوسائط

### 3. إنشاء بيانات تجريبية

```bash
# إنشاء متاجر تجريبية
php artisan db:seed --class=TenantSeeder

# إنشاء بيانات تجريبية
php artisan db:seed --class=DemoDataSeeder
```

### 4. إعداد Storage للصور

```bash
php artisan storage:link
```

## كيفية الاستخدام

### إنشاء متجر جديد

```php
use App\Models\Tenant;

$tenant = Tenant::create([
    'name' => 'متجر الإلكترونيات',
    'slug' => 'electronics-store',
    'domain' => 'electronics.example.com',
    'email' => 'info@electronics.com',
    'status' => true,
]);
```

### ضبط المتجر الحالي

```php
use App\Models\Tenant;

// من خلال الدومين
$tenant = Tenant::findByDomain('electronics.example.com');
Tenant::setCurrent($tenant);

// أو يدوياً
$tenant = Tenant::find(1);
Tenant::setCurrent($tenant);
```

### إنشاء منتج (سيُضاف تلقائياً للمتجر الحالي)

```php
use App\Models\Product;
use App\Models\Tenant;

// ضبط المتجر أولاً
Tenant::setCurrent($tenant);

$product = Product::create([
    'category_id' => 1,
    'user_id' => auth()->id(),
    'title' => 'آيفون 13 برو',
    'slug' => 'iphone-13-pro',
    'description' => 'بحالة ممتازة',
    'price' => 3500.00,
    'condition' => 'like_new',
    'location' => 'الرياض',
]);

// إضافة صورة
$product->addMedia($request->file('image'))
    ->toMediaCollection('images');
```

### استعلام المنتجات (تلقائياً محدود للمتجر الحالي)

```php
// سيرجع فقط منتجات المتجر الحالي
$products = Product::where('status', true)->get();

// لجلب منتجات متجر معين
Tenant::setCurrent($tenant);
$products = Product::all();
```

### رفع الصور

```php
// صورة واحدة
$product->addMedia($file)->toMediaCollection('images');

// صورة مميزة
$product->addMedia($file)->toMediaCollection('featured');

// جلب الصور
$images = $product->getMedia('images');
$featuredImage = $product->getFirstMediaUrl('featured');
```

## Routes

### Central Routes (إدارة المتاجر)
```
GET  /admin/tenants           - قائمة المتاجر
GET  /admin/tenants/create    - صفحة إنشاء متجر
POST /admin/tenants           - حفظ متجر جديد
GET  /admin/tenants/{id}      - عرض متجر
GET  /admin/tenants/{id}/edit - تعديل متجر
PUT  /admin/tenants/{id}      - تحديث متجر
DELETE /admin/tenants/{id}    - حذف متجر
```

### Tenant Routes (داخل المتجر)
```
# المنتجات
GET  /products              - قائمة المنتجات
GET  /products/create       - إضافة منتج (auth)
POST /products              - حفظ منتج (auth)
GET  /products/{slug}       - عرض منتج
GET  /products/{slug}/edit  - تعديل منتج (auth)
PUT  /products/{slug}       - تحديث منتج (auth)
DELETE /products/{slug}     - حذف منتج (auth)

# التصنيفات
GET  /categories            - قائمة التصنيفات
GET  /categories/{slug}     - منتجات التصنيف

# الطلبات
GET  /orders                - طلباتي (auth)
GET  /orders/create/{product} - إنشاء طلب (auth)
POST /orders/{product}      - حفظ طلب (auth)
GET  /orders/{id}           - عرض طلب (auth)
PATCH /orders/{id}/status   - تحديث حالة طلب (auth)
```

## حالات المنتج (Condition)

```php
'new'       - جديد
'like_new'  - كالجديد
'good'      - جيد
'fair'      - مقبول
'poor'      - يحتاج صيانة
```

## حالات الطلب (Order Status)

```php
'pending'    - قيد الانتظار
'confirmed'  - مؤكد
'completed'  - مكتمل
'cancelled'  - ملغي
```

## الأمان Security

### 1. عزل البيانات
- جميع الاستعلامات تُفلتر تلقائياً حسب `tenant_id`
- TenantScoped Trait يمنع الوصول بين المتاجر

### 2. Policies
- ProductPolicy: التحكم في صلاحيات المنتجات
- OrderPolicy: التحكم في صلاحيات الطلبات

### 3. Validation
- جميع البيانات تُتحقق منها قبل الحفظ
- الصور محدودة بحجم ونوع معين

## Media Collections

### Products
```php
'images'    - صور المنتج (متعددة)
'featured'  - الصورة الرئيسية (واحدة)
```

### Categories
```php
'icon'      - أيقونة التصنيف (واحدة)
```

## أمثلة عملية

### مثال 1: إنشاء متجر كامل

```php
// إنشاء المتجر
$tenant = Tenant::create([
    'name' => 'متجر الإلكترونيات',
    'slug' => 'electronics',
    'domain' => 'electronics.localhost',
    'email' => 'info@electronics.com',
]);

// ضبط المتجر الحالي
Tenant::setCurrent($tenant);

// إنشاء مستخدم
$user = User::create([
    'name' => 'أحمد',
    'email' => 'ahmed@example.com',
    'password' => Hash::make('password'),
]);

// إنشاء تصنيف
$category = Category::create([
    'name' => 'هواتف',
    'slug' => 'phones',
]);

// إنشاء منتج
$product = Product::create([
    'category_id' => $category->id,
    'user_id' => $user->id,
    'title' => 'آيفون 13',
    'slug' => 'iphone-13',
    'description' => 'بحالة ممتازة',
    'price' => 3000,
    'condition' => 'like_new',
]);
```

### مثال 2: البحث والفلترة

```php
// البحث في المنتجات
$products = Product::where('title', 'like', '%آيفون%')
    ->where('price', '<=', 5000)
    ->where('condition', 'like_new')
    ->active()
    ->get();

// منتجات تصنيف معين
$products = Product::where('category_id', $category->id)
    ->active()
    ->latest()
    ->paginate(20);

// المنتجات المميزة
$featured = Product::featured()->get();
```

### مثال 3: إدارة الطلبات

```php
// إنشاء طلب
$order = Order::create([
    'product_id' => $product->id,
    'seller_id' => $product->user_id,
    'buyer_id' => auth()->id(),
    'total_amount' => $product->price,
    'buyer_name' => 'محمد',
    'buyer_email' => 'mohamed@example.com',
    'buyer_phone' => '0501234567',
]);

// تحديث حالة الطلب
$order->update(['status' => Order::STATUS_CONFIRMED]);

// إكمال الطلب
$order->markAsCompleted();

// إلغاء الطلب
$order->cancel('غير متوفر');
```

## ملاحظات مهمة

1. **دائماً اضبط Tenant قبل العمليات**
   ```php
   Tenant::setCurrent($tenant);
   ```

2. **Storage المنفصل**
   - كل متجر يمكن أن يكون له storage منفصل
   - الصور محفوظة في `storage/app/public/`

3. **Performance**
   - استخدم Eager Loading للعلاقات
   - أضف Indexes على الحقول المستخدمة كثيراً

4. **Testing**
   - اختبر دائماً عزل البيانات بين المتاجر
   - تأكد من عدم تسريب البيانات

## التطوير المستقبلي

### ميزات مقترحة:

1. **نظام الاشتراكات**
   - خطط مجانية ومدفوعة
   - حدود للمنتجات والصور

2. **Domains مخصصة**
   - ربط دومينات خاصة بالمتاجر
   - SSL تلقائي

3. **Multi-language**
   - دعم لغات متعددة لكل متجر

4. **Analytics**
   - إحصائيات المبيعات
   - تتبع الزيارات

5. **Payment Gateway**
   - تكامل مع بوابات الدفع
   - إدارة العمولات

## الدعم والمساعدة

للمزيد من المساعدة:
- راجع الكود في المجلدات
- اطلع على الأمثلة في Seeders
- استخدم `php artisan route:list` لعرض جميع الـ Routes

---

**تم بناؤه بـ ❤️ لموقع بيع المستعمل**

