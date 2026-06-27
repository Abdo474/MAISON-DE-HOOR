@extends('layouts.app')

@section('title', 'Order #' . $order->id . ' - Maison de Hoor')

@section('content')
<style>
    .order-show-container {
        min-height: 90vh;
        padding: 4rem 2rem;
        background-color: #FFFCF7;
    }
    
    .order-show-header {
        text-align: center;
        margin-bottom: 3rem;
    }
    
    .order-show-title {
        font-size: 2.5rem;
        font-weight: 700;
        color: #2C2C2C;
        text-transform: uppercase;
        letter-spacing: 2px;
        margin-bottom: 0.5rem;
    }
    
    .order-show-subtitle {
        color: #B49F79;
        font-size: 1rem;
        letter-spacing: 1px;
    }
    
    .order-info-cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
        margin-bottom: 2rem;
    }
    
    .info-card {
        background: white;
        padding: 2rem;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    }
    
    .info-card h3 {
        color: #2C2C2C;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-size: 1.1rem;
        margin-bottom: 1.5rem;
        border-bottom: 2px solid #E0E0E0;
        padding-bottom: 1rem;
    }
    
    .info-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 1rem;
    }
    
    .info-label {
        color: #666;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 0.5px;
    }
    
    .info-value {
        color: #2C2C2C;
        font-weight: 600;
    }
    
    .total-amount-large {
        font-size: 2.5rem;
        color: #B49F79;
        text-align: right;
        margin-top: 1rem;
    }
    
    .order-items-table {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        margin-bottom: 2rem;
    }
    
    .order-items-table table {
        width: 100%;
        border-collapse: collapse;
    }
    
    .order-items-table thead {
        background: #F4F4F4;
        border-bottom: 2px solid #E0E0E0;
    }
    
    .order-items-table th {
        padding: 1.5rem;
        text-align: left;
        color: #2C2C2C;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 1px;
    }
    
    .order-items-table td {
        padding: 1.5rem;
        color: #4A4A4A;
        border-bottom: 1px solid #E0E0E0;
    }
    
    .order-items-table tr:hover {
        background: #F9F9F9;
    }
    
    .order-items-table a {
        color: #B49F79;
        text-decoration: none;
        font-weight: 600;
        transition: color 0.3s;
    }
    
    .order-items-table a:hover {
        color: #C893A0;
    }
    
    .badge-luxury {
        padding: 6px 12px;
        border-radius: 4px;
        font-weight: 600;
        text-transform: capitalize;
        font-size: 0.85rem;
        letter-spacing: 0.5px;
    }
    
    .badge-success {
        background: #d4edda;
        color: #155724;
    }
    
    .badge-warning {
        background: #fff3cd;
        color: #856404;
    }
    
    .badge-danger {
        background: #f8d7da;
        color: #721c24;
    }
    
    .action-buttons {
        display: flex;
        gap: 1rem;
        margin-top: 2rem;
    }
    
    .btn-back {
        background: #B49F79;
        color: white;
        padding: 12px 30px;
        border: none;
        border-radius: 6px;
        font-weight: 600;
        text-decoration: none;
        cursor: pointer;
        transition: all 0.3s;
        text-transform: uppercase;
        letter-spacing: 1px;
        flex: 1;
    }
    
    .btn-back:hover {
        background: #C893A0;
        color: white;
        text-decoration: none;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(193, 137, 160, 0.3);
    }
    
    .btn-cancel {
        background: #dc3545;
        color: white;
        padding: 12px 30px;
        border: none;
        border-radius: 6px;
        font-weight: 600;
        text-decoration: none;
        cursor: pointer;
        transition: all 0.3s;
        text-transform: uppercase;
        letter-spacing: 1px;
        flex: 1;
    }
    
    .btn-cancel:hover {
        background: #c82333;
        text-decoration: none;
        transform: translateY(-2px);
    }
    
    @media (max-width: 768px) {
        .order-show-title {
            font-size: 1.8rem;
        }
        
        .action-buttons {
            flex-direction: column;
        }
        
        .total-amount-large {
            text-align: left;
        }
    }
</style>

<div class="order-show-container">
    <div class="container">
        <div class="order-show-header">
            <h1 class="order-show-title">Order #{{ $order->id }}</h1>
            <p class="order-show-subtitle">Order Details & Information</p>
        </div>

        <div class="order-info-cards">
            <div class="info-card">
                <h3>Order Information</h3>
                <div class="info-row">
                    <span class="info-label">Order Date</span>
                    <span class="info-value">{{ $order->created_at->format('M d, Y') }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Time</span>
                    <span class="info-value">{{ $order->created_at->format('h:i A') }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Status</span>
                    <span class="badge-luxury badge-{{ 
                        $order->status == 'delivered' ? 'success' : 
                        ($order->status == 'cancelled' ? 'danger' : 'warning')
                    }}">
                        {{ ucfirst($order->status) }}
                    </span>
                </div>
            </div>

            <div class="info-card">
                <h3>Payment Details</h3>
                <div class="info-row">
                    <span class="info-label">Payment Method</span>
                    <span class="info-value">{{ ucfirst(str_replace('_', ' ', $order->payment_method)) }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Total Items</span>
                    <span class="info-value">{{ $order->orderItems->count() }}</span>
                </div>
                <div class="total-amount-large">${{ number_format($order->total_amount, 2) }}</div>
            </div>
        </div>

        <div class="order-items-table">
            <table>
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->orderItems as $item)
                        <tr>
                            <td>
                                <a href="{{ route('products.show', $item->product) }}">
                                    {{ $item->product->name }}
                                </a>
                            </td>
                            <td>{{ $item->quantity }}</td>
                            <td>${{ number_format($item->price, 2) }}</td>
                            <td style="font-weight: 600; color: #B49F79;">${{ number_format($item->price * $item->quantity, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="action-buttons">
            <a href="{{ route('orders.index') }}" class="btn-back">Back to Orders</a>
            
            @if ($order->status == 'pending')
                <form action="{{ route('orders.destroy', $order) }}" method="POST" style="flex: 1;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-cancel" style="width: 100%;" onclick="return confirm('Are you sure you want to cancel this order?')">Cancel Order</button>
                </form>
            @endif
        </div>
    </div>
</div>
@endsection
