@extends('layouts.app')

@section('title', $product->name . ' - Maison de Hoor')

@section('content')
<div class="container" style="margin: 3rem 0;">
    <div class="row g-5">
        <!-- Product Image Gallery -->
        <div class="col-md-6">
            @php
                $galleryImages = [];
                if ($product->image) $galleryImages[] = Storage::url($product->image);
                foreach ($product->productImages as $pi) $galleryImages[] = Storage::url($pi->image);
            @endphp

            @if(count($galleryImages) > 0)
                <!-- Main image display -->
                <div style="position: relative; overflow: hidden; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); margin-bottom: 12px; background: #F4F4F4;">
                    <img id="mainGalleryImg" src="{{ $galleryImages[0] }}" alt="{{ $product->name }}"
                         style="width: 100%; height: 520px; object-fit: cover; transition: opacity 0.35s ease;">

                    @if(count($galleryImages) > 1)
                        <!-- Prev/Next arrows -->
                        <button onclick="galleryPrev()" style="position:absolute; left:12px; top:50%; transform:translateY(-50%); width:40px; height:40px; background:rgba(255,255,255,0.85); border:none; border-radius:50%; cursor:pointer; font-size:1.1rem; display:flex; align-items:center; justify-content:center; box-shadow:0 2px 8px rgba(0,0,0,0.15); transition:background 0.2s;" onmouseover="this.style.background='white'" onmouseout="this.style.background='rgba(255,255,255,0.85)'">&#8592;</button>
                        <button onclick="galleryNext()" style="position:absolute; right:12px; top:50%; transform:translateY(-50%); width:40px; height:40px; background:rgba(255,255,255,0.85); border:none; border-radius:50%; cursor:pointer; font-size:1.1rem; display:flex; align-items:center; justify-content:center; box-shadow:0 2px 8px rgba(0,0,0,0.15); transition:background 0.2s;" onmouseover="this.style.background='white'" onmouseout="this.style.background='rgba(255,255,255,0.85)'">&#8594;</button>

                        <!-- Counter -->
                        <div style="position:absolute; bottom:12px; right:12px; background:rgba(0,0,0,0.45); color:white; font-size:0.8rem; padding:3px 10px; border-radius:20px; font-weight:600;">
                            <span id="galleryCounter">1</span> / {{ count($galleryImages) }}
                        </div>
                    @endif
                </div>

                @if(count($galleryImages) > 1)
                    <!-- Thumbnail strip -->
                    <div style="display: flex; gap: 8px; flex-wrap: wrap;">
                        @foreach($galleryImages as $i => $imgUrl)
                            <div onclick="galleryGoTo({{ $i }})" id="thumb-{{ $i }}"
                                 style="width: 70px; height: 70px; border-radius: 4px; overflow: hidden; cursor: pointer; border: 2px solid {{ $i === 0 ? '#B49F79' : '#E0E0E0' }}; transition: border-color 0.2s; flex-shrink:0;">
                                <img src="{{ $imgUrl }}" alt="" style="width:100%; height:100%; object-fit:cover;">
                            </div>
                        @endforeach
                    </div>
                @endif
            @else
                <div style="background-color: #f5f1e8; min-height: 500px; display: flex; align-items: center; justify-content: center; border-radius: 8px;">
                    <div style="text-align:center;">
                        <i class="fas fa-image" style="font-size: 4rem; color: #ddd; margin-bottom: 1rem; display: block;"></i>
                        <span class="text-muted">Image Coming Soon</span>
                    </div>
                </div>
            @endif
        </div>

        <!-- Product Details -->
        <div class="col-md-6">
            <!-- Title -->
            <h1 style="font-size: 2.2rem; font-weight: 700; color: #2c2c2c; margin-bottom: 1rem; line-height: 1.2;">
                {{ $product->name }}
            </h1>

            <!-- Price -->
            <h2 style="color: #8b7355; font-weight: 700; font-size: 2rem; margin-bottom: 1.5rem;">
                AED {{ number_format($product->price, 2) }}
            </h2>

            <!-- Description -->
            <div style="margin-bottom: 2rem;">
                <p style="color: #4a4a4a; line-height: 1.8; font-size: 1rem;">
                    {{ $product->description }}
                </p>
            </div>

            <!-- Stock Status -->
            <div style="margin-bottom: 2rem;">
                <p style="font-weight: 600; color: #2c2c2c; margin-bottom: 0.5rem;">AVAILABILITY</p>
                <p>
                    <span class="badge" style="background-color: {{ $product->stock > 0 ? '#B49F79' : '#dc3545' }}; padding: 0.5rem 1rem; font-size: 0.9rem;">
                        {{ $product->stock > 0 ? $product->stock . ' units in stock' : 'Out of Stock' }}
                    </span>
                </p>
            </div>

            <!-- Add to Cart Form / Login Prompt -->
            @if ($product->stock > 0)
                @auth
                    <!-- Logged in - Show Add to Cart -->
                    <form action="{{ route('cart.store') }}" method="POST" style="margin-bottom: 2rem;">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        
                        <div style="margin-bottom: 1.5rem;">
                            <label for="quantity" style="font-weight: 600; color: #2c2c2c; display: block; margin-bottom: 0.5rem;">QUANTITY</label>
                            <div style="display: flex; gap: 1rem;">
                                <input type="number" id="quantity" name="quantity" class="form-control" value="1" min="1" max="{{ $product->stock }}" required style="max-width: 100px; padding: 0.75rem; border: 1px solid #ddd; text-align: center;">
                                <button type="submit" class="btn btn-primary" style="flex: 1; text-transform: uppercase; letter-spacing: 1px; font-weight: 600;">
                                    <i class="fas fa-shopping-bag"></i> ADD TO CART
                                </button>
                            </div>
                        </div>
                    </form>
                @else
                    <!-- Not logged in - Show login prompt -->
                    <div style="background: #FFF5F5; border: 2px solid #C893A0; padding: 2rem; border-radius: 8px; margin-bottom: 2rem; text-align: center;">
                        <i class="fas fa-lock" style="font-size: 2rem; color: #C893A0; margin-bottom: 1rem; display: block;"></i>
                        <h3 style="color: #2C2C2C; font-weight: 700; margin-bottom: 0.5rem;">Sign in to Add to Cart</h3>
                        <p style="color: #666; margin-bottom: 1.5rem; font-size: 0.95rem;">
                            Create an account or sign in to add items to your cart and proceed to checkout.
                        </p>
                        <div style="display: flex; gap: 1rem; justify-content: center;">
                            <a href="{{ route('login') }}" class="btn btn-primary" style="text-transform: uppercase; letter-spacing: 1px; font-weight: 600; text-decoration: none;">
                                <i class="fas fa-sign-in-alt"></i> SIGN IN
                            </a>
                            <a href="{{ route('register') }}" class="btn btn-outline-primary" style="text-transform: uppercase; letter-spacing: 1px; font-weight: 600; text-decoration: none;">
                                <i class="fas fa-user-plus"></i> CREATE ACCOUNT
                            </a>
                        </div>
                    </div>
                @endauth
            @else
                <div class="alert alert-warning" role="alert" style="margin-bottom: 2rem;">
                    <i class="fas fa-info-circle"></i> This item is currently out of stock
                </div>
            @endif

            <!-- Back Button -->
            <div style="border-top: 1px solid #eee; padding-top: 2rem;">
                <a href="{{ route('products.index') }}" class="btn btn-outline-primary">← BACK TO CREATIONS</a>
            </div>

            <!-- Product Info -->
            <div style="background-color: #FFFCF7; padding: 1.5rem; border-radius: 8px; margin-top: 2rem;">
                <div class="row text-center">
                    <div class="col-4">
                        <i class="fas fa-shipping-fast" style="font-size: 1.5rem; color: #B49F79; margin-bottom: 0.5rem; display: block;"></i>
                        <p style="font-size: 0.85rem; color: #7A7A7A;">FAST SHIPPING</p>
                    </div>
                    <div class="col-4">
                        <i class="fas fa-lock" style="font-size: 1.5rem; color: #B49F79; margin-bottom: 0.5rem; display: block;"></i>
                        <p style="font-size: 0.85rem; color: #7A7A7A;">SECURE</p>
                    </div>
                    <div class="col-4">
                        <i class="fas fa-redo" style="font-size: 1.5rem; color: #B49F79; margin-bottom: 0.5rem; display: block;"></i>
                        <p style="font-size: 0.85rem; color: #7A7A7A;">30-DAY RETURNS</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const galleryImages = @json($galleryImages ?? []);
    let currentIndex = 0;

    function galleryGoTo(index) {
        if (index < 0 || index >= galleryImages.length) return;
        const img = document.getElementById('mainGalleryImg');
        const counter = document.getElementById('galleryCounter');

        img.style.opacity = '0';
        setTimeout(() => {
            img.src = galleryImages[index];
            img.style.opacity = '1';
            if (counter) counter.textContent = index + 1;
        }, 200);

        // Update thumbnail borders
        document.querySelectorAll('[id^="thumb-"]').forEach((el, i) => {
            el.style.borderColor = i === index ? '#B49F79' : '#E0E0E0';
        });

        currentIndex = index;
    }

    function galleryNext() {
        galleryGoTo((currentIndex + 1) % galleryImages.length);
    }

    function galleryPrev() {
        galleryGoTo((currentIndex - 1 + galleryImages.length) % galleryImages.length);
    }

    // Keyboard arrow navigation
    document.addEventListener('keydown', (e) => {
        if (e.key === 'ArrowRight') galleryNext();
        if (e.key === 'ArrowLeft') galleryPrev();
    });
</script>

@endsection
