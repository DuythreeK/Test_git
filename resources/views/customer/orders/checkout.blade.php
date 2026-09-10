@extends('customer.layouts.app')

@section('title', 'Checkout')

@section('content')
    <div class="container">
        <div class="card mb-4">
            <div class="card-header">
                <h5>Checkout</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('customer.orders.store') }}" method="POST">

                    @csrf
                    <table class="table table-hover" border="1px" cellpadding=10 cellspacing=0>
                        <thead class="table-dark">
                            <tr>
                                <th>
                                    Image
                                </th>
                                <th>
                                    Product
                                </th>
                                <th>
                                    Size
                                </th>
                                <th>
                                    Price
                                </th>
                                <th>
                                    Qty
                                </th>
                                <th>
                                    Subtotal
                                </th>
                            </tr>
                        </thead>

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
                                    @if ($item->variant->product->image)
                                        <img src="{{ asset('storage/' . $item->variant->product->image) }}" width="80">
                                    @endif
                                </td>
                                <td>
                                    {{ $item->variant->product->name }}
                                </td>
                                <td>
                                    Size {{ $item->variant->size->name }}
                                </td>
                                <td>
                                    {{ number_format($item->variant->product->price) }}
                                </td>
                                <td>
                                    {{ $item->quantity }}
                                </td>
                                <td>
                                    {{ number_format($subtotal) }}
                                </td>
                            </tr>
                            <input type="hidden" name="cart_items[]" value="{{ $item->id }}">
                        @endforeach
                    </table>
                    <h5>Total: {{ number_format($total) }}</h5>
            </div>
        </div>
        <div class="card">
            <div class="card-header">Shipping Information</div>
            <div class="card-body">
                <p>
                    Receiver Name
                    <br>
                    <input class="form-control" type="text" name="receiver_name" value="{{ auth()->user()->name }}"
                        required>
                </p>

                <p>
                    Phone
                    <br>
                    <input class="form-control" type="text" name="phone" value="{{ auth()->user()->phone }}" required>
                </p>

                <p>Address
                    <br>
                    <textarea class="form-control" name="shipping_address">{{ auth()->user()->address }}</textarea>
                </p>

                <p>
                    Note
                    <br>
                    <textarea class="form-control" name="note"></textarea>
                </p>
                <div>
                    <p><strong>Payment method</strong></p>
                    <div class="mb-4 d-flex gap-4">
                        <div>
                            <input type="radio" class="btn-check" name="payment_method" value="cod" id="cod"
                                checked>
                            <label for="cod" class="btn btn btn-outline-primary">
                                <p class="fw-bold">Cash on Delivery (COD)</p>
                                <small>Pay when your order arrives</small>
                            </label>
                        </div>
                        <div>
                            <input type="radio" class="btn-check" name="payment_method" value="vnpay" id="vnpay">
                            <label for="vnpay" class="btn btn-outline-primary">
                                <p class="fw-bold">VNPay</p>
                                <small>Pay securely via VNPay</small>
                            </label>
                        </div>

                    </div>
                    <button class="btn btn-outline-success" type="submit">Place Order</button>
                </div>
                </form>
            </div>

        </div>
    </div>



@endsection
