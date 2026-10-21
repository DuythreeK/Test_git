@extends('layouts.app')

@section('title', 'Thông tin người dùng: ' . ($user->name ?? 'Chi tiết') . ' - Simple Shop Admin')

@section('content')
    <div class="container-fluid px-0" style="max-width: 800px;">
        {{-- BREADCRUMB --}}
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb small">
                <li class="breadcrumb-item"><a href="{{ route('users.index') }}" class="text-decoration-none">Người dùng</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $user->name ?? 'Chi tiết' }}</li>
            </ol>
        </nav>

        @if ($user)
            <div class="card border-0 rounded-4 shadow-sm bg-white overflow-hidden">
                <div class="card-body p-4 text-center border-bottom bg-light bg-opacity-50">
                    <div class="avatar-circle mx-auto mb-3 shadow-sm" style="width: 80px; height: 80px; font-size: 2rem; background: linear-gradient(135deg, #2563eb, #3b82f6); color: #fff; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 700;">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                    <h4 class="fw-bold text-dark mb-1">{{ $user->name }}</h4>
                    <p class="text-muted small mb-2"><i class="bi bi-envelope me-1"></i>{{ $user->email }}</p>
                    <div>
                        @if ($user->role === 'admin')
                            <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-3 py-1 rounded-pill">
                                <i class="bi bi-shield-lock-fill me-1"></i> Quản trị viên hệ thống
                            </span>
                        @else
                            <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-3 py-1 rounded-pill">
                                <i class="bi bi-person-fill me-1"></i> Tài khoản khách hàng
                            </span>
                        @endif
                    </div>
                </div>

                <div class="card-body p-4">
                    <h6 class="fw-bold text-dark mb-3">
                        <i class="bi bi-person-lines-fill text-primary me-2"></i>Chi tiết tài khoản
                    </h6>

                    <div class="row g-3">
                        <div class="col-12 col-sm-6">
                            <div class="p-3 bg-light rounded-3">
                                <span class="text-secondary small fw-semibold text-uppercase d-block mb-1">Mã định danh (ID)</span>
                                <div class="fw-bold text-dark">#{{ $user->id }}</div>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6">
                            <div class="p-3 bg-light rounded-3">
                                <span class="text-secondary small fw-semibold text-uppercase d-block mb-1">Số điện thoại</span>
                                <div class="fw-bold text-dark">{{ $user->phone ?? 'Chưa cập nhật' }}</div>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6">
                            <div class="p-3 bg-light rounded-3">
                                <span class="text-secondary small fw-semibold text-uppercase d-block mb-1">Ngày đăng ký tham gia</span>
                                <div class="fw-bold text-dark">
                                    {{ $user->created_at ? $user->created_at->format('d/m/Y H:i:s') : 'N/A' }}
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6">
                            <div class="p-3 bg-light rounded-3">
                                <span class="text-secondary small fw-semibold text-uppercase d-block mb-1">Cập nhật gần nhất</span>
                                <div class="fw-bold text-dark">
                                    {{ $user->updated_at ? $user->updated_at->format('d/m/Y H:i:s') : 'N/A' }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex gap-2 mt-4 pt-3 border-top justify-content-end">
                        <a href="{{ route('users.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                            <i class="bi bi-arrow-left me-1"></i> Quay lại danh sách
                        </a>
                    </div>
                </div>
            </div>
        @else
            <div class="card border-0 rounded-4 shadow-sm bg-white p-5 text-center">
                <i class="bi bi-person-x fs-1 text-danger mb-3"></i>
                <h5 class="fw-bold text-dark">Không tìm thấy tài khoản người dùng</h5>
                <p class="text-secondary small mb-4">Tài khoản này có thể đã bị xóa hoặc đường dẫn không hợp lệ.</p>
                <div>
                    <a href="{{ route('users.index') }}" class="btn btn-primary rounded-pill px-4">
                        <i class="bi bi-arrow-left me-1"></i> Quay lại danh sách người dùng
                    </a>
                </div>
            </div>
        @endif
    </div>
@endsection
