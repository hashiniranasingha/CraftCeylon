<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = Cart::where('user_id', auth()->id())
            ->with('items.product')
            ->first();

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()
                ->route('cart.index')
                ->with('error', 'Your shopping cart is empty.');
        }

        $subtotal = $cart->items->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        $shippingFee = 0;
        $total = $subtotal + $shippingFee;

        return view('checkout.index', compact(
            'cart',
            'subtotal',
            'shippingFee',
            'total'
        ));
    }

    public function placeOrder(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'required|string|max:20',
            'shipping_address' => 'required|string',
            'city' => 'required|string|max:100',
            'notes' => 'nullable|string|max:1000',
        ]);

        $cart = Cart::where('user_id', auth()->id())
            ->with('items')
            ->first();

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()
                ->route('cart.index')
                ->with('error', 'Your shopping cart is empty.');
        }

        try {
            $order = DB::transaction(function () use ($cart, $validated) {

                $subtotal = 0;
                $orderItems = [];

                foreach ($cart->items as $cartItem) {

                    $product = Product::whereKey($cartItem->product_id)
                        ->lockForUpdate()
                        ->first();

                    if (
                        !$product ||
                        !$product->is_active ||
                        $product->stock < $cartItem->quantity
                    ) {
                        throw new \Exception(
                            'Some products are unavailable or have insufficient stock.'
                        );
                    }

                    $itemSubtotal = $cartItem->price * $cartItem->quantity;
                    $subtotal += $itemSubtotal;

                    $orderItems[] = [
                        'product_id' => $product->id,
                        'product_name' => $product->name,
                        'product_image' => $product->image,
                        'price' => $cartItem->price,
                        'quantity' => $cartItem->quantity,
                        'subtotal' => $itemSubtotal,
                    ];

                    $product->decrement('stock', $cartItem->quantity);
                }

                $shippingFee = 0;

                $order = Order::create([
                    'user_id' => auth()->id(),
                    'order_number' => 'CC-' . strtoupper(Str::random(10)),
                    'customer_name' => $validated['customer_name'],
                    'customer_email' => $validated['customer_email'],
                    'customer_phone' => $validated['customer_phone'],
                    'shipping_address' => $validated['shipping_address'],
                    'city' => $validated['city'],
                    'subtotal' => $subtotal,
                    'shipping_fee' => $shippingFee,
                    'total_amount' => $subtotal + $shippingFee,
                    'payment_method' => 'Cash on Delivery',
                    'payment_status' => 'Pending',
                    'order_status' => 'Pending',
                    'notes' => $validated['notes'] ?? null,
                ]);

                $order->items()->createMany($orderItems);

                $cart->items()->delete();

                return $order;
            });

            return redirect()
                ->route('checkout.success', $order)
                ->with('success', 'Your order has been placed successfully!');

        } catch (\Exception $exception) {

            return back()
                ->withInput()
                ->with('error', $exception->getMessage());
        }
    }

    public function success(Order $order)
    {
        abort_unless($order->user_id === auth()->id(), 403);

        $order->load('items');

        return view('orders.confirmation', compact('order'));
    }
}
