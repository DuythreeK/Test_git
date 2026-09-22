@extends('customer.layouts.app')

@section('title', 'Thanh toán đơn hàng - Simple Shop')

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
                    <a href="{{ route('customer.cart.index') }}" class="text-decoration-none text-secondary">
                        Giỏ hàng
                    </a>
                </li>
                <li class="breadcrumb-item active text-dark fw-medium" aria-current="page">Thanh toán</li>
            </ol>
        </nav>

        <form action="{{ route('customer.orders.store') }}" method="POST">
            @csrf

            <div class="row g-4">
                {{-- Cột trái: Thông tin giao hàng & Phương thức thanh toán --}}
                <div class="col-12 col-lg-7">
                    <div class="card shadow-sm border-light-subtle rounded-3 mb-4">
                        <div class="card-header bg-white py-3">
                            <h5 class="mb-0 fw-bold text-dark">
                                <i class="bi bi-geo-alt me-2 text-primary"></i>Thông tin giao hàng
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label small fw-semibold">Họ tên người nhận <span
                                        class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="receiver_name"
                                    value="{{ auth()->user()->name }}" placeholder="Nhập tên người nhận hàng" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label small fw-semibold">Số điện thoại liên hệ <span
                                        class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="phone"
                                    value="{{ auth()->user()->phone }}" placeholder="Nhập số điện thoại giao hàng" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label small fw-semibold">Địa chỉ giao hàng cụ thể <span
                                        class="text-danger">*</span></label>
                                <textarea class="form-control" name="shipping_address" rows="3"
                                    placeholder="Số nhà, tên đường, phường/xã, quận/huyện, tỉnh/thành phố" required>{{ auth()->user()->address }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label small fw-semibold">Ghi chú cho đơn hàng (tùy chọn)</label>
                                <textarea class="form-control" name="note" rows="2"
                                    placeholder="Ví dụ: Giao hàng vào giờ hành chính, gọi trước khi đến..."></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="card shadow-sm border-light-subtle rounded-3">
                        <div class="card-header bg-white py-3">
                            <h5 class="mb-0 fw-bold text-dark">
                                <i class="bi bi-wallet2 me-2 text-primary"></i>Phương thức thanh toán
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-12 col-md-6">
                                    <input type="radio" class="btn-check" name="payment_method" value="cod"
                                        id="cod" checked>
                                    <label for="cod"
                                        class="btn btn-outline-primary w-100 text-start p-3 rounded-3 h-100">
                                        <div class="fw-bold d-flex align-items-center gap-2 mb-1">
                                            <i class="bi bi-cash-stack fs-5"></i> Thanh toán khi nhận hàng (COD)
                                        </div>
                                        <small class="text-muted d-block">Thanh toán bằng tiền mặt khi shipper giao tận
                                            nơi</small>
                                    </label>
                                </div>

                                <div class="col-12 col-md-6">
                                    <input type="radio" class="btn-check" name="payment_method" value="vnpay"
                                        id="vnpay">
                                    <label for="vnpay"
                                        class="btn btn-outline-primary w-100 text-start p-3 rounded-3 h-100">
                                        <div class="fw-bold d-flex align-items-center gap-2 mb-1">
                                            <i class="bi bi-qr-code-scan fs-5"></i> Cổng thanh toán VNPAY
                                        </div>
                                        <small class="text-muted d-block">Thanh toán quét mã QR / Thẻ ATM / Internet Banking
                                            an toàn</small>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Cột phải: Tóm tắt đơn hàng --}}
                <div class="col-12 col-lg-5">
                    <div class="card shadow-sm border-light-subtle rounded-3 sticky-top" style="top: 85px;">
                        <div class="card-header bg-white py-3">
                            <h5 class="mb-0 fw-bold text-dark">
                                <i class="bi bi-bag-check me-2 text-primary"></i>Đơn hàng của bạn
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive mb-3" style="max-height: 280px; overflow-y: auto;">
                                <table class="table table-sm align-middle">
                                    <thead class="table-light small">
                                        <tr>
                                            <th>Sản phẩm</th>
                                            <th class="text-center">SL</th>
                                            <th class="text-end">Tạm tính</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $total = 0;
                                        @endphp

                                        @foreach ($cartItems as $item)
                                            @php
                                                $subtotal = $item->variant->product->price * $item->quantity;
                                                $total += $subtotal;
                                            @endphp
                                            <tr>
                                                <td>
                                                    <img src="{{ asset('storage/' . $item->variant->product->image) }}"
                                                        alt="product.image" width="50px">
                                                    <div class="fw-semibold small">{{ $item->variant->product->name }}</div>
                                                    <small class="text-muted">Size: {{ $item->variant->size->name }} |
                                                        {{ number_format($item->variant->product->price) }}₫</small>
                                                </td>
                                                <td class="text-center small">x{{ $item->quantity }}</td>
                                                <td class="text-end small fw-bold text-danger">
                                                    {{ number_format($subtotal) }}₫</td>
                                            </tr>
                                            <input type="hidden" name="cart_items[]" value="{{ $item->id }}">
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <hr>

                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="fs-5 fw-bold text-dark">Tổng thanh toán:</span>
                                <span class="fs-4 fw-bold text-danger">{{ number_format($total) }} VNĐ</span>
                            </div>

                            <button class="btn btn-primary w-100 rounded-pill py-2 fw-semibold fs-6 shadow-sm"
                                type="submit">
                                <i class="bi bi-check2-circle me-1"></i> Xác nhận đặt hàng
                            </button>

                            <div class="text-center mt-3">
                                <a href="{{ route('customer.cart.index') }}"
                                    class="text-secondary text-decoration-none small">
                                    <i class="bi bi-arrow-left me-1"></i> Quay lại giỏ hàng
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
