<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Display all customer orders
    public function index()
    {
        $orders = Order::with('user')
            ->latest()
            ->paginate(10);

        return view('admin.orders.index', compact('orders'));
    }

    // Display order details
    public function show(Order $order)
    {
        $order->load(['user', 'items.product']);

        return view('admin.orders.show', compact('order'));
    }

    // Update order and payment status
    public function update(Request $request, Order $order)
    {
        $validated = $request->validate([
            'order_status' => [
                'required',
                'in:Pending,Processing,Shipped,Delivered,Cancelled'
            ],

            'payment_status' => [
                'required',
                'in:Pending,Paid,Failed'
            ],
        ]);

        $order->update($validated);

        return redirect()
            ->route('admin.orders.show', $order)
            ->with('success', 'Order updated successfully!');
    }
}
