@extends('layouts.app')

@section('title', 'Chi tiết đơn hàng #' . $order->id . ' - Simple Shop Admin')

@section('content')
    <div class="container-fluid px-0">
        {{-- TOP BAR --}}
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
            <div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-1 small">
                        <li class="breadcrumb-item"><a href="{{ route('orders.index') }}" class="text-decoration-none">Đơn
                                hàng</a></li>
                        <li class="breadcrumb-item active" aria-current="page">#{{ $order->id }}</li>
                    </ol>
                </nav>
                <h4 class="fw-bold text-dark mb-0">
                    <i class="bi bi-receipt text-primary me-2"></i>Chi tiết đơn hàng #{{ $order->id }}
                </h4>
            </div>
            <div>
                <a href="{{ route('orders.index') }}" class="btn btn-outline-secondary rounded-pill px-3">
                    <i class="bi bi-arrow-left me-1"></i> Quay lại danh sách
                </a>
            </div>
        </div>

        {{-- INFO CARDS --}}
        <div class="row g-3 mb-4">
            <div class="col-12 col-md-6 col-xl-3">
                <div class="card border-0 rounded-4 shadow-sm bg-white p-3 h-100">
                    <span class="text-secondary small fw-semibold text-uppercase">Khách hàng</span>
                    <h6 class="fw-bold text-dark mt-2 mb-1">{{ $order->user->name ?? 'Khách vãng lai' }}</h6>
                    <small class="text-muted text-truncate d-block">{{ $order->user->email ?? 'Chưa có email' }}</small>
                </div>
            </div>

            <div class="col-12 col-md-6 col-xl-3">
                <div class="card border-0 rounded-4 shadow-sm bg-white p-3 h-100">
                    <span class="text-secondary small fw-semibold text-uppercase">Người nhận & Liên hệ</span>
                    <h6 class="fw-bold text-dark mt-2 mb-1">
                        {{ $order->receiver_name ?? ($order->user->name ?? 'Chưa cập nhật') }}</h6>
                    <small class="text-muted d-block">
                        <i class="bi bi-telephone me-1"></i>{{ $order->phone ?? ($order->user->phone ?? 'Chưa có SĐT') }}
                    </small>
                </div>
            </div>

            <div class="col-12 col-md-6 col-xl-3">
                <div class="card border-0 rounded-4 shadow-sm bg-white p-3 h-100">
                    <span class="text-secondary small fw-semibold text-uppercase">Trạng thái đơn hàng</span>
                    <form action="{{ route('orders.updateStatus', $order) }}" method="POST" class="mt-2">
                        @csrf
                        @method('PATCH')
                        <select
                            class="form-select form-select-sm rounded-pill fw-medium 
                            {{ $order->status === 'completed' ? 'border-success text-success bg-success-subtle' : '' }}
                            {{ $order->status === 'cancelled' ? 'border-danger text-danger bg-danger-subtle' : '' }}
                            {{ $order->status === 'pending' ? 'border-warning text-dark bg-warning-subtle' : '' }}
                            {{ $order->status === 'shipping' ? 'border-info text-dark bg-info-subtle' : '' }}
                            {{ $order->status === 'processing' ? 'border-primary text-primary bg-primary-subtle' : '' }}"
                            name="status" onchange="this.form.submit()" style="width: fit-content">
                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Chờ xử lý</option>
                            <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Đang xử lý
                            </option>
                            <option value="shipping" {{ $order->status == 'shipping' ? 'selected' : '' }}>Đang giao
                            </option>
                            <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Hoàn thành
                            </option>
                            <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Đã hủy</option>
                        </select>
                    </form>
                </div>
            </div>

            <div class="col-12 col-md-6 col-xl-3">
                <div class="card border-0 rounded-4 shadow-sm bg-white p-3 h-100">
                    <span class="text-secondary small fw-semibold text-uppercase">Tổng giá trị đơn</span>
                    <h4 class="fw-bold text-danger mt-2 mb-0">{{ number_format($order->total_price) }}₫</h4>
                    <small class="text-muted">Phương thức: {{ strtoupper($order->payment_method ?? 'COD') }}</small>
                </div>
            </div>
        </div>

        {{-- DELIVERY & NOTES ROW --}}
        @if ($order->shipping_address || $order->note)
            <div class="card border-0 rounded-4 shadow-sm bg-white p-3 mb-4">
                <div class="row g-3">
                    @if ($order->shipping_address)
                        <div class="col-12 col-md-6">
                            <span class="text-secondary small fw-semibold text-uppercase d-block mb-1">
                                <i class="bi bi-geo-alt-fill text-danger me-1"></i>Địa chỉ nhận hàng
                            </span>
                            <div class="text-dark">{{ $order->shipping_address }}</div>
                        </div>
                    @endif
                    @if ($order->note)
                        <div class="col-12 col-md-6">
                            <span class="text-secondary small fw-semibold text-uppercase d-block mb-1">
                                <i class="bi bi-chat-left-text-fill text-primary me-1"></i>Ghi chú của khách
                            </span>
                            <div class="text-secondary fst-italic">{{ $order->note }}</div>
                        </div>
                    @endif
                </div>
            </div>
        @endif

        {{-- ORDER ITEMS TABLE --}}
        <div class="card border-0 rounded-4 shadow-sm bg-white overflow-hidden mb-4">
            <div class="card-header bg-white py-3 border-0">
                <h6 class="fw-bold text-dark mb-0">
                    <i class="bi bi-box-seam me-2 text-primary"></i>Danh sách sản phẩm đã đặt
                </h6>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light small">
                            <tr>
                                <th class="ps-3 py-3">Sản phẩm</th>
                                <th class="py-3 text-center">Kích cỡ (Size)</th>
                                <th class="py-3 text-end">Đơn giá</th>
                                <th class="py-3 text-center">Số lượng</th>
                                <th class="py-3 text-end pe-3">Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($order->orderItems as $item)
                                <tr>
                                    <td class="ps-3">
                                        <div class="d-flex align-items-center gap-2">
                                            @if ($item->variant && $item->variant->product && $item->variant->product->image)
                                                <img src="{{ asset('storage/' . $item->variant->product->image) }}"
                                                    alt="{{ $item->variant->product->name }}"
                                                    class="rounded-3 border object-fit-cover flex-shrink-0"
                                                    style="width: 44px; height: 44px;">
                                            @else
                                                <div class="rounded-3 bg-light d-flex align-items-center justify-content-center text-secondary flex-shrink-0"
                                                    style="width: 44px; height: 44px;">
                                                    <i class="bi bi-image"></i>
                                                </div>
                                            @endif
                                            <div>
                                                <div class="fw-semibold text-dark">
                                                    {{ $item->variant->product->name ?? 'Sản phẩm đã xóa' }}
                                                </div>
                                                <small class="text-muted">Mã phân loại #{{ $item->variant_id }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-light text-dark border px-2 py-1">
                                            Size {{ $item->variant->size->name ?? 'N/A' }}
                                        </span>
                                    </td>
                                    <td class="text-end fw-medium text-dark">
                                        {{ number_format($item->price) }}₫
                                    </td>
                                    <td class="text-center fw-semibold">
                                        {{ $item->quantity }}
                                    </td>
                                    <td class="text-end pe-3 fw-bold text-danger">
                                        {{ number_format($item->subtotal ?? $item->price * $item->quantity) }}₫
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-muted">
                                        Không có dữ liệu mặt hàng nào trong đơn này.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                        <tfoot class="table-light">
                            <tr>
                                <td colspan="4" class="text-end fw-bold py-3 text-dark">Tổng tiền thanh toán:</td>
                                <td class="text-end pe-3 fw-bold fs-5 text-danger py-3">
                                    {{ number_format($order->total_price) }}₫
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
