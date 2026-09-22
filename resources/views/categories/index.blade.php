@extends('layouts.app')

@section('title', 'Quản lý danh mục - Simple Shop Admin')

@section('content')
    <div class="container-fluid px-0">
        {{-- HEADER --}}
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
            <div>
                <h4 class="fw-bold text-dark mb-1">
                    <i class="bi bi-tags text-primary me-2"></i>Quản lý danh mục
                </h4>
                <p class="text-secondary small mb-0">Phân loại các dòng giày thể thao (Sneaker, Running, Casual...).</p>
            </div>
            <div>
                <a class="btn btn-primary rounded-pill px-3 shadow-sm d-inline-flex align-items-center gap-1" 
                   href="{{ route('categories.create') }}">
                    <i class="bi bi-plus-lg"></i> Thêm danh mục mới
                </a>
            </div>
        </div>

        {{-- TABLE CARD --}}
        <div class="card border-0 rounded-4 shadow-sm bg-white overflow-hidden">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light small">
                            <tr>
                                <th class="ps-3 py-3" style="width: 80px;">ID</th>
                                <th class="py-3">Tên danh mục</th>
                                <th class="py-3 text-center pe-3" style="width: 180px;">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($categories as $category)
                                <tr>
                                    <td class="ps-3 fw-bold text-secondary">
                                        #{{ $category->id }}
                                    </td>
                                    <td>
                                        <div class="fw-semibold text-dark fs-6">{{ $category->name }}</div>
                                        @if(isset($category->description) && $category->description)
                                            <small class="text-muted">{{ Str::limit($category->description, 60) }}</small>
                                        @endif
                                    </td>
                                    <td class="text-center pe-3">
                                        <div class="d-inline-flex gap-2">
                                            <a class="btn btn-sm btn-outline-primary rounded-pill px-3" 
                                               href="{{ route('categories.edit', $category) }}" title="Chỉnh sửa">
                                                <i class="bi bi-pencil me-1"></i> Sửa
                                            </a>
                                            <form action="{{ route('categories.destroy', $category) }}" method="POST"
                                                  class="d-inline"
                                                  onsubmit="return confirm('Bạn có chắc chắn muốn xóa danh mục này? Các sản phẩm thuộc danh mục có thể bị ảnh hưởng.')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-outline-danger rounded-pill px-3" type="submit" title="Xóa">
                                                    <i class="bi bi-trash me-1"></i> Xóa
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center py-5 text-muted">
                                        <i class="bi bi-tag fs-2 d-block mb-2 text-secondary"></i>
                                        Chưa có danh mục nào. Hãy bấm "Thêm danh mục mới" ở trên.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @if(method_exists($categories, 'hasPages') && $categories->hasPages())
                <div class="card-footer bg-white border-0 py-3 d-flex justify-content-center">
                    {{ $categories->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
