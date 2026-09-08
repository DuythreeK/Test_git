@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2>Order #{{ $order->id }}</h2>
            </div>
            <div class="card-body">
                <p class="card-title">

                    <strong>Customer :</strong>

                    {{ $order->user->name }}

                </p>
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>

                            <th>Product</th>

                            <th>Price</th>

                            <th>Qty</th>

                            <th>Subtotal</th>

                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($order->orderItems as $item)
                            <tr>

                                <td>{{ $item->variant->product->name }}</td>

                                <td>{{ $item->variant->product->price }}</td>

                                <td>{{ $item->quantity }}</td>

                                <td>{{ $item->subtotal }}</td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>




    <table border="1">





    </table>
@endsection
