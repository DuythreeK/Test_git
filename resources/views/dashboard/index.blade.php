@extends('layouts.app')

@section('title', 'Báo cáo & Thống kê - Simple Shop Admin')

@section('content')
    <div class="container-fluid px-0">
        {{-- PAGE TITLE --}}
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
            <div>
                <h4 class="fw-bold text-dark mb-1">
                    <i class="bi bi-speedometer2 text-primary me-2"></i>Báo cáo & Thống kê
                </h4>
                <p class="text-secondary small mb-0">Tổng quan tình hình kinh doanh, doanh thu và tồn kho của cửa hàng.</p>
            </div>
            <div class="d-flex align-items-center gap-2">
                <span class="badge bg-light text-secondary border px-3 py-2 rounded-pill small">
                    <i class="bi bi-clock me-1"></i> Cập nhật theo thời gian thực
                </span>
            </div>
        </div>

        {{-- 6 KPI METRIC CARDS --}}
        <div class="row g-3 mb-4">
            {{-- 1. Tổng sản phẩm --}}
            <div class="col-12 col-sm-6 col-xl-4">
                <div class="card border-0 rounded-4 shadow-sm h-100 p-3 bg-white">
                    <div class="card-body d-flex align-items-center justify-content-between p-2">
                        <div>
                            <span class="text-secondary small fw-semibold text-uppercase">Tổng sản phẩm</span>
                            <h3 class="fw-bold text-dark mb-0 mt-1">{{ number_format($totalProducts) }}</h3>
                            <small class="text-muted" style="font-size: 0.75rem;">Mẫu mã đang kinh doanh</small>
                        </div>
                        <div class="rounded-4 d-flex align-items-center justify-content-center" 
                             style="width: 54px; height: 54px; background-color: #eff6ff; color: #2563eb;">
                            <i class="bi bi-boxes fs-3"></i>
                        </div>
                    </div>
                </div>
            </div>

            {{-- 2. Tổng danh mục --}}
            <div class="col-12 col-sm-6 col-xl-4">
                <div class="card border-0 rounded-4 shadow-sm h-100 p-3 bg-white">
                    <div class="card-body d-flex align-items-center justify-content-between p-2">
                        <div>
                            <span class="text-secondary small fw-semibold text-uppercase">Tổng danh mục</span>
                            <h3 class="fw-bold text-dark mb-0 mt-1">{{ number_format($totalCategories) }}</h3>
                            <small class="text-muted" style="font-size: 0.75rem;">Phân loại giày</small>
                        </div>
                        <div class="rounded-4 d-flex align-items-center justify-content-center" 
                             style="width: 54px; height: 54px; background-color: #f5f3ff; color: #7c3aed;">
                            <i class="bi bi-tags fs-3"></i>
                        </div>
                    </div>
                </div>
            </div>

            {{-- 3. Tổng người dùng --}}
            <div class="col-12 col-sm-6 col-xl-4">
                <div class="card border-0 rounded-4 shadow-sm h-100 p-3 bg-white">
                    <div class="card-body d-flex align-items-center justify-content-between p-2">
                        <div>
                            <span class="text-secondary small fw-semibold text-uppercase">Tổng khách hàng</span>
                            <h3 class="fw-bold text-dark mb-0 mt-1">{{ number_format($totalUsers) }}</h3>
                            <small class="text-muted" style="font-size: 0.75rem;">Tài khoản đăng ký</small>
                        </div>
                        <div class="rounded-4 d-flex align-items-center justify-content-center" 
                             style="width: 54px; height: 54px; background-color: #ecfdf5; color: #059669;">
                            <i class="bi bi-people fs-3"></i>
                        </div>
                    </div>
                </div>
            </div>

            {{-- 4. Tổng đơn hàng --}}
            <div class="col-12 col-sm-6 col-xl-4">
                <div class="card border-0 rounded-4 shadow-sm h-100 p-3 bg-white">
                    <div class="card-body d-flex align-items-center justify-content-between p-2">
                        <div>
                            <span class="text-secondary small fw-semibold text-uppercase">Tổng đơn hàng</span>
                            <h3 class="fw-bold text-dark mb-0 mt-1">{{ number_format($totalOrders) }}</h3>
                            <small class="text-muted" style="font-size: 0.75rem;">Đơn mua từ khách hàng</small>
                        </div>
                        <div class="rounded-4 d-flex align-items-center justify-content-center" 
                             style="width: 54px; height: 54px; background-color: #fffbeb; color: #d97706;">
                            <i class="bi bi-receipt fs-3"></i>
                        </div>
                    </div>
                </div>
            </div>

            {{-- 5. Tổng doanh thu --}}
            <div class="col-12 col-sm-6 col-xl-4">
                <div class="card border-0 rounded-4 shadow-sm h-100 p-3 bg-white">
                    <div class="card-body d-flex align-items-center justify-content-between p-2">
                        <div>
                            <span class="text-secondary small fw-semibold text-uppercase">Tổng doanh thu</span>
                            <h3 class="fw-bold text-danger mb-0 mt-1">{{ number_format($totalRevenue) }}₫</h3>
                            <small class="text-muted" style="font-size: 0.75rem;">Doanh thu tích lũy</small>
                        </div>
                        <div class="rounded-4 d-flex align-items-center justify-content-center" 
                             style="width: 54px; height: 54px; background-color: #fef2f2; color: #dc2626;">
                            <i class="bi bi-cash-stack fs-3"></i>
                        </div>
                    </div>
                </div>
            </div>

            {{-- 6. Giá trị tồn kho --}}
            <div class="col-12 col-sm-6 col-xl-4">
                <div class="card border-0 rounded-4 shadow-sm h-100 p-3 bg-white">
                    <div class="card-body d-flex align-items-center justify-content-between p-2">
                        <div>
                            <span class="text-secondary small fw-semibold text-uppercase">Giá trị kho hàng</span>
                            <h3 class="fw-bold text-primary mb-0 mt-1">{{ number_format($totalInventoryValue) }}₫</h3>
                            <small class="text-muted" style="font-size: 0.75rem;">Tổng tài sản trong kho</small>
                        </div>
                        <div class="rounded-4 d-flex align-items-center justify-content-center" 
                             style="width: 54px; height: 54px; background-color: #ecfeff; color: #0891b2;">
                            <i class="bi bi-archive fs-3"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- TABLES SECTION --}}
        <div class="row g-4 mb-4">
            {{-- BẢNG 1: TOP SẢN PHẨM BÁN CHẠY NHẤT --}}
            <div class="col-12 col-lg-6">
                <div class="card border-0 rounded-4 shadow-sm h-100 bg-white">
                    <div class="card-header bg-white py-3 border-0 d-flex align-items-center justify-content-between">
                        <h6 class="fw-bold text-dark mb-0 d-flex align-items-center gap-2">
                            <i class="bi bi-fire text-danger"></i> Top 5 Sản phẩm bán chạy nhất
                        </h6>
                        <span class="badge bg-danger-subtle text-danger rounded-pill">Hot</span>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light small">
                                    <tr>
                                        <th class="ps-3">Tên sản phẩm</th>
                                        <th class="text-center">Đã bán</th>
                                        <th class="text-end pe-3">Đơn giá</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($topSellingProducts as $item)
                                        <tr>
                                            <td class="ps-3">
                                                <div class="fw-semibold text-dark">
                                                    {{ $item->variant->product ? $item->variant->product->name : 'N/A' }}
                                                </div>
                                                <small class="text-muted">
                                                    Size: {{ $item->variant->size->name ?? 'Free' }}
                                                </small>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1 rounded-pill">
                                                    <i class="bi bi-check2 me-1"></i>{{ $item->total_sold }} đôi
                                                </span>
                                            </td>
                                            <td class="text-end pe-3 fw-bold text-danger">
                                                {{ number_format($item->variant->product ? $item->variant->product->price : 0) }}₫
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center py-4 text-muted">Chưa có dữ liệu bán hàng.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            {{-- BẢNG 2: TOP SẢN PHẨM TỒN KHO NHIỀU NHẤT --}}
            <div class="col-12 col-lg-6">
                <div class="card border-0 rounded-4 shadow-sm h-100 bg-white">
                    <div class="card-header bg-white py-3 border-0 d-flex align-items-center justify-content-between">
                        <h6 class="fw-bold text-dark mb-0 d-flex align-items-center gap-2">
                            <i class="bi bi-box-seam text-primary"></i> Top 5 Sản phẩm tồn kho nhiều nhất
                        </h6>
                        <span class="badge bg-primary-subtle text-primary rounded-pill">Kho hàng</span>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light small">
                                    <tr>
                                        <th class="ps-3">Tên sản phẩm</th>
                                        <th class="text-center">Số lượng tồn</th>
                                        <th class="text-end pe-3">Đơn giá</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($topStockProducts as $product)
                                        <tr>
                                            <td class="ps-3">
                                                <div class="fw-semibold text-dark">{{ $product->name }}</div>
                                                <small class="text-muted">{{ $product->category->name ?? 'Giày' }}</small>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge bg-info-subtle text-info border border-info-subtle px-2 py-1 rounded-pill">
                                                    {{ $product->variants_sum_stock }} đôi
                                                </span>
                                            </td>
                                            <td class="text-end pe-3 fw-semibold">
                                                {{ number_format($product->price) }}₫
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center py-4 text-muted">Chưa có dữ liệu tồn kho.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- BẢNG 3: TOP 5 SẢN PHẨM ĐẮT NHẤT --}}
        <div class="card border-0 rounded-4 shadow-sm bg-white mb-4">
            <div class="card-header bg-white py-3 border-0 d-flex align-items-center justify-content-between">
                <h6 class="fw-bold text-dark mb-0 d-flex align-items-center gap-2">
                    <i class="bi bi-gem text-warning"></i> Top 5 Sản phẩm giá cao nhất (Cao cấp)
                </h6>
                <span class="badge bg-warning-subtle text-warning rounded-pill">Premium</span>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light small">
                            <tr>
                                <th class="ps-3">Tên sản phẩm</th>
                                <th>Danh mục</th>
                                <th class="text-center">Tổng tồn kho</th>
                                <th class="text-center">Số lượt đặt</th>
                                <th class="text-end pe-3">Giá niêm yết</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($topExpensiveProducts as $product)
                                <tr>
                                    <td class="ps-3 fw-bold text-dark">
                                        {{ $product->name }}
                                    </td>
                                    <td>
                                        <span class="badge bg-light text-secondary border">
                                            {{ $product->category->name ?? 'Sneaker' }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-secondary-subtle text-dark">
                                            {{ $product->variants->sum('stock') }} đôi
                                        </span>
                                    </td>
                                    <td class="text-center small text-secondary">
                                        {{ $product->order_items_count }} lượt
                                    </td>
                                    <td class="text-end pe-3 fw-bold text-danger fs-6">
                                        {{ number_format($product->price) }} VNĐ
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-muted">Chưa có dữ liệu sản phẩm.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
