@extends('customer.layouts.app')

@section('title', 'My Cart')

@section('content')

    <h2>My Cart</h2>

    @if (session('success'))
        <p style="color: green">
            {{ session('success') }}
        </p>
    @endif

    @if ($cartItems->count())

        <table border="1" cellpadding="10" cellspacing="0">

            <tr>
                <th>Image</th>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Subtotal</th>
                <th>Action</th>
            </tr>

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
                            <img src="{{ asset($item->product->image) }}" width="80">
                        @endif

                    </td>

                    <td>

                        <a href="{{ route('customer.products.show', $item->product) }}">
                            {{ $item->product->name }}
                        </a>

                    </td>

                    <td>

                        {{ number_format($item->product->price) }}

                    </td>

                    <td>

                        <form action="{{ route('customer.cart.update', $item) }}" method="POST">

                            @csrf
                            @method('PUT')

                            <input type="number" name="quantity" value="{{ $item->quantity }}" min="1"
                                max="{{ $item->product->stock }}">

                            <button type="submit">
                                Update
                            </button>

                        </form>

                    </td>

                    <td>

                        {{ number_format($subtotal) }}

                    </td>

                    <td>

                        <form action="{{ route('customer.cart.destroy', $item) }}" method="POST">

                            @csrf
                            @method('DELETE')

                            <button onclick="return confirm('Remove this product?')">

                                Remove

                            </button>

                        </form>

                    </td>

                </tr>
            @endforeach

        </table>

        <br>

        <h3>

            Total :
            {{ number_format($total) }}

        </h3>

        <br>

        <a href="{{ route('customer.products.index') }}">

            Continue Shopping

        </a>

        &nbsp;&nbsp;

        <a href="{{ route('customer.orders.checkout') }}">

            Checkout

        </a>
    @else
        <h3>Your cart is empty.</h3>

        <a href="{{ route('customer.products.index') }}">
            Go Shopping
        </a>

    @endif

@endsection
