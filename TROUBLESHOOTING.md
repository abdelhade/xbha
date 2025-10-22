# حل المشاكل - Troubleshooting

## 🔧 مشاكل شائعة وحلولها

---

## 1. مشكلة Spatie Media Library

### المشكلة
```
Undefined type 'Spatie\MediaLibrary\HasMedia'
Undefined type 'Spatie\MediaLibrary\InteractsWithMedia'
```

### الحل

#### الخطوة 1: تثبيت Package
```bash
composer require spatie/laravel-medialibrary
```

#### الخطوة 2: نشر ملفات الـ Config
```bash
php artisan vendor:publish --provider="Spatie\MediaLibrary\MediaLibraryServiceProvider"
```

#### الخطوة 3: تشغيل Migration
```bash
php artisan migrate
```

#### الخطوة 4: ربط Storage
```bash
php artisan storage:link
```

---

## 2. مشكلة Undefined method 'authorize'

### المشكلة
```
Undefined method 'authorize'
```

### الحل

هذا طبيعي - `authorize()` موجود في Laravel Controllers بشكل افتراضي.

لكن إذا أردت تجنب التحذير، استخدم:

```php
// بدلاً من:
$this->authorize('update', $product);

// استخدم:
if (Gate::denies('update', $product)) {
    abort(403);
}

// أو:
use Illuminate\Support\Facades\Gate;

if (!Gate::allows('update', $product)) {
    abort(403, 'غير مصرح لك بهذا الإجراء');
}
```

---

## 3. مشكلة auth()->id()

### المشكلة
```
Undefined method 'id'
```

### الحل

هذا false positive - `auth()->id()` موجود في Laravel.

لتجنب التحذير:

```php
// بدلاً من:
$userId = auth()->id();

// استخدم:
use Illuminate\Support\Facades\Auth;

$userId = Auth::id();

// أو:
$user = auth()->user();
$userId = $user->id;
```

---

## 4. مشكلة Composer Install

### المشكلة
```
Composer install توقف أو فشل
```

### الحل

#### الطريقة 1: إعادة المحاولة
```bash
composer clear-cache
composer install
```

#### الطريقة 2: تثبيت يدوي
```bash
composer require stancl/tenancy
composer require spatie/laravel-medialibrary
composer dump-autoload
```

#### الطريقة 3: تحديث Composer
```bash
composer self-update
composer update
```

---

## 5. مشكلة Database Connection

### المشكلة
```
SQLSTATE[HY000] [1045] Access denied
```

### الحل

تحقق من `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

#### للتطوير السريع، استخدم SQLite:
```env
DB_CONNECTION=sqlite
DB_DATABASE=D:\laravel\exabha.com\exabha\database\database.sqlite
```

---

## 6. مشكلة Storage Link

### المشكلة
```
The [public/storage] link already exists.
```

### الحل

#### Windows:
```powershell
# احذف الرابط الموجود
Remove-Item public\storage -Force

# أنشئ رابط جديد
php artisan storage:link
```

#### Linux/Mac:
```bash
rm public/storage
php artisan storage:link
```

---

## 7. مشكلة GD Library

### المشكلة
```
GD Library extension not available
```

### الحل

#### Windows (XAMPP/Laragon):
1. افتح `php.ini`
2. ابحث عن `;extension=gd`
3. احذف `;` لتصبح `extension=gd`
4. أعد تشغيل Apache/Server

#### Linux:
```bash
sudo apt-get install php-gd
sudo service apache2 restart
```

#### Mac:
```bash
brew install php-gd
brew services restart php
```

---

## 8. مشكلة Class Not Found

### المشكلة
```
Class 'App\Models\Tenant' not found
```

### الحل

```bash
# أعد بناء Autoload
composer dump-autoload

# امسح Cache
php artisan optimize:clear

# في حالة استمرار المشكلة:
composer install --optimize-autoloader
```

---

## 9. مشكلة Migration Failed

### المشكلة
```
SQLSTATE[42S01]: Base table or view already exists
```

### الحل

#### إعادة بناء قاعدة البيانات:
```bash
# حذر: سيحذف جميع البيانات
php artisan migrate:fresh

# مع Seeders:
php artisan migrate:fresh --seed
```

#### أو rollback ثم migrate:
```bash
php artisan migrate:rollback
php artisan migrate
```

---

## 10. مشكلة Node/NPM

### المشكلة
```
npm ERR! code ENOENT
```

### الحل

```bash
# احذف node_modules
Remove-Item -Recurse -Force node_modules
Remove-Item package-lock.json

# أعد التثبيت
npm install

# إذا استمرت المشكلة:
npm cache clean --force
npm install
```

---

## 11. مشكلة Permission Denied

### المشكلة (Linux/Mac)
```
Permission denied: storage/logs/laravel.log
```

### الحل

```bash
# أعط صلاحيات للمجلدات
chmod -R 775 storage
chmod -R 775 bootstrap/cache

# تغيير المالك
sudo chown -R www-data:www-data storage
sudo chown -R www-data:www-data bootstrap/cache
```

---

## 12. مشكلة Routes Not Found

### المشكلة
```
Route [products.index] not defined
```

### الحل

```bash
# امسح Route Cache
php artisan route:clear

# أعد بناء Routes
php artisan route:cache

# اعرض جميع Routes للتحقق
php artisan route:list
```

---

## 13. مشكلة Tenant Not Found

### المشكلة
```
404 - Tenant not found
```

### الحل

#### تحقق من وجود Tenants:
```bash
php artisan tinker
```

```php
// في Tinker:
Tenant::all();

// إذا لم يوجد أي tenant:
exit

// شغل Seeder:
php artisan db:seed --class=TenantSeeder
```

#### تحقق من الدومين:
```php
// في Tinker:
$tenant = Tenant::findByDomain('electronics.localhost');
if (!$tenant) {
    echo "الدومين غير موجود\n";
}
```

---

## 14. مشكلة Media Upload

### المشكلة
```
The file exceeds the upload_max_filesize directive
```

### الحل

#### تعديل php.ini:
```ini
upload_max_filesize = 10M
post_max_size = 10M
max_execution_time = 300
```

#### في .htaccess (Apache):
```apache
php_value upload_max_filesize 10M
php_value post_max_size 10M
```

---

## 15. مشكلة Vite Not Running

### المشكلة
```
Failed to load resource: net::ERR_CONNECTION_REFUSED
```

### الحل

```bash
# تأكد من تشغيل Vite
npm run dev

# في نافذة منفصلة:
php artisan serve

# إذا استمرت المشكلة:
npm run build
```

---

## 🆘 مشكلة عامة - إعادة ضبط كاملة

إذا واجهت مشاكل متعددة، جرب:

```bash
# 1. مسح جميع الـ Cache
php artisan optimize:clear

# 2. إعادة بناء Composer
composer dump-autoload

# 3. إعادة بناء قاعدة البيانات
php artisan migrate:fresh --seed

# 4. إعادة بناء Node
Remove-Item -Recurse -Force node_modules
npm install

# 5. ربط Storage
php artisan storage:link

# 6. تشغيل
php artisan serve
npm run dev
```

---

## 📝 التحقق من البيئة

### سكريبت فحص شامل

```bash
# في Terminal:
php artisan about

# سيعرض:
# - نسخة PHP
# - نسخة Laravel
# - Database Connection
# - Cache Drivers
# - Queue Connection
# وغيرها...
```

---

## 🐛 Debug Mode

### لعرض الأخطاء بالتفصيل

في `.env`:
```env
APP_DEBUG=true
APP_ENV=local
LOG_LEVEL=debug
```

### عرض SQL Queries

```php
// في AppServiceProvider.php - boot():
use Illuminate\Support\Facades\DB;

DB::listen(function ($query) {
    logger($query->sql, $query->bindings);
});
```

---

## 📞 طلب المساعدة

إذا استمرت المشكلة:

1. تحقق من الـ Logs في `storage/logs/laravel.log`
2. استخدم `php artisan tinker` للاختبار
3. راجع التوثيق في `MULTI_TENANCY_GUIDE.md`
4. اطلع على الأمثلة في `EXAMPLES.md`

---

## ✅ Checklist للتأكد من سلامة التثبيت

```
□ Composer packages مثبتة
□ NPM packages مثبتة
□ .env موجود ومضبوط
□ Database متصل
□ Migrations تم تشغيلها
□ Storage مربوط
□ Seeders تم تشغيلها (اختياري)
□ Cache ممسوح
□ php artisan serve يعمل
□ npm run dev يعمل
□ يمكن فتح localhost:8000
```

---

**💡 نصيحة:** احتفظ بهذا الملف كمرجع سريع لحل المشاكل!

