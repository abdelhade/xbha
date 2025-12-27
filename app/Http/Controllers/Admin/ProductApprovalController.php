<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductApproval;
use Illuminate\Http\Request;

class ProductApprovalController extends Controller
{
    public function index()
    {
        $approvals = ProductApproval::with(['product', 'admin'])->latest()->paginate(20);

        return view('admin.products.approvals', compact('approvals'));
    }

    public function approve(Product $product)
    {
        $product->update(['status' => true]);

        ProductApproval::create([
            'product_id' => $product->id,
            'admin_id' => auth()->id(),
            'action' => 'approved',
            'note' => null,
        ]);

        if ($product->user) {
            $product->user->notify(new \App\Notifications\ProductApproved($product));
        }

        return redirect()->back()->with('message', 'تم نشر المنتج');
    }
}