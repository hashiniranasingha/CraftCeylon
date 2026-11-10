<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class CustomerOrderController extends Controller
{
    // Display all orders belonging to the logged-in customer
    public function index()
    {
        $orders = Auth::user()
            ->orders()
            ->latest()
            ->paginate(10);

        return view('customer.orders.index', compact('orders'));
    }

    // Display details of a specific customer order
    public function show(Order $order)
    {
        // Ensure customers can only view their own orders
        abort_unless($order->user_id === Auth::id(), 403);

        $order->load('items');

        return view('customer.orders.show', compact('order'));
    }
}
