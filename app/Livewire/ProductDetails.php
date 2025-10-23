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