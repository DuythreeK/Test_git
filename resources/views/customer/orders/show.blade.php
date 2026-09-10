@extends('customer.layouts.app')
@section('title', 'Detail Order')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2>Order Detail</h2>
            </div>
            <div class="card-body">
                <p><strong>User name: </strong>{{ $order->user->name }}</p>
                <p><strong>Order date: </strong>{{ $order->order_date }}</p>
                <p><strong>Status: </strong>{{ $order->status }}</p>
                <p><strong>Shipping address: </strong>{{ $order->shipping_address }}</p>
                <p><strong>Note: </strong>{{ $order->note }}</p>
                <p><strong>Total price: </strong>{{ $order->total_price }}</p>
                <p><strong>Payment method: </strong>{{ $order->payment_method }}</p>
                <p><strong>Payment status: </strong>{{ $order->payment_status }}</p>
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        <h6>Order items</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <th>Product name</th>
                                    <th>Size</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Subtotal</th>
                                </thead>
                                <tbody>
                                    @foreach ($order->orderItems as $item)
                                        <tr>
                                            <td>{{ $item->variant->product->name }}</td>
                                            <td>{{ $item->variant->size->name }}</td>
                                            <td>{{ number_format($item->price) }}</td>
                                            <td>{{ $item->quantity }}</td>
                                            <td>{{ number_format($item->subtotal) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button class="btn btn-outline-secondary mt-2" type="button" onclick="history.back()"> Back </button>
    </div>
@endsection
