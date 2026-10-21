@extends('layouts.app')

@section('title', 'Chi tiết sản phẩm: ' . $product->name . ' - Simple Shop Admin')
{{-- 
@php
    $allSizes = $allSizes ?? \App\Models\Size::orderBy('name')->get();
@endphp --}}

@section('content')
    <div class="container-fluid px-0">
        {{-- BREADCRUMB --}}
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb small">
                <li class="breadcrumb-item"><a href="{{ route('products.index') }}" class="text-decoration-none">Sản phẩm</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
            </ol>
        </nav>

        <div class="row g-4">
            {{-- PRODUCT PREVIEW & QUICK INFO --}}
            <div class="col-12 col-lg-5">
                <div class="card border-0 rounded-4 shadow-sm bg-white p-4 text-center">
                    <div class="rounded-4 bg-light p-4 d-flex align-items-center justify-content-center mb-3"
                        style="min-height: 280px;">
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
                        <span
                            class="badge bg-primary-subtle text-primary border border-primary-subtle px-3 py-1 rounded-pill">
                            <i class="bi bi-tag-fill me-1"></i>{{ $product->category->name ?? 'Sneaker' }}
                        </span>
                        <span
                            class="badge bg-secondary-subtle text-secondary border border-secondary-subtle px-3 py-1 rounded-pill">
                            <i class="bi bi-box me-1"></i>Tổng tồn kho:
                            {{ $product->variants ? $product->variants->sum('stock') : 0 }} đôi
                        </span>
                    </div>
                </div>
            </div>

            {{-- PRODUCT VARIANTS MANAGEMENT --}}
            <div class="col-12 col-lg-7">
                <div class="card border-0 rounded-4 shadow-sm bg-white p-4 h-100 d-flex flex-column">
                    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-2 mb-3">
                        <h5 class="fw-bold text-dark mb-0">
                            <i class="bi bi-boxes text-primary me-2"></i>Quản lý Size & Tồn kho
                        </h5>
                        {{-- Nút mở Modal thêm biến thể --}}
                        <button type="button"
                            class="btn btn-sm btn-primary rounded-pill px-3 shadow-sm d-inline-flex align-items-center gap-1"
                            data-bs-toggle="modal" data-bs-target="#addVariantModal">
                            <i class="bi bi-plus-lg"></i> Thêm Size / Mặt hàng
                        </button>
                    </div>

                    {{-- BẢNG DANH SÁCH BIẾN THỂ --}}
                    <div class="table-responsive border rounded-3 overflow-hidden mb-4">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light small">
                                <tr>
                                    <th class="ps-3 py-3">Kích cỡ (Size)</th>
                                    <th class="py-3 text-center" style="width: 140px;">Số lượng tồn</th>
                                    <th class="py-3 text-center">Trạng thái</th>
                                    <th class="py-3 text-end pe-3" style="width: 120px;">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($product->variants ?? [] as $variant)
                                    <tr>
                                        <td class="ps-3 fw-bold text-dark">
                                            Size {{ $variant->size->name ?? 'N/A' }}
                                        </td>
                                        <td class="text-center">
                                            <span class="fw-semibold fs-6">{{ $variant->stock }}</span> <span
                                                class="small text-muted">đôi</span>
                                        </td>
                                        <td class="text-center">
                                            @if ($variant->stock > 0)
                                                <span
                                                    class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1 rounded-pill">
                                                    <i class="bi bi-check-circle me-1"></i>Còn hàng
                                                </span>
                                            @else
                                                <span
                                                    class="badge bg-danger-subtle text-danger border border-danger-subtle px-2 py-1 rounded-pill">
                                                    <i class="bi bi-x-circle me-1"></i>Hết hàng
                                                </span>
                                            @endif
                                        </td>
                                        <td class="text-end pe-3">
                                            <div class="d-inline-flex align-items-center gap-2">
                                                {{-- Nút sửa biến thể --}}
                                                <button type="button" class="btn btn-outline-primary"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#editVariantModal{{ $variant->id }}"
                                                    title="Chỉnh sửa size hoặc số lượng">
                                                    <i class="bi bi-pencil-square"></i>
                                                </button>
                                                {{-- Nút xóa biến thể --}}
                                                <form action="{{ route('variants.destroy', $variant) }}" method="POST"
                                                    class="d-inline"
                                                    onsubmit="return confirm('Bạn có chắc chắn muốn xóa kích cỡ Size {{ $variant->size->name ?? '' }} này không?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-outline-danger"
                                                        title="Xóa kích cỡ này">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </div>

                                            {{-- MODAL CHỈNH SỬA BIẾN THỂ --}}
                                            <div class="modal fade text-start" id="editVariantModal{{ $variant->id }}"
                                                tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content border-0 rounded-4 shadow">
                                                        <div class="modal-header border-0 pb-0">
                                                            <h6 class="modal-title fw-bold text-dark">
                                                                <i class="bi bi-pencil-square text-primary me-2"></i>Chỉnh
                                                                sửa mặt hàng: Size {{ $variant->size->name ?? '' }}
                                                            </h6>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <form action="{{ route('variants.update', $variant) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-body py-3">
                                                                <div class="mb-3">
                                                                    <label
                                                                        class="form-label small fw-semibold text-secondary">Chọn
                                                                        kích cỡ có sẵn</label>
                                                                    <select name="size_id" class="form-select rounded-3">
                                                                        @foreach ($allSizes as $size)
                                                                            <option value="{{ $size->id }}"
                                                                                {{ $variant->size_id == $size->id ? 'selected' : '' }}>
                                                                                Size {{ $size->name }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label
                                                                        class="form-label small fw-semibold text-secondary">Hoặc
                                                                        đổi sang tên kích cỡ mới</label>
                                                                    <input type="text" name="new_size"
                                                                        class="form-control rounded-3"
                                                                        placeholder="Nhập tên size mới nếu chưa có trong danh mục">
                                                                </div>
                                                                <div class="mb-2">
                                                                    <label
                                                                        class="form-label small fw-semibold text-secondary">Số
                                                                        lượng tồn kho <span
                                                                            class="text-danger">*</span></label>
                                                                    <input type="number" name="stock"
                                                                        class="form-control rounded-3"
                                                                        value="{{ $variant->stock }}" min="0"
                                                                        required>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer border-0 pt-0">
                                                                <button type="button"
                                                                    class="btn btn-light rounded-pill px-3"
                                                                    data-bs-dismiss="modal">Đóng</button>
                                                                <button type="submit"
                                                                    class="btn btn-primary rounded-pill px-4 fw-semibold">
                                                                    <i class="bi bi-check-lg me-1"></i> Lưu thay đổi
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-4 text-muted">
                                            <i class="bi bi-inbox fs-2 d-block mb-1 text-secondary"></i>
                                            Chưa có phân loại kích cỡ nào. Bấm <strong>"+ Thêm Size / Mặt hàng"</strong> ở
                                            góc phải để tạo.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- MÔ TẢ SẢN PHẨM --}}
                    <div class="mb-4">
                        <label class="fw-semibold text-secondary small text-uppercase">Mô tả sản phẩm</label>
                        <div class="p-3 bg-light rounded-3 mt-1 text-dark"
                            style="min-height: 80px; white-space: pre-line;">
                            {{ $product->description ?: 'Chưa có mô tả chi tiết cho sản phẩm này.' }}
                        </div>
                    </div>

                    <div class="d-flex gap-2 mt-auto pt-3 border-top">
                        <a href="{{ route('products.edit', $product) }}"
                            class="btn btn-primary rounded-pill px-4 fw-semibold shadow-sm">
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

    {{-- MODAL THÊM BIẾN THỂ MỚI --}}
    <div class="modal fade" id="addVariantModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 rounded-4 shadow">
                <div class="modal-header border-0 pb-0">
                    <h6 class="modal-title fw-bold text-dark">
                        <i class="bi bi-plus-circle text-primary me-2"></i>Thêm kích cỡ / mặt hàng mới
                    </h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form
                    action="{{ Route::has('variants.store') ? route('variants.store', $product) : url('admin/products/' . $product->id . '/variants') }}"
                    method="POST">
                    @csrf
                    <div class="modal-body py-3">
                        <div class="mb-3">
                            <label class="form-label small fw-semibold text-secondary">Chọn kích cỡ có sẵn</label>
                            <select name="size_id" class="form-select rounded-3">
                                <option value="">-- Chọn size có sẵn --</option>
                                @foreach ($allSizes as $size)
                                    <option value="{{ $size->id }}">Size {{ $size->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-semibold text-secondary">Hoặc tạo kích cỡ mới</label>
                            <input type="text" name="new_size" class="form-control rounded-3"
                                placeholder="Ví dụ: 38.5, 42.5, XL, Freesize...">
                            <small class="text-muted">Nếu kích cỡ chưa có trong danh mục ở trên, hãy nhập tên size vào ô
                                này.</small>
                        </div>
                        <div class="mb-2">
                            <label class="form-label small fw-semibold text-secondary">Số lượng tồn kho ban đầu <span
                                    class="text-danger">*</span></label>
                            <input type="number" name="stock" class="form-control rounded-3" value="10"
                                min="0" required>
                        </div>
                    </div>
                    <div class="modal-footer border-0 pt-0">
                        <button type="button" class="btn btn-light rounded-pill px-3"
                            data-bs-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary rounded-pill px-4 fw-semibold shadow-sm">
                            <i class="bi bi-plus-lg me-1"></i> Thêm mặt hàng
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
