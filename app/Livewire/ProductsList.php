<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ProductsList extends Component
{
    use WithPagination;

    public $search = '';

    public $searchSuggestions = [];

    public $showSearchSuggestions = false;

    public $showQuickView = false;

    public $quickViewProduct = null;

    public $isLoading = false;

    public $compareList = [];

    public $showCompareModal = false;

    public $category_id = '';

    public $condition = '';

    public $min_price = '';

    public $max_price = '';

    public $sort = 'latest';

    public $location = '';

    public $rating = '';

    public $is_auction = '';

    public $has_bids = '';

    protected $queryString = [
        'search' => ['except' => ''],
        'category_id' => ['except' => ''],
        'condition' => ['except' => ''],
        'sort' => ['except' => 'latest'],
        'location' => ['except' => ''],
        'rating' => ['except' => ''],
        'is_auction' => ['except' => ''],
        'has_bids' => ['except' => ''],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
        $this->updateSearchSuggestions();
    }

    public function updateSearchSuggestions()
    {
        if (strlen($this->search) >= 2) {
            $this->searchSuggestions = Product::where('title', 'like', '%'.$this->search.'%')
                ->orWhere('description', 'like', '%'.$this->search.'%')
                ->active()
                ->where('tenant_id', session('tenant_id', 1))
                ->limit(5)
                ->pluck('title')
                ->toArray();
            
            $this->showSearchSuggestions = count($this->searchSuggestions) > 0;
        } else {
            $this->searchSuggestions = [];
            $this->showSearchSuggestions = false;
        }
    }

    public function selectSearchSuggestion($suggestion)
    {
        $this->search = $suggestion;
        $this->showSearchSuggestions = false;
        $this->searchSuggestions = [];
    }

    public function openQuickView($productId)
    {
        $this->quickViewProduct = Product::with(['category', 'user', 'media', 'bids'])
            ->active()
            ->where('tenant_id', session('tenant_id', 1))
            ->find($productId);
        
        if ($this->quickViewProduct) {
            $this->showQuickView = true;
        }
    }

    public function closeQuickView()
    {
        $this->showQuickView = false;
        $this->quickViewProduct = null;
    }

    public function addToCompare($productId)
    {
        if (count($this->compareList) >= 3) {
            $this->dispatch('showNotification', 'يمكنك مقارنة 3 منتجات كحد أقصى', 'error');
            return;
        }

        if (!in_array($productId, $this->compareList)) {
            $this->compareList[] = $productId;
            $this->dispatch('showNotification', 'تمت إضافة المنتج للمقارنة', 'success');
        }
    }

    public function removeFromCompare($productId)
    {
        $this->compareList = array_diff($this->compareList, [$productId]);
        $this->compareList = array_values($this->compareList);
    }

    public function openCompareModal()
    {
        if (count($this->compareList) < 2) {
            $this->dispatch('showNotification', 'اختر منتجين على الأقل للمقارنة', 'error');
            return;
        }
        $this->showCompareModal = true;
    }

    public function closeCompareModal()
    {
        $this->showCompareModal = false;
    }

    public function getCompareProducts()
    {
        if (empty($this->compareList)) {
            return collect();
        }

        return Product::with(['category', 'user', 'media'])
            ->active()
            ->where('tenant_id', session('tenant_id', 1))
            ->whereIn('id', $this->compareList)
            ->get()
            ->keyBy('id');
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

    public function updatingLocation()
    {
        $this->resetPage();
    }

    public function updatingRating()
    {
        $this->resetPage();
    }

    public function updatingIsAuction()
    {
        $this->resetPage();
    }

    public function updatingHasBids()
    {
        $this->resetPage();
    }

    public function clearFilters()
    {
        $this->reset(['search', 'category_id', 'condition', 'min_price', 'max_price', 'location', 'rating', 'is_auction', 'has_bids']);
        $this->resetPage();
    }

    public function toggleWishlist($productId)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        $wishlist = $user->wishlist()
            ->where('product_id', $productId)
            ->where('tenant_id', session('tenant_id', 1))
            ->first();

        if ($wishlist) {
            $wishlist->delete();
            $this->dispatch('wishlistRemoved', $productId);
        } else {
            $user->wishlist()->create([
                'product_id' => $productId,
                'tenant_id' => session('tenant_id', 1)
            ]);
            $this->dispatch('wishlistAdded', $productId);
        }
    }

    public function isInWishlist($productId)
    {
        if (!Auth::check()) {
            return false;
        }

        return Auth::user()->wishlist()
            ->where('product_id', $productId)
            ->where('tenant_id', session('tenant_id', 1))
            ->exists();
    }

    public function render()
    {
        $this->isLoading = true;
        
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

        // Location filter
        if ($this->location) {
            $query->where('location', 'like', '%'.$this->location.'%');
        }

        // Rating filter (assuming you have a ratings relationship)
        if ($this->rating) {
            $query->whereHas('user', function ($q) {
                $q->where('rating', '>=', $this->rating);
            });
        }

        // Auction filter
        if ($this->is_auction !== '') {
            $query->where('is_auction', $this->is_auction === '1');
        }

        // Has bids filter
        if ($this->has_bids === '1') {
            $query->whereHas('bids', function ($q) {
                $q->where('amount', '>', 0);
            });
        } elseif ($this->has_bids === '0') {
            $query->whereDoesntHave('bids');
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

        $products = $query->paginate(12);
        $categories = Category::active()->get();
        
        $this->isLoading = false;

        return view('livewire.products-list', [
            'products' => $products,
            'categories' => $categories,
        ]);
    }
}
