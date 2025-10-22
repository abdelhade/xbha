<?php

namespace App\Http\Middleware;

use App\Models\Tenant;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class InitializeTenant
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Get the current domain
        $domain = $request->getHost();

        // Check if it's a tenant domain
        $tenant = Tenant::findByDomain($domain);

        if ($tenant) {
            // Set the current tenant
            Tenant::setCurrent($tenant);

            // Share tenant with views
            view()->share('currentTenant', $tenant);
        }

        return $next($request);
    }
}

