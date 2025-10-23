<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'الإلكترونيات',
            'السيارات',
            'العقارات',
            'الأزياء',
            'المنزل والحديقة',
            'الرياضة',
            'الكتب',
            'الألعاب',
        ];

        foreach ($categories as $category) {
            Category::create([
                'tenant_id' => 1,
                'name' => $category,
                'slug' => Str::slug($category),
                'status' => true,
                'order' => 0,
            ]);
        }
    }
}