<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();
        $categories = Category::all();

        if (!$user || $categories->isEmpty()) {
            return;
        }

        $products = [
            [
                'title' => 'آيفون 14 برو ماكس 256 جيجا',
                'description' => 'آيفون 14 برو ماكس بحالة ممتازة، 256 جيجا، لون أزرق، مع الشاحن والعلبة الأصلية',
                'price' => 4500,
                'condition' => 'like_new',
                'location' => 'الرياض، حي النخيل',
                'category_id' => $categories->where('name', 'الإلكترونيات')->first()?->id ?? 1,
            ],
            [
                'title' => 'لابتوب ديل XPS 13',
                'description' => 'لابتوب ديل XPS 13 بمعالج Intel i7، 16 جيجا رام، 512 SSD، حالة ممتازة',
                'price' => 3200,
                'condition' => 'good',
                'location' => 'جدة، حي الروضة',
                'category_id' => $categories->where('name', 'الإلكترونيات')->first()?->id ?? 1,
            ],
            [
                'title' => 'تويوتا كامري 2020',
                'description' => 'تويوتا كامري موديل 2020، ممشى 45 ألف كم، حالة ممتازة، فحص كامل',
                'price' => 85000,
                'condition' => 'good',
                'location' => 'الدمام، حي الشاطئ',
                'category_id' => $categories->where('name', 'السيارات')->first()?->id ?? 2,
            ],
            [
                'title' => 'شقة للبيع 3 غرف',
                'description' => 'شقة 3 غرف وصالة، 120 متر، الدور الثالث، موقع ممتاز قريب من الخدمات',
                'price' => 450000,
                'condition' => 'good',
                'location' => 'الرياض، حي العليا',
                'category_id' => $categories->where('name', 'العقارات')->first()?->id ?? 3,
            ],
            [
                'title' => 'ساعة أبل الجيل الثامن',
                'description' => 'ساعة أبل الجيل الثامن، 45 مم، لون أسود، مع السوار الرياضي',
                'price' => 1200,
                'condition' => 'new',
                'location' => 'الرياض، حي الملز',
                'category_id' => $categories->where('name', 'الإلكترونيات')->first()?->id ?? 1,
            ],
            [
                'title' => 'دراجة هوائية جبلية',
                'description' => 'دراجة هوائية جبلية، 21 سرعة، حالة ممتازة، مناسبة للرحلات',
                'price' => 800,
                'condition' => 'good',
                'location' => 'جدة، حي الحمراء',
                'category_id' => $categories->where('name', 'الرياضة')->first()?->id ?? 6,
            ],
        ];

        foreach ($products as $productData) {
            Product::create([
                'tenant_id' => 1,
                'user_id' => $user->id,
                'title' => $productData['title'],
                'slug' => Str::slug($productData['title']) . '-' . time() . '-' . rand(1000, 9999),
                'description' => $productData['description'],
                'price' => $productData['price'],
                'condition' => $productData['condition'],
                'location' => $productData['location'],
                'category_id' => $productData['category_id'],
                'status' => true,
                'views_count' => rand(10, 500),
            ]);
        }
    }
}