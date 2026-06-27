@extends('layouts.app')

@section('title', 'My Orders - Maison de Hoor')

@section('content')
<style>
    .orders-container {
        min-height: 90vh;
        padding: 4rem 2rem;
        background-color: #FFFCF7;
    }
    
    .orders-header {
        text-align: center;
        margin-bottom: 3rem;
    }
    
    .orders-title {
        font-size: 2.5rem;
        font-weight: 700;
        color: #2C2C2C;
        text-transform: uppercase;
        letter-spacing: 2px;
        margin-bottom: 0.5rem;
    }
    
    .orders-subtitle {
        color: #B49F79;
        font-size: 1rem;
        letter-spacing: 1px;
    }
    
    .orders-table {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        margin-bottom: 2rem;
    }
    
    .orders-table table {
        width: 100%;
        border-collapse: collapse;
    }
    
    .orders-table thead {
        background: #F4F4F4;
        border-bottom: 2px solid #E0E0E0;
    }
    
    .orders-table th {
        padding: 1.5rem;
        text-align: left;
        color: #2C2C2C;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 1px;
    }
    
    .orders-table td {
        padding: 1.5rem;
        color: #4A4A4A;
        border-bottom: 1px solid #E0E0E0;
    }
    
    .orders-table tr:hover {
        background: #F9F9F9;
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
    
    .btn-view {
        background: #B49F79;
        color: white;
        padding: 8px 16px;
        border: none;
        border-radius: 4px;
        font-weight: 600;
        text-decoration: none;
        cursor: pointer;
        transition: all 0.3s;
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 0.5px;
        display: inline-block;
    }
    
    .btn-view:hover {
        background: #C893A0;
        color: white;
        text-decoration: none;
        transform: translateY(-2px);
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
    
    .btn-shop {
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
        display: inline-block;
    }
    
    .btn-shop:hover {
        background: #C893A0;
        color: white;
        text-decoration: none;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(193, 137, 160, 0.3);
    }
    
    .pagination {
        display: flex;
        justify-content: center;
        gap: 0.5rem;
        margin-top: 2rem;
    }
    
    .pagination a, .pagination span {
        padding: 8px 12px;
        border: 2px solid #E0E0E0;
        border-radius: 4px;
        text-decoration: none;
        color: #2C2C2C;
        font-weight: 600;
        transition: all 0.3s;
    }
    
    .pagination a:hover {
        border-color: #B49F79;
        color: #B49F79;
    }
    
    .pagination span.active {
        background: #B49F79;
        color: white;
        border-color: #B49F79;
    }
    
    @media (max-width: 768px) {
        .orders-title {
            font-size: 1.8rem;
        }
    }
</style>

<div class="orders-container">
    <div class="container">
        <div class="orders-header">
            <h1 class="orders-title">Your Orders</h1>
            <p class="orders-subtitle">Track your luxury purchases</p>
        </div>

        @if ($orders->count())
            <div class="orders-table">
                <table>
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Date</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td><strong>#{{ $order->id }}</strong></td>
                                <td>{{ $order->created_at->format('M d, Y') }}</td>
                                <td style="font-weight: 600; color: #B49F79;">${{ number_format($order->total_amount, 2) }}</td>
                                <td>
                                    <span class="badge-luxury badge-{{ 
                                        $order->status == 'delivered' ? 'success' : 
                                        ($order->status == 'cancelled' ? 'danger' : 'warning')
                                    }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('orders.show', $order) }}" class="btn-view">View Details</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="pagination">
                {{ $orders->links() }}
            </div>
        @else
            <div class="empty-state">
                <h2>No Orders Yet</h2>
                <p>Explore our luxury collection and place your first order today.</p>
                <a href="{{ route('products.index') }}" class="btn-shop">Start Shopping</a>
            </div>
        @endif
    </div>
</div>
@endsection
