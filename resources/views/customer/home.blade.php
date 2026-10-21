@extends('customer.layouts.app')

@section('title', 'Simple Shop - Giày thể thao chính hãng')

@php
    $categoryImageMap = [
        'Sneaker' => asset('images/home/cat-sneaker.jpg'),
        'Running' => asset('images/home/cat-running.jpg'),
        'Basketball' => asset('images/home/cat-basketball.jpg'),
        'Football' => asset('images/home/cat-football.jpg'),
        'Casual' => asset('images/home/cat-casual.jpg'),
    ];

    $defaultCategories = [
        [
            'name' => 'Sneaker',
            'count' => '120+ sản phẩm',
            'image' => asset('images/home/cat-sneaker.jpg'),
            'url' => route('customer.products.index'),
        ],
        [
            'name' => 'Running',
            'count' => '86+ sản phẩm',
            'image' => asset('images/home/cat-running.jpg'),
            'url' => route('customer.products.index'),
        ],
        [
            'name' => 'Basketball',
            'count' => '64+ sản phẩm',
            'image' => asset('images/home/cat-basketball.jpg'),
            'url' => route('customer.products.index'),
        ],
        [
            'name' => 'Football',
            'count' => '48+ sản phẩm',
            'image' => asset('images/home/cat-football.jpg'),
            'url' => route('customer.products.index'),
        ],
        [
            'name' => 'Casual',
            'count' => '75+ sản phẩm',
            'image' => asset('images/home/cat-casual.jpg'),
            'url' => route('customer.products.index'),
        ],
    ];

    $displayCategories = [];
    if (isset($categories) && count($categories) > 0) {
        foreach ($categories as $cat) {
            $displayCategories[] = [
                'name' => $cat->name,
                'count' => ($cat->products_count ?? ($cat->products->count() ?? 0)) . '+ sản phẩm',
                'image' => $categoryImageMap[$cat->name] ?? asset('images/home/cat-sneaker.jpg'),
                'url' => route('customer.products.index', ['category' => $cat->id]),
            ];
        }
    } else {
        $displayCategories = $defaultCategories;
    }
@endphp

@section('style')
    <style>
        :root {
            --home-hero-bg: linear-gradient(135deg, #f0f7ff 0%, #e8f2fe 50%, #f4f8fd 100%);
            --home-card-blue-bg: linear-gradient(135deg, #f0f7ff 0%, #e6f0fa 100%);
            --home-card-green-bg: linear-gradient(135deg, #f0fdf4 0%, #e6f7ec 100%);
            --home-card-blue-border: rgba(191, 219, 254, 0.7);
            --home-card-green-border: rgba(187, 247, 208, 0.7);
            --home-lift-transform: translateY(-4px);
            --home-lift-shadow: 0 12px 24px -6px rgba(0, 0, 0, 0.08);
            --home-watermark-color: rgba(59, 130, 246, 0.12);
        }

        /* Hero Banner */
        .hero-banner-card {
            background: var(--home-hero-bg);
        }

        .hero-watermark {
            position: absolute;
            top: 6%;
            right: 8%;
            font-size: clamp(2.5rem, 6.5vw, 5rem);
            font-weight: 900;
            font-style: italic;
            letter-spacing: 2px;
            color: var(--home-watermark-color);
            z-index: 0;
            transform: rotate(-6deg);
            user-select: none;
            pointer-events: none;
        }

        .hero-img {
            max-height: 340px;
            filter: drop-shadow(0 15px 30px rgba(0, 0, 0, 0.12));
        }

        /* Shared Icon Circle Component */
        .icon-circle {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            flex-shrink: 0;
        }

        .icon-circle-md {
            width: 36px;
            height: 36px;
            font-size: 1.1rem;
        }

        .icon-circle-lg {
            width: 44px;
            height: 44px;
            font-size: 1.25rem;
        }

        .icon-circle-sm {
            width: 32px;
            height: 32px;
            font-size: 0.75rem;
        }

        /* Hover Micro-interaction */
        .hover-lift {
            transition: transform 0.25s ease, box-shadow 0.25s ease;
        }

        .hover-lift:hover {
            transform: var(--home-lift-transform);
            box-shadow: var(--home-lift-shadow);
        }

        /* Action Cards */
        .card-action-product {
            background: var(--home-card-blue-bg);
            border: 1px solid var(--home-card-blue-border);
        }

        .card-action-cart {
            background: var(--home-card-green-bg);
            border: 1px solid var(--home-card-green-border);
        }

        .action-card-img {
            max-height: 110px;
            filter: drop-shadow(0 10px 15px rgba(0, 0, 0, 0.08));
        }

        /* Category Cards */
        .category-card {
            transition: transform 0.25s ease, box-shadow 0.25s ease, border-color 0.25s ease;
        }

        .category-card:hover {
            transform: var(--home-lift-transform);
            box-shadow: var(--home-lift-shadow);
        }

        .category-card:hover .cat-img {
            transform: scale(1.06);
        }

        .category-card:hover .cat-arrow-btn {
            background-color: var(--bs-primary);
            color: var(--bs-white);
        }

        .cat-img {
            max-height: 95px;
            transition: transform 0.3s ease;
        }

        .cat-arrow-btn {
            transition: background-color 0.2s ease, color 0.2s ease;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid px-3 px-lg-4 py-3">

        {{-- ========================================================
             1. HERO BANNER SECTION
             ======================================================== --}}
        <section class="hero-banner-card position-relative overflow-hidden rounded-4 p-4 p-md-5 mb-4 shadow-sm">
            {{-- Watermark "Better Steps" --}}
            <div class="hero-watermark">
                Better Steps
            </div>

            <div class="row align-items-center g-4 position-relative" style="z-index: 2;">
                {{-- Left: Content --}}
                <div class="col-12 col-lg-6">
                    {{-- Tag/Badge --}}
                    <div class="mb-3">
                        <span
                            class="badge bg-primary-subtle text-primary border border-primary-subtle px-3 py-2 rounded-pill fw-medium small">
                            Giày thể thao chính hãng
                        </span>
                    </div>

                    {{-- Main Title --}}
                    <h1 class="display-4 fw-bold text-dark mb-3">
                        Simple Shop
                    </h1>

                    {{-- Subtitle --}}
                    <p class="text-secondary mb-4 fs-6 lh-base" style="max-width: 480px;">
                        Khám phá những đôi giày tốt nhất, phù hợp với phong cách của bạn.
                    </p>

                    {{-- 3 Features Row --}}
                    <div class="d-flex flex-wrap align-items-center gap-3 gap-md-4 mb-4 pt-1">
                        <div class="d-flex align-items-center gap-2">
                            <div class="icon-circle icon-circle-md bg-primary-subtle text-primary">
                                <i class="bi bi-truck"></i>
                            </div>
                            <div>
                                <div class="fw-bold text-dark small">Giao hàng toàn quốc</div>
                                <div class="text-muted small">Nhanh chóng, an toàn</div>
                            </div>
                        </div>

                        <div class="d-flex align-items-center gap-2">
                            <div class="icon-circle icon-circle-md bg-primary-subtle text-primary">
                                <i class="bi bi-shield-check"></i>
                            </div>
                            <div>
                                <div class="fw-bold text-dark small">Sản phẩm chính hãng</div>
                                <div class="text-muted small">Cam kết chất lượng</div>
                            </div>
                        </div>

                        <div class="d-flex align-items-center gap-2">
                            <div class="icon-circle icon-circle-md bg-primary-subtle text-primary">
                                <i class="bi bi-headset"></i>
                            </div>
                            <div>
                                <div class="fw-bold text-dark small">Hỗ trợ 24/7</div>
                                <div class="text-muted small">Luôn sẵn sàng</div>
                            </div>
                        </div>
                    </div>

                    {{-- CTA Button --}}
                    <div>
                        <a href="{{ route('customer.products.index') }}"
                            class="btn btn-primary rounded-pill px-4 py-2 fw-semibold shadow-sm d-inline-flex align-items-center gap-2">
                            <span>Khám phá ngay</span>
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>

                {{-- Right: Hero Shoe Showcase --}}
                <div class="col-12 col-lg-6 text-center position-relative">
                    <div class="d-inline-block position-relative">
                        <img src="{{ asset('images/home/hero-sneaker.jpg') }}" alt="Simple Shop Sneakers"
                            class="img-fluid rounded-4 shadow-sm hero-img object-fit-contain">
                    </div>

                    {{-- Carousel Indicators --}}
                    <div class="d-flex justify-content-center align-items-center gap-2 mt-3">
                        <span class="rounded-pill bg-primary" style="width: 20px; height: 6px;"></span>
                        <span class="rounded-circle bg-primary-subtle" style="width: 6px; height: 6px;"></span>
                        <span class="rounded-circle bg-primary-subtle" style="width: 6px; height: 6px;"></span>
                    </div>
                </div>
            </div>
        </section>

        {{-- ========================================================
             2. QUICK ACTION CARDS (DANH SÁCH & GIỎ HÀNG)
             ======================================================== --}}
        <section class="row g-4 mb-4">
            {{-- Card 1: Danh sách sản phẩm --}}
            <div class="col-12 col-md-6">
                <div
                    class="card card-action-product rounded-4 p-4 h-100 shadow-sm hover-lift position-relative overflow-hidden">
                    <div class="row align-items-center g-3 h-100">
                        <div class="col-7 z-1">
                            <div class="icon-circle icon-circle-lg bg-primary text-white mb-3 shadow-sm">
                                <i class="bi bi-search"></i>
                            </div>
                            <h5 class="fw-bold text-dark mb-1">Danh sách sản phẩm</h5>
                            <p class="text-secondary small mb-3">Xem những sản phẩm có sẵn</p>
                            <a href="{{ route('customer.products.index') }}"
                                class="btn btn-light bg-white text-primary rounded-pill px-3 py-2 fw-semibold shadow-sm small d-inline-flex align-items-center gap-2 border-0">
                                <span>Đến xem các sản phẩm</span>
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                        <div class="col-5 text-end position-relative">
                            <img src="{{ asset('images/home/cat-sneaker.jpg') }}" alt="Danh sách sản phẩm"
                                class="img-fluid rounded-3 action-card-img object-fit-contain">
                        </div>
                    </div>
                </div>
            </div>

            {{-- Card 2: Giỏ hàng --}}
            <div class="col-12 col-md-6">
                <div
                    class="card card-action-cart rounded-4 p-4 h-100 shadow-sm hover-lift position-relative overflow-hidden">
                    <div class="row align-items-center g-3 h-100">
                        <div class="col-7 z-1">
                            <div class="icon-circle icon-circle-lg bg-success text-white mb-3 shadow-sm">
                                <i class="bi bi-bag-check-fill"></i>
                            </div>
                            <h5 class="fw-bold text-dark mb-1">Giỏ hàng</h5>
                            <p class="text-secondary small mb-3">Xem những sản phẩm trong giỏ hàng</p>
                            <a href="{{ route('customer.cart.index') }}"
                                class="btn btn-light bg-white text-success rounded-pill px-3 py-2 fw-semibold shadow-sm small d-inline-flex align-items-center gap-2 border-0">
                                <span>Đi tới giỏ hàng</span>
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                        <div class="col-5 text-end position-relative">
                            <img src="{{ asset('images/home/cart-sneaker.jpg') }}" alt="Giỏ hàng"
                                class="img-fluid rounded-3 action-card-img object-fit-contain">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- ========================================================
             3. CATEGORY LIST SECTION (DANH MỤC SẢN PHẨM)
             ======================================================== --}}
        <section class="mb-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="fw-bold text-dark mb-0">Danh mục sản phẩm</h5>
                <a href="{{ route('customer.products.index') }}"
                    class="text-primary text-decoration-none fw-semibold small d-inline-flex align-items-center gap-1">
                    <span>Xem tất cả</span>
                    <i class="bi bi-arrow-right"></i>
                </a>
            </div>

            <div class="row row-cols-2 row-cols-sm-3 row-cols-lg-5 g-3">
                @foreach ($displayCategories as $cat)
                    <div class="col">
                        <a href="{{ $cat['url'] }}" class="text-decoration-none">
                            <div
                                class="card category-card border border-light-subtle rounded-4 p-3 h-100 shadow-sm bg-white">
                                <div class="text-center mb-3 rounded-3 p-2 d-flex align-items-center justify-content-center bg-light"
                                    style="height: 120px;">
                                    <img src="{{ $cat['image'] }}" alt="{{ $cat['name'] }}"
                                        class="img-fluid cat-img object-fit-contain">
                                </div>
                                <div class="d-flex align-items-center justify-content-between mt-auto">
                                    <div>
                                        <h6 class="fw-bold text-dark mb-0 fs-6">{{ $cat['name'] }}</h6>
                                        <span class="small text-muted">{{ $cat['count'] }}</span>
                                    </div>
                                    <div class="icon-circle icon-circle-sm cat-arrow-btn bg-primary-subtle text-primary">
                                        <i class="bi bi-chevron-right"></i>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </section>

    </div>
@endsection
