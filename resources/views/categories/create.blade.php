@extends('layouts.app')

@section('title', 'Thêm danh mục mới - Simple Shop Admin')

@section('content')
    <div class="container-fluid px-0" style="max-width: 800px;">
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb small">
                <li class="breadcrumb-item"><a href="{{ route('categories.index') }}" class="text-decoration-none">Danh mục</a></li>
                <li class="breadcrumb-item active" aria-current="page">Thêm mới</li>
            </ol>
        </nav>

        <div class="card border-0 rounded-4 shadow-sm bg-white">
            <div class="card-header bg-white py-3 border-0">
                <h5 class="fw-bold text-dark mb-0">
                    <i class="bi bi-tag text-primary me-2"></i>Thêm danh mục mới
                </h5>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label fw-semibold small text-secondary">Tên danh mục <span class="text-danger">*</span></label>
                        <input class="form-control rounded-3" type="text" name="name" id="name"
                            value="{{ old('name') }}" placeholder="Ví dụ: Sneaker, Giày chạy bộ, Giày bóng rổ..." required>
                    </div>

                    <div class="mb-4">
                        <label for="description" class="form-label fw-semibold small text-secondary">Mô tả danh mục</label>
                        <textarea class="form-control rounded-3" name="description" id="description" rows="3"
                            placeholder="Nhập mô tả tóm tắt về loại sản phẩm trong danh mục này...">{{ old('description') }}</textarea>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary rounded-pill px-4 fw-semibold shadow-sm">
                            <i class="bi bi-check-lg me-1"></i> Lưu danh mục
                        </button>
                        <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                            Hủy bỏ
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
