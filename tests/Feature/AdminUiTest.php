<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class AdminUiTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_sees_admin_link_in_navbar()
    {
        $admin = User::factory()->create();
        Role::create(['name' => 'admin']);
        $admin->assignRole('admin');

        $this->actingAs($admin)->get('/')->assertSee('لوحة التحكم');
    }

    public function test_admin_can_open_settings_and_save()
    {
        $admin = User::factory()->create();
        Role::create(['name' => 'admin']);
        $admin->assignRole('admin');

        $this->actingAs($admin)->get(route('admin.settings'))->assertStatus(200)->assertSee('إعدادات لوحة الأدمن');

        $this->actingAs($admin)->post(route('admin.settings.update'), [
            'site_name' => 'Test Site',
            'support_email' => 'support@example.test',
            'sms_notifications' => 1,
        ])->assertRedirect();
    }
}
