# تعليمات التثبيت - موقع بيع المستعمل Multi-Tenancy

## المتطلبات

- PHP >= 8.2
- Composer
- MySQL/MariaDB أو SQLite
- Node.js & NPM (للـ Frontend)
- GD Library أو Imagick (للصور)

## خطوات التثبيت

### 1. استنساخ المشروع

```bash
cd d:\laravel\exabha.com\exabha
```

### 2. تثبيت Dependencies

```bash
# تثبيت PHP packages
composer install

# تثبيت Node packages
npm install
```

### 3. إعداد ملف البيئة

```bash
# نسخ ملف البيئة
copy .env.example .env

# توليد مفتاح التطبيق
php artisan key:generate
```

### 4. تكوين قاعدة البيانات

افتح ملف `.env` وعدّل الإعدادات:

```env
# لـ MySQL
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=exabha_db
DB_USERNAME=root
DB_PASSWORD=

# أو لـ SQLite (للتطوير)
DB_CONNECTION=sqlite
DB_DATABASE=D:\laravel\exabha.com\exabha\database\database.sqlite
```

### 5. إنشاء قاعدة البيانات

#### MySQL:
```sql
CREATE DATABASE exabha_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

#### SQLite:
```bash
# الملف موجود بالفعل
# إذا لم يكن موجوداً:
type nul > database\database.sqlite
```

### 6. تشغيل Migrations

```bash
php artisan migrate
```

سيتم إنشاء الجداول التالية:
- `tenants` - المتاجر
- `users` - المستخدمين
- `categories` - التصنيفات
- `products` - المنتجات
- `orders` - الطلبات
- `media` - الوسائط والصور
- جداول Laravel الافتراضية

### 7. إنشاء بيانات تجريبية (اختياري)

```bash
# إنشاء متاجر تجريبية
php artisan db:seed --class=TenantSeeder

# إنشاء منتجات وتصنيفات تجريبية
php artisan db:seed --class=DemoDataSeeder
```

هذا سينشئ:
- 3 متاجر تجريبية
- مستخدم تجريبي (demo@example.com / password)
- 7 تصنيفات
- 4 منتجات

### 8. ربط Storage

```bash
php artisan storage:link
```

### 9. تجميع Assets

```bash
# للتطوير
npm run dev

# أو للإنتاج
npm run build
```

### 10. تشغيل المشروع

```bash
php artisan serve
```

الموقع سيكون متاحاً على: `http://localhost:8000`

## التحقق من التثبيت

### 1. الصفحة الرئيسية
زر: `http://localhost:8000`

### 2. إدارة المتاجر
زر: `http://localhost:8000/admin/tenants`

### 3. المنتجات
زر: `http://localhost:8000/products`

## إعداد المتاجر للتطوير المحلي

### استخدام Domains محلية

قم بتعديل ملف `hosts`:

**Windows:** `C:\Windows\System32\drivers\etc\hosts`

أضف:
```
127.0.0.1 electronics.localhost
127.0.0.1 furniture.localhost
127.0.0.1 clothing.localhost
```

الآن يمكنك زيارة:
- `http://electronics.localhost:8000`
- `http://furniture.localhost:8000`
- `http://clothing.localhost:8000`

## إعداد الصلاحيات (Linux/Mac)

```bash
# صلاحيات Storage و Cache
chmod -R 775 storage
chmod -R 775 bootstrap/cache

# تغيير المالك (إذا لزم)
chown -R www-data:www-data storage
chown -R www-data:www-data bootstrap/cache
```

## تكوينات إضافية

### 1. إعداد الميديا

في `.env`:
```env
FILESYSTEM_DISK=public
```

### 2. إعداد Mail (للإشعارات)

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@exabha.com"
MAIL_FROM_NAME="${APP_NAME}"
```

### 3. إعداد Queue (للمهام الخلفية)

```env
QUEUE_CONNECTION=database
```

ثم شغل Queue Worker:
```bash
php artisan queue:work
```

## حل المشاكل الشائعة

### 1. خطأ في الصور

```bash
# تأكد من ربط storage
php artisan storage:link

# تحقق من الصلاحيات
icacls storage /grant Everyone:F /t
```

### 2. خطأ في قاعدة البيانات

```bash
# امسح البيانات وأعد الإنشاء
php artisan migrate:fresh --seed
```

### 3. خطأ في الـ Cache

```bash
# امسح جميع الـ Cache
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear
```

### 4. خطأ في Composer

```bash
# أعد تثبيت Dependencies
composer install --no-cache
composer dump-autoload
```

### 5. مشكلة في GD Library

إذا واجهت خطأ في معالجة الصور:

**Windows (XAMPP):**
- افتح `php.ini`
- أزل `;` من أمام `extension=gd`
- أعد تشغيل Apache

**Linux:**
```bash
sudo apt-get install php-gd
sudo service apache2 restart
```

## اختبار النظام

### اختبار عزل البيانات

```bash
# شغل Laravel Tinker
php artisan tinker
```

```php
// جرب:
$tenant1 = Tenant::find(1);
Tenant::setCurrent($tenant1);
$products1 = Product::all();
echo $products1->count();

$tenant2 = Tenant::find(2);
Tenant::setCurrent($tenant2);
$products2 = Product::all();
echo $products2->count();

// يجب أن تحصل على أعداد مختلفة
```

## الخطوات التالية

1. ✅ تسجيل الدخول بالمستخدم التجريبي
2. ✅ إضافة منتج جديد
3. ✅ رفع صور للمنتج
4. ✅ إنشاء تصنيف جديد
5. ✅ إنشاء طلب
6. ✅ تجربة البحث والفلترة

## البيئة الإنتاجية (Production)

### تحسينات الأداء

```bash
# تحسين Autoloader
composer install --optimize-autoloader --no-dev

# Cache الإعدادات
php artisan config:cache
php artisan route:cache
php artisan view:cache

# تجميع Assets
npm run build
```

### أمان إضافي

في `.env`:
```env
APP_DEBUG=false
APP_ENV=production
```

### SSL Certificate

استخدم Let's Encrypt للحصول على شهادة SSL مجانية.

## الدعم

للمساعدة:
1. راجع ملف `MULTI_TENANCY_GUIDE.md`
2. تحقق من الـ Logs في `storage/logs/laravel.log`
3. استخدم `php artisan route:list` لعرض جميع الـ Routes

---

**مبروك! 🎉 تم تثبيت النظام بنجاح**

