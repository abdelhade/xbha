<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function index()
    {
        $favorites = auth()->user()->favorites()->with('product.media')->latest()->get();
        return view('favorites.index', compact('favorites'));
    }

    public function toggle(Product $product)
    {
        $favorite = auth()->user()->favorites()->where('product_id', $product->id)->first();
        
        if ($favorite) {
            $favorite->delete();
            return back()->with('success', 'تم إزالة المنتج من المفضلة');
        }
        
        auth()->user()->favorites()->create(['product_id' => $product->id]);
        return back()->with('success', 'تم إضافة المنتج للمفضلة');
    }

    public function destroy($id)
    {
        $favorite = auth()->user()->favorites()->findOrFail($id);
        $favorite->delete();
        
        return back()->with('success', 'تم إزالة المنتج من المفضلة');
    }
}
