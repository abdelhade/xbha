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

    public $is_auction = false;

    public $starting_price = '';

    public $auction_days = 7;

    public $min_bid_increment = 10;

    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => $this->is_auction ? 'nullable' : 'required|numeric|min:0|max:999999999',
            'condition' => 'required|in:new,like_new,good,fair,poor',
            'location' => 'required|string|max:255',
            'description' => 'required|string|min:10',
            'starting_price' => $this->is_auction ? 'required|numeric|min:0|max:999999999' : 'nullable',
            'auction_days' => $this->is_auction ? 'required|integer|min:1|max:30' : 'nullable',
            'min_bid_increment' => $this->is_auction ? 'required|numeric|min:1|max:10000' : 'nullable',
        ];
    }

    protected $messages = [
        'title.required' => 'عنوان الإعلان مطلوب',
        'category_id.required' => 'التصنيف مطلوب',
        'price.required' => 'السعر مطلوب',
        'price.max' => 'السعر أكبر من اللازم',
        'condition.required' => 'حالة المنتج مطلوبة',
        'location.required' => 'الموقع مطلوب',
        'description.required' => 'وصف المنتج مطلوب',
        'description.min' => 'وصف المنتج يجب أن يكون 10 أحرف على الأقل',
        'images.*.image' => 'يجب أن تكون الملفات صور',
        'images.*.max' => 'حجم الصورة يجب أن يكون أقل من 2 ميجا',
    ];

    public function removeImage($index)
    {
        unset($this->images[$index]);
        $this->images = array_values($this->images);
    }

    public function save($isDraft = false)
    {
        // All user-created products require admin approval by default
        $this->status = false;
        $this->validate();

        $productData = [
            'user_id' => auth()->id(),
            'tenant_id' => session('tenant_id', 1),
            'title' => $this->title,
            'slug' => Str::slug($this->title).'-'.time(),
            'category_id' => $this->category_id,
            'condition' => $this->condition,
            'location' => $this->location,
            'description' => $this->description,
            'status' => $this->status, // false until admin approves
            'is_auction' => $this->is_auction,
        ];

        if ($this->is_auction) {
            $productData['starting_price'] = $this->starting_price;
            $productData['current_bid'] = $this->starting_price;
            $productData['auction_ends_at'] = now()->addDays((int) $this->auction_days);
            $productData['price'] = $this->starting_price;
            $productData['min_bid_increment'] = $this->min_bid_increment;
        } else {
            $productData['price'] = $this->price;
        }

        $product = Product::create($productData);

        // Upload images
        if ($this->images && count($this->images) > 0) {
            foreach ($this->images as $image) {
                if ($image && is_object($image)) {
                    $product->addMedia($image->getRealPath())
                        ->usingName($image->getClientOriginalName())
                        ->toMediaCollection('images');
                }
            }
        }

        session()->flash('message', $isDraft ? 'تم حفظ الإعلان كمسودة' : 'تم إضافة الإعلان بنجاح، سينتظر موافقة الأدمن');

        return redirect()->route('dashboard');
    }

    public function saveDraft()
    {
        return $this->save(true);
    }

    public function render()
    {
        return view('livewire.create-product', [
            'categories' => Category::active()->get(),
        ]);
    }
}
