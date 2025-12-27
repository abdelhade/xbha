<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $pendingCount = Product::where('status', false)->count();

        $usersCount = User::count();
        $productsCount = Product::count();
        $ordersCount = Order::count();

        $pendingOrdersCount = Order::pending()->count();
        $latestOrders = Order::with('buyer')->latest()->take(10)->get();
        $pendingProducts = Product::where('status', false)->with(['user', 'category'])->latest()->take(10)->get();

        return view('admin.dashboard', compact('pendingCount', 'usersCount', 'productsCount', 'ordersCount', 'pendingOrdersCount', 'latestOrders', 'pendingProducts'));
    }
}
