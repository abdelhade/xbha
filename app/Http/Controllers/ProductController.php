<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of products.
     */
    public function index(Request $request)
    {
        $query = Product::with(['category', 'user'])
            ->active()
            ->latest();

        // Filter by category
        if ($request->has('category')) {
            $query->where('category_id', $request->category);
        }

        // Search
        if ($request->has('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%'.$request->search.'%')
                    ->orWhere('description', 'like', '%'.$request->search.'%');
            });
        }

        // Filter by condition
        if ($request->has('condition')) {
            $query->where('condition', $request->condition);
        }

        // Price range
        if ($request->has('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->has('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        $products = $query->paginate(20);
        $categories = Category::active()->root()->with('children')->get();

        return view('products.index', compact('products', 'categories'));
    }

    /**
     * Show the form for creating a new product.
     */
    public function create()
    {
        $categories = Category::active()->get();

        return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created product.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'condition' => 'required|in:new,like_new,good,fair,poor',
            'location' => 'nullable|string|max:255',
            'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:10240',
        ]);

        $validated['user_id'] = auth()->id();
        $validated['slug'] = Str::slug($validated['title']);

        // Ensure slug is unique within tenant
        $originalSlug = $validated['slug'];
        $count = 1;
        while (Product::where('slug', $validated['slug'])->exists()) {
            $validated['slug'] = $originalSlug.'-'.$count;
            $count++;
        }

        $product = Product::create($validated);

        // Handle image uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $product->addMedia($image)
                    ->toMediaCollection('images');

                // Set first image as featured
                if ($index === 0) {
                    $product->addMedia($image)
                        ->toMediaCollection('featured');
                }
            }
        }

        return redirect()
            ->route('products.show', $product)
            ->with('success', 'تم إضافة المنتج بنجاح!');
    }

    /**
     * Display the specified product.
     */
    public function show(Product $product)
    {
        // Hide unapproved products from public unless viewer is admin or owner
        if (! $product->status && ! (auth()->check() && (auth()->user()->hasRole('admin') || auth()->id() === $product->user_id))) {
            abort(404);
        }

        $product->load(['category', 'user', 'media']);
        $product->incrementViews();

        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->active()
            ->limit(4)
            ->get();

        return view('products.show', compact('product', 'relatedProducts'));
    }

    /**
     * Show the form for editing the product.
     */
    public function edit(Product $product)
    {
        $this->authorize('update', $product);
        $categories = Category::active()->get();

        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified product.
     */
    public function update(Request $request, Product $product)
    {
        $this->authorize('update', $product);

        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'condition' => 'required|in:new,like_new,good,fair,poor',
            'location' => 'nullable|string|max:255',
            'status' => 'boolean',
            'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:10240',
        ]);

        $product->update($validated);

        // Handle new images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $product->addMedia($image)
                    ->toMediaCollection('images');
            }
        }

        return redirect()
            ->route('products.show', $product)
            ->with('success', 'تم تحديث المنتج بنجاح!');
    }

    /**
     * Remove the specified product.
     */
    public function destroy(Product $product)
    {
        $this->authorize('delete', $product);
        $product->delete();

        return redirect()
            ->route('products.index')
            ->with('success', 'تم حذف المنتج بنجاح!');
    }
}
