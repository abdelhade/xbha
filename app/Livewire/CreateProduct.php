<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateProduct extends Component
{
    use WithFileUploads;

    public $title = '';
    public $category_id = '';
    public $price = '';
    public $condition = '';
    public $location = '';
    public $description = '';
    public $images = [];
    public $status = true;

    protected $rules = [
        'title' => 'required|string|max:255',
        'category_id' => 'required|exists:categories,id',
        'price' => 'required|numeric|min:0',
        'condition' => 'required|in:new,like_new,good,fair,poor',
        'location' => 'required|string|max:255',
        'description' => 'required|string|min:10',
        'images.*' => 'image|max:2048',
    ];

    protected $messages = [
        'title.required' => 'عنوان الإعلان مطلوب',
        'category_id.required' => 'التصنيف مطلوب',
        'price.required' => 'السعر مطلوب',
        'condition.required' => 'حالة المنتج مطلوبة',
        'location.required' => 'الموقع مطلوب',
        'description.required' => 'وصف المنتج مطلوب',
        'description.min' => 'وصف المنتج يجب أن يكون 10 أحرف على الأقل',
        'images.*.image' => 'يجب أن تكون الملفات صور',
        'images.*.max' => 'حجم الصورة يجب أن يكون أقل من 2 ميجا',
    ];

    public function save($isDraft = false)
    {
        $this->status = !$isDraft;
        $this->validate();

        $product = Product::create([
            'user_id' => auth()->id(),
            'tenant_id' => session('tenant_id', 1),
            'title' => $this->title,
            'slug' => Str::slug($this->title) . '-' . time(),
            'category_id' => $this->category_id,
            'price' => $this->price,
            'condition' => $this->condition,
            'location' => $this->location,
            'description' => $this->description,
            'status' => $this->status,
        ]);

        // Upload images
        if ($this->images) {
            foreach ($this->images as $image) {
                $product->addMediaFromStream($image->stream())
                    ->usingName($image->getClientOriginalName())
                    ->toMediaCollection('images');
            }
        }

        session()->flash('message', $isDraft ? 'تم حفظ الإعلان كمسودة' : 'تم نشر الإعلان بنجاح');
        
        return redirect()->route('dashboard');
    }

    public function saveDraft()
    {
        return $this->save(true);
    }

    public function render()
    {
        return view('livewire.create-product', [
            'categories' => Category::active()->get()
        ]);
    }
}