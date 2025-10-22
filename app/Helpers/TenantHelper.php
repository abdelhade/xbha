<?php

namespace App\Helpers;

use App\Models\Tenant;

class TenantHelper
{
    /**
     * Get the current tenant.
     */
    public static function current(): ?Tenant
    {
        return Tenant::current();
    }

    /**
     * Check if we're in a tenant context.
     */
    public static function inTenantContext(): bool
    {
        return Tenant::current() !== null;
    }

    /**
     * Get tenant setting value.
     */
    public static function setting(string $key, $default = null)
    {
        $tenant = self::current();

        if (!$tenant) {
            return $default;
        }

        $settings = $tenant->settings ?? [];

        return $settings[$key] ?? $default;
    }

    /**
     * Get tenant URL.
     */
    public static function url(): ?string
    {
        $tenant = self::current();

        if (!$tenant) {
            return null;
        }

        return $tenant->url;
    }

    /**
     * Get tenant name.
     */
    public static function name(): ?string
    {
        $tenant = self::current();

        return $tenant?->name;
    }

    /**
     * Execute code in tenant context.
     */
    public static function run(Tenant $tenant, callable $callback)
    {
        $previousTenant = self::current();
        
        try {
            Tenant::setCurrent($tenant);
            return $callback($tenant);
        } finally {
            Tenant::setCurrent($previousTenant);
        }
    }

    /**
     * Execute code for each tenant.
     */
    public static function each(callable $callback)
    {
        $tenants = Tenant::where('status', true)->get();

        foreach ($tenants as $tenant) {
            self::run($tenant, $callback);
        }
    }
}

