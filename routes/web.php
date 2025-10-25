<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/products', function () {
    return view('products.index');
})->name('products.index');

Route::get('/myAds', function () {
    $user = Auth::user();
    $products = $user->products()->with('category')->latest()->get();
    $stats = [
        'total' => $products->count(),
        'active' => $products->where('status', true)->count(),
        'views' => $products->sum('views_count'),
        'revenue' => $products->where('status', true)->sum('price')
    ];
    return view('dashboard', compact('products', 'stats'));
})->middleware(['auth', 'verified'])->name('dashboard');

// Keep old dashboard route for compatibility
Route::get('/dashboard', function () {
    return redirect('/myAds');
})->middleware(['auth', 'verified']);

// Redirect authenticated users to home page
Route::get('/home', function () {
    return redirect('/');
})->middleware(['auth', 'verified']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Products routes
    Route::get('/products/create', function () {
        return view('products.create');
    })->name('products.create');
    
    Route::post('/products', function () {
        return redirect()->route('products.index');
    })->name('products.store');
    
    Route::get('/products/{product:slug}/edit', function (Product $product) {
        return view('products.edit', compact('product'));
    })->name('products.edit');
});

// Product show route (public)
Route::get('/products/{product:slug}', function (Product $product) {
    return view('products.show', compact('product'));
})->name('products.show');

// Categories routes
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
Route::get('/categories/{category:slug}', [CategoryController::class, 'show'])->name('categories.show');
Route::get('/categories/{category:slug}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
Route::put('/categories/{category:slug}', [CategoryController::class, 'update'])->name('categories.update');
Route::delete('/categories/{category:slug}', [CategoryController::class, 'destroy'])->name('categories.destroy');

// Orders routes
use App\Http\Controllers\OrderController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\NotificationController;

Route::middleware('auth')->group(function () {
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/sales', [OrderController::class, 'sales'])->name('orders.sales');
    Route::get('/orders/create/{product}', [OrderController::class, 'create'])->name('orders.create');
    Route::post('/orders/{product}', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::patch('/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
    
    // Favorites routes
    Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');
    Route::post('/favorites/{product}', [FavoriteController::class, 'toggle'])->name('favorites.toggle');
    Route::delete('/favorites/{favorite}', [FavoriteController::class, 'destroy'])->name('favorites.destroy');
    
    // Notifications routes
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::get('/notifications/{id}', [NotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::post('/notifications/mark-all', [NotificationController::class, 'markAllAsRead'])->name('notifications.markAllAsRead');
});

require __DIR__.'/auth.php';
