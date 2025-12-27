<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of categories.
     */
    public function index()
    {
        $categories = Category::with(['children', 'products'])
            ->root()
            ->active()
            ->orderBy('order')
            ->get();

        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new category.
     */
    public function create()
    {
        $categories = Category::root()->active()->get();

        return view('categories.create', compact('categories'));
    }

    /**
     * Store a newly created category.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'parent_id' => 'nullable|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'order' => 'integer|min:0',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,svg,webp|max:1024',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $validated['tenant_id'] = session('tenant_id', 1);

        // Ensure slug is unique within tenant
        $originalSlug = $validated['slug'];
        $count = 1;
        while (Category::where('slug', $validated['slug'])->exists()) {
            $validated['slug'] = $originalSlug.'-'.$count;
            $count++;
        }

        $category = Category::create($validated);

        // Handle icon upload
        if ($request->hasFile('icon')) {
            $category->addMedia($request->file('icon'))
                ->toMediaCollection('icon');
        }

        return redirect()
            ->route('categories.index')
            ->with('success', 'تم إضافة التصنيف بنجاح!');
    }

    /**
     * Display products in the specified category.
     */
    public function show(Category $category)
    {
        $products = $category->products()
            ->with(['user', 'media'])
            ->active()
            ->latest()
            ->paginate(20);

        return view('categories.show', compact('category', 'products'));
    }

    /**
     * Show the form for editing the category.
     */
    public function edit(Category $category)
    {
        $categories = Category::root()
            ->where('id', '!=', $category->id)
            ->active()
            ->get();

        return view('categories.edit', compact('category', 'categories'));
    }

    /**
     * Update the specified category.
     */
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'parent_id' => 'nullable|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'order' => 'integer|min:0',
            'status' => 'boolean',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,svg,webp|max:1024',
        ]);

        $category->update($validated);

        // Handle icon upload
        if ($request->hasFile('icon')) {
            $category->clearMediaCollection('icon');
            $category->addMedia($request->file('icon'))
                ->toMediaCollection('icon');
        }

        return redirect()
            ->route('categories.index')
            ->with('success', 'تم تحديث التصنيف بنجاح!');
    }

    /**
     * Remove the specified category.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()
            ->route('categories.index')
            ->with('success', 'تم حذف التصنيف بنجاح!');
    }
}
