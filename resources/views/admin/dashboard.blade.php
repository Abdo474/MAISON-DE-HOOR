@extends('layouts.app')

@section('title', 'Admin Dashboard - Maison de Hoor')

@section('content')
<div style="min-height: 90vh; padding: 4rem 2rem; background-color: #FFFCF7;">
    <div class="container">
        <!-- Header -->
        <div style="margin-bottom: 3rem;">
            <h1 style="font-size: 2.5rem; color: #2C2C2C; text-transform: uppercase; letter-spacing: 2px; font-weight: 700; margin-bottom: 0.5rem;">
                Admin Dashboard
            </h1>
            <p style="color: #999; font-size: 1rem;">Manage your store - Collections, Products, and Videos</p>
        </div>

        <!-- Quick Stats -->
        <div class="row g-4" style="margin-bottom: 3rem;">
            <div class="col-md-12">
                <div style="background: white; padding: 2rem; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.08); text-align: center;">
                    <h3 style="color: #2C2C2C; font-weight: 700; margin: 0;">{{ $collectionsCount }}</h3>
                    <p style="color: #999; margin: 0.5rem 0 0;">Collections</p>
                </div>
            </div>

        <!-- Admin Actions -->
        <div style="background: white; border-radius: 12px; padding: 2rem; box-shadow: 0 4px 12px rgba(0,0,0,0.08);">
            <h2 style="font-size: 1.5rem; color: #2C2C2C; font-weight: 700; margin-bottom: 2rem; text-transform: uppercase; letter-spacing: 1px;">
                Management Options
            </h2>

            <div class="row g-3">
                <!-- Collections -->
                <div class="col-md-12">
                    <a href="{{ route('admin.collections') }}" style="display: block; padding: 2rem; background: linear-gradient(135deg, #FFFCF7, #F4F4F4); border: 2px solid #B49F79; border-radius: 8px; text-decoration: none; transition: all 0.3s;"
                       onmouseover="this.style.borderColor='#C893A0'; this.style.background='linear-gradient(135deg, #F9F4F0, #EFEFEF)'"
                       onmouseout="this.style.borderColor='#B49F79'; this.style.background='linear-gradient(135deg, #FFFCF7, #F4F4F4)'">
                        <h3 style="color: #2C2C2C; font-weight: 700; margin: 0 0 0.5rem;">Manage Collections</h3>
                        <p style="color: #999; margin: 0; font-size: 0.95rem;">Create, edit collections and manage their videos</p>
                    </a>
                </div>

                <!-- Products -->
                <div class="col-md-12">
                    <a href="{{ route('admin.products') }}" style="display: block; padding: 2rem; background: linear-gradient(135deg, #FFFCF7, #F4F4F4); border: 2px solid #B49F79; border-radius: 8px; text-decoration: none; transition: all 0.3s;"
                       onmouseover="this.style.borderColor='#C893A0'; this.style.background='linear-gradient(135deg, #F9F4F0, #EFEFEF)'"
                       onmouseout="this.style.borderColor='#B49F79'; this.style.background='linear-gradient(135deg, #FFFCF7, #F4F4F4)'">
                        <h3 style="color: #2C2C2C; font-weight: 700; margin: 0 0 0.5rem;">Manage Products</h3>
                        <p style="color: #999; margin: 0; font-size: 0.95rem;">Create, edit, or delete products</p>
                    </a>
                </div>
            </div>
        </div>

        <!-- Back Link -->
        <div style="margin-top: 3rem; text-align: center;">
            <a href="{{ route('home') }}" style="color: #B49F79; text-decoration: none; font-weight: 600; font-size: 0.95rem;">
                ← Back to Home
            </a>
        </div>
    </div>
</div>
@endsection
