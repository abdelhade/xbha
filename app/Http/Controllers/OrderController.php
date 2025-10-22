<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of orders.
     */
    public function index()
    {
        $orders = Order::with(['product', 'buyer', 'seller'])
            ->where('buyer_id', auth()->id())
            ->orWhere('seller_id', auth()->id())
            ->latest()
            ->paginate(20);

        return view('orders.index', compact('orders'));
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

        $validated['product_id'] = $product->id;
        $validated['seller_id'] = $product->user_id;
        $validated['buyer_id'] = auth()->id();
        $validated['total_amount'] = $product->price;
        $validated['status'] = Order::STATUS_PENDING;

        $order = Order::create($validated);

        // Here you can send notifications to buyer and seller

        return redirect()
            ->route('orders.show', $order)
            ->with('success', 'تم إرسال طلبك بنجاح! سيتم التواصل معك قريباً.');
    }

    /**
     * Display the specified order.
     */
    public function show(Order $order)
    {
        $this->authorize('view', $order);
        $order->load(['product', 'buyer', 'seller']);

        return view('orders.show', compact('order'));
    }

    /**
     * Update order status.
     */
    public function updateStatus(Request $request, Order $order)
    {
        $this->authorize('update', $order);

        $validated = $request->validate([
            'status' => 'required|in:pending,confirmed,completed,cancelled',
            'cancellation_reason' => 'required_if:status,cancelled|nullable|string',
        ]);

        if ($validated['status'] === Order::STATUS_COMPLETED) {
            $order->markAsCompleted();
        } elseif ($validated['status'] === Order::STATUS_CANCELLED) {
            $order->cancel($validated['cancellation_reason'] ?? null);
        } else {
            $order->update(['status' => $validated['status']]);
        }

        return redirect()
            ->route('orders.show', $order)
            ->with('success', 'تم تحديث حالة الطلب بنجاح!');
    }
}

