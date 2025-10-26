<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

class FavoritesList extends Component
{
    use WithPagination;

    public function removeFavorite($favoriteId)
    {
        $favorite = auth()->user()->favorites()->findOrFail($favoriteId);
        $favorite->delete();
        
        session()->flash('message', 'تم إزالة المنتج من المفضلة');
    }

    public function render()
    {
        $favorites = auth()->user()->favorites()->with('product.media')->latest()->paginate(12);
        
        return view('livewire.favorites-list', compact('favorites'));
    }
}
