<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // Get the current user's or guest's cart
    private function getCart()
    {
        if (auth()->check()) {
            return Cart::firstOrCreate([
                'user_id' => auth()->id(),
            ]);
        }

        return Cart::firstOrCreate([
            'session_id' => session()->getId(),
        ]);
    }

    // Display shopping cart
    public function index()
    {
        $cart = $this->getCart();

        $cart->load('items.product');

        $subtotal = $cart->items->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        return view('cart.index', compact('cart', 'subtotal'));
    }

    // Add product to cart
    public function add(Request $request, Product $product)
    {
        $validated = $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        if (!$product->is_active || $product->stock < 1) {
            return back()->with('error', 'This product is currently unavailable.');
        }

        $cart = $this->getCart();

        $cartItem = $cart->items()
            ->where('product_id', $product->id)
            ->first();

        $quantity = ($cartItem ? $cartItem->quantity : 0)
            + $validated['quantity'];

        if ($quantity > $product->stock) {
            return back()->with(
                'error',
                'Only ' . $product->stock . ' items are available in stock.'
            );
        }

        if ($cartItem) {
            $cartItem->update([
                'quantity' => $quantity,
            ]);
        } else {
            $cart->items()->create([
                'product_id' => $product->id,
                'quantity' => $validated['quantity'],
                'price' => $product->price,
            ]);
        }

        return redirect()
            ->route('cart.index')
            ->with('success', 'Product added to cart successfully!');
    }

    // Update cart item quantity
    public function update(Request $request, $itemId)
    {
        $validated = $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = $this->getCart();

        $cartItem = $cart->items()
            ->with('product')
            ->whereKey($itemId)
            ->firstOrFail();

        if (!$cartItem->product ||
            $validated['quantity'] > $cartItem->product->stock) {
            return back()->with(
                'error',
                'Requested quantity is not available in stock.'
            );
        }

        $cartItem->update([
            'quantity' => $validated['quantity'],
        ]);

        return back()->with('success', 'Cart updated successfully!');
    }

    // Remove product from cart
    public function remove($itemId)
    {
        $cart = $this->getCart();

        $cartItem = $cart->items()
            ->whereKey($itemId)
            ->firstOrFail();

        $cartItem->delete();

        return back()->with('success', 'Product removed from cart!');
    }
}
