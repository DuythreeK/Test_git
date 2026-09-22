@extends('layouts.app')

@section('title', 'Quản lý sản phẩm - Simple Shop Admin')

@section('content')
    <div class="container-fluid px-0">
        {{-- HEADER --}}
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
            <div>
                <h4 class="fw-bold text-dark mb-1">
                    <i class="bi bi-boxes text-primary me-2"></i>Quản lý sản phẩm
                </h4>
                <p class="text-secondary small mb-0">Danh sách giày, cấu hình giá bán, kích cỡ và số lượng tồn kho.</p>
            </div>
            <div>
                <a class="btn btn-primary rounded-pill px-3 shadow-sm d-inline-flex align-items-center gap-1" 
                   href="{{ route('products.create') }}">
                    <i class="bi bi-plus-lg"></i> Thêm sản phẩm mới
                </a>
            </div>
        </div>

        {{-- BỘ LỌC TÌM KIẾM --}}
        <div class="card border-0 rounded-4 shadow-sm bg-white mb-4">
            <div class="card-body p-3 p-md-4">
                <form action="{{ route('products.index') }}" method="GET">
                    <div class="row g-3 align-items-end">
                        <div class="col-12 col-md-3">
                            <label class="form-label small fw-semibold text-secondary" for="search">Tìm kiếm</label>
                            <input class="form-control form-control-sm rounded-3" type="text" name="search" id="search"
                                value="{{ request('search') }}" placeholder="Nhập tên giày...">
                        </div>
                        <div class="col-12 col-md-3">
                            <label class="form-label small fw-semibold text-secondary" for="category">Danh mục</label>
                            <select class="form-select form-select-sm rounded-3" name="category" id="category">
                                <option value="">-- Tất cả danh mục --</option>
                                @foreach (\App\Models\Category::all() as $category)
                                    <option value="{{ $category->id }}"
                                        {{ request('category') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-6 col-md-2">
                            <label class="form-label small fw-semibold text-secondary" for="min-price">Giá tối thiểu</label>
                            <input class="form-control form-control-sm rounded-3" type="number" name="min_price" id="min-price"
                                value="{{ request('min_price') }}" placeholder="Từ (VNĐ)">
                        </div>
                        <div class="col-6 col-md-2">
                            <label class="form-label small fw-semibold text-secondary" for="max_price">Giá tối đa</label>
                            <input class="form-control form-control-sm rounded-3" type="number" name="max_price" id="max-price"
                                value="{{ request('max_price') }}" placeholder="Đến (VNĐ)">
                        </div>
                        <div class="col-12 col-md-2 d-flex gap-2">
                            <button class="btn btn-primary btn-sm rounded-pill flex-grow-1" type="submit">
                                <i class="bi bi-funnel-fill me-1"></i> Lọc
                            </button>
                            <a class="btn btn-outline-secondary btn-sm rounded-pill" href="{{ route('products.index') }}" title="Xóa bộ lọc">
                                <i class="bi bi-arrow-counterclockwise"></i>
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- PRODUCTS TABLE CARD --}}
        <div class="card border-0 rounded-4 shadow-sm bg-white overflow-hidden">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light small">
                            <tr>
                                <th class="ps-3 py-3" style="width: 70px;">ID</th>
                                <th class="py-3">Hình ảnh</th>
                                <th class="py-3">Tên sản phẩm</th>
                                <th class="py-3">Danh mục</th>
                                <th class="py-3">Đơn giá</th>
                                <th class="py-3 text-center">Tổng tồn kho</th>
                                <th class="py-3 text-center">Trạng thái</th>
                                <th class="py-3 text-center pe-3">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($products as $product)
                                @php
                                    $totalStock = $product->variants->sum('stock');
                                @endphp
                                <tr>
                                    <td class="ps-3 fw-bold text-secondary">
                                        #{{ $product->id }}
                                    </td>
                                    <td>
                                        <div class="rounded-3 bg-light p-1 d-flex align-items-center justify-content-center" 
                                             style="width: 55px; height: 55px;">
                                            @if ($product->image)
                                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" 
                                                     class="img-fluid object-fit-contain mh-100">
                                            @else
                                                <i class="bi bi-image text-secondary fs-4"></i>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <div class="fw-semibold text-dark">{{ $product->name }}</div>
                                        <small class="text-muted">
                                            {{ $product->variants->count() }} kích cỡ size
                                        </small>
                                    </td>
                                    <td>
                                        <span class="badge bg-primary-subtle text-primary border border-primary-subtle">
                                            {{ $product->category->name ?? 'Chưa phân loại' }}
                                        </span>
                                    </td>
                                    <td class="fw-bold text-danger">
                                        {{ number_format($product->price) }}₫
                                    </td>
                                    <td class="text-center">
                                        @if($totalStock > 0)
                                            <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1 rounded-pill">
                                                {{ $totalStock }} đôi
                                            </span>
                                        @else
                                            <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-2 py-1 rounded-pill">
                                                Hết hàng
                                            </span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if ($product->status === 1 || !isset($product->status))
                                            <span class="badge bg-success text-white small">Hoạt động</span>
                                        @else
                                            <span class="badge bg-secondary text-white small">Tạm ẩn</span>
                                        @endif
                                    </td>
                                    <td class="text-center pe-3">
                                        <div class="d-inline-flex gap-1">
                                            <a class="btn btn-sm btn-outline-info rounded-circle" style="width: 32px; height: 32px; padding: 0; display: inline-flex; align-items: center; justify-content: center;"
                                               href="{{ route('products.show', $product) }}" title="Xem chi tiết">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a class="btn btn-sm btn-outline-primary rounded-circle" style="width: 32px; height: 32px; padding: 0; display: inline-flex; align-items: center; justify-content: center;"
                                               href="{{ route('products.edit', $product) }}" title="Chỉnh sửa">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="{{ route('products.destroy', $product) }}" method="POST"
                                                  class="d-inline"
                                                  onsubmit="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-outline-danger rounded-circle" style="width: 32px; height: 32px; padding: 0; display: inline-flex; align-items: center; justify-content: center;"
                                                        type="submit" title="Xóa">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-5 text-muted">
                                        <i class="bi bi-inbox fs-2 d-block mb-2 text-secondary"></i>
                                        Không tìm thấy sản phẩm nào phù hợp.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @if ($products->hasPages())
                <div class="card-footer bg-white border-0 py-3 d-flex justify-content-center">
                    {{ $products->appends(request()->query())->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
