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

    // Auction fields (mirror CreateProduct)
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
            'newImages.*' => 'nullable|image|max:2048',
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
        'newImages.*.image' => 'يجب أن تكون الملفات صور',
        'newImages.*.max' => 'حجم الصورة يجب أن يكون أقل من 2 ميجا',
        'starting_price.required' => 'سعر بداية المزاد مطلوب',
        'auction_days.required' => 'مدة المزاد مطلوبة',
        'min_bid_increment.required' => 'الحد الأدنى للزيادة مطلوب',
    ];

    public function mount(Product $product)
    {
        // 🔒 تأكيد أن المستخدم هو صاحب المنتج
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

        // Auction defaults from existing product
        $this->is_auction = (bool) $product->is_auction;
        $this->starting_price = $product->starting_price ?? '';
        $this->min_bid_increment = $product->min_bid_increment ?? 10;
        if ($product->auction_ends_at) {
            $days = now()->diffInDays($product->auction_ends_at);
            $this->auction_days = $days > 0 ? $days : 1;
        }
    }

    public function markImageForDeletion($mediaId)
    {
        if (! in_array($mediaId, $this->imagesToDelete)) {
            $this->imagesToDelete[] = $mediaId;
        }
    }

    public function unmarkImageForDeletion($mediaId)
    {
        $this->imagesToDelete = array_filter($this->imagesToDelete, fn ($id) => $id != $mediaId);
    }

    public function update()
    {
        $this->validate();

        $updateData = [
            'title' => $this->title,
            'slug' => Str::slug($this->title).'-'.time(),
            'category_id' => $this->category_id,
            'condition' => $this->condition,
            'location' => $this->location,
            'description' => $this->description,
            'status' => $this->status,
        ];

        if ($this->is_auction) {
            $updateData['is_auction'] = true;
            $updateData['starting_price'] = $this->starting_price;
            $updateData['min_bid_increment'] = $this->min_bid_increment;
            $updateData['auction_ends_at'] = now()->addDays((int) $this->auction_days);
            $updateData['price'] = $this->starting_price;

            // Only set current_bid if there are no bids yet
            if ($this->product->bids()->count() === 0) {
                $updateData['current_bid'] = $this->starting_price;
            }
        } else {
            $updateData['is_auction'] = false;
            $updateData['starting_price'] = null;
            $updateData['min_bid_increment'] = null;
            $updateData['auction_ends_at'] = null;
        }

        // If not auction and price provided
        if (! $this->is_auction) {
            $updateData['price'] = $this->price;
        }

        $this->product->update($updateData);

        // ✅ حذف الصور المحددة
        if (! empty($this->imagesToDelete)) {
            foreach ($this->imagesToDelete as $mediaId) {
                $media = $this->product->getMedia('images')->where('id', $mediaId)->first();
                if ($media) {
                    $media->delete();
                }
            }
        }

        // ✅ رفع الصور الجديدة
        if (! empty($this->newImages)) {
            foreach ($this->newImages as $image) {
                if ($image) {
                    $this->product->addMedia($image->getRealPath())
                        ->usingName($image->getClientOriginalName())
                        ->toMediaCollection('images');
                }
            }
        }

        session()->flash('message', 'تم تحديث الإعلان بنجاح');

        return redirect()->route('dashboard');
    }

    public function render()
    {
        return view('livewire.edit-product', [
            'categories' => Category::active()->get(),
            'existingImages' => $this->product->getMedia('images'),
        ]);
    }
}
