# موقع بيع المستعمل - Multi-Tenancy

## 🎯 نظرة عامة

موقع متعدد المتاجر (Multi-Tenancy) لبيع المنتجات المستعملة، مبني على Laravel 12 مع نظام Single Database.

### ✨ المميزات الرئيسية

- 🏪 **Multi-Tenancy**: كل بائع له متجره الخاص
- 📦 **إدارة المنتجات**: إضافة وتعديل المنتجات المستعملة
- 🖼️ **مكتبة الوسائط**: رفع وإدارة الصور باستخدام Spatie Media Library
- 📂 **التصنيفات الهرمية**: تنظيم المنتجات في تصنيفات وتصنيفات فرعية
- 🛒 **نظام الطلبات**: طلبات كاملة مع حالات متعددة
- 🔒 **عزل البيانات**: كل متجر له بياناته المنفصلة تماماً
- 🎨 **واجهة حديثة**: جاهزة للتخصيص مع Tailwind CSS

## 🏗️ الهيكل المعماري

```
Single Database Architecture
├── Tenants Table (جدول المتاجر)
├── Products Table (tenant_id) ← عزل تلقائي
├── Categories Table (tenant_id) ← عزل تلقائي
├── Orders Table (tenant_id) ← عزل تلقائي
└── Media Table ← مشترك
```

## 📋 المتطلبات

- PHP 8.2 أو أحدث
- Composer
- MySQL 5.7+ أو SQLite
- Node.js & NPM
- GD Library أو Imagick

## 🚀 التثبيت السريع

```bash
# 1. استنساخ المشروع
cd d:\laravel\exabha.com\exabha

# 2. تثبيت Dependencies
composer install
npm install

# 3. إعداد البيئة
copy .env.example .env
php artisan key:generate

# 4. إعداد قاعدة البيانات (عدّل .env أولاً)
php artisan migrate

# 5. بيانات تجريبية (اختياري)
php artisan db:seed --class=TenantSeeder
php artisan db:seed --class=DemoDataSeeder

# 6. ربط Storage
php artisan storage:link

# 7. تجميع Assets
npm run dev

# 8. تشغيل المشروع
php artisan serve
```

زر: `http://localhost:8000`

## 📚 الملفات الأساسية

### Models
```
app/Models/
├── Tenant.php          - إدارة المتاجر
├── Product.php         - المنتجات المستعملة
├── Category.php        - التصنيفات
├── Order.php           - الطلبات
└── User.php            - المستخدمين
```

### Traits
```
app/Traits/
└── TenantScoped.php    - عزل البيانات تلقائياً
```

### Controllers
```
app/Http/Controllers/
├── TenantController.php     - إدارة المتاجر
├── ProductController.php    - إدارة المنتجات
├── CategoryController.php   - إدارة التصنيفات
└── OrderController.php      - إدارة الطلبات
```

### Middleware
```
app/Http/Middleware/
├── InitializeTenant.php      - تحديد المتجر الحالي
└── EnsureTenantExists.php    - التحقق من وجود متجر
```

### Migrations
```
database/migrations/
├── 2024_01_01_000001_create_tenants_table.php
├── 2024_01_01_000002_add_tenant_id_to_users_table.php
├── 2024_01_01_000003_create_categories_table.php
├── 2024_01_01_000004_create_products_table.php
├── 2024_01_01_000005_create_orders_table.php
└── 2024_01_01_000006_create_media_table.php
```

## 🎯 كيفية الاستخدام

### إنشاء متجر جديد

```php
use App\Models\Tenant;

$tenant = Tenant::create([
    'name' => 'متجر الإلكترونيات',
    'slug' => 'electronics',
    'domain' => 'electronics.localhost',
    'email' => 'info@electronics.com',
    'status' => true,
]);
```

### إضافة منتج

```php
use App\Models\Tenant;
use App\Models\Product;

// ضبط المتجر الحالي
Tenant::setCurrent($tenant);

// إنشاء المنتج (سيُضاف tenant_id تلقائياً)
$product = Product::create([
    'category_id' => 1,
    'user_id' => auth()->id(),
    'title' => 'آيفون 13 برو',
    'slug' => 'iphone-13-pro',
    'description' => 'بحالة ممتازة جداً',
    'price' => 3500.00,
    'condition' => 'like_new',
    'location' => 'الرياض',
]);

// رفع صورة
$product->addMedia($request->file('image'))
    ->toMediaCollection('images');
```

### استعلام المنتجات

```php
// المنتجات محدودة تلقائياً للمتجر الحالي
$products = Product::active()->latest()->get();

// البحث
$products = Product::where('title', 'like', '%آيفون%')
    ->where('price', '<=', 5000)
    ->get();

// المنتجات المميزة
$featured = Product::featured()->get();
```

## 🛣️ Routes المتاحة

### إدارة المتاجر (Central)
```
GET    /admin/tenants           - قائمة المتاجر
POST   /admin/tenants           - إنشاء متجر
GET    /admin/tenants/{id}      - عرض متجر
PUT    /admin/tenants/{id}      - تحديث متجر
DELETE /admin/tenants/{id}      - حذف متجر
```

### المنتجات (Tenant Scoped)
```
GET    /products                - قائمة المنتجات
GET    /products/{slug}         - عرض منتج
GET    /products/create         - إضافة منتج (auth)
POST   /products                - حفظ منتج (auth)
PUT    /products/{slug}         - تحديث منتج (auth)
DELETE /products/{slug}         - حذف منتج (auth)
```

### التصنيفات
```
GET    /categories              - قائمة التصنيفات
GET    /categories/{slug}       - منتجات التصنيف
```

### الطلبات
```
GET    /orders                  - طلباتي (auth)
POST   /orders/{product}        - إنشاء طلب (auth)
GET    /orders/{id}             - عرض طلب (auth)
PATCH  /orders/{id}/status      - تحديث حالة (auth)
```

## 🎨 حالات المنتج

```php
'new'       => 'جديد'
'like_new'  => 'كالجديد'
'good'      => 'جيد'
'fair'      => 'مقبول'
'poor'      => 'يحتاج صيانة'
```

## 📦 حالات الطلب

```php
'pending'    => 'قيد الانتظار'
'confirmed'  => 'مؤكد'
'completed'  => 'مكتمل'
'cancelled'  => 'ملغي'
```

## 🔒 الأمان

### عزل البيانات
- ✅ TenantScoped Trait يطبق تلقائياً على جميع Models
- ✅ Global Scope يمنع الوصول للبيانات بين المتاجر
- ✅ Middleware يتحقق من المتجر في كل طلب

### Policies
- ✅ ProductPolicy: التحكم في صلاحيات المنتجات
- ✅ OrderPolicy: التحكم في صلاحيات الطلبات

### Validation
- ✅ جميع المدخلات تُتحقق منها
- ✅ الصور محدودة بحجم ونوع معين
- ✅ CSRF Protection مفعّل

## 📸 مكتبة الوسائط

### Collections المتاحة

**Products:**
- `images` - صور المنتج (متعددة)
- `featured` - الصورة الرئيسية (واحدة)

**Categories:**
- `icon` - أيقونة التصنيف (واحدة)

### أمثلة

```php
// رفع صورة
$product->addMedia($file)->toMediaCollection('images');

// صورة مميزة
$product->addMedia($file)->toMediaCollection('featured');

// جلب الصور
$images = $product->getMedia('images');
$featuredUrl = $product->getFirstMediaUrl('featured');

// حذف صورة
$product->clearMediaCollection('images');
```

## 🧪 البيانات التجريبية

```bash
# إنشاء 3 متاجر تجريبية
php artisan db:seed --class=TenantSeeder

# إنشاء منتجات وتصنيفات
php artisan db:seed --class=DemoDataSeeder
```

**المستخدم التجريبي:**
- Email: `demo@example.com`
- Password: `password`

**المتاجر التجريبية:**
- `electronics.localhost` - متجر الإلكترونيات
- `furniture.localhost` - متجر الأثاث
- `clothing.localhost` - متجر الملابس

## 📖 التوثيق الكامل

للتوثيق الشامل، راجع:
- 📘 [دليل Multi-Tenancy](MULTI_TENANCY_GUIDE.md)
- 🛠️ [تعليمات التثبيت](INSTALLATION.md)

## 🧰 الأوامر المفيدة

```bash
# مسح الـ Cache
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear

# إعادة بناء قاعدة البيانات
php artisan migrate:fresh --seed

# عرض جميع الـ Routes
php artisan route:list

# Laravel Tinker للتجربة
php artisan tinker
```

## 🐛 حل المشاكل

### خطأ في الصور
```bash
php artisan storage:link
```

### خطأ في قاعدة البيانات
```bash
php artisan migrate:fresh --seed
```

### خطأ في Composer
```bash
composer dump-autoload
```

## 🚀 التطوير المستقبلي

### ميزات مقترحة:
- [ ] نظام اشتراكات (Subscription)
- [ ] بوابة دفع متكاملة
- [ ] تقييمات ومراجعات
- [ ] نظام رسائل داخلي
- [ ] إشعارات Push
- [ ] تطبيق Mobile
- [ ] Multi-language Support
- [ ] Analytics Dashboard
- [ ] SEO Optimization
- [ ] Social Media Integration

## 📊 قاعدة البيانات

### ERD (مخطط العلاقات)

```
┌──────────┐       ┌──────────┐       ┌──────────┐
│ Tenants  │──┐    │  Users   │       │Categories│
└──────────┘  │    └──────────┘       └──────────┘
              │         │                    │
              │         │                    │
              ↓         ↓                    ↓
         ┌─────────────────────────────────────┐
         │           Products                  │
         └─────────────────────────────────────┘
                        │
                        ↓
                   ┌─────────┐
                   │ Orders  │
                   └─────────┘
```

## 🤝 المساهمة

المشروع مفتوح للتطوير والمساهمة.

## 📝 الترخيص

MIT License

## 👥 الفريق

بُني بـ ❤️ لموقع exabha.com

---

**استمتع بالتطوير! 🎉**

