<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;

class SalesList extends Component
{
    use WithPagination;

    public $statusFilter = 'all';

    public function render()
    {
        $query = Order::with(['product', 'buyer', 'seller'])
            ->where('seller_id', auth()->id())
            ->latest();

        if ($this->statusFilter !== 'all') {
            $query->where('status', $this->statusFilter);
        }

        $orders = $query->paginate(10);

        return view('livewire.sales-list', compact('orders'));
    }
}
