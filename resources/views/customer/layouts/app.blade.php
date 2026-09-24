<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Simple Shop')</title>

    {{-- Google Font: Inter --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    {{-- Bootstrap 5.3.8 & Bootstrap Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        /* ============================================================
           1. DESIGN TOKENS (CSS VARIABLES)
           ============================================================ */
        :root {
            --app-font: 'Inter', system-ui, -apple-system, sans-serif;
            --app-nav-bg: #111827;
            --app-nav-search-bg: #1f2937;
            --app-nav-search-border: #374151;
            --app-price-color: #dc2626;
            --app-radius: 0.75rem;
            --app-shadow-hover: 0 10px 20px -5px rgba(0, 0, 0, 0.08);
            --app-transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        }

        body {
            font-family: var(--app-font);
        }

        /* ============================================================
           2. NAVBAR
           ============================================================ */
        .custom-navbar {
            background-color: var(--app-nav-bg);
        }

        .custom-navbar .nav-link {
            color: var(--bs-gray-400);
            position: relative;
            transition: color 0.2s ease;
        }

        .custom-navbar .nav-link:hover,
        .custom-navbar .nav-link.active {
            color: var(--bs-white);
        }

        .custom-navbar .nav-link.active::after {
            content: '';
            position: absolute;
            bottom: -0.65rem;
            left: 1rem;
            right: 1rem;
            height: 2px;
            background-color: var(--bs-primary);
            border-radius: 2px;
        }

        .navbar-search {
            background-color: var(--app-nav-search-bg);
            border-color: var(--app-nav-search-border);
            color: var(--bs-white);
            padding-right: 2.25rem;
        }

        .navbar-search:focus {
            background-color: var(--app-nav-search-bg);
            border-color: var(--bs-primary);
            color: var(--bs-white);
            box-shadow: none;
        }

        /* ============================================================
           3. HERO BANNER
           ============================================================ */
        .hero-banner {
            background: linear-gradient(90deg, #eef2f6 0%, #f8fafc 50%, #eef2f6 100%);
            min-height: 175px;
        }

        .hero-shoe-img {
            position: absolute;
            right: 5%;
            top: 50%;
            transform: translateY(-50%);
            max-height: 195px;
            filter: drop-shadow(0 15px 25px rgba(0, 0, 0, 0.15));
            pointer-events: none;
        }

        /* ============================================================
           4. PRODUCT CARD & MICRO-INTERACTIONS
           ============================================================ */
        .product-card {
            border-radius: var(--app-radius);
            transition: var(--app-transition);
        }

        .product-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--app-shadow-hover);
        }

        .product-img-box {
            height: 140px;
        }

        .product-img {
            transition: transform 0.3s ease;
        }

        .product-card:hover .product-img {
            transform: scale(1.06);
        }

        .btn-floating-wishlist {
            position: absolute;
            top: 0.6rem;
            right: 0.6rem;
            width: 30px;
            height: 30px;
            z-index: 2;
            background-color: rgba(255, 255, 255, 0.9);
            border: 1px solid var(--bs-border-color);
            color: var(--bs-secondary);
            transition: var(--app-transition);
        }

        .btn-floating-wishlist:hover {
            color: var(--bs-danger);
            background-color: var(--bs-white);
        }

        .text-price {
            color: var(--app-price-color);
        }
    </style>
    @yield('style')
</head>

<body class="d-flex flex-column min-vh-100 bg-body-tertiary">

    {{-- NAVBAR --}}
    <nav class="navbar navbar-expand-lg custom-navbar sticky-top py-2">
        <div class="container-fluid px-lg-4">
            {{-- LOGO --}}
            <a href="{{ route('home') }}" class="navbar-brand text-white fw-bold d-flex align-items-center gap-2">
                <i class="bi bi-lightning-charge-fill text-primary fs-4"></i>
                <span>Simple Shop</span>
            </a>

            <button class="navbar-toggler border-secondary text-white" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            {{-- MENU ITEMS --}}
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto ms-lg-3 mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a href="{{ route('home') }}"
                            class="nav-link px-3 d-inline-flex align-items-center gap-1 {{ request()->routeIs('home') ? 'active' : '' }}">
                            <i class="bi bi-house-door"></i> Trang chủ
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('customer.products.index') }}"
                            class="nav-link px-3 d-inline-flex align-items-center gap-1 {{ request()->routeIs('customer.products.*') ? 'active' : '' }}">
                            <i class="bi bi-grid-3x3-gap"></i> Danh sách sản phẩm
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('customer.cart.index') }}"
                            class="nav-link px-3 d-inline-flex align-items-center gap-1 {{ request()->routeIs('customer.cart.*') ? 'active' : '' }}">
                            <i class="bi bi-cart3"></i> Giỏ hàng
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('customer.orders.index') }}"
                            class="nav-link px-3 d-inline-flex align-items-center gap-1 {{ request()->routeIs('customer.orders.*') ? 'active' : '' }}">
                            <i class="bi bi-receipt"></i> Danh sách đơn hàng
                        </a>
                    </li>
                </ul>

                {{-- SEARCH & AUTH --}}
                <div class="d-flex align-items-center gap-3">
                    <form action="{{ route('customer.products.index') }}" method="GET"
                        class="position-relative d-none d-md-block m-0">
                        <input type="text" name="search"
                            class="form-control form-control-sm rounded-pill navbar-search"
                            placeholder="Tìm kiếm sản phẩm..." value="{{ request('search') }}">
                        <i class="bi bi-search position-absolute text-secondary"
                            style="right: 12px; top: 50%; transform: translateY(-50%); font-size: 0.8rem;"></i>
                    </form>

                    @auth
                        <div class="dropdown">
                            <button
                                class="btn btn-outline-secondary btn-sm text-light rounded-2 d-inline-flex align-items-center gap-1 dropdown-toggle"
                                type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-person-circle"></i>
                                <span>{{ auth()->user()->name }}</span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 rounded-3 mt-2">
                                <li>
                                    <a class="dropdown-item py-2 small" href="{{ route('customer.orders.index') }}">
                                        <i class="bi bi-receipt me-2 text-primary"></i>Đơn hàng của tôi
                                    </a>
                                </li>
                                @if (auth()->user()->role === 'admin')
                                    <li>
                                        <a class="dropdown-item py-2 small" href="{{ route('dashboard.index') }}">
                                            <i class="bi bi-speedometer2 me-2 text-primary"></i>Quản trị hệ thống</a>
                                    </li>
                                @endif
                                <li>
                                    <hr class="dropdown-divider my-1">
                                </li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST" class="m-0">
                                        @csrf
                                        <button type="submit" class="dropdown-item py-2 small text-danger"><i
                                                class="bi bi-box-arrow-right me-2"></i>Đăng xuất</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @else
                        <a href="{{ route('login') }}"
                            class="btn btn-outline-secondary btn-sm text-light rounded-2 d-inline-flex align-items-center gap-1">
                            <i class="bi bi-person"></i>
                            <span>Đăng nhập</span>
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    {{-- MAIN CONTENT --}}
    <main class="flex-grow-1">
        {{-- Flash Messages --}}
        <div class="container-fluid px-lg-4 mt-3">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show rounded-3 shadow-sm">
                    <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show rounded-3 shadow-sm">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if (isset($errors) && $errors->any())
                <div class="alert alert-danger alert-dismissible fade show rounded-3 shadow-sm">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
        </div>

        @yield('content')
    </main>

    {{-- FOOTER --}}
    <footer class="bg-white border-top py-3 text-center text-muted small mt-5">
        <div class="container">
            <p class="mb-0">© 2026 Simple Shop. Tất cả các quyền được bảo lưu.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <x-chatbot />
    @yield('script')
</body>

</html>
