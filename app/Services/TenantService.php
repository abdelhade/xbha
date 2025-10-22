<?php

namespace App\Services;

use App\Models\Tenant;
use Illuminate\Support\Str;

class TenantService
{
    /**
     * Create a new tenant.
     */
    public function createTenant(array $data): Tenant
    {
        // Generate unique slug
        if (!isset($data['slug'])) {
            $data['slug'] = $this->generateUniqueSlug($data['name']);
        }

        // Set default settings
        $data['settings'] = array_merge([
            'theme' => 'default',
            'currency' => 'SAR',
            'language' => 'ar',
            'products_per_page' => 20,
            'max_images_per_product' => 5,
            'allow_guest_orders' => true,
        ], $data['settings'] ?? []);

        return Tenant::create($data);
    }

    /**
     * Update tenant settings.
     */
    public function updateSettings(Tenant $tenant, array $settings): bool
    {
        $currentSettings = $tenant->settings ?? [];
        $newSettings = array_merge($currentSettings, $settings);

        return $tenant->update(['settings' => $newSettings]);
    }

    /**
     * Generate unique slug.
     */
    protected function generateUniqueSlug(string $name): string
    {
        $slug = Str::slug($name);
        $originalSlug = $slug;
        $count = 1;

        while (Tenant::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        return $slug;
    }

    /**
     * Activate tenant.
     */
    public function activate(Tenant $tenant): bool
    {
        return $tenant->update(['status' => true]);
    }

    /**
     * Deactivate tenant.
     */
    public function deactivate(Tenant $tenant): bool
    {
        return $tenant->update(['status' => false]);
    }

    /**
     * Get tenant statistics.
     */
    public function getStatistics(Tenant $tenant): array
    {
        $previousTenant = Tenant::current();
        Tenant::setCurrent($tenant);

        $stats = [
            'products_count' => $tenant->products()->count(),
            'active_products' => $tenant->products()->where('status', true)->count(),
            'categories_count' => $tenant->categories()->count(),
            'orders_count' => $tenant->orders()->count(),
            'pending_orders' => $tenant->orders()->where('status', 'pending')->count(),
            'completed_orders' => $tenant->orders()->where('status', 'completed')->count(),
            'total_revenue' => $tenant->orders()
                ->where('status', 'completed')
                ->sum('total_amount'),
        ];

        Tenant::setCurrent($previousTenant);

        return $stats;
    }

    /**
     * Delete tenant and all related data.
     */
    public function deleteTenant(Tenant $tenant): bool
    {
        // Delete all media files
        foreach ($tenant->products as $product) {
            $product->clearMediaCollection('images');
            $product->clearMediaCollection('featured');
        }

        foreach ($tenant->categories as $category) {
            $category->clearMediaCollection('icon');
        }

        // Delete tenant (cascade will handle related records)
        return $tenant->delete();
    }
}

