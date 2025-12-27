<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class ProductsList extends Component
{
    use WithPagination;

    public $search = '';

    public $category_id = '';

    public $condition = '';

    public $min_price = '';

    public $max_price = '';

    public $sort = 'latest';

    protected $queryString = [
        'search' => ['except' => ''],
        'category_id' => ['except' => ''],
        'condition' => ['except' => ''],
        'sort' => ['except' => 'latest'],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingCategoryId()
    {
        $this->resetPage();
    }

    public function updatingCondition()
    {
        $this->resetPage();
    }

    public function updatingSort()
    {
        $this->resetPage();
    }

    public function clearFilters()
    {
        $this->reset(['search', 'category_id', 'condition', 'min_price', 'max_price']);
        $this->resetPage();
    }

    public function render()
    {
        $query = Product::with(['category', 'user', 'media'])
            ->active()
            ->where('tenant_id', session('tenant_id', 1));

        // Search
        if ($this->search) {
            $query->where(function ($q) {
                $q->where('title', 'like', '%'.$this->search.'%')
                    ->orWhere('description', 'like', '%'.$this->search.'%')
                    ->orWhere('location', 'like', '%'.$this->search.'%');
            });
        }

        // Category filter
        if ($this->category_id) {
            $query->where('category_id', $this->category_id);
        }

        // Condition filter
        if ($this->condition) {
            $query->where('condition', $this->condition);
        }

        // Price range
        if ($this->min_price) {
            $query->where('price', '>=', $this->min_price);
        }
        if ($this->max_price) {
            $query->where('price', '<=', $this->max_price);
        }

        // Sorting
        switch ($this->sort) {
            case 'price_low':
                $query->orderBy('price', 'asc');
                break;
            case 'price_high':
                $query->orderBy('price', 'desc');
                break;
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
        }

        return view('livewire.products-list', [
            'products' => $query->paginate(12),
            'categories' => Category::active()->get(),
        ]);
    }
}
