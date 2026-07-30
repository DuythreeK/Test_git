@extends('layouts.app')

@section('content')
    <h2>Order #{{ $order->id }}</h2>

    <p>

        Customer :

        {{ $order->user->name }}

    </p>

    <table border="1">

        <tr>

            <th>Product</th>

            <th>Price</th>

            <th>Qty</th>

            <th>Subtotal</th>

        </tr>

        @foreach ($order->orderItems as $item)
            <tr>

                <td>{{ $item->product->name }}</td>

                <td>{{ $item->price }}</td>

                <td>{{ $item->quantity }}</td>

                <td>{{ $item->subtotal }}</td>

            </tr>
        @endforeach

    </table>
@endsection
