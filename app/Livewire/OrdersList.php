<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;

class OrdersList extends Component
{
    use WithPagination;

    public $statusFilter = 'all';

    public function render()
    {
        $query = Order::with(['product', 'buyer', 'seller'])
            ->where('buyer_id', auth()->id())
            ->latest();

        if ($this->statusFilter !== 'all') {
            $query->where('status', $this->statusFilter);
        }

        $orders = $query->paginate(10);

        return view('livewire.orders-list', compact('orders'));
    }
}
