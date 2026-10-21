@extends('layouts.app')

@section('title', 'Chỉnh sửa danh mục - Simple Shop Admin')

@section('content')
    <div class="container-fluid px-0" style="max-width: 800px;">
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb small">
                <li class="breadcrumb-item"><a href="{{ route('categories.index') }}" class="text-decoration-none">Danh mục</a></li>
                <li class="breadcrumb-item active" aria-current="page">Chỉnh sửa #{{ $category->id }}</li>
            </ol>
        </nav>

        <div class="card border-0 rounded-4 shadow-sm bg-white">
            <div class="card-header bg-white py-3 border-0">
                <h5 class="fw-bold text-dark mb-0">
                    <i class="bi bi-pencil-square text-primary me-2"></i>Chỉnh sửa danh mục: {{ $category->name }}
                </h5>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('categories.update', $category) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="name" class="form-label fw-semibold small text-secondary">Tên danh mục <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="name" class="form-control rounded-3"
                            value="{{ old('name', $category->name) }}" placeholder="Nhập tên danh mục..." required>
                    </div>

                    <div class="mb-4">
                        <label for="description" class="form-label fw-semibold small text-secondary">Mô tả danh mục</label>
                        <textarea name="description" id="description" class="form-control rounded-3" rows="4"
                            placeholder="Nhập mô tả danh mục...">{{ old('description', $category->description) }}</textarea>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary rounded-pill px-4 fw-semibold shadow-sm">
                            <i class="bi bi-check-lg me-1"></i> Cập nhật
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
