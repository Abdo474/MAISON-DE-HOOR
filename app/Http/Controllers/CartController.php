<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display the shopping cart
     */
    public function index()
    {
        $cartItems = Cart::where('user_id', auth()->id())
            ->with('product')
            ->get();
        
        $total = $cartItems->sum(function($item) {
            return $item->product->price * $item->quantity;
        });
        
        return view('cart.index', compact('cartItems', 'total'));
    }

    /**
     * Add product to cart
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        // Get the product
        $product = Product::find($validated['product_id']);

        // Check if enough stock available
        if ($product->stock < $validated['quantity']) {
            return back()->with('error', 'Not enough stock available');
        }

        $cartItem = Cart::where('user_id', auth()->id())
            ->where('product_id', $validated['product_id'])
            ->first();

        if ($cartItem) {
            // Check if adding more quantity doesn't exceed stock
            $totalQuantity = $cartItem->quantity + $validated['quantity'];
            if ($product->stock < $totalQuantity) {
                return back()->with('error', 'Not enough stock available for this quantity');
            }
            $cartItem->increment('quantity', $validated['quantity']);
        } else {
            Cart::create([
                'user_id' => auth()->id(),
                'product_id' => $validated['product_id'],
                'quantity' => $validated['quantity'],
            ]);
        }

        // Decrease product stock
        $product->decrement('stock', $validated['quantity']);

        return redirect()->route('cart.index')->with('success', 'Product added to cart');
    }

    /**
     * Update cart item quantity
     */
    public function update(Request $request, Cart $cart)
    {
        // Check if user owns this cart item
        if ($cart->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        $validated = $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        // Get the product and check stock
        $product = $cart->product;
        $quantityDifference = $validated['quantity'] - $cart->quantity;

        if ($quantityDifference > 0) {
            // Increasing quantity - check if stock is available
            if ($product->stock < $quantityDifference) {
                return back()->with('error', 'Not enough stock available');
            }
            // Decrease stock for the additional quantity
            $product->decrement('stock', $quantityDifference);
        } elseif ($quantityDifference < 0) {
            // Decreasing quantity - restore stock
            $product->increment('stock', abs($quantityDifference));
        }

        $cart->update($validated);

        return back()->with('success', 'Cart updated');
    }

    /**
     * Remove item from cart
     */
    public function destroy(Cart $cart)
    {
        // Check if user owns this cart item
        if ($cart->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }
        
        // Restore product stock
        $product = $cart->product;
        $product->increment('stock', $cart->quantity);
        
        $cart->delete();
        return back()->with('success', 'Item removed from cart');
    }
}
