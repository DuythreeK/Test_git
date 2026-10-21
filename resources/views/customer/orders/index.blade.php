@extends('customer.layouts.app')

@section('title', 'Danh sách đơn hàng - Simple Shop')

@section('content')
    <div class="container py-4">
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb small">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}" class="text-decoration-none text-secondary">
                        <i class="bi bi-house-door-fill me-1"></i>Trang chủ
                    </a>
                </li>
                <li class="breadcrumb-item active text-dark fw-medium" aria-current="page">Danh sách đơn hàng</li>
            </ol>
        </nav>

        <div class="card shadow-sm border-light-subtle rounded-3 mb-4">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0 fw-bold text-dark">
                    <i class="bi bi-receipt me-2 text-primary"></i>Lịch sử đơn hàng của bạn
                </h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle border">
                        <thead class="table-light">
                            <tr>
                                <th>Ngày đặt</th>
                                <th>Tổng tiền</th>
                                <th>Trạng thái đơn</th>
                                <th>Địa chỉ giao hàng</th>
                                <th>Phương thức</th>
                                <th>Thanh toán</th>
                                <th class="text-center">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($orders as $order)
                                <tr>
                                    <td class="small">{{ $order->order_date }}</td>
                                    <td class="fw-bold text-danger">{{ number_format($order->total_price) }}₫</td>
                                    <td>
                                        @if ($order->status === 'completed' || $order->status === 'đã giao')
                                            <span
                                                class="badge bg-success-subtle text-success border border-success-subtle">Hoàn
                                                thành</span>
                                        @elseif($order->status === 'pending' || $order->status === 'chờ xử lý')
                                            <span
                                                class="badge bg-warning-subtle text-warning border border-warning-subtle">Chờ
                                                xử lý</span>
                                        @elseif($order->status === 'cancelled' || $order->status === 'đã hủy')
                                            <span class="badge bg-danger-subtle text-danger border border-danger-subtle">Đã
                                                hủy</span>
                                        @elseif($order->status === 'processing' || $order->status === 'đang xử lý')
                                            <span
                                                class="badge bg-secondary-subtle text-secondary border border-secondary-subtle">Đang
                                                xử lý
                                            </span>
                                        @elseif($order->status === 'processing')
                                            <span
                                                class="badge bg-secondary-subtle text-secondary border border-secondary-subtle">Đang
                                                xử lý</span>
                                        @elseif($order->status === 'shipping')
                                            <span class="badge bg-info-subtle text-info border border-info-subtle">Đang
                                                giao</span>
                                        @else
                                            <span
                                                class="badge bg-secondary-subtle text-secondary border">{{ ucfirst($order->status) }}</span>
                                        @endif
                                    </td>
                                    <td class="small text-truncate" style="max-width: 200px;"
                                        title="{{ $order->shipping_address }}">
                                        {{ $order->shipping_address }}
                                    </td>
                                    <td>
                                        <span
                                            class="badge bg-light text-dark border">{{ strtoupper($order->payment_method) }}</span>
                                    </td>
                                    <td>
                                        @if ($order->payment_status === 'paid' || $order->payment_status === 'đã thanh toán')
                                            <span class="badge bg-success text-white">Đã thanh toán</span>
                                        @else
                                            <span class="badge bg-secondary text-white">Chưa thanh toán</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('customer.orders.show', $order) }}"
                                            class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                            <i class="bi bi-eye me-1"></i> Chi tiết
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4 text-muted">
                                        <i class="bi bi-inbox fs-3 d-block mb-2"></i>
                                        Bạn chưa có đơn hàng nào.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-center mt-3">
                    {{ $orders->links() }}
                </div>
            </div>
        </div>

        <a href="{{ route('customer.products.index') }}" class="btn btn-outline-secondary rounded-pill px-3">
            <i class="bi bi-arrow-left me-1"></i> Tiếp tục mua hàng
        </a>
    </div>
@endsection
