@extends('layouts.app')

@section('title', 'Quản lý người dùng - Simple Shop Admin')

@section('content')
    <div class="container-fluid px-0">
        {{-- HEADER --}}
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
            <div>
                <h4 class="fw-bold text-dark mb-1">
                    <i class="bi bi-people text-primary me-2"></i>Quản lý người dùng
                </h4>
                <p class="text-secondary small mb-0">Danh sách các tài khoản khách hàng và quản trị viên trong hệ thống.</p>
            </div>
            <div>
                <a class="btn btn-primary rounded-pill px-3 shadow-sm d-inline-flex align-items-center gap-1" 
                   href="{{ route('users.create') }}">
                    <i class="bi bi-person-plus-fill"></i> Thêm người dùng mới
                </a>
            </div>
        </div>

        {{-- USERS TABLE CARD --}}
        <div class="card border-0 rounded-4 shadow-sm bg-white overflow-hidden">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light small">
                            <tr>
                                <th class="ps-3 py-3" style="width: 70px;">ID</th>
                                <th class="py-3">Họ và tên</th>
                                <th class="py-3">Email liên hệ</th>
                                <th class="py-3 text-center">Vai trò</th>
                                <th class="py-3 text-center">Thời gian tạo</th>
                                <th class="py-3 text-center pe-3">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                                <tr>
                                    <td class="ps-3 fw-bold text-secondary">
                                        #{{ $user->id }}
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="avatar-circle flex-shrink-0" style="width: 36px; height: 36px; font-size: 0.85rem;">
                                                {{ strtoupper(substr($user->name, 0, 1)) }}
                                            </div>
                                            <div class="fw-semibold text-dark">{{ $user->name }}</div>
                                        </div>
                                    </td>
                                    <td class="text-secondary small">
                                        <i class="bi bi-envelope me-1 text-muted"></i>{{ $user->email }}
                                    </td>
                                    <td class="text-center">
                                        @if ($user->role === 'admin')
                                            <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-2 py-1 rounded-pill">
                                                <i class="bi bi-shield-lock-fill me-1"></i> Quản trị viên
                                            </span>
                                        @else
                                            <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-2 py-1 rounded-pill">
                                                <i class="bi bi-person-fill me-1"></i> Khách hàng
                                            </span>
                                        @endif
                                    </td>
                                    <td class="text-center small text-secondary">
                                        {{ $user->created_at ? $user->created_at->format('d/m/Y') : 'N/A' }}
                                    </td>
                                    <td class="text-center pe-3">
                                        <a href="{{ route('users.show', $user->id) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3 fw-medium">
                                            <i class="bi bi-eye me-1"></i> Chi tiết
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5 text-muted">
                                        <i class="bi bi-people fs-2 d-block mb-2 text-secondary"></i>
                                        Chưa có tài khoản người dùng nào.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @if ($users->hasPages())
                <div class="card-footer bg-white border-0 py-3 d-flex justify-content-center">
                    {{ $users->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
