<?php

namespace App\Models;

use App\Traits\TenantScoped;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Product extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, SoftDeletes, TenantScoped;

    protected $fillable = [
        'tenant_id',
        'category_id',
        'user_id',
        'title',
        'slug',
        'description',
        'price',
        'condition',
        'status',
        'views_count',
        'location',
        'is_featured',
        'featured_until',
        'is_auction',
        'starting_price',
        'current_bid',
        'auction_ends_at',
        'min_bid_increment',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_featured' => 'boolean',
        'featured_until' => 'datetime',
        'status' => 'boolean',
        'views_count' => 'integer',
        'is_auction' => 'boolean',
        'starting_price' => 'decimal:2',
        'current_bid' => 'decimal:2',
        'auction_ends_at' => 'datetime',
        'min_bid_increment' => 'decimal:2',
    ];

    /**
     * Product conditions
     */
    public const CONDITION_NEW = 'new';

    public const CONDITION_LIKE_NEW = 'like_new';

    public const CONDITION_GOOD = 'good';

    public const CONDITION_FAIR = 'fair';

    public const CONDITION_POOR = 'poor';

    /**
     * Register media collections
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('images')
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp'])
            ->useDisk('public');

        $this->addMediaCollection('featured')
            ->singleFile()
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp'])
            ->useDisk('public');
    }

    /**
     * Get the category that owns the product.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the user that owns the product.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the orders for the product.
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Scope a query to only include active products.
     */
    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    /**
     * Scope a query to only include featured products.
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true)
            ->where('featured_until', '>', now());
    }

    /**
     * Increment views count
     */
    public function incrementViews()
    {
        $this->increment('views_count');
    }

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function bids()
    {
        return $this->hasMany(Bid::class);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }
}
