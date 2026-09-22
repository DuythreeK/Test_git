@extends('layouts.app')

@section('title', 'Thêm sản phẩm mới - Simple Shop Admin')

@section('content')
    <div class="container-fluid px-0" style="max-width: 900px;">
        {{-- BREADCRUMB --}}
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb small">
                <li class="breadcrumb-item"><a href="{{ route('products.index') }}" class="text-decoration-none">Sản phẩm</a></li>
                <li class="breadcrumb-item active" aria-current="page">Thêm mới</li>
            </ol>
        </nav>

        {{-- MAIN CARD --}}
        <div class="card border-0 rounded-4 shadow-sm bg-white overflow-hidden">
            <div class="card-header bg-white py-3 border-0">
                <h5 class="fw-bold text-dark mb-0">
                    <i class="bi bi-plus-circle text-primary me-2"></i>Thêm sản phẩm mới
                </h5>
            </div>
            <div class="card-body p-4 pt-2">
                {{-- Validation Errors --}}
                @if ($errors->any())
                    <div class="alert alert-danger rounded-3 mb-4">
                        <div class="fw-semibold mb-1"><i class="bi bi-exclamation-triangle-fill me-1"></i> Vui lòng kiểm tra lại dữ liệu:</div>
                        <ul class="mb-0 ps-3 small">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row g-3">
                        <div class="col-12 col-md-6">
                            <label for="name" class="form-label small fw-semibold text-secondary">
                                Tên sản phẩm <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="name" id="name" class="form-control rounded-3"
                                value="{{ old('name') }}" placeholder="Ví dụ: Nike Air Force 1, Adidas Samba..." required>
                        </div>

                        <div class="col-12 col-md-6">
                            <label for="category_id" class="form-label small fw-semibold text-secondary">
                                Danh mục sản phẩm <span class="text-danger">*</span>
                            </label>
                            <select name="category_id" id="category_id" class="form-select rounded-3" required>
                                <option value="">-- Chọn danh mục --</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12 col-md-6">
                            <label for="price" class="form-label small fw-semibold text-secondary">
                                Giá bán niêm yết (VNĐ) <span class="text-danger">*</span>
                            </label>
                            <input type="number" step="any" name="price" id="price" class="form-control rounded-3"
                                value="{{ old('price') }}" placeholder="Ví dụ: 1890000" required>
                        </div>

                        <div class="col-12 col-md-6">
                            <label for="image" class="form-label small fw-semibold text-secondary">
                                Ảnh sản phẩm
                            </label>
                            <input type="file" name="image" id="image" class="form-control rounded-3" accept="image/*">
                        </div>

                        <div class="col-12">
                            <label for="description" class="form-label small fw-semibold text-secondary">
                                Mô tả sản phẩm
                            </label>
                            <textarea name="description" id="description" class="form-control rounded-3" rows="4"
                                placeholder="Nhập thông tin chi tiết, đặc điểm nổi bật của đôi giày...">{{ old('description') }}</textarea>
                        </div>
                    </div>

                    <div class="d-flex gap-2 mt-4 pt-3 border-top">
                        <button type="submit" class="btn btn-primary rounded-pill px-4 fw-semibold shadow-sm">
                            <i class="bi bi-check-lg me-1"></i> Lưu sản phẩm
                        </button>
                        <a href="{{ route('products.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                            Hủy bỏ
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
