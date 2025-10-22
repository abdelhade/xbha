<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'domain',
        'email',
        'phone',
        'status',
        'settings',
    ];

    protected $casts = [
        'settings' => 'array',
        'status' => 'boolean',
    ];

    /**
     * The current tenant instance.
     */
    protected static ?Tenant $current = null;

    /**
     * Get the current tenant.
     */
    public static function current(): ?Tenant
    {
        return static::$current;
    }

    /**
     * Set the current tenant.
     */
    public static function setCurrent(?Tenant $tenant): void
    {
        static::$current = $tenant;
    }

    /**
     * Get tenant by domain.
     */
    public static function findByDomain(string $domain): ?Tenant
    {
        return static::where('domain', $domain)
            ->where('status', true)
            ->first();
    }

    /**
     * Get all products for this tenant.
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    /**
     * Get all categories for this tenant.
     */
    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    /**
     * Get all orders for this tenant.
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Get the URL for this tenant.
     */
    public function getUrlAttribute(): string
    {
        return $this->domain 
            ? "https://{$this->domain}" 
            : route('tenant.show', $this->slug);
    }
}

