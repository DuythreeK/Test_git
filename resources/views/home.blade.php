@extends('layouts.app')

@section('title', 'Bảng điều khiển - Simple Shop Admin')

@section('content')
    {{-- WELCOME HERO BANNER --}}
    <div class="card border-0 rounded-4 shadow-sm mb-4 overflow-hidden position-relative"
        style="background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%); color: white;">
        <div class="card-body p-4 p-md-5 position-relative z-1">
            <div class="row align-items-center">
                <div class="col-12 col-md-8">
                    <span
                        class="badge bg-primary-subtle text-primary border border-primary-subtle px-3 py-2 rounded-pill mb-3">
                        <i class="bi bi-shield-check me-1"></i> Trung tâm quản trị
                    </span>
                    <h2 class="fw-bold mb-2">Xin chào, {{ auth()->user()->name ?? 'Quản trị viên' }}! 👋</h2>
                    <p class="text-secondary mb-4" style="max-width: 600px; font-size: 0.95rem;">
                        Chào mừng bạn quay trở lại hệ thống quản lý Simple Shop. Dưới đây là các tính năng chính giúp bạn
                        vận hành cửa hàng dễ dàng và hiệu quả.
                    </p>
                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('dashboard.index') }}" class="btn btn-primary rounded-pill px-4 py-2 fw-semibold">
                            <i class="bi bi-speedometer2 me-1"></i> Xem thống kê ngay
                        </a>
                        <a href="{{ route('orders.index') }}" class="btn btn-outline-light rounded-pill px-4 py-2">
                            <i class="bi bi-receipt me-1"></i> Kiểm tra đơn hàng
                        </a>
                    </div>
                </div>
                <div class="col-12 col-md-4 d-none d-md-block text-end">
                    <i class="bi bi-gear-wide-connected text-white opacity-10"
                        style="font-size: 10rem; line-height: 1;"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- QUICK ACCESS GRID --}}
    <div class="d-flex align-items-center justify-content-between mb-3">
        <h5 class="fw-bold text-dark mb-0">
            <i class="bi bi-grid-fill text-primary me-2"></i>Tính năng quản lý nhanh
        </h5>
    </div>

    <div class="row g-4">
        {{-- CARD: DASHBOARD --}}
        <div class="col-12 col-sm-6 col-xl-4">
            <div class="card border-0 rounded-4 shadow-sm h-100 p-3 hover-lift bg-white">
                <div class="card-body d-flex flex-column">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="rounded-3 d-flex align-items-center justify-content-center"
                            style="width: 50px; height: 50px; background-color: #eff6ff; color: #2563eb;">
                            <i class="bi bi-speedometer2 fs-4"></i>
                        </div>
                        <span class="badge bg-primary-subtle text-primary rounded-pill">Thống kê</span>
                    </div>
                    <h5 class="fw-bold text-dark mb-2">Báo cáo & Thống kê</h5>
                    <p class="text-muted small mb-4">
                        Theo dõi tổng doanh thu, giá trị tồn kho, các sản phẩm bán chạy nhất và biểu đồ đơn hàng.
                    </p>
                    <a href="{{ route('dashboard.index') }}"
                        class="btn btn-outline-primary rounded-pill mt-auto fw-semibold">
                        Truy cập Dashboard <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>

        {{-- CARD: PRODUCTS --}}
        <div class="col-12 col-sm-6 col-xl-4">
            <div class="card border-0 rounded-4 shadow-sm h-100 p-3 hover-lift bg-white">
                <div class="card-body d-flex flex-column">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="rounded-3 d-flex align-items-center justify-content-center"
                            style="width: 50px; height: 50px; background-color: #ecfdf5; color: #059669;">
                            <i class="bi bi-boxes fs-4"></i>
                        </div>
                        <span class="badge bg-success-subtle text-success rounded-pill">Sản phẩm</span>
                    </div>
                    <h5 class="fw-bold text-dark mb-2">Quản lý Sản phẩm</h5>
                    <p class="text-muted small mb-4">
                        Thêm mới giày, cập nhật hình ảnh, giá bán, cấu hình kích cỡ (size) và số lượng tồn kho từng loại.
                    </p>
                    <a href="{{ route('products.index') }}"
                        class="btn btn-outline-success rounded-pill mt-auto fw-semibold">
                        Quản lý sản phẩm <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>

        {{-- CARD: CATEGORIES --}}
        <div class="col-12 col-sm-6 col-xl-4">
            <div class="card border-0 rounded-4 shadow-sm h-100 p-3 hover-lift bg-white">
                <div class="card-body d-flex flex-column">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="rounded-3 d-flex align-items-center justify-content-center"
                            style="width: 50px; height: 50px; background-color: #f5f3ff; color: #7c3aed;">
                            <i class="bi bi-tags fs-4"></i>
                        </div>
                        <span class="badge bg-purple-subtle text-purple rounded-pill"
                            style="background: #f3e8ff; color: #7e22ce;">Danh mục</span>
                    </div>
                    <h5 class="fw-bold text-dark mb-2">Quản lý Danh mục</h5>
                    <p class="text-muted small mb-4">
                        Phân loại sản phẩm (Sneaker, Running, Basketball, Casual...), thêm mới và chỉnh sửa tên danh mục.
                    </p>
                    <a href="{{ route('categories.index') }}"
                        class="btn btn-outline-primary rounded-pill mt-auto fw-semibold"
                        style="color: #7c3aed; border-color: #7c3aed;">
                        Quản lý danh mục <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>

        {{-- CARD: ORDERS --}}
        <div class="col-12 col-sm-6 col-xl-4">
            <div class="card border-0 rounded-4 shadow-sm h-100 p-3 hover-lift bg-white">
                <div class="card-body d-flex flex-column">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="rounded-3 d-flex align-items-center justify-content-center"
                            style="width: 50px; height: 50px; background-color: #fffbeb; color: #d97706;">
                            <i class="bi bi-receipt fs-4"></i>
                        </div>
                        <span class="badge bg-warning-subtle text-warning rounded-pill">Đơn hàng</span>
                    </div>
                    <h5 class="fw-bold text-dark mb-2">Quản lý Đơn hàng</h5>
                    <p class="text-muted small mb-4">
                        Xem chi tiết các đơn đặt hàng mới, duyệt đơn, thay đổi trạng thái giao hàng và phương thức thanh
                        toán.
                    </p>
                    <a href="{{ route('orders.index') }}"
                        class="btn btn-outline-warning rounded-pill mt-auto fw-semibold text-dark">
                        Quản lý đơn hàng <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>

        {{-- CARD: USERS --}}
        <div class="col-12 col-sm-6 col-xl-4">
            <div class="card border-0 rounded-4 shadow-sm h-100 p-3 hover-lift bg-white">
                <div class="card-body d-flex flex-column">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="rounded-3 d-flex align-items-center justify-content-center"
                            style="width: 50px; height: 50px; background-color: #fff1f2; color: #e11d48;">
                            <i class="bi bi-people fs-4"></i>
                        </div>
                        <span class="badge bg-danger-subtle text-danger rounded-pill">Người dùng</span>
                    </div>
                    <h5 class="fw-bold text-dark mb-2">Quản lý Người dùng</h5>
                    <p class="text-muted small mb-4">
                        Danh sách tài khoản khách hàng và quản trị viên, thông tin liên hệ và lịch sử hoạt động.
                    </p>
                    <a href="{{ route('users.index') }}" class="btn btn-outline-danger rounded-pill mt-auto fw-semibold">
                        Quản lý người dùng <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('style')
    <style>
        .hover-lift {
            transition: transform 0.25s ease, box-shadow 0.25s ease;
        }

        .hover-lift:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px -6px rgba(0, 0, 0, 0.08) !important;
        }
    </style>
@endsection
