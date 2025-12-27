<?php

namespace App\Traits;

use App\Models\Tenant;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

trait TenantScoped
{
    /**
     * Boot the tenant scoped trait for a model.
     */
    protected static function bootTenantScoped(): void
    {
        // Add tenant_id when creating
        static::creating(function (Model $model) {
            if (! $model->getAttribute('tenant_id') && Tenant::current()) {
                $model->setAttribute('tenant_id', Tenant::current()->id);
            }
        });

        // Global scope for all queries
        static::addGlobalScope('tenant', function (Builder $builder) {
            if (Tenant::current()) {
                $builder->where('tenant_id', Tenant::current()->id);
            }
        });
    }

    /**
     * Get the tenant that owns the model.
     */
    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
}
