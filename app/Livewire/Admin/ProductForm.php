<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Str;

class ProductForm extends Component
{
    use WithFileUploads;

    public $productId;
    public $title;
    public $slug;
    public $description;
    public $price;
    public $category_id;
    public $user_id;
    public $status = true;
    public $images = [];

    protected function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:products,slug' . ($this->productId ? ",$this->productId" : ''),
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'nullable|exists:categories,id',
            'user_id' => 'nullable|exists:users,id',
            'status' => 'boolean',
            'images.*' => 'image|max:2048',
        ];
    }

    public function mount($productId = null)
    {
        $this->categories = Category::pluck('name', 'id');
        $this->users = User::pluck('name', 'id');

        if ($productId) {
            $product = Product::findOrFail($productId);
            $this->productId = $product->id;
            $this->title = $product->title;
            $this->slug = $product->slug;
            $this->description = $product->description;
            $this->price = $product->price;
            $this->category_id = $product->category_id;
            $this->user_id = $product->user_id;
            $this->status = $product->status;
        }
    }

    public function updatedTitle($value)
    {
        if (! $this->productId) {
            $this->slug = Str::slug($value);
        }
    }

    public function save()
    {
        $this->validate();

        if ($this->productId) {
            $product = Product::findOrFail($this->productId);
            $product->update([
                'title' => $this->title,
                'slug' => $this->slug ?: Str::slug($this->title),
                'description' => $this->description,
                'price' => $this->price,
                'category_id' => $this->category_id,
                'user_id' => $this->user_id,
                'status' => $this->status,
            ]);
        } else {
            $product = Product::create([
                'title' => $this->title,
                'slug' => $this->slug ?: Str::slug($this->title),
                'description' => $this->description,
                'price' => $this->price,
                'category_id' => $this->category_id,
                'user_id' => $this->user_id ?: auth()->id(),
                'status' => $this->status,
            ]);
            $this->productId = $product->id;
        }

        // handle images
        if (! empty($this->images)) {
            foreach ($this->images as $image) {
                $product->addMedia($image->getRealPath())->toMediaCollection('images');
            }
        }

        $this->emit('productSaved');
        session()->flash('message', 'تم حفظ المنتج');

        return redirect()->route('admin.products.index');
    }

    public function approve()
    {
        if (! $this->productId) {
            return;
        }

        $product = Product::findOrFail($this->productId);
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

        session()->flash('message', 'تم نشر المنتج');
        return redirect()->route('admin.products.index');
    }

    public function render()
    {
        return view('livewire.admin.product-form', [
            'categories' => Category::all(),
            'users' => User::all(),
        ]);
    }
}
