<?php

namespace App\View\Components;

use App\Models\Tenant;
use Illuminate\View\Component;

class TenantLayout extends Component
{
    public ?Tenant $tenant;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->tenant = Tenant::current();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('components.tenant-layout');
    }
}
