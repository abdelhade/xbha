<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class AdminProductApprovalTest extends TestCase
{
    use RefreshDatabase;

    public function test_non_admin_cannot_see_unapproved_product()
    {
        $user = User::factory()->create();

        $tenant = \App\Models\Tenant::create(['name' => 'TestTenant', 'slug' => 'testtenant', 'email' => 'tenant@example.test']);
        $category = \App\Models\Category::create(['tenant_id' => $tenant->id, 'name' => 'TestCat', 'slug' => 'testcat']);

        $product = Product::create([
            'tenant_id' => session('tenant_id', 1),
            'category_id' => $category->id,
            'user_id' => $user->id,
            'title' => 'Test Product',
            'slug' => 'test-product',
            'description' => 'desc',
            'price' => 10,
            'condition' => 'good',
            'status' => false,
        ]);

        $this->get(route('products.show', $product))->assertStatus(404);
    }

    public function test_admin_can_approve_product_and_notification_sent_and_audit_created()
    {
        Notification::fake();

        $admin = User::factory()->create();
        Role::create(['name' => 'admin']);
        $admin->assignRole('admin');

        $user = User::factory()->create();

        $tenant = \App\Models\Tenant::create(['name' => 'MainTenant', 'slug' => 'maintenant', 'email' => 'main@example.test']);
        $category = \App\Models\Category::create(['tenant_id' => $tenant->id, 'name' => 'MainCat', 'slug' => 'maincat']);

        $product = Product::create([
            'tenant_id' => session('tenant_id', 1),
            'category_id' => $category->id,
            'user_id' => $user->id,
            'title' => 'Pending Product',
            'slug' => 'pending-product',
            'description' => 'pending',
            'price' => 20,
            'condition' => 'good',
            'status' => false,
        ]);

        $this->actingAs($admin)->post(route('admin.products.approve', $product));

        $this->assertTrue(Product::find($product->id)->status);

        Notification::assertSentTo([$user], \App\Notifications\ProductApproved::class);

        $this->assertDatabaseHas('product_approvals', [
            'product_id' => $product->id,
            'admin_id' => $admin->id,
            'action' => 'approved',
        ]);
    }
}
