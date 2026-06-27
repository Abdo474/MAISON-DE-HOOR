@extends('layouts.app')

@section('title', 'MAISON DE HOOR - Luxury Fashion')

@section('content')
<style>
    .hero-section {
        background: linear-gradient(135deg, #2C2C2C 0%, #1a1a1a 100%);
        background-image: url('{{ asset("images/logo.svg") }}'), linear-gradient(135deg, #2C2C2C 0%, #1a1a1a 100%);
        background-position: center;
        background-size: 600px;
        background-repeat: no-repeat;
        background-attachment: fixed;
        color: white;
        padding: 120px 40px;
        text-align: center;
        min-height: 70vh;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        position: relative;
        overflow: hidden;
        width: 100vw;
        margin-left: calc(-50vw + 50%);
    }
    
    .hero-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(44, 44, 44, 0.85);
        z-index: 1;
    }
    
    .hero-section > * {
        position: relative;
        z-index: 2;
    }
    
    body {
        background-color: #000 !important;
        background-image: none !important;
    }
    
    .hero-title {
        font-size: 4rem;
        font-weight: 700;
        letter-spacing: 4px;
        margin-bottom: 1.5rem;
        text-transform: uppercase;
        color: #FFFCF7;
    }
    
    .hero-subtitle {
        font-size: 1.3rem;
        color: #C893A0;
        margin-bottom: 2rem;
        letter-spacing: 2px;
        font-weight: 300;
    }
    
    .hero-description {
        font-size: 1rem;
        color: #FFFCF7;
        max-width: 700px;
        margin: 0 auto 3rem;
        line-height: 1.8;
        opacity: 0.9;
    }
    
    .cta-buttons {
        display: flex;
        gap: 2rem;
        justify-content: center;
        flex-wrap: wrap;
        margin-bottom: 3rem;
    }
    
    .btn-primary, .btn-secondary {
        padding: 15px 40px;
        font-size: 1rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        text-decoration: none;
        display: inline-block;
        transition: all 0.3s ease;
    }
    
    .btn-primary {
        background: #B49F79;
        color: white;
    }
    
    .btn-primary:hover {
        background: #C893A0;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(193, 137, 160, 0.3);
    }
    
    .btn-secondary {
        background: transparent;
        color: #B49F79;
        border: 2px solid #B49F79;
    }
    
    .btn-secondary:hover {
        background: #B49F79;
        color: white;
        transform: translateY(-2px);
    }
    
    .features-section {
        padding: 80px 40px;
        background: #FFFCF7;
    }
    
    .features-container {
        max-width: 1200px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 3rem;
    }
    
    .feature-card {
        text-align: center;
        padding: 2rem;
    }
    
    .feature-icon {
        font-size: 3rem;
        margin-bottom: 1rem;
        color: #B49F79;
    }
    
    .feature-title {
        font-size: 1.3rem;
        font-weight: 700;
        color: #2C2C2C;
        margin-bottom: 0.5rem;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    
    .feature-text {
        color: #4A4A4A;
        line-height: 1.6;
    }
    
    .collections-section {
        padding: 80px 40px;
        background: white;
    }
    
    .section-title {
        font-size: 2.5rem;
        font-weight: 700;
        text-align: center;
        color: #2C2C2C;
        margin-bottom: 3rem;
        text-transform: uppercase;
        letter-spacing: 2px;
    }
    
    .collections-grid {
        max-width: 1200px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 2rem;
    }
    
    .collection-item {
        position: relative;
        overflow: hidden;
        border-radius: 8px;
        aspect-ratio: 1;
        cursor: pointer;
        transition: transform 0.3s ease;
    }
    
    .collection-item:hover {
        transform: scale(1.03);
    }
    
    .collection-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        background: linear-gradient(135deg, #B49F79 0%, #C893A0 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.2rem;
    }
    
    .collection-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.4);
        display: flex;
        align-items: flex-end;
        justify-content: center;
        padding: 2rem;
        color: white;
    }
    
    .collection-name {
        font-size: 1.5rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    
    .about-section {
        padding: 80px 40px;
        background: linear-gradient(135deg, #2C2C2C 0%, #1a1a1a 100%);
        color: white;
        text-align: center;
    }
    
    .about-content {
        max-width: 800px;
        margin: 0 auto;
    }
    
    .about-title {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 2rem;
        text-transform: uppercase;
        letter-spacing: 2px;
        color: #C893A0;
    }
    
    .about-text {
        font-size: 1.1rem;
        line-height: 1.8;
        opacity: 0.9;
        margin-bottom: 2rem;
    }
    
    @media (max-width: 768px) {
        .hero-title {
            font-size: 2.5rem;
        }
        
        .hero-subtitle {
            font-size: 1rem;
        }
        
        .cta-buttons {
            flex-direction: column;
            gap: 1rem;
        }
        
        .btn-primary, .btn-secondary {
            width: 100%;
        }
        
        .section-title {
            font-size: 1.8rem;
        }
    }
</style>

<!-- Hero Section -->
<section class="hero-section">
    <div class="hero-subtitle">WELCOME TO</div>
    <h1 class="hero-title">MAISON DE HOOR</h1>
    <p class="hero-description">
        Handcrafted luxury pieces for the discerning woman. Discover timeless elegance and modern sophistication in every creation.
    </p>
    <div class="cta-buttons">
        <a href="{{ route('products.index') }}" class="btn-primary">
            Explore Creations
        </a>
        <a href="{{ route('collections.index') }}" class="btn-secondary">
            View Collections
        </a>
    </div>
</section>

<!-- Features Section -->
<section class="features-section">
    <div class="features-container">
        <div class="feature-card">
            <div class="feature-icon">✨</div>
            <h3 class="feature-title">Luxury Crafted</h3>
            <p class="feature-text">Each piece is meticulously handcrafted with premium materials and exceptional attention to detail.</p>
        </div>
        <div class="feature-card">
            <div class="feature-icon">🌟</div>
            <h3 class="feature-title">Timeless Design</h3>
            <p class="feature-text">Classic elegance that transcends trends, designed to be cherished for years to come.</p>
        </div>
        <div class="feature-card">
            <div class="feature-icon">💎</div>
            <h3 class="feature-title">Premium Quality</h3>
            <p class="feature-text">Only the finest materials are selected to ensure durability and unmatched quality in every piece.</p>
        </div>
    </div>
</section>

<!-- Collections Showcase -->
<section class="collections-section">
    <h2 class="section-title">Our Collections</h2>
    <div class="collections-grid">
        @forelse($collections as $collection)
            <a href="{{ route('collections.show', $collection->slug) }}" class="collection-item" style="text-decoration: none;">
                @if($collection->media_type === 'photo' && $collection->media)
                    <img src="{{ Storage::url($collection->media) }}" alt="{{ $collection->name }}" class="collection-image" style="width: 100%; height: 100%; object-fit: cover;">
                @elseif($collection->media_type === 'video' && $collection->media)
                    <video style="width: 100%; height: 100%; object-fit: cover;" autoplay muted loop playsinline>
                        <source src="{{ Storage::url($collection->media) }}" type="video/mp4">
                    </video>
                @elseif($collection->video)
                    <video style="width: 100%; height: 100%; object-fit: cover;" autoplay muted loop playsinline>
                        <source src="{{ route('videos.stream', $collection->video->id) }}" type="video/mp4">
                    </video>
                @else
                    <div class="collection-image">{{ $collection->name }}</div>
                @endif
                <div class="collection-overlay">
                    <div class="collection-name">{{ $collection->name }}</div>
                </div>
            </a>
        @empty
            <p style="grid-column: 1/-1; text-align: center; color: #999;">No collections available yet.</p>
        @endforelse
    </div>
</section>

<!-- About Section -->
<section class="about-section">
    <div class="about-content">
        <h2 class="about-title">About Maison de Hoor</h2>
        <p class="about-text">
            Maison de Hoor represents the pinnacle of luxury fashion craftsmanship. Founded with a passion for timeless elegance, we create exclusive pieces that celebrate the modern woman's sophistication and refined taste.
        </p>
        <p class="about-text">
            Every creation tells a story of dedication, artistry, and uncompromising quality. From concept to completion, we ensure that each piece reflects our commitment to excellence.
        </p>
        <a href="{{ route('products.index') }}" class="btn-primary" style="margin-top: 1rem;">
            Start Shopping
        </a>
    </div>
</section>

<script>
    // Simple animation on scroll
    document.addEventListener('DOMContentLoaded', function() {
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -100px 0px'
        };
        
        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);
        
        document.querySelectorAll('.feature-card, .collection-item').forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(20px)';
            el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            observer.observe(el);
        });
    });
</script>
@endsection
