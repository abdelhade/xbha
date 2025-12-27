<?php

namespace Database\Seeders;

use App\Models\Tenant;
use Illuminate\Database\Seeder;

class TenantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tenants = [
            [
                'name' => 'متجر الإلكترونيات',
                'slug' => 'electronics-store',
                'domain' => 'electronics.localhost',
                'email' => 'electronics@example.com',
                'phone' => '0501234567',
                'status' => true,
            ],
            [
                'name' => 'متجر الأثاث',
                'slug' => 'furniture-store',
                'domain' => 'furniture.localhost',
                'email' => 'furniture@example.com',
                'phone' => '0509876543',
                'status' => true,
            ],
            [
                'name' => 'متجر الملابس',
                'slug' => 'clothing-store',
                'domain' => 'clothing.localhost',
                'email' => 'clothing@example.com',
                'phone' => '0505555555',
                'status' => true,
            ],
        ];

        foreach ($tenants as $tenantData) {
            Tenant::create($tenantData);
        }
    }
}
