<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DemoDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get first tenant
        $tenant = Tenant::first();
        
        if (!$tenant) {
            $this->command->error('No tenants found. Please run TenantSeeder first.');
            return;
        }

        // Set current tenant
        Tenant::setCurrent($tenant);

        // Create demo user
        $user = User::create([
            'tenant_id' => $tenant->id,
            'name' => 'مستخدم تجريبي',
            'email' => 'demo@example.com',
            'password' => Hash::make('password'),
        ]);

        // Create categories
        $categories = [
            ['name' => 'إلكترونيات', 'slug' => 'electronics', 'description' => 'جميع المنتجات الإلكترونية'],
            ['name' => 'هواتف', 'slug' => 'phones', 'description' => 'هواتف ذكية وأجهزة محمولة'],
            ['name' => 'أجهزة كمبيوتر', 'slug' => 'computers', 'description' => 'أجهزة كمبيوتر ولابتوب'],
            ['name' => 'أثاث', 'slug' => 'furniture', 'description' => 'أثاث منزلي ومكتبي'],
            ['name' => 'ملابس', 'slug' => 'clothing', 'description' => 'ملابس رجالي ونسائي'],
            ['name' => 'سيارات', 'slug' => 'cars', 'description' => 'سيارات وقطع غيار'],
            ['name' => 'عقارات', 'slug' => 'real-estate', 'description' => 'شقق وفلل للبيع والإيجار'],
        ];

        foreach ($categories as $categoryData) {
            $categoryData['tenant_id'] = $tenant->id;
            Category::create($categoryData);
        }

        // Create demo products
        $phonesCategory = Category::where('slug', 'phones')->first();
        $computersCategory = Category::where('slug', 'computers')->first();

        $products = [
            [
                'category_id' => $phonesCategory->id,
                'title' => 'آيفون 13 برو مستعمل',
                'slug' => 'iphone-13-pro-used',
                'description' => 'آيفون 13 برو بحالة ممتازة، 256 جيجا، لون أزرق سييرا',
                'price' => 3500.00,
                'condition' => 'like_new',
                'location' => 'الرياض',
            ],
            [
                'category_id' => $phonesCategory->id,
                'title' => 'سامسونج جالاكسي S22',
                'slug' => 'samsung-galaxy-s22',
                'description' => 'سامسونج جالاكسي S22، 128 جيجا، بحالة جيدة جداً',
                'price' => 2200.00,
                'condition' => 'good',
                'location' => 'جدة',
            ],
            [
                'category_id' => $computersCategory->id,
                'title' => 'لابتوب Dell XPS 15',
                'slug' => 'dell-xps-15',
                'description' => 'لابتوب Dell XPS 15، معالج i7، رام 16 جيجا، SSD 512',
                'price' => 4500.00,
                'condition' => 'like_new',
                'location' => 'الدمام',
            ],
            [
                'category_id' => $computersCategory->id,
                'title' => 'MacBook Pro 2021',
                'slug' => 'macbook-pro-2021',
                'description' => 'MacBook Pro 2021، M1 Pro، 16 جيجا رام، 512 SSD',
                'price' => 7500.00,
                'condition' => 'like_new',
                'location' => 'الرياض',
            ],
        ];

        foreach ($products as $productData) {
            $productData['tenant_id'] = $tenant->id;
            $productData['user_id'] = $user->id;
            Product::create($productData);
        }

        $this->command->info('Demo data created successfully!');
    }
}

