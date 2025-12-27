<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class FavoritesList extends Component
{
    use WithPagination;

    public function removeFavorite($favoriteId)
    {
        if (auth()->check()) {
            $favorite = auth()->user()->favorites()->findOrFail($favoriteId);
            $favorite->delete();
        } else {
            $favorites = session()->get('favorites', []);
            $favorites = array_diff($favorites, [$favoriteId]);
            session()->put('favorites', $favorites);
        }

        session()->flash('message', 'تم إزالة المنتج من المفضلة');
    }

    public function render()
    {
        if (auth()->check()) {
            $favorites = auth()->user()->favorites()->with('product.media')->latest()->paginate(12);
        } else {
            $favoriteIds = session()->get('favorites', []);
            $products = Product::whereIn('id', $favoriteIds)->with('media')->get();
            $favorites = new \Illuminate\Pagination\LengthAwarePaginator(
                $products,
                count($products),
                12,
                1
            );
        }

        return view('livewire.favorites-list', compact('favorites'));
    }
}
