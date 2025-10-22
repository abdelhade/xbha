# أوامر مفيدة - Laravel Multi-Tenancy

## 🚀 أوامر التشغيل

### تشغيل المشروع
```bash
# تشغيل Laravel Server
php artisan serve

# تشغيل على port معين
php artisan serve --port=8080

# تشغيل على host معين
php artisan serve --host=0.0.0.0

# تشغيل Vite (Frontend)
npm run dev

# تشغيل Queue Worker
php artisan queue:work

# تشغيل Queue في الخلفية
php artisan queue:work --daemon
```

---

## 🗄️ أوامر قاعدة البيانات

### Migrations
```bash
# تشغيل جميع Migrations
php artisan migrate

# التراجع عن آخر batch
php artisan migrate:rollback

# التراجع عن جميع Migrations
php artisan migrate:reset

# إعادة تشغيل جميع Migrations
php artisan migrate:refresh

# مسح وإعادة البناء مع Seeders
php artisan migrate:fresh --seed

# التحقق من حالة Migrations
php artisan migrate:status

# إنشاء migration جديد
php artisan make:migration create_table_name
```

### Seeders
```bash
# تشغيل جميع Seeders
php artisan db:seed

# تشغيل Seeder معين
php artisan db:seed --class=TenantSeeder

# إنشاء Seeder جديد
php artisan make:seeder TenantSeeder
```

---

## 🧹 أوامر التنظيف

### مسح Cache
```bash
# مسح جميع أنواع الـ Cache
php artisan optimize:clear

# مسح Application Cache
php artisan cache:clear

# مسح Config Cache
php artisan config:clear

# مسح Route Cache
php artisan route:clear

# مسح View Cache
php artisan view:clear

# مسح Compiled Classes
php artisan clear-compiled

# مسح Event Cache
php artisan event:clear
```

### بناء Cache (للإنتاج)
```bash
# Cache Config
php artisan config:cache

# Cache Routes
php artisan route:cache

# Cache Views
php artisan view:cache

# Cache Events
php artisan event:cache

# تحسين التطبيق (يشمل جميع ما سبق)
php artisan optimize
```

---

## 🎨 أوامر Frontend

### Vite/NPM
```bash
# تثبيت Dependencies
npm install

# تشغيل Development Server
npm run dev

# بناء للإنتاج
npm run build

# مسح node_modules وإعادة التثبيت
rm -rf node_modules package-lock.json
npm install
```

---

## 🛠️ أوامر إنشاء الملفات

### Models
```bash
# إنشاء Model
php artisan make:model Product

# Model مع Migration
php artisan make:model Product -m

# Model مع Controller و Migration
php artisan make:model Product -mc

# Model مع كل شيء
php artisan make:model Product -mcr
# m = migration, c = controller, r = resource controller
```

### Controllers
```bash
# إنشاء Controller
php artisan make:controller ProductController

# Resource Controller
php artisan make:controller ProductController --resource

# API Controller
php artisan make:controller API/ProductController --api

# Invokable Controller
php artisan make:controller ProductController --invokable
```

### Middleware
```bash
# إنشاء Middleware
php artisan make:middleware EnsureTenantExists
```

### Requests
```bash
# إنشاء Form Request
php artisan make:request StoreProductRequest
```

### Policies
```bash
# إنشاء Policy
php artisan make:policy ProductPolicy

# Policy لـ Model معين
php artisan make:policy ProductPolicy --model=Product
```

### Jobs
```bash
# إنشاء Job
php artisan make:job ProcessOrder
```

### Events
```bash
# إنشاء Event
php artisan make:event OrderCreated

# إنشاء Listener
php artisan make:listener SendOrderNotification
```

### Mail
```bash
# إنشاء Mailable
php artisan make:mail OrderShipped
```

### Notifications
```bash
# إنشاء Notification
php artisan make:notification OrderShipped
```

---

## 🔍 أوامر الفحص

### Routes
```bash
# عرض جميع Routes
php artisan route:list

# عرض Routes لـ URL معين
php artisan route:list --path=products

# عرض Routes لـ Middleware معين
php artisan route:list --middleware=auth

# عرض Routes بترتيب URI
php artisan route:list --sort=uri
```

### Info
```bash
# معلومات التطبيق
php artisan about

# معلومات البيئة
php artisan env

# قائمة الأوامر المتاحة
php artisan list

# مساعدة لأمر معين
php artisan help migrate
```

---

## 🧪 أوامر Tinker (التجربة)

### تشغيل Tinker
```bash
php artisan tinker
```

### أمثلة في Tinker
```php
// عرض جميع المتاجر
Tenant::all();

// إنشاء متجر
$tenant = Tenant::create(['name' => 'Test', 'slug' => 'test', 'email' => 'test@test.com']);

// ضبط المتجر الحالي
Tenant::setCurrent($tenant);

// عد المنتجات
Product::count();

// جلب منتج
$product = Product::first();

// عرض خصائص المنتج
$product->toArray();

// الخروج من Tinker
exit
```

---

## 📦 أوامر Composer

```bash
# تثبيت Dependencies
composer install

# تحديث Dependencies
composer update

# تثبيت package جديد
composer require vendor/package

# إزالة package
composer remove vendor/package

# Dump Autoload
composer dump-autoload

# تحسين Autoloader
composer install --optimize-autoloader --no-dev
```

---

## 🖼️ أوامر Storage

```bash
# ربط Storage مع Public
php artisan storage:link

# مسح جميع ملفات Storage (حذر!)
# يدوياً: احذف storage/app/public/*
```

---

## 👥 أوامر المستخدمين

```bash
# إنشاء مستخدم (في Tinker)
php artisan tinker
User::create(['name' => 'Admin', 'email' => 'admin@test.com', 'password' => Hash::make('password')]);
```

---

## 🎯 أوامر خاصة بالمشروع

### إنشاء متجر تجريبي
```bash
php artisan db:seed --class=TenantSeeder
```

### إنشاء بيانات تجريبية
```bash
php artisan db:seed --class=DemoDataSeeder
```

### إعادة البناء الكامل
```bash
php artisan migrate:fresh --seed
php artisan db:seed --class=TenantSeeder
php artisan db:seed --class=DemoDataSeeder
php artisan storage:link
php artisan optimize:clear
```

---

## 🔐 أوامر الأمان

```bash
# توليد Application Key
php artisan key:generate

# توليد JWT Secret (إذا كنت تستخدم JWT)
php artisan jwt:secret
```

---

## 🌐 أوامر متقدمة

### Queue
```bash
# عمل جدول Jobs
php artisan queue:table
php artisan migrate

# تشغيل Queue Worker
php artisan queue:work

# إعادة تشغيل Workers
php artisan queue:restart

# عرض Failed Jobs
php artisan queue:failed

# إعادة تشغيل Failed Job
php artisan queue:retry {id}

# إعادة تشغيل جميع Failed Jobs
php artisan queue:retry all

# مسح Failed Jobs
php artisan queue:flush
```

### Schedule
```bash
# تشغيل المهام المجدولة (مرة واحدة)
php artisan schedule:run

# عرض المهام المجدولة
php artisan schedule:list
```

### Maintenance Mode
```bash
# تفعيل Maintenance Mode
php artisan down

# تفعيل مع رسالة
php artisan down --message="نقوم بالصيانة"

# تفعيل مع سماح بـ IP معين
php artisan down --allow=127.0.0.1

# إيقاف Maintenance Mode
php artisan up
```

---

## 🧰 سكريبت تنظيف شامل

### Windows (PowerShell)
```powershell
php artisan optimize:clear
composer dump-autoload
Remove-Item -Recurse -Force node_modules
npm install
npm run build
php artisan migrate:fresh --seed
php artisan storage:link
```

### Linux/Mac (Bash)
```bash
php artisan optimize:clear && \
composer dump-autoload && \
rm -rf node_modules package-lock.json && \
npm install && \
npm run build && \
php artisan migrate:fresh --seed && \
php artisan storage:link
```

---

## 📊 أوامر إحصائية

### في Tinker
```php
// عدد المتاجر
Tenant::count();

// عدد المنتجات النشطة
Product::where('status', true)->count();

// إجمالي الطلبات المكتملة
Order::where('status', 'completed')->count();

// إجمالي المبيعات
Order::where('status', 'completed')->sum('total_amount');

// أحدث 10 منتجات
Product::latest()->take(10)->get();
```

---

## 🎓 نصائح مفيدة

### Alias مفيد (اختياري)
أضف إلى `.bashrc` أو `.zshrc`:
```bash
alias pa='php artisan'
alias pam='php artisan migrate'
alias pas='php artisan serve'
alias pat='php artisan tinker'
```

بعدها يمكنك استخدام:
```bash
pa serve
pam
pat
```

---

**💡 نصيحة:** احفظ هذا الملف في المفضلة للرجوع إليه!

