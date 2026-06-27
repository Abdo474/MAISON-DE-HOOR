@extends('layouts.app')

@section('title', 'Manage Products - Admin')

@section('content')
<div style="min-height: 90vh; padding: 4rem 2rem; background-color: #FFFCF7;">
    <div class="container">
        <!-- Header -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 3rem;">
            <div>
                <h1 style="font-size: 2rem; color: #2C2C2C; text-transform: uppercase; letter-spacing: 2px; font-weight: 700; margin-bottom: 0.5rem;">
                    Manage Products
                </h1>
                <p style="color: #999; margin: 0;">Create, edit, or delete products</p>
            </div>
            <a href="{{ route('admin.products.create') }}" style="display: inline-block; padding: 12px 30px; background: #B49F79; color: white; border-radius: 6px; text-decoration: none; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; transition: all 0.3s;"
               onmouseover="this.style.background='#C893A0'"
               onmouseout="this.style.background='#B49F79'">
                Add Product
            </a>
        </div>

        @if ($products->count())
            <!-- Products Table -->
            <div style="background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.08);">
                <div style="overflow-x: auto;">
                    <table style="width: 100%; border-collapse: collapse;">
                        <thead>
                            <tr style="background-color: #F4F4F4; border-bottom: 2px solid #E0E0E0;">
                                <th style="padding: 1.5rem; text-align: left; color: #2C2C2C; font-weight: 600; text-transform: uppercase; font-size: 0.85rem; letter-spacing: 1px;">Name</th>
                                <th style="padding: 1.5rem; text-align: left; color: #2C2C2C; font-weight: 600; text-transform: uppercase; font-size: 0.85rem; letter-spacing: 1px;">Collection</th>
                                <th style="padding: 1.5rem; text-align: left; color: #2C2C2C; font-weight: 600; text-transform: uppercase; font-size: 0.85rem; letter-spacing: 1px;">Price</th>
                                <th style="padding: 1.5rem; text-align: left; color: #2C2C2C; font-weight: 600; text-transform: uppercase; font-size: 0.85rem; letter-spacing: 1px;">Stock</th>
                                <th style="padding: 1.5rem; text-align: center; color: #2C2C2C; font-weight: 600; text-transform: uppercase; font-size: 0.85rem; letter-spacing: 1px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr style="border-bottom: 1px solid #E0E0E0; transition: background-color 0.3s;"
                                    onmouseover="this.style.backgroundColor='#F9F9F9'"
                                    onmouseout="this.style.backgroundColor='transparent'">
                                    <td style="padding: 1.5rem; color: #2C2C2C; font-weight: 600;">{{ $product->name }}</td>
                                    <td style="padding: 1.5rem; color: #666;">{{ $product->collection?->name ?? 'Unassigned' }}</td>
                                    <td style="padding: 1.5rem; color: #B49F79; font-weight: 600;">${{ number_format($product->price, 2) }}</td>
                                    <td style="padding: 1.5rem; color: #666;">{{ $product->stock }}</td>
                                    <td style="padding: 1.5rem; text-align: center;">
                                        <a href="{{ route('admin.products.edit', $product) }}" style="display: inline-block; padding: 6px 12px; background: #B49F79; color: white; border-radius: 4px; text-decoration: none; font-weight: 600; font-size: 0.8rem; margin-right: 0.5rem; transition: all 0.3s;"
                                           onmouseover="this.style.background='#C893A0'"
                                           onmouseout="this.style.background='#B49F79'">
                                            Edit
                                        </a>
                                        <form action="{{ route('admin.products.delete', $product) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this product?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" style="padding: 6px 12px; background: #dc3545; color: white; border: none; border-radius: 4px; font-weight: 600; font-size: 0.8rem; cursor: pointer; transition: all 0.3s;"
                                                    onmouseover="this.style.background='#c82333'"
                                                    onmouseout="this.style.background='#dc3545'">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            <!-- Empty State -->
            <div style="background: white; border-radius: 12px; padding: 4rem; text-align: center; box-shadow: 0 4px 12px rgba(0,0,0,0.08);">
                <h2 style="color: #2C2C2C; font-weight: 700; margin-bottom: 0.5rem;">No Products Yet</h2>
                <p style="color: #999; font-size: 1rem; margin-bottom: 2rem;">
                    Create your first product to get started!
                </p>
                <a href="{{ route('admin.products.create') }}" style="display: inline-block; padding: 12px 30px; background: #B49F79; color: white; border-radius: 6px; text-decoration: none; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; transition: all 0.3s;"
                   onmouseover="this.style.background='#C893A0'"
                   onmouseout="this.style.background='#B49F79'">
                    Create Product
                </a>
            </div>
        @endif

        <!-- Back Link -->
        <div style="margin-top: 3rem; text-align: center;">
            <a href="{{ route('admin.dashboard') }}" style="color: #B49F79; text-decoration: none; font-weight: 600; font-size: 0.95rem;">
                ← Back to Admin Dashboard
            </a>
        </div>
    </div>
</div>
@endsection
