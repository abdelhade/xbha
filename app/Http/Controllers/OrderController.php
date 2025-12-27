<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of orders (as buyer).
     */
    public function index()
    {
        return view('orders.index');
    }

    /**
     * Display sales orders (as seller).
     */
    public function sales()
    {
        return view('orders.sales');
    }

    /**
     * Show the form for creating a new order.
     */
    public function create(Product $product)
    {
        return view('orders.create', compact('product'));
    }

    /**
     * Store a newly created order.
     */
    public function store(Request $request, Product $product)
    {
        $validated = $request->validate([
            'buyer_name' => 'required|string|max:255',
            'buyer_email' => 'required|email',
            'buyer_phone' => 'required|string|max:20',
            'buyer_address' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        $validated['tenant_id'] = $product->tenant_id;
        $validated['product_id'] = $product->id;
        $validated['product_title'] = $product->title;
        $validated['product_price'] = $product->price;
        $validated['product_condition'] = $product->condition;
        $validated['seller_id'] = $product->user_id;
        $validated['buyer_id'] = auth()->id();
        $validated['total_amount'] = $product->price;
        $validated['status'] = Order::STATUS_PENDING;

        $order = Order::create($validated);

        $product->user->notify(new \App\Notifications\NewOrderNotification($order));

        return redirect()
            ->route('orders.show', $order)
            ->with('success', 'تم إرسال طلبك بنجاح! سيتم التواصل معك قريباً.');
    }

    /**
     * Display the specified order.
     */
    public function show(Order $order)
    {
        if ($order->buyer_id !== auth()->id() && $order->seller_id !== auth()->id()) {
            abort(403);
        }

        $order->load(['product', 'buyer', 'seller']);

        return view('orders.show', compact('order'));
    }

    /**
     * Update order status.
     */
    public function updateStatus(Request $request, Order $order)
    {
        // Allow seller to change any status, buyer can only cancel
        if ($order->seller_id !== auth()->id() && $order->buyer_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'status' => 'required|in:pending,completed,cancelled',
        ]);

        // Buyer can only cancel
        if ($order->buyer_id === auth()->id() && $validated['status'] !== 'cancelled') {
            abort(403);
        }

        $order->update(['status' => $validated['status']]);

        if ($validated['status'] === 'completed') {
            $order->update(['completed_at' => now()]);
        }

        return redirect()
            ->route('orders.show', $order)
            ->with('success', 'تم تحديث حالة الطلب بنجاح!');
    }
}
