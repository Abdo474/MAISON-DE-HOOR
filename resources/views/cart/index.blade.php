@extends('layouts.app')

@section('title', 'Shopping Cart - Maison de Hoor')

@section('content')
<style>
    .cart-container {
        min-height: 90vh;
        padding: 4rem 2rem;
        background-color: #FFFCF7;
    }
    
    .cart-header {
        text-align: center;
        margin-bottom: 3rem;
    }
    
    .cart-title {
        font-size: 2.5rem;
        font-weight: 700;
        color: #2C2C2C;
        text-transform: uppercase;
        letter-spacing: 2px;
        margin-bottom: 0.5rem;
    }
    
    .cart-subtitle {
        color: #B49F79;
        font-size: 1rem;
        letter-spacing: 1px;
    }
    
    .cart-table {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        margin-bottom: 2rem;
    }
    
    .cart-table table {
        width: 100%;
        border-collapse: collapse;
    }
    
    .cart-table thead {
        background: #F4F4F4;
        border-bottom: 2px solid #E0E0E0;
    }
    
    .cart-table th {
        padding: 1.5rem;
        text-align: left;
        color: #2C2C2C;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 1px;
    }
    
    .cart-table td {
        padding: 1.5rem;
        color: #4A4A4A;
        border-bottom: 1px solid #E0E0E0;
    }
    
    .cart-table tr:hover {
        background: #F9F9F9;
    }
    
    .cart-table a {
        color: #B49F79;
        text-decoration: none;
        font-weight: 600;
        transition: color 0.3s;
    }
    
    .cart-table a:hover {
        color: #C893A0;
    }
    
    .cart-summary {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 2rem;
    }
    
    .cart-actions {
        background: white;
        padding: 2rem;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    }
    
    .cart-total {
        background: linear-gradient(135deg, #2C2C2C 0%, #1a1a1a 100%);
        padding: 2rem;
        border-radius: 12px;
        color: white;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    }
    
    .total-label {
        font-size: 1.1rem;
        color: #B49F79;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 0.5rem;
    }
    
    .total-amount {
        font-size: 2.5rem;
        font-weight: 700;
        color: #FFFCF7;
    }
    
    .btn-luxury-primary {
        background: #B49F79;
        color: white;
        padding: 12px 30px;
        border: none;
        border-radius: 6px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        cursor: pointer;
        transition: all 0.3s;
        width: 100%;
        font-size: 1rem;
    }
    
    .btn-luxury-primary:hover {
        background: #C893A0;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(193, 137, 160, 0.3);
    }
    
    .btn-luxury-secondary {
        background: transparent;
        color: #B49F79;
        padding: 12px 30px;
        border: 2px solid #B49F79;
        border-radius: 6px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        cursor: pointer;
        transition: all 0.3s;
        width: 100%;
        font-size: 1rem;
    }
    
    .btn-luxury-secondary:hover {
        background: #B49F79;
        color: white;
        transform: translateY(-2px);
    }
    
    .form-label {
        color: #2C2C2C;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 0.5px;
        margin-bottom: 0.5rem;
        display: block;
    }
    
    .form-control, .form-select {
        border: 2px solid #E0E0E0;
        border-radius: 6px;
        padding: 12px 15px;
        font-size: 1rem;
        transition: border-color 0.3s;
    }
    
    .form-control:focus, .form-select:focus {
        outline: none;
        border-color: #B49F79;
        box-shadow: 0 0 0 3px rgba(180, 159, 121, 0.1);
    }
    
    .empty-state {
        background: white;
        padding: 4rem;
        border-radius: 12px;
        text-align: center;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    }
    
    .empty-state h2 {
        color: #2C2C2C;
        font-weight: 700;
        margin-bottom: 1rem;
        font-size: 1.8rem;
    }
    
    .empty-state p {
        color: #666;
        font-size: 1rem;
        margin-bottom: 2rem;
    }
    
    @media (max-width: 768px) {
        .cart-summary {
            grid-template-columns: 1fr;
        }
        
        .cart-title {
            font-size: 1.8rem;
        }
        
        .total-amount {
            font-size: 2rem;
        }
    }
</style>

<div class="cart-container">
    <div class="container">
        <div class="cart-header">
            <h1 class="cart-title">Your Cart</h1>
            <p class="cart-subtitle">Review your selections</p>
        </div>

        @if ($cartItems->count())
            <div class="cart-table">
                <table>
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cartItems as $item)
                            <tr>
                                <td>
                                    <a href="{{ route('products.show', $item->product) }}">
                                        {{ $item->product->name }}
                                    </a>
                                </td>
                                <td>${{ number_format($item->product->price, 2) }}</td>
                                <td>
                                    <form action="{{ route('cart.update', $item) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" max="{{ $item->product->stock }}" class="form-control" style="width: 60px;">
                                    </form>
                                </td>
                                <td style="font-weight: 600; color: #B49F79;">${{ number_format($item->product->price * $item->quantity, 2) }}</td>
                                <td>
                                    <form action="{{ route('cart.destroy', $item) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" style="background: #dc3545; color: white; border: none; padding: 6px 12px; border-radius: 4px; font-weight: 600; cursor: pointer; transition: all 0.3s; font-size: 0.8rem;" onmouseover="this.style.background='#c82333'" onmouseout="this.style.background='#dc3545'">Remove</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="cart-summary">
                <div class="cart-actions">
                    <button onclick="window.location.href='{{ route('products.index') }}'" class="btn-luxury-secondary" style="margin-bottom: 1rem;">Continue Shopping</button>
                </div>
                <div class="cart-total">
                    <div class="total-label">Order Total</div>
                    <div class="total-amount">${{ number_format($total, 2) }}</div>
                    
                    <form action="{{ route('orders.store') }}" method="POST" style="margin-top: 2rem;">
                        @csrf
                        <div style="margin-bottom: 1rem;">
                            <label for="payment_method" class="form-label" style="color: white;">Payment Method</label>
                            <select id="payment_method" name="payment_method" class="form-select" required>
                                <option value="">Select Payment Method</option>
                                <option value="credit_card">Credit Card</option>
                                <option value="debit_card">Debit Card</option>
                                <option value="paypal">PayPal</option>
                                <option value="bank_transfer">Bank Transfer</option>
                            </select>
                        </div>
                        <button type="submit" class="btn-luxury-primary" style="background: #C893A0; margin-top: 1rem;">Proceed to Checkout</button>
                    </form>
                </div>
            </div>
        @else
            <div class="empty-state">
                <h2>Your Cart is Empty</h2>
                <p>Start exploring our luxury collection to find your perfect pieces.</p>
                <button onclick="window.location.href='{{ route('products.index') }}'" class="btn-luxury-primary">Continue Shopping</button>
            </div>
        @endif
    </div>
</div>
@endsection
