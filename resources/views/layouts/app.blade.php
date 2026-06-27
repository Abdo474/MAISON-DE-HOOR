<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Maison de Hoor - Luxury Fashion')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --dark-gold: #B49F79;
            --light-gold: #C893A0;
            --cream: #FFFCF7;
            --light-grey: #F4F4F4;
            --dark: #2C2C2C;
            --text: #4A4A4A;
        }
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Poppins', 'Segoe UI', sans-serif;
            color: var(--text);
            background-color: #fff;
            background-image: url('/images/background-pattern.svg');
            background-repeat: repeat;
            background-size: 200px 200px;
            background-attachment: fixed;
        }
        /* Navbar */
        .navbar {
            background-color: var(--dark) !important;
            padding: 1rem 0;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .navbar-brand {
            font-weight: 700;
            font-size: 1.8rem;
            letter-spacing: 2px;
            color: var(--light-gold) !important;
            font-style: italic;
        }
        .navbar-brand:hover {
            color: #fff !important;
        }
        .nav-link {
            color: #ddd !important;
            font-weight: 500;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 1px;
            transition: color 0.3s;
            margin: 0 0.5rem;
        }
        .nav-link:hover {
            color: var(--light-gold) !important;
        }
        .nav-link.active {
            color: var(--light-gold) !important;
            border-bottom: 2px solid var(--light-gold);
        }
        /* Buttons */
        .btn-primary {
            background-color: var(--dark-gold);
            border-color: var(--dark-gold);
            font-weight: 600;
            letter-spacing: 1px;
            transition: all 0.3s;
        }
        .btn-primary:hover {
            background-color: var(--light-gold);
            border-color: var(--light-gold);
            color: var(--dark);
        }
        /* Hero Section */
        .hero {
            position: relative;
            color: white;
            padding: 8rem 0;
            text-align: center;
            min-height: 500px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }
        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(44, 44, 44, 0.7), rgba(139, 115, 85, 0.7));
            z-index: 1;
        }
        .hero video {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: 0;
        }
        .hero .text-center {
            position: relative;
            z-index: 2;
        }
        .hero h1 {
            font-size: 3.5rem;
            font-weight: 700;
            letter-spacing: 2px;
            margin-bottom: 1rem;
            text-transform: uppercase;
        }
        .hero p {
            font-size: 1.3rem;
            font-weight: 300;
            letter-spacing: 1px;
            margin-bottom: 2rem;
        }
        /* Product Cards */
        .product-card {
            border: none;
            transition: all 0.4s;
            overflow: hidden;
            background: #fff;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        }
        .product-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 24px rgba(0,0,0,0.15);
        }
        .product-image {
            height: 350px;
            object-fit: cover;
            transition: transform 0.5s;
        }
        .product-card:hover .product-image {
            transform: scale(1.05);
        }
        .product-title {
            font-weight: 600;
            font-size: 1.1rem;
            color: var(--dark);
            text-transform: capitalize;
            margin-top: 1rem;
        }
        .product-price {
            color: var(--dark-gold);
            font-weight: 700;
            font-size: 1.3rem;
            margin: 0.5rem 0;
        }
        .product-category {
            color: #A8A8A8;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 0.5rem;
        }
        /* Collections Section */
        .collection-section {
            padding: 4rem 0;
            background-color: rgba(255, 252, 247, 0.95);
            background-image: url('/images/background-pattern.svg');
            background-repeat: repeat;
            background-size: 200px 200px;
            background-attachment: fixed;
        }
        .collection-title {
            text-align: center;
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 3rem;
            letter-spacing: 1px;
            text-transform: uppercase;
        }
        .collection-title::after {
            content: '';
            display: block;
            width: 60px;
            height: 3px;
            background: var(--dark-gold);
            margin: 1rem auto 0;
        }
        /* Footer */
        footer {
            background-color: var(--dark);
            background-image: url('/images/background-pattern.svg');
            background-repeat: repeat;
            background-size: 200px 200px;
            background-attachment: fixed;
            color: #ddd;
            margin-top: 5rem;
            padding: 3rem 0 1rem;
        }
        footer h5 {
            color: var(--light-gold);
            font-weight: 600;
            font-size: 1.1rem;
            margin-bottom: 1.5rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        footer a {
            color: #B0A090;
            text-decoration: none;
            transition: color 0.3s;
            font-size: 0.95rem;
        }
        footer a:hover {
            color: var(--light-gold);
        }
        footer .social-links a {
            font-size: 1.3rem;
            margin-right: 1rem;
        }
        .footer-bottom {
            border-top: 1px solid #444;
            margin-top: 2rem;
            padding-top: 2rem;
            text-align: center;
            color: #888;
            font-size: 0.9rem;
        }
    </style>
    @stack('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/nouislider@15.7.1/dist/nouislider.min.css">
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}" style="gap: 0.75rem;">
                <img src="{{ asset('images/logo.svg') }}" alt="MAISON DE HOOR" style="height: 45px; width: auto;">
                <span>MAISON DE HOOR</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">HOME</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('products.index') }}">CREATIONS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('collections.index') }}">COLLECTIONS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="@auth{{ route('cart.index') }}@else{{ route('login') }}@endauth">
                            <i class="fas fa-shopping-bag"></i> CART
                        </a>
                    </li>
                    
                    @auth
                        <!-- Logged in - Show user info and logout -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-user-circle"></i> {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown" style="background-color: #1a1a1a; border-color: #B49F79;">
                                <li>
                                    <a class="dropdown-item" href="{{ route('home') }}" style="color: #ddd;">
                                        <i class="fas fa-user"></i> My Account
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('orders.index') }}" style="color: #ddd;">
                                        <i class="fas fa-box"></i> My Orders
                                    </a>
                                </li>
                                @if (Auth::user()->is_admin)
                                    <li><hr class="dropdown-divider" style="border-color: #444;"></li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('admin.dashboard') }}" style="color: #FFD700; font-weight: 600;">
                                            <i class="fas fa-crown"></i> Admin Panel
                                        </a>
                                    </li>
                                @endif
                                <li><hr class="dropdown-divider" style="border-color: #444;"></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="dropdown-item" style="color: #ddd; border: none; background: none; cursor: pointer; width: 100%; text-align: left;">
                                            <i class="fas fa-sign-out-alt"></i> Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <!-- Not logged in - Show login/register links -->
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">
                                <i class="fas fa-sign-in-alt"></i> SIGN IN
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}" style="color: var(--light-gold) !important;">
                                <i class="fas fa-user-plus"></i> REGISTER
                            </a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Messages -->
    @if ($errors->any())
        <div class="alert alert-danger container mt-3">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success container mt-3">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger container mt-3">
            {{ session('error') }}
        </div>
    @endif

    <!-- Main Content -->
    <main class="py-4">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-3 mb-4">
                    <h5>ABOUT US</h5>
                    <p>Maison de Hoor is a luxury fashion house dedicated to creating timeless, elegant pieces for the modern woman.</p>
                    <div class="social-links mt-3">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-facebook"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-tiktok"></i></a>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <h5>CREATIONS</h5>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('products.index') }}">Latest Collection</a></li>
                        <li><a href="{{ route('products.index') }}">Featured Items</a></li>
                        <li><a href="{{ route('products.index') }}">New Arrivals</a></li>
                        <li><a href="{{ route('products.index') }}">Sale</a></li>
                    </ul>
                </div>
                <div class="col-md-3 mb-4">
                    <h5>CUSTOMER CARE</h5>
                    <ul class="list-unstyled">
                        <li><a href="#">Contact Us</a></li>
                        <li><a href="#">Shipping Info</a></li>
                        <li><a href="#">Returns</a></li>
                        <li><a href="#">Size Guide</a></li>
                    </ul>
                </div>
                <div class="col-md-3 mb-4">
                    <h5>CONTACT</h5>
                    <p>
                        <strong>Email:</strong><br>
                        <a href="mailto:hello@maisondehoor.com">hello@maisondehoor.com</a>
                    </p>
                    <p>
                        <strong>Phone:</strong><br>
                        +971-4-XXX-XXXX
                    </p>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2024 MAISON DE HOOR. All rights reserved. | Privacy Policy | Terms & Conditions</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/nouislider@15.7.1/dist/nouislider.min.js"></script>
    @stack('scripts')
</body>
</html>
