@extends('customer.layouts.app')

@section('title', 'Chi tiết đơn hàng #' . $order->id . ' - Simple Shop')

@section('content')
    <div class="container py-4">
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb small">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}" class="text-decoration-none text-secondary">
                        <i class="bi bi-house-door-fill me-1"></i>Trang chủ
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('customer.orders.index') }}" class="text-decoration-none text-secondary">
                        Danh sách đơn hàng
                    </a>
                </li>
                <li class="breadcrumb-item active text-dark fw-medium" aria-current="page">Đơn hàng #{{ $order->id }}
                </li>
            </ol>
        </nav>

        <div class="card shadow-sm border-light-subtle rounded-3 mb-4">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-bold text-dark">
                    <i class="bi bi-receipt me-2 text-primary"></i>Chi tiết đơn hàng #{{ $order->id }}
                </h5>
                <span class="small text-muted">Ngày đặt: {{ $order->order_date }}</span>
            </div>
            <div class="card-body">
                <div class="row g-3 mb-4">
                    <div class="col-12 col-md-6">
                        <div class="p-3 bg-light rounded-3 h-100">
                            <h6 class="fw-bold text-dark border-bottom pb-2 mb-2">Thông tin người nhận</h6>
                            <p class="mb-1"><strong>Khách hàng:</strong> {{ $order->user->name }}</p>
                            <p class="mb-1"><strong>Số điện thoại:</strong>
                                {{ $order->phone ?? ($order->user->phone ?? 'Chưa cập nhật') }}</p>
                            <p class="mb-1"><strong>Địa chỉ giao:</strong> {{ $order->shipping_address }}</p>
                            @if ($order->note)
                                <p class="mb-0"><strong>Ghi chú:</strong> <span
                                        class="fst-italic text-secondary">{{ $order->note }}</span></p>
                            @endif
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="p-3 bg-light rounded-3 h-100">
                            <h6 class="fw-bold text-dark border-bottom pb-2 mb-2">Trạng thái & Thanh toán</h6>
                            <p class="mb-1">
                                <strong>Trạng thái đơn:</strong>
                                @if ($order->status === 'pending')
                                    <span class="badge bg-warning-subtle text-warning border border-warning-subtle">Chờ xử
                                        lý</span>
                                @elseif($order->status === 'processing')
                                    <span
                                        class="badge bg-secondary-subtle text-secondary border border-secondary-subtle">Đang
                                        xử lý</span>
                                @elseif($order->status === 'shipping')
                                    <span class="badge bg-info-subtle text-info border border-info-subtle">Đang
                                        giao</span>
                                @elseif($order->status === 'completed')
                                    <span class="badge bg-success-subtle text-success border border-success-subtle">Hoàn
                                        thành</span>
                                @elseif($order->status === 'cancelled')
                                    <span class="badge bg-danger-subtle text-danger border border-danger-subtle">Đã
                                        hủy</span>
                                @else
                                    <span
                                        class="badge bg-primary-subtle text-primary border">{{ ucfirst($order->status) }}</span>
                                @endif
                            </p>
                            <p class="mb-1">
                                <strong>Phương thức:</strong>
                                <span
                                    class="badge bg-light text-dark border">{{ strtoupper($order->payment_method) }}</span>
                            </p>
                            <p class="mb-1">
                                <strong>Thanh toán:</strong>
                                @if ($order->payment_status === 'paid' || $order->payment_status === 'đã thanh toán')
                                    <span class="badge bg-success">Đã thanh toán</span>
                                @else
                                    <span class="badge bg-secondary">Chưa thanh toán</span>
                                @endif

                                @if ($order->payment_method === 'vnpay' && $order->payment_status !== 'paid')
                                    <a href="{{ route('customer.orders.createpayment', $order) }}"
                                        class="btn btn-sm btn-success rounded-pill ms-2">
                                        <i class="bi bi-credit-card me-1"></i> Thanh toán ngay
                                    </a>
                                @endif
                            </p>
                            <p class="mb-0">
                                <strong>Tổng giá trị:</strong>
                                <span class="fs-5 fw-bold text-danger">{{ number_format($order->total_price) }} VNĐ</span>
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Danh sách sản phẩm --}}
                <div class="card border">
                    <div class="card-header bg-light py-2">
                        <h6 class="mb-0 fw-bold text-dark">Sản phẩm trong đơn hàng</h6>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light small">
                                    <tr>
                                        <th>Tên sản phẩm</th>
                                        <th>Kích cỡ</th>
                                        <th>Đơn giá</th>
                                        <th class="text-center">Số lượng</th>
                                        <th class="text-end">Thành tiền</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order->orderItems as $item)
                                        <tr>
                                            <td class="fw-semibold">{{ $item->variant->product->name }}</td>
                                            <td>
                                                <span class="badge bg-secondary-subtle text-dark">Size
                                                    {{ $item->variant->size->name }}</span>
                                            </td>
                                            <td>{{ number_format($item->price) }}₫</td>
                                            <td class="text-center">{{ $item->quantity }}</td>
                                            <td class="text-end fw-bold text-danger">{{ number_format($item->subtotal) }}₫
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <a href="{{ route('customer.orders.index') }}" class="btn btn-outline-secondary rounded-pill px-3">
            <i class="bi bi-arrow-left me-1"></i> Quay lại danh sách đơn hàng
        </a>
    </div>
@endsection
