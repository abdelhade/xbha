<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/products', function () {
    return view('products.index');
})->name('products.index');

Route::get('/myAds', function () {
    return view('dashboard');
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
});

require __DIR__.'/auth.php';
