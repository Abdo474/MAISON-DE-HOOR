<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display user's orders
     */
    public function index()
    {
        $orders = Order::where('user_id', auth()->id())
            ->with('orderItems.product')
            ->latest()
            ->paginate(10);
        
        return view('orders.index', compact('orders'));
    }

    /**
     * Show order details
     */
    public function show(Order $order)
    {
        // Check if user owns this order
        if ($order->user_id !== auth()->id()) {
            abort(403, 'Unauthorized access to this order');
        }
        
        $order->load('orderItems.product');
        return view('orders.show', compact('order'));
    }

    /**
     * Create order from cart (checkout)
     */
    public function store(Request $request)
    {
        $cartItems = Cart::where('user_id', auth()->id())
            ->with('product')
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Cart is empty');
        }

        $totalAmount = $cartItems->sum(function($item) {
            return $item->product->price * $item->quantity;
        });

        $validated = $request->validate([
            'payment_method' => 'required|string',
        ]);

        // Create order
        $order = Order::create([
            'user_id' => auth()->id(),
            'total_amount' => $totalAmount,
            'status' => 'pending',
            'payment_method' => $validated['payment_method'],
        ]);

        // Create order items from cart
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->price,
            ]);
        }

        // Clear cart
        Cart::where('user_id', auth()->id())->delete();

        return redirect()->route('orders.show', $order)->with('success', 'Order created successfully');
    }

    /**
     * Update order status (admin only)
     */
    public function update(Request $request, Order $order)
    {
        // For now, allow any authenticated user to update their own order status
        // In production, you'd want to check if user is admin
        if ($order->user_id !== auth()->id()) {
            abort(403, 'Unauthorized to update this order');
        }

        $validated = $request->validate([
            'status' => 'required|in:pending,processing,shipped,delivered,cancelled',
        ]);

        $order->update($validated);

        return back()->with('success', 'Order status updated');
    }

    /**
     * Cancel order
     */
    public function destroy(Order $order)
    {
        // Check if user owns this order
        if ($order->user_id !== auth()->id()) {
            abort(403, 'Unauthorized access to this order');
        }

        if ($order->status !== 'pending') {
            return back()->with('error', 'Can only cancel pending orders');
        }

        // Restore product stock for all items in this order
        $order->load('orderItems');
        foreach ($order->orderItems as $item) {
            $item->product->increment('stock', $item->quantity);
        }

        $order->update(['status' => 'cancelled']);

        return back()->with('success', 'Order cancelled and stock restored');
    }
}
