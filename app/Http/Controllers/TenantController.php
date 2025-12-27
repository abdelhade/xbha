<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TenantController extends Controller
{
    /**
     * Display a listing of tenants.
     */
    public function index()
    {
        $tenants = Tenant::latest()->paginate(20);

        return view('tenants.index', compact('tenants'));
    }

    /**
     * Show the form for creating a new tenant.
     */
    public function create()
    {
        return view('tenants.create');
    }

    /**
     * Store a newly created tenant.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:tenants',
            'phone' => 'nullable|string|max:20',
            'domain' => 'nullable|string|unique:tenants|regex:/^[a-z0-9-]+$/',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        // Ensure slug is unique
        $originalSlug = $validated['slug'];
        $count = 1;
        while (Tenant::where('slug', $validated['slug'])->exists()) {
            $validated['slug'] = $originalSlug.'-'.$count;
            $count++;
        }

        $tenant = Tenant::create($validated);

        return redirect()
            ->route('tenants.show', $tenant)
            ->with('success', 'تم إنشاء المتجر بنجاح!');
    }

    /**
     * Display the specified tenant.
     */
    public function show(Tenant $tenant)
    {
        $tenant->load(['products' => function ($query) {
            $query->latest()->take(10);
        }]);

        return view('tenants.show', compact('tenant'));
    }

    /**
     * Show the form for editing the tenant.
     */
    public function edit(Tenant $tenant)
    {
        return view('tenants.edit', compact('tenant'));
    }

    /**
     * Update the specified tenant.
     */
    public function update(Request $request, Tenant $tenant)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:tenants,email,'.$tenant->id,
            'phone' => 'nullable|string|max:20',
            'domain' => 'nullable|string|unique:tenants,domain,'.$tenant->id.'|regex:/^[a-z0-9-]+$/',
            'status' => 'boolean',
        ]);

        $tenant->update($validated);

        return redirect()
            ->route('tenants.show', $tenant)
            ->with('success', 'تم تحديث المتجر بنجاح!');
    }

    /**
     * Remove the specified tenant.
     */
    public function destroy(Tenant $tenant)
    {
        $tenant->delete();

        return redirect()
            ->route('tenants.index')
            ->with('success', 'تم حذف المتجر بنجاح!');
    }
}
