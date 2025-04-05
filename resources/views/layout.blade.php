<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Para4You')</title>
    <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css" rel="stylesheet">
    
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css">
    
    <!-- Page specific styles -->
    @yield('page_styles')

    <!-- Custom Styles -->
    <style>
        :root {
            --primary: #c98eb6;
            --primary-dark: #a76e93;
            --secondary: #f8f4f7;
            --dark: #2d3142;
            --light: #ffffff;
            --gray: #eef1f6;
            --success: #4caf50;
            --danger: #f44336;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            color: var(--dark);
            background-color: #fafafa;
            overflow-x: hidden;
        }
        
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Montserrat', sans-serif;
            font-weight: 600;
        }
        
        .navbar {
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            padding: 15px 0;
            background-color: var(--light) !important;
        }
        
        .navbar-brand {
            font-family: 'Montserrat', sans-serif;
            font-weight: 700;
            font-size: 1.8rem;
            color: var(--primary) !important;
        }
        
        .nav-link {
            font-weight: 500;
            color: var(--dark) !important;
            margin: 0 10px;
            position: relative;
            transition: all 0.3s ease;
        }
        
        .nav-link:after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            background-color: var(--primary);
            left: 0;
            bottom: 0;
            transition: width 0.3s ease;
        }
        
        .nav-link:hover:after, .nav-link.active:after {
            width: 100%;
        }
        
        .btn-primary {
            background-color: var(--primary);
            border-color: var(--primary);
            border-radius: 30px;
            padding: 8px 24px;
            font-weight: 500;
            transition: all 0.3s ease;
            color: white;
        }
        
        .btn-primary:hover, 
        .btn-primary:focus, 
        .btn-primary:active,
        .btn-primary:focus-visible {
            background-color: var(--primary-dark) !important;
            border-color: var(--primary-dark) !important;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(201, 142, 182, 0.3);
            color: white !important;
            outline: none !important;
        }
        
        .btn-outline-primary {
            color: var(--primary) !important;
            border-color: var(--primary);
            border-radius: 30px;
            padding: 8px 24px;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .btn-outline-primary:hover,
        .btn-outline-primary:focus,
        .btn-outline-primary:active,
        .btn-outline-primary:focus-visible {
            background-color: var(--primary) !important;
            border-color: var(--primary) !important;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(201, 142, 182, 0.3);
            color: white !important;
            outline: none !important;
        }
        
        /* Fix active state for all buttons */
        .btn:active, .btn:focus {
            outline: none !important;
            box-shadow: none !important;
        }
        
        /* Fix dropdown active states */
        .dropdown-item:active,
        .dropdown-item:focus {
            background-color: var(--primary) !important;
            color: white !important;
        }
        
        .card {
            border: none;
            border-radius: 12px;
            overflow: hidden;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.1);
        }
        
        footer {
            background-color: var(--dark);
            color: var(--light);
            padding: 60px 0 20px;
        }
        
        .badge-cart {
            position: absolute;
            top: -8px;
            right: -8px;
            background-color: var(--primary);
            border-radius: 50%;
            width: 20px;
            height: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 12px;
            font-weight: 600;
        }
        
        .cart-icon {
            position: relative;
            font-size: 24px;
        }
        
        .hero-section {
            background-size: cover;
            background-position: center;
            padding: 120px 0;
            position: relative;
            color: white;
        }
        
        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to right, rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.4));
        }
        
        .hero-content {
            position: relative;
            z-index: 1;
        }
        
        .section-title {
            position: relative;
            margin-bottom: 50px;
            text-align: center;
        }
        
        .section-title h2 {
            font-size: 16px;
            font-weight: 500;
            text-transform: uppercase;
            color: var(--primary);
            margin-bottom: 5px;
        }
        
        .section-title h1 {
            font-size: 32px;
            margin-bottom: 15px;
            position: relative;
            display: inline-block;
        }
        
        .section-title h1:after {
            content: '';
            position: absolute;
            width: 50px;
            height: 3px;
            background-color: var(--primary);
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
        }
        
        /* Button Get Started styling */
        .btn-get-started {
            display: inline-block;
            background: var(--primary);
            color: white;
            padding: 10px 25px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            text-align: center;
        }
        
        .btn-get-started:hover {
            background: var(--primary-dark);
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(201, 142, 182, 0.4);
            color: white;
        }
        
        /* Additional styling for specific sections */
        .about-section, .testimonials {
            padding: 80px 0;
        }
        
        .about-section .content-title {
            font-size: 26px;
            margin-bottom: 20px;
            color: var(--dark);
        }
        
        .about-section .content-subtitle {
            color: var(--primary);
            font-weight: 500;
            display: block;
            margin-bottom: 10px;
        }

        /* Additional custom styles here */
        html {
            scroll-behavior: smooth;
        }

        /* Dropdown styles */
        .dropdown-menu {
            display: none;
            position: absolute;
            background-color: #fff;
            min-width: 10rem;
            padding: 0.5rem 0;
            margin: 0.125rem 0 0;
            font-size: 1rem;
            color: #212529;
            text-align: left;
            list-style: none;
            background-clip: padding-box;
            border: 1px solid rgba(0,0,0,.15);
            border-radius: 0.25rem;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
            z-index: 1000;
        }

        .dropdown-menu.show {
            display: block;
        }

        .dropdown-item {
            display: block;
            width: 100%;
            padding: 0.25rem 1.5rem;
            clear: both;
            font-weight: 400;
            color: #212529;
            text-align: inherit;
            white-space: nowrap;
            background-color: transparent;
            border: 0;
        }

        .dropdown-item:hover, .dropdown-item:focus {
            color: #16181b;
            text-decoration: none;
            background-color: #f8f9fa;
        }
    </style>
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('welcome') }}">Para4You</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('welcome') ? 'active' : '' }}" aria-current="page" href="{{ route('welcome') }}">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('produits.index') ? 'active' : '' }}" href="{{ route('produits.index') }}">Produits</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">À propos</a>
                    </li>
                </ul>
                <div class="d-flex align-items-center">
                    @if (session('user_id'))
                        <a href="{{ route('cart') }}" class="nav-link position-relative me-3">
                            <div class="cart-icon">
                                <i class="bi bi-cart"></i>
                                <span class="badge badge-cart" id="cartCount">{{ \App\Models\CartItem::where('user_id', session('user_id'))->sum('quantity') }}</span>
                            </div>
                        </a>
                        <div class="dropdown">
                            <button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ session('name') }}
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item" href="{{ route('profile') }}">Profil</a></li>
                                <li><a class="dropdown-item" href="{{ route('orders.index') }}">Mes commandes</a></li>
                                @if (session('is_admin'))
                                    <li><a class="dropdown-item" href="{{ route('admin') }}">Administration</a></li>
                                @endif
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="{{ route('logout') }}">Déconnexion</a></li>
                            </ul>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline-primary me-2">Connexion</a>
                        <a href="{{ route('register') }}" class="btn btn-primary text-white">Inscription</a>
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    @yield('footer')

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- AOS JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    
    <!-- Initialize AOS -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            AOS.init({
                duration: 1000,
                easing: 'ease-in-out',
                once: true,
                mirror: false
            });
        });
    </script>
    
    <!-- Page specific scripts -->
    @yield('page_scripts')
</body>

</html>
