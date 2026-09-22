@extends('layouts.app')

@section('title', 'Quản lý đơn hàng - Simple Shop Admin')

@section('content')
    <div class="container-fluid px-0">
        {{-- HEADER --}}
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
            <div>
                <h4 class="fw-bold text-dark mb-1">
                    <i class="bi bi-receipt text-primary me-2"></i>Quản lý đơn hàng
                </h4>
                <p class="text-secondary small mb-0">Theo dõi, kiểm tra và cập nhật trạng thái các đơn đặt hàng.</p>
            </div>
            <div>
                <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-3 py-2 rounded-pill">
                    Tổng cộng: {{ $orders->total() ?? $orders->count() }} đơn hàng
                </span>
            </div>
        </div>

        {{-- ORDERS TABLE CARD --}}
        <div class="card border-0 rounded-4 shadow-sm bg-white overflow-hidden">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light small">
                            <tr>
                                <th class="ps-3 py-3">Mã đơn</th>
                                <th class="py-3">Khách hàng</th>
                                <th class="py-3">Tổng tiền</th>
                                <th class="py-3" style="min-width: 170px;">Trạng thái đơn</th>
                                <th class="py-3">Ngày đặt</th>
                                <th class="py-3 text-center pe-3">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($orders as $order)
                                <tr>
                                    <td class="ps-3 fw-bold text-primary">
                                        #{{ $order->id }}
                                    </td>
                                    <td>
                                        <div class="fw-semibold text-dark">{{ $order->user->name ?? 'Khách vãng lai' }}
                                        </div>
                                        <small class="text-muted">{{ $order->user->email ?? '' }}</small>
                                    </td>
                                    <td class="fw-bold text-danger">
                                        {{ number_format($order->total_price) }}₫
                                    </td>
                                    <td>
                                        <form action="{{ route('orders.updateStatus', $order) }}" method="POST"
                                            class="m-0">
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
                                                <option value="pending"
                                                    {{ $order->status == 'pending' ? 'selected' : '' }}>Chờ xử lý</option>
                                                <option value="processing"
                                                    {{ $order->status == 'processing' ? 'selected' : '' }}>Đang xử lý
                                                </option>
                                                <option value="shipping"
                                                    {{ $order->status == 'shipping' ? 'selected' : '' }}>Đang giao</option>
                                                <option value="completed"
                                                    {{ $order->status == 'completed' ? 'selected' : '' }}>Hoàn thành
                                                </option>
                                                <option value="cancelled"
                                                    {{ $order->status == 'cancelled' ? 'selected' : '' }}>Đã hủy</option>
                                            </select>
                                        </form>
                                    </td>
                                    <td class="small text-secondary">
                                        {{ $order->created_at ? $order->created_at->format('d/m/Y H:i') : $order->order_date ?? 'N/A' }}
                                    </td>
                                    <td class="text-center pe-3">
                                        <a class="btn btn-sm btn-outline-primary rounded-pill px-3 fw-medium"
                                            href="{{ route('orders.show', $order) }}">
                                            <i class="bi bi-eye me-1"></i> Chi tiết
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5 text-muted">
                                        <i class="bi bi-inbox fs-2 d-block mb-2 text-secondary"></i>
                                        Chưa có đơn hàng nào trong hệ thống.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @if ($orders->hasPages())
                <div class="card-footer bg-white border-0 py-3 d-flex justify-content-center">
                    {{ $orders->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
