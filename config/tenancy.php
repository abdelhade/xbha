<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Tenant Model
    |--------------------------------------------------------------------------
    |
    | The model that represents a tenant in your application.
    |
    */

    'tenant_model' => \App\Models\Tenant::class,

    /*
    |--------------------------------------------------------------------------
    | Tenant Column
    |--------------------------------------------------------------------------
    |
    | The column name used to identify the tenant in multi-tenant tables.
    |
    */

    'tenant_column' => 'tenant_id',

    /*
    |--------------------------------------------------------------------------
    | Central Domains
    |--------------------------------------------------------------------------
    |
    | Domains that should not be treated as tenant domains.
    |
    */

    'central_domains' => [
        'localhost',
        '127.0.0.1',
        env('APP_URL'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Exempt Tables
    |--------------------------------------------------------------------------
    |
    | Tables that should not be scoped to tenants.
    |
    */

    'exempt_tables' => [
        'tenants',
        'migrations',
        'password_reset_tokens',
        'sessions',
        'cache',
        'cache_locks',
        'jobs',
        'job_batches',
        'failed_jobs',
    ],

];

