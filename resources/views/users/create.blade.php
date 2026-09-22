@extends('layouts.app')

@section('title', 'Thêm người dùng mới - Simple Shop Admin')

@section('content')
    <div class="container-fluid px-0" style="max-width: 800px;">
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb small">
                <li class="breadcrumb-item"><a href="{{ route('users.index') }}" class="text-decoration-none">Người dùng</a></li>
                <li class="breadcrumb-item active" aria-current="page">Thêm mới</li>
            </ol>
        </nav>

        <div class="card border-0 rounded-4 shadow-sm bg-white">
            <div class="card-header bg-white py-3 border-0">
                <h5 class="fw-bold text-dark mb-0">
                    <i class="bi bi-person-plus text-primary me-2"></i>Thêm người dùng mới
                </h5>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('users.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label fw-semibold small text-secondary">Họ và tên <span class="text-danger">*</span></label>
                        <input class="form-control rounded-3" type="text" name="name" id="name"
                            value="{{ old('name') }}" placeholder="Nhập họ và tên..." required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold small text-secondary">Địa chỉ Email <span class="text-danger">*</span></label>
                        <input class="form-control rounded-3" type="email" name="email" id="email"
                            value="{{ old('email') }}" placeholder="example@domain.com" required>
                    </div>

                    <div class="mb-4">
                        <label for="password" class="form-label fw-semibold small text-secondary">Mật khẩu <span class="text-danger">*</span></label>
                        <input class="form-control rounded-3" type="password" name="password" id="password"
                            placeholder="Nhập mật khẩu..." required>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary rounded-pill px-4 fw-semibold shadow-sm">
                            <i class="bi bi-check-lg me-1"></i> Lưu người dùng
                        </button>
                        <a href="{{ route('users.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                            Hủy bỏ
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
