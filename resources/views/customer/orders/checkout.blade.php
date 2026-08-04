@extends('customer.layouts.app')

@section('title', 'Checkout')

@section('content')

    <h2>
        Checkout
    </h2>
    <form action="{{ route('customer.orders.store') }}" method="POST">

        @csrf
        <table border="1px" cellpadding=10 cellspacing=0>
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
            <tr>
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

        <hr>
        <h3>Total: {{ number_format($total) }}</h3>
        <h3>Shipping Information</h3>
        <p>
            Receiver Name
            <br>
            <input type="text" name="receiver_name" value="{{ auth()->user()->name }}" required>
        </p>

        <p>
            Phone
            <br>
            <input type="text" name="phone" value="{{ auth()->user()->phone }}" required>
        </p>

        <p>Address
            <br>
            <textarea name="shipping_address">{{ auth()->user()->address }}</textarea>
        </p>

        <p>
            Note
            <br>
            <textarea name="note"></textarea>
        </p>

        <button type="submit">Place Order</button>
    </form>
@endsection
