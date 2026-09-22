@extends('layouts.app')

@section('title', 'Chi tiết sản phẩm: ' . $product->name . ' - Simple Shop Admin')

@section('content')
    <div class="container-fluid px-0">
        {{-- BREADCRUMB --}}
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb small">
                <li class="breadcrumb-item"><a href="{{ route('products.index') }}" class="text-decoration-none">Sản phẩm</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
            </ol>
        </nav>

        <div class="row g-4">
            {{-- PRODUCT PREVIEW & QUICK INFO --}}
            <div class="col-12 col-lg-5">
                <div class="card border-0 rounded-4 shadow-sm bg-white p-4 text-center">
                    <div class="rounded-4 bg-light p-4 d-flex align-items-center justify-content-center mb-3" style="min-height: 280px;">
                        @if ($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" 
                                 class="img-fluid object-fit-contain rounded-3" style="max-height: 250px;">
                        @else
                            <div class="text-secondary py-5">
                                <i class="bi bi-image fs-1 d-block mb-2"></i>
                                <span class="small">Chưa có hình ảnh</span>
                            </div>
                        @endif
                    </div>
                    <h5 class="fw-bold text-dark mb-1">{{ $product->name }}</h5>
                    <div class="text-danger fw-bold fs-4 mb-2">{{ number_format($product->price) }} VNĐ</div>
                    <div class="d-flex justify-content-center gap-2 flex-wrap">
                        <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-3 py-1 rounded-pill">
                            <i class="bi bi-tag-fill me-1"></i>{{ $product->category->name ?? 'Sneaker' }}
                        </span>
                        <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle px-3 py-1 rounded-pill">
                            <i class="bi bi-box me-1"></i>Tổng tồn kho: {{ $product->variants ? $product->variants->sum('stock') : 0 }} đôi
                        </span>
                    </div>
                </div>
            </div>

            {{-- PRODUCT DETAILED SPECS & VARIANTS --}}
            <div class="col-12 col-lg-7">
                <div class="card border-0 rounded-4 shadow-sm bg-white p-4 h-100 d-flex flex-column">
                    <h5 class="fw-bold text-dark mb-3">
                        <i class="bi bi-info-circle text-primary me-2"></i>Thông tin chi tiết
                    </h5>
                    
                    <div class="mb-4">
                        <label class="fw-semibold text-secondary small text-uppercase">Mô tả sản phẩm</label>
                        <div class="p-3 bg-light rounded-3 mt-1 text-dark" style="min-height: 80px; white-space: pre-line;">
                            {{ $product->description ?: 'Chưa có mô tả chi tiết cho sản phẩm này.' }}
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="fw-semibold text-secondary small text-uppercase mb-2">Số lượng tồn kho theo Kích cỡ (Size)</label>
                        <div class="table-responsive border rounded-3 overflow-hidden">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light small">
                                    <tr>
                                        <th class="ps-3">Kích cỡ (Size)</th>
                                        <th class="text-center">Số lượng tồn</th>
                                        <th class="text-center pe-3">Trạng thái</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($product->variants ?? [] as $variant)
                                        <tr>
                                            <td class="ps-3 fw-bold text-dark">
                                                Size {{ $variant->size->name ?? 'N/A' }}
                                            </td>
                                            <td class="text-center fw-semibold">
                                                {{ $variant->stock }} đôi
                                            </td>
                                            <td class="text-center pe-3">
                                                @if ($variant->stock > 0)
                                                    <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1 rounded-pill">
                                                        <i class="bi bi-check-circle me-1"></i>Còn hàng
                                                    </span>
                                                @else
                                                    <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-2 py-1 rounded-pill">
                                                        <i class="bi bi-x-circle me-1"></i>Hết hàng
                                                    </span>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center text-muted py-3">
                                                <i class="bi bi-inbox me-1"></i>Chưa có phân loại kích cỡ size nào.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="d-flex gap-2 mt-auto pt-3 border-top">
                        <a href="{{ route('products.edit', $product) }}" class="btn btn-primary rounded-pill px-4 fw-semibold shadow-sm">
                            <i class="bi bi-pencil me-1"></i> Chỉnh sửa sản phẩm
                        </a>
                        <a href="{{ route('products.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                            <i class="bi bi-arrow-left me-1"></i> Quay lại danh sách
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
