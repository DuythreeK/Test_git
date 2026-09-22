@extends('layouts.app')

@section('title', 'Chỉnh sửa sản phẩm: ' . $product->name . ' - Simple Shop Admin')

@section('content')
    <div class="container-fluid px-0" style="max-width: 900px;">
        {{-- BREADCRUMB --}}
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb small">
                <li class="breadcrumb-item"><a href="{{ route('products.index') }}" class="text-decoration-none">Sản phẩm</a></li>
                <li class="breadcrumb-item active" aria-current="page">Chỉnh sửa</li>
            </ol>
        </nav>

        {{-- MAIN CARD --}}
        <div class="card border-0 rounded-4 shadow-sm bg-white overflow-hidden">
            <div class="card-header bg-white py-3 border-0">
                <h5 class="fw-bold text-dark mb-0">
                    <i class="bi bi-pencil-square text-primary me-2"></i>Chỉnh sửa sản phẩm: {{ $product->name }}
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

                <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row g-3">
                        <div class="col-12 col-md-6">
                            <label for="name" class="form-label small fw-semibold text-secondary">
                                Tên sản phẩm <span class="text-danger">*</span>
                            </label>
                            <input class="form-control rounded-3" type="text" name="name" id="name"
                                value="{{ old('name', $product->name) }}" placeholder="Nhập tên giày..." required>
                        </div>

                        <div class="col-12 col-md-6">
                            <label for="category_id" class="form-label small fw-semibold text-secondary">
                                Danh mục sản phẩm <span class="text-danger">*</span>
                            </label>
                            <select class="form-select rounded-3" name="category_id" id="category_id" required>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12 col-md-6">
                            <label for="price" class="form-label small fw-semibold text-secondary">
                                Giá bán niêm yết (VNĐ) <span class="text-danger">*</span>
                            </label>
                            <input class="form-control rounded-3" type="number" name="price" id="price"
                                value="{{ old('price', $product->price) }}" step="any" required>
                        </div>

                        <div class="col-12 col-md-6">
                            <label for="image" class="form-label small fw-semibold text-secondary">
                                Hình ảnh mới (nếu thay đổi)
                            </label>
                            <input class="form-control rounded-3" type="file" name="image" id="image" accept="image/*">
                            @if ($product->image)
                                <div class="d-flex align-items-center gap-2 mt-2">
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" 
                                         class="rounded-3 border object-fit-cover" style="width: 48px; height: 48px;">
                                    <span class="small text-muted text-truncate" style="max-width: 250px;">Ảnh hiện tại: {{ basename($product->image) }}</span>
                                </div>
                            @endif
                        </div>

                        <div class="col-12">
                            <label for="description" class="form-label small fw-semibold text-secondary">
                                Mô tả sản phẩm
                            </label>
                            <textarea rows="4" class="form-control rounded-3" name="description" id="description"
                                placeholder="Nhập mô tả sản phẩm...">{{ old('description', $product->description) }}</textarea>
                        </div>
                    </div>

                    <div class="d-flex gap-2 mt-4 pt-3 border-top">
                        <button type="submit" class="btn btn-primary rounded-pill px-4 fw-semibold shadow-sm">
                            <i class="bi bi-check-lg me-1"></i> Cập nhật sản phẩm
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
