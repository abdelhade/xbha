<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product;

class ProductsList extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;
    public $confirming = null;
    public $filter = 'all';

    protected $listeners = ['productSaved' => 'render'];

    public function mount()
    {
        $this->filter = request()->query('filter', 'all');
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function setFilter($filter)
    {
        $this->filter = $filter;
        $this->resetPage();
    }

    public function confirmDelete($id)
    {
        $this->confirming = $id;
    }

    public function deleteProduct($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        $this->confirming = null;
        session()->flash('message', 'تم حذف المنتج');
    }

    public function approveProduct($id)
    {
        $product = Product::findOrFail($id);
        $product->update(['status' => true]);

        // Create approval audit
        \App\Models\ProductApproval::create([
            'product_id' => $product->id,
            'admin_id' => auth()->id() ?? null,
            'action' => 'approved',
            'note' => null,
        ]);

        // notify owner
        if ($product->user) {
            $product->user->notify(new \App\Notifications\ProductApproved($product));
        }
        $this->confirming = null;
        session()->flash('message', 'تم نشر المنتج');
        $this->emit('productSaved');
    }

    public function render()
    {
        $query = Product::with(['category', 'user'])
            ->where(function ($q) {
                $q->where('title', 'like', "%{$this->search}%")
                  ->orWhere('description', 'like', "%{$this->search}%");
            });

        if ($this->filter === 'pending') {
            $query->where('status', false);
        } elseif ($this->filter === 'published') {
            $query->where('status', true);
        }

        $products = $query->latest()->paginate($this->perPage);

        return view('livewire.admin.products-list', [
            'products' => $products,
        ]);
    }
}
