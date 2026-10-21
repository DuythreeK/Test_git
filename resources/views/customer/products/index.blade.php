@extends('customer.layouts.app')

@section('title', 'Danh sách sản phẩm - Simple Shop')

@section('style')
    <style>
        /* ============================================================
                                   CHẾ ĐỘ XEM DANH SÁCH (LIST VIEW)
                                   ============================================================ */
        :root {
            --list-img-size-sm: 96px;
            --list-img-size-md: 130px;
            --list-gap: 1rem;
        }

        /* 1. Chuyển card từ dọc sang ngang */
        .view-list .product-card {
            display: flex;
            flex-direction: row;
            align-items: center;
            gap: var(--list-gap);
            padding: var(--list-gap) !important;
        }

        /* 2. Cố định kích thước khung ảnh (ghi đè utility mb-2 của Bootstrap) */
        .view-list .product-img-box {
            width: var(--list-img-size-sm);
            height: var(--list-img-size-sm);
            min-width: var(--list-img-size-sm);
            margin-bottom: 0 !important;
            flex-shrink: 0;
        }

        /* 3. Ẩn nút wishlist nổi ở góc để tránh trùng lặp và đè lên ảnh */
        .view-list .btn-floating-wishlist {
            display: none !important;
        }

        /*
                    /* 4. Responsive cho Tablet & Desktop (>= 768px) */
        @media (min-width: 768px) {
            .view-list .product-img-box {
                width: var(--list-img-size-md);
                height: var(--list-img-size-md);
                min-width: var(--list-img-size-md);
            }

            /* Thông tin bên trái, Giá & Nút bấm bên phải */
            .view-list .product-info {
                flex-direction: row !important;
                align-items: center;
                justify-content: space-between;
                gap: 1.5rem;
            }

            .view-list .product-meta .text-truncate {
                white-space: normal !important;
            }

            .view-list .product-side {
                min-width: 180px;
                margin-top: 0 !important;
            }

            .view-list .product-side .text-price {
                margin-top: 0 !important;
                font-size: 1.2rem;
            }
        }

        */
    </style>
@endsection

@section('content')
    <div class="container-fluid px-lg-4 py-3">

        {{-- HERO BANNER --}}
        <div class="hero-banner p-4 p-md-5 mb-4 shadow-sm position-relative rounded-4">
            <div class="row align-items-center">
                <div class="col-12 col-md-7 z-1">
                    <h1 class="fw-bold text-dark mb-2" style="font-size: 1.85rem;">Simple Shop</h1>
                    <p class="text-secondary mb-3" style="font-size: 0.95rem;">
                        Khám phá những đôi giày tốt nhất, phù hợp với phong cách của bạn.
                    </p>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 small">
                            <li class="breadcrumb-item">
                                <a href="{{ route('home') }}" class="text-decoration-none text-secondary">
                                    <i class="bi bi-house-door-fill me-1"></i>Trang chủ
                                </a>
                            </li>
                            <li class="breadcrumb-item active text-dark fw-medium" aria-current="page">Danh sách sản phẩm
                            </li>
                        </ol>
                    </nav>
                </div>
                <div class="col-12 col-md-5 d-none d-md-block text-end">
                    <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=600&auto=format&fit=crop&q=80"
                        alt="Shoe Banner" class="hero-shoe-img">
                </div>
            </div>
        </div>

        {{-- MAIN 2-COLUMN LAYOUT --}}
        <div class="row g-4">

            {{-- LEFT SIDEBAR: BỘ LỌC SẢN PHẨM --}}
            <div class="col-12 col-lg-3">
                <div class="card bg-white border-light-subtle rounded-3 p-3 shadow-sm sticky-top"
                    style="top: 80px; z-index: 10;">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="fw-bold text-dark d-flex align-items-center gap-2" style="font-size: 0.95rem;">
                            <i class="bi bi-sliders"></i> Bộ lọc sản phẩm
                        </span>
                        <a href="{{ route('customer.products.index') }}"
                            class="text-primary text-decoration-none small fw-medium">
                            Xóa tất cả
                        </a>
                    </div>

                    <form method="GET" action="{{ route('customer.products.index') }}" id="filterForm">
                        @if (request('per_page'))
                            <input type="hidden" name="per_page" value="{{ request('per_page') }}">
                        @endif

                        {{-- Tìm kiếm --}}
                        <div class="mb-3">
                            <label class="form-label small fw-semibold text-secondary" for="search">Tìm kiếm</label>
                            <div class="position-relative">
                                <input type="text" class="form-control form-control-sm pe-4" name="search"
                                    id="search" placeholder="Nhập tên sản phẩm..." value="{{ request('search') }}">
                                <i class="bi bi-search position-absolute text-secondary"
                                    style="right: 10px; top: 50%; transform: translateY(-50%); font-size: 0.8rem;"></i>
                            </div>
                        </div>

                        {{-- Danh mục --}}
                        <div class="mb-3">
                            <label class="form-label small fw-semibold text-secondary" for="category">Danh mục</label>
                            <select class="form-select form-select-sm" name="category" id="category">
                                <option value="">Tất cả danh mục</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ request('category') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Khoảng giá --}}
                        <div class="mb-3">
                            <label class="form-label small fw-semibold text-secondary">Khoảng giá</label>
                            <div class="d-flex align-items-center gap-2">
                                <input type="number" class="form-control form-control-sm" name="min_price"
                                    placeholder="Từ (VNĐ)" value="{{ request('min_price') }}">
                                <span class="text-secondary">-</span>
                                <input type="number" class="form-control form-control-sm" name="max_price"
                                    placeholder="Đến (VNĐ)" value="{{ request('max_price') }}">
                            </div>
                        </div>

                        {{-- Sắp xếp theo --}}
                        <div class="mb-4">
                            <label class="form-label small fw-semibold text-secondary" for="sort">Sắp xếp theo</label>
                            <select class="form-select form-select-sm" name="sort" id="sort">
                                <option value="">Mặc định</option>
                                <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>Giá: Thấp đến Cao
                                </option>
                                <option value="desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>Giá: Cao đến Thấp
                                </option>
                            </select>
                        </div>

                        {{-- Nút Submit --}}
                        <button type="submit" class="btn btn-primary w-100 rounded-pill py-2 fw-semibold shadow-sm"
                            style="font-size: 0.875rem;">
                            <i class="bi bi-funnel-fill me-1"></i> Lọc sản phẩm
                        </button>
                    </form>
                </div>
            </div>

            {{-- RIGHT COLUMN: PRODUCT GRID --}}
            <div class="col-12 col-lg-9">

                {{-- Toolbar --}}
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-secondary small fw-medium">
                        Hiển thị <strong class="text-dark">{{ $products->count() }}</strong> sản phẩm
                    </span>

                    <div class="d-flex align-items-center gap-2">
                        {{-- Chế độ xem Grid / List --}}
                        <div class="btn-group btn-group-sm">
                            <button type="button" class="btn btn-primary active" id="btnGridView" title="Dạng lưới">
                                <i class="bi bi-grid-fill"></i>
                            </button>
                            <button type="button" class="btn btn-outline-secondary" id="btnListView"
                                title="Dạng danh sách">
                                <i class="bi bi-list-ul"></i>
                            </button>
                        </div>

                        {{-- Số lượng hiển thị / trang --}}
                        <select class="form-select form-select-sm" style="width: 120px;"
                            onchange="location.href = updateQueryString('per_page', this.value)">
                            <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10 / trang
                            </option>
                            <option value="20" {{ request('per_page') == 20 ? 'selected' : '' }}>20 / trang</option>
                            <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50 / trang</option>
                        </select>
                    </div>
                </div>

                {{-- 5-COLUMN PRODUCT GRID --}}
                <div id="productContainer" class="row row-cols-2 row-cols-sm-3 row-cols-md-3 row-cols-xl-5 g-3">
                    @forelse($products as $product)
                        @php
                            $hasStock = true;
                            if ($product->variants && $product->variants->count() > 0) {
                                $hasStock = $product->variants->sum('stock') > 0;
                            } elseif (isset($product->status) && $product->status == 0) {
                                $hasStock = false;
                            }
                        @endphp

                        <div class="col">
                            <div
                                class="card product-card border-light-subtle h-100 p-2 position-relative bg-white shadow-sm">
                                {{-- Badge Còn hàng / Hết hàng --}}
                                @if ($hasStock)
                                    <span class="badge rounded-pill bg-success position-absolute top-0 start-0 m-2 z-1">
                                        Còn hàng
                                    </span>
                                @else
                                    <span class="badge rounded-pill bg-danger position-absolute top-0 start-0 m-2 z-1">
                                        Hết hàng
                                    </span>
                                @endif

                                {{-- Wishlist Button --}}
                                <button type="button"
                                    class="btn btn-floating-wishlist rounded-circle d-flex align-items-center justify-content-center p-0"
                                    title="Yêu thích">
                                    <i class="bi bi-heart"></i>
                                </button>

                                {{-- Product Image --}}
                                <div
                                    class="product-img-box bg-light rounded-2 d-flex align-items-center justify-content-center p-2 mb-2">
                                    @if ($product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                            class="product-img img-fluid object-fit-contain mh-100">
                                    @else
                                        <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=300&auto=format&fit=crop&q=80"
                                            alt="{{ $product->name }}"
                                            class="product-img img-fluid object-fit-contain mh-100">
                                    @endif
                                </div>

                                {{-- Product Info --}}
                                <div class="product-info d-flex flex-column flex-grow-1 px-1">
                                    {{-- Cột trái: Thông tin sản phẩm --}}
                                    <div class="product-meta flex-grow-1 pe-md-3">
                                        <h6 class="text-truncate fw-bold text-dark mb-1" title="{{ $product->name }}"
                                            style="font-size: 0.875rem;">
                                            {{ $product->name }}
                                        </h6>

                                        {{-- Category Tag --}}
                                        <div>
                                            <span
                                                class="badge bg-primary-subtle text-primary border border-primary-subtle mb-1"
                                                style="font-size: 0.7rem;">
                                                {{ $product->category->name ?? 'Casual' }}
                                            </span>
                                        </div>

                                        {{-- Rating --}}
                                        <div class="d-flex align-items-center gap-1 text-warning small mb-1"
                                            style="font-size: 0.725rem;">
                                            <i class="bi bi-star-fill"></i>
                                            {{-- <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-half"></i> --}}
                                            <span class="text-secondary ms-1">{{ $product->averageRating() }}
                                                ({{ $product->totalReviews() }})
                                            </span>
                                        </div>
                                    </div>

                                    {{-- Cột phải: Giá & Nút hành động --}}
                                    <div class="product-side mt-auto text-md-end">
                                        {{-- Price --}}
                                        <div class="text-price fw-bold fs-6 mb-2">
                                            {{ number_format($product->price) }}₫
                                        </div>

                                        {{-- Action Buttons --}}
                                        <div class="d-flex gap-1 justify-content-md-end">
                                            @if ($hasStock)
                                                <a href="{{ route('customer.products.show', $product) }}"
                                                    class="btn btn-primary btn-sm rounded-2 flex-grow-1 flex-md-grow-0 d-inline-flex align-items-center justify-content-center gap-1 fw-semibold"
                                                    style="font-size: 0.775rem;">
                                                    <i class="bi bi-cart3"></i> Chi tiết
                                                </a>
                                            @else
                                                <button
                                                    class="btn btn-secondary btn-sm rounded-2 flex-grow-1 flex-md-grow-0 disabled"
                                                    style="font-size: 0.775rem;" disabled>
                                                    <i class="bi bi-slash-circle"></i> Hết hàng
                                                </button>
                                            @endif

                                            <button class="btn btn-outline-secondary btn-sm rounded-2 px-2" type="button"
                                                title="Thêm vào yêu thích">
                                                <i class="bi bi-heart"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 w-100">
                            <div class="alert alert-light text-center border py-5 rounded-4 bg-white shadow-sm">
                                <i class="bi bi-inbox text-secondary" style="font-size: 2.5rem;"></i>
                                <h6 class="mt-3 text-secondary">Không tìm thấy sản phẩm phù hợp</h6>
                                <p class="text-muted small">Hãy thử tìm với từ khóa khác hoặc xóa bộ lọc</p>
                                <a href="{{ route('customer.products.index') }}"
                                    class="btn btn-outline-primary btn-sm rounded-pill mt-2">
                                    Xem tất cả sản phẩm
                                </a>
                            </div>
                        </div>
                    @endforelse
                </div>

                {{-- Phân trang --}}
                <div class="d-flex justify-content-center mt-4">
                    {{ $products->appends(request()->query())->links() }}
                </div>

            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function updateQueryString(key, value) {
            let url = new URL(window.location.href);
            url.searchParams.set(key, value);
            return url.href;
        }
        document.addEventListener('DOMContentLoaded', function() {
            const btnGrid = document.getElementById('btnGridView');
            const btnList = document.getElementById('btnListView');
            const container = document.getElementById('productContainer');
            if (!btnGrid || !btnList || !container) return;
            const GRID_COLS = ['row-cols-2', 'row-cols-sm-3', 'row-cols-md-3', 'row-cols-xl-5'];

            function setView(mode) {
                const isList = mode === 'list';

                //Đổi chế độ xem giữa Grid và List
                container.classList.toggle('view-list', isList);
                container.classList.toggle('row-cols-1', isList);
                GRID_COLS.forEach(c => container.classList.toggle(c, !isList));

                //Đổi trạng thái của Nút
                btnList.classList.toggle('btn-primary', isList);
                btnList.classList.toggle('active', isList);
                btnList.classList.toggle('btn-outline-secondary', !isList);

                btnGrid.classList.toggle('btn-primary', !isList);
                btnGrid.classList.toggle('active', !isList);
                btnGrid.classList.toggle('btn-outline-secondary', isList);

                localStorage.setItem('product_view_mode', mode);

            }
            btnGrid.addEventListener('click', () => setView('grid'));
            btnList.addEventListener('click', () => setView('list'));

            if (localStorage.getItem('product_view_mode') === 'list') {
                setView('list');
            }
        });
    </script>
@endsection
