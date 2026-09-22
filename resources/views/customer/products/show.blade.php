@extends('customer.layouts.app')

@section('title', 'Chi tiết sản phẩm - ' . $product->name)

@section('style')
    <style>
        #tbl tr th {
            background-color: #111827;
            color: white;
            width: 25%;
        }
    </style>
@endsection

@section('content')
    <div class="container py-4">
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb small">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}" class="text-decoration-none text-secondary">
                        <i class="bi bi-house-door-fill me-1"></i>Trang chủ
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('customer.products.index') }}" class="text-decoration-none text-secondary">
                        Danh sách sản phẩm
                    </a>
                </li>
                <li class="breadcrumb-item active text-dark fw-medium" aria-current="page">{{ $product->name }}</li>
            </ol>
        </nav>

        <div class="card shadow-sm border-light-subtle rounded-3">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0 fw-bold text-dark">
                    <i class="bi bi-info-circle me-2 text-primary"></i>Chi tiết sản phẩm
                </h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped align-middle" id="tbl">
                    <tr>
                        <th>Tên sản phẩm</th>
                        <td class="fw-semibold">{{ $product->name }}</td>
                    </tr>
                    <tr>
                        <th>Danh mục</th>
                        <td>
                            <span class="badge bg-primary-subtle text-primary border border-primary-subtle">
                                {{ $product->category->name }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th>Đơn giá</th>
                        <td class="text-danger fw-bold fs-5">{{ number_format($product->price) }} VNĐ</td>
                    </tr>
                    <tr>
                        <th>Mô tả</th>
                        <td>{{ $product->description ?? 'Đang cập nhật mô tả cho sản phẩm này.' }}</td>
                    </tr>
                    @if ($product->image)
                        <tr>
                            <th>Hình ảnh</th>
                            <td>
                                <img src="{{ asset('storage/' . $product->image) }}" class="img-thumbnail"
                                    style="max-height: 250px; object-fit: contain;">
                            </td>
                        </tr>
                    @endif
                </table>

                <hr class="my-4">

                @if ($product->variants->count() > 0)
                    <form action="{{ route('customer.cart.store') }}" method="POST">
                        @csrf
                        {{-- Chọn kích cỡ (Size) --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold">
                                Chọn kích cỡ (Size):
                            </label>
                            <div class="d-flex gap-2 flex-wrap">
                                @foreach ($product->variants as $variant)
                                    <input type="radio" class="btn-check" name="product_variant_id"
                                        id="size-{{ $variant->id }}" value="{{ $variant->id }}"
                                        {{ $variant->stock <= 0 ? 'disabled' : '' }} required>
                                    <label class="btn btn-outline-primary size-option rounded-3 p-2"
                                        for="size-{{ $variant->id }}">
                                        <strong>Size {{ $variant->size->name }}</strong>
                                        @if ($variant->stock <= 0)
                                            <small class="d-block text-danger">Hết hàng</small>
                                        @else
                                            <small class="d-block text-muted">Còn: {{ $variant->stock }}</small>
                                        @endif
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        {{-- Số lượng --}}
                        <div class="d-flex mb-3 align-items-center gap-3">
                            <label class="fw-semibold">Số lượng:</label>
                            <input class="form-control form-control-sm" type="number" name="quantity" value="1"
                                min="1" style="width: 100px" required>
                        </div>

                        <button type="submit" class="btn btn-primary px-4 py-2 rounded-pill fw-semibold shadow-sm">
                            <i class="bi bi-cart-plus me-1"></i> Thêm vào giỏ hàng
                        </button>
                    </form>
                @else
                    <div class="alert alert-warning d-inline-block">
                        <i class="bi bi-exclamation-triangle me-1"></i> Sản phẩm hiện đang tạm hết hàng.
                    </div>
                @endif
            </div>
        </div>

        <a href="{{ route('customer.products.index') }}" class="btn btn-outline-secondary mt-3 rounded-pill px-3">
            <i class="bi bi-arrow-left me-1"></i> Quay lại danh sách sản phẩm
        </a>
    </div>
@endsection
