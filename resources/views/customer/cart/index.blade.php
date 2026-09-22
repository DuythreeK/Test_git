@extends('customer.layouts.app')

@section('title', 'Giỏ hàng của tôi - Simple Shop')

@section('content')
    <div class="container py-4">
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb small">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}" class="text-decoration-none text-secondary">
                        <i class="bi bi-house-door-fill me-1"></i>Trang chủ
                    </a>
                </li>
                <li class="breadcrumb-item active text-dark fw-medium" aria-current="page">Giỏ hàng của tôi</li>
            </ol>
        </nav>

        @if ($cartItems->count())
            <div class="card shadow-sm border-light-subtle rounded-3">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold text-dark">
                        <i class="bi bi-cart3 me-2 text-primary"></i>Giỏ hàng của bạn ({{ $cartItems->count() }} sản phẩm)
                    </h5>
                    <a href="{{ route('customer.products.index') }}"
                        class="text-primary text-decoration-none small fw-medium">
                        <i class="bi bi-plus-circle me-1"></i>Tiếp tục mua hàng
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle border">
                            <thead class="table-light">
                                <tr>
                                    <th style="width: 40px;" class="text-center">
                                        <input type="checkbox" id="check-all" class="form-check-input">
                                    </th>
                                    <th>Hình ảnh</th>
                                    <th>Sản phẩm</th>
                                    <th>Kích cỡ</th>
                                    <th>Đơn giá</th>
                                    <th>Số lượng</th>
                                    <th>Tạm tính</th>
                                    <th class="text-center">Thao tác</th>
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
                                        <td class="text-center">
                                            <input type="checkbox" name="cart_items[]" value="{{ $item->id }}"
                                                class="item-checkbox form-check-input" form="checkout-form">
                                        </td>
                                        <td>
                                            @if ($item->variant->product->image)
                                                <img src="{{ asset('storage/' . $item->variant->product->image) }}"
                                                    class="img-thumbnail rounded-2" width="75" height="75"
                                                    style="object-fit: contain;">
                                            @else
                                                <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=150"
                                                    class="img-thumbnail rounded-2" width="75" height="75"
                                                    style="object-fit: contain;">
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('customer.products.show', $item->variant->product) }}"
                                                class="text-decoration-none text-dark fw-bold">
                                                {{ $item->variant->product->name }}
                                            </a>
                                            <div class="small text-muted">
                                                Danh mục: {{ $item->variant->product->category->name ?? 'Giày' }}
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge bg-secondary-subtle text-dark border">
                                                Size {{ $item->variant->size->name }}
                                            </span>
                                        </td>
                                        <td class="fw-semibold">
                                            {{ number_format($item->variant->product->price) }}₫
                                        </td>
                                        <td>
                                            <form action="{{ route('customer.cart.update', $item) }}" method="POST"
                                                class="d-flex gap-2 align-items-center">
                                                @csrf
                                                @method('PUT')
                                                <input type="number" name="quantity" value="{{ $item->quantity }}"
                                                    min="1" max="{{ $item->variant->stock }}"
                                                    class="form-control form-control-sm text-center" style="width: 70px;">
                                                <button type="submit" class="btn btn-sm btn-outline-primary"
                                                    title="Cập nhật số lượng">
                                                    <i class="bi bi-arrow-repeat"></i>
                                                </button>
                                            </form>
                                        </td>
                                        <td class="fw-bold text-danger">
                                            {{ number_format($subtotal) }}₫
                                        </td>
                                        <td class="text-center">
                                            <form action="{{ route('customer.cart.destroy', $item) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button
                                                    onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này khỏi giỏ hàng?')"
                                                    class="btn btn-sm btn-outline-danger" title="Xóa khỏi giỏ hàng">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div
                        class="d-flex flex-column flex-md-row justify-content-between align-items-md-center pt-3 border-top gap-3">
                        <div>
                            <span class="text-muted small">* Vui lòng tích chọn các sản phẩm bạn muốn thanh toán.</span>
                        </div>
                        <div class="d-flex align-items-center gap-4">
                            <div>
                                <span class="text-secondary">Tổng ước tính:</span>
                                <h4 class="fw-bold text-danger mb-0">{{ number_format($total) }} VNĐ</h4>
                            </div>
                            <form id="checkout-form" action="{{ route('customer.orders.checkout') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary px-4 py-2 rounded-pill fw-semibold shadow-sm">
                                    <i class="bi bi-credit-card me-1"></i> Tiến hành thanh toán
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="card shadow-sm border-light-subtle rounded-4">
                <div class="card-body text-center py-5">
                    <i class="bi bi-cart-x text-secondary" style="font-size: 3.5rem;"></i>
                    <h4 class="mt-3 fw-bold text-dark">Giỏ hàng của bạn đang trống</h4>
                    <p class="text-muted">Hãy khám phá thêm các mẫu giày phong cách và thêm vào giỏ hàng nhé!</p>
                    <a href="{{ route('customer.products.index') }}"
                        class="btn btn-primary rounded-pill px-4 py-2 mt-2 shadow-sm">
                        <i class="bi bi-shop me-1"></i> Mua sắm ngay
                    </a>
                </div>
            </div>
        @endif
    </div>
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkAll = document.getElementById('check-all');
            if (checkAll) {
                checkAll.addEventListener('change', function() {
                    document.querySelectorAll('.item-checkbox').forEach(item => {
                        item.checked = this.checked;
                    });
                });
            }
        });
    </script>
@endsection
