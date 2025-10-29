<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class ProductDetails extends Component
{
    public Product $product;
    public $currentImageIndex = 0;
    public $showContactInfo = false;

    public function mount(Product $product)
    {
        $this->product = $product;
        $this->product->incrementViews();
    }

    public function nextImage()
    {
        $totalImages = $this->product->getMedia('images')->count();
        if ($totalImages > 0) {
            $this->currentImageIndex = ($this->currentImageIndex + 1) % $totalImages;
        }
    }

    public function previousImage()
    {
        $totalImages = $this->product->getMedia('images')->count();
        if ($totalImages > 0) {
            $this->currentImageIndex = $this->currentImageIndex > 0 
                ? $this->currentImageIndex - 1 
                : $totalImages - 1;
        }
    }

    public function selectImage($index)
    {
        $this->currentImageIndex = $index;
    }

    public function toggleContactInfo()
    {
        $this->showContactInfo = !$this->showContactInfo;
    }

    public $bidAmount = '';

    public function placeBid()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $minBid = $this->product->current_bid + ($this->product->min_bid_increment ?? 1);
        
        $this->validate([
            'bidAmount' => 'required|numeric|min:' . $minBid,
        ], [
            'bidAmount.required' => 'يجب إدخال مبلغ المزايدة',
            'bidAmount.numeric' => 'المبلغ يجب أن يكون رقماً',
            'bidAmount.min' => 'المبلغ يجب أن يكون ' . number_format($minBid) . ' ريال على الأقل',
        ]);

        \App\Models\Bid::create([
            'tenant_id' => session('tenant_id', 1),
            'product_id' => $this->product->id,
            'user_id' => auth()->id(),
            'amount' => $this->bidAmount,
        ]);

        $this->product->update(['current_bid' => $this->bidAmount]);
        $this->product->refresh();
        $this->bidAmount = '';

        session()->flash('message', 'تم تقديم مزايدتك بنجاح!');
    }

    public function render()
    {
        $relatedProducts = Product::where('category_id', $this->product->category_id)
            ->where('id', '!=', $this->product->id)
            ->where('status', true)
            ->with(['category', 'user', 'media'])
            ->limit(4)
            ->get();

        return view('livewire.product-details', [
            'relatedProducts' => $relatedProducts
        ]);
    }
}