<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // $this->call([
        //     TenantSeeder::class,
        //     CategorySeeder::class,
        // ]);

        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password'=>Hash::make('12345678'),
        ]);
    }
}
