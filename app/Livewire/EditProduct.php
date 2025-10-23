<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditProduct extends Component
{
    use WithFileUploads;

    public Product $product;
    public $title;
    public $category_id;
    public $price;
    public $condition;
    public $location;
    public $description;
    public $status;
    public $newImages = [];
    public $imagesToDelete = [];

    protected $rules = [
        'title' => 'required|string|max:255',
        'category_id' => 'required|exists:categories,id',
        'price' => 'required|numeric|min:0',
        'condition' => 'required|in:new,like_new,good,fair,poor',
        'location' => 'required|string|max:255',
        'description' => 'required|string|min:10',
        'newImages.*' => 'image|max:2048',
    ];

    protected $messages = [
        'title.required' => 'عنوان الإعلان مطلوب',
        'category_id.required' => 'التصنيف مطلوب',
        'price.required' => 'السعر مطلوب',
        'condition.required' => 'حالة المنتج مطلوبة',
        'location.required' => 'الموقع مطلوب',
        'description.required' => 'وصف المنتج مطلوب',
        'description.min' => 'وصف المنتج يجب أن يكون 10 أحرف على الأقل',
        'newImages.*.image' => 'يجب أن تكون الملفات صور',
        'newImages.*.max' => 'حجم الصورة يجب أن يكون أقل من 2 ميجا',
    ];

    public function mount(Product $product)
    {
        // Check if user owns this product
        if ($product->user_id !== auth()->id()) {
            abort(403);
        }

        $this->product = $product;
        $this->title = $product->title;
        $this->category_id = $product->category_id;
        $this->price = $product->price;
        $this->condition = $product->condition;
        $this->location = $product->location;
        $this->description = $product->description;
        $this->status = $product->status;
    }

    public function markImageForDeletion($mediaId)
    {
        if (!in_array($mediaId, $this->imagesToDelete)) {
            $this->imagesToDelete[] = $mediaId;
        }
    }

    public function unmarkImageForDeletion($mediaId)
    {
        $this->imagesToDelete = array_filter($this->imagesToDelete, function($id) use ($mediaId) {
            return $id != $mediaId;
        });
    }

    public function update()
    {
        $this->validate();

        // Update product
        $this->product->update([
            'title' => $this->title,
            'slug' => Str::slug($this->title) . '-' . time(),
            'category_id' => $this->category_id,
            'price' => $this->price,
            'condition' => $this->condition,
            'location' => $this->location,
            'description' => $this->description,
            'status' => $this->status,
        ]);

        // Delete marked images
        if (!empty($this->imagesToDelete)) {
            foreach ($this->imagesToDelete as $mediaId) {
                $media = $this->product->getMedia('images')->where('id', $mediaId)->first();
                if ($media) {
                    $media->delete();
                }
            }
        }

        // Add new images
        if ($this->newImages) {
            foreach ($this->newImages as $image) {
                $this->product->addMediaFromStream($image->stream())
                    ->usingName($image->getClientOriginalName())
                    ->toMediaCollection('images');
            }
        }

        session()->flash('message', 'تم تحديث الإعلان بنجاح');
        
        return redirect()->route('dashboard');
    }

    public function render()
    {
        return view('livewire.edit-product', [
            'categories' => Category::active()->get(),
            'existingImages' => $this->product->getMedia('images')
        ]);
    }
}