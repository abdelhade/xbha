# البدء السريع - 5 دقائق ⚡

## الخطوة 1: التثبيت (دقيقة واحدة)

```bash
composer install && npm install
copy .env.example .env
php artisan key:generate
```

## الخطوة 2: قاعدة البيانات (دقيقة واحدة)

عدّل `.env`:
```env
DB_CONNECTION=sqlite
```

ثم:
```bash
php artisan migrate --seed
```

## الخطوة 3: ربط Storage (30 ثانية)

```bash
php artisan storage:link
```

## الخطوة 4: البيانات التجريبية (دقيقة واحدة)

```bash
php artisan db:seed --class=TenantSeeder
php artisan db:seed --class=DemoDataSeeder
```

## الخطوة 5: التشغيل (30 ثانية)

```bash
# في نافذة أولى
php artisan serve

# في نافذة ثانية
npm run dev
```

## ✅ جاهز!

زر: **http://localhost:8000**

### 🎯 تجربة سريعة

#### 1. عرض المتاجر
```
http://localhost:8000/admin/tenants
```

#### 2. عرض المنتجات
```
http://localhost:8000/products
```

#### 3. تسجيل الدخول
- Email: `demo@example.com`
- Password: `password`

#### 4. إضافة منتج جديد
```
http://localhost:8000/products/create
```

---

## 🧪 اختبار Multi-Tenancy

### في Terminal:
```bash
php artisan tinker
```

### في Tinker:
```php
// المتجر الأول
$tenant1 = Tenant::find(1);
Tenant::setCurrent($tenant1);
echo "متجر 1: " . Product::count() . " منتجات\n";

// المتجر الثاني
$tenant2 = Tenant::find(2);
Tenant::setCurrent($tenant2);
echo "متجر 2: " . Product::count() . " منتجات\n";

// يجب أن ترى أعداد مختلفة ✅
```

---

## 🎨 أمثلة سريعة

### إنشاء متجر جديد

```php
use App\Models\Tenant;

$tenant = Tenant::create([
    'name' => 'متجري الجديد',
    'slug' => 'my-new-store',
    'email' => 'store@example.com',
]);
```

### إضافة منتج

```php
use App\Models\{Tenant, Product};

Tenant::setCurrent($tenant);

$product = Product::create([
    'category_id' => 1,
    'user_id' => 1,
    'title' => 'منتج جديد',
    'slug' => 'new-product',
    'description' => 'وصف المنتج',
    'price' => 100,
    'condition' => 'new',
]);
```

### رفع صورة

```php
// في Controller
$product->addMedia($request->file('image'))
    ->toMediaCollection('images');
```

---

## 📱 إعداد Domains للتطوير

### Windows
1. افتح: `C:\Windows\System32\drivers\etc\hosts` (كـ Admin)
2. أضف:
```
127.0.0.1 electronics.localhost
127.0.0.1 furniture.localhost
```

### Linux/Mac
```bash
sudo nano /etc/hosts
```
أضف:
```
127.0.0.1 electronics.localhost
127.0.0.1 furniture.localhost
```

### ثم زر:
- http://electronics.localhost:8000
- http://furniture.localhost:8000

---

## 🚨 حل سريع للمشاكل

### خطأ في Storage
```bash
php artisan storage:link
```

### خطأ في Cache
```bash
php artisan optimize:clear
```

### خطأ في Database
```bash
php artisan migrate:fresh --seed
```

### خطأ في Composer
```bash
composer dump-autoload
```

---

## 📚 للمزيد

- [دليل Multi-Tenancy الكامل](MULTI_TENANCY_GUIDE.md)
- [تعليمات التثبيت المفصلة](INSTALLATION.md)
- [README العربي](README_AR.md)

---

**مبروك! 🎉 أنت جاهز للبدء**

