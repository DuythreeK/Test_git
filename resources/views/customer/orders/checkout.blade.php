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
                                    Price
                                </th>
                                <th>
                                    Qty
                                </th>
                                <th>
                                    Subtotal
                                </th>
                            <tr></tr>
                        </thead>

                        @php
                            $total = 0;
                        @endphp

                        @foreach ($cartItems as $item)
                            @php
                                $subtotal = $item->product->price * $item->quantity;
                                $total += $subtotal;
                            @endphp
                            <tr>
                                <td>
                                    @if ($item->product->image)
                                        <img src="{{ asset('storage/' . $item->product->image) }}" width="80">
                                    @endif
                                </td>
                                <td>
                                    {{ $item->product->name }}
                                </td>
                                <td>
                                    {{ number_format($item->product->price) }}
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
                    <h5>Total: {{ number_format($total) }}</h3>
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

                <button class="btn btn-outline-success" type="submit">Place Order</button>
                </form>
            </div>

        </div>
    </div>



@endsection
