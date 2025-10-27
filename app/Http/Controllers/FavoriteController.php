<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function index()
    {
        return view('favorites.index');
    }

    public function toggle(Product $product)
    {
        if (auth()->check()) {
            $favorite = auth()->user()->favorites()->where('product_id', $product->id)->first();
            
            if ($favorite) {
                $favorite->delete();
                return back()->with('success', 'تم إزالة المنتج من المفضلة');
            }
            
            auth()->user()->favorites()->create(['product_id' => $product->id]);
            return back()->with('success', 'تم إضافة المنتج للمفضلة');
        }
        
        // For guests, use session
        $sessionId = session()->getId();
        $favorites = session()->get('favorites', []);
        
        if (in_array($product->id, $favorites)) {
            $favorites = array_diff($favorites, [$product->id]);
            session()->put('favorites', $favorites);
            return back()->with('success', 'تم إزالة المنتج من المفضلة');
        }
        
        $favorites[] = $product->id;
        session()->put('favorites', $favorites);
        return back()->with('success', 'تم إضافة المنتج للمفضلة');
    }

    public function destroy($id)
    {
        $favorite = auth()->user()->favorites()->findOrFail($id);
        $favorite->delete();
        
        return back()->with('success', 'تم إزالة المنتج من المفضلة');
    }
}
