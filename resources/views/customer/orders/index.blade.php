@extends('customer.layouts.app')

@section('title', 'Order List')

@section('content')
    <div class="container">
        <div class="card mb-2">
            <div class="card-header">
                <h5>Order List</h5>
            </div>
            <div class="card-body">
                <table class="table table-hover table-striped" border="1px solid" cellpadding=10 cellspacing=0>
                    <thead class="table-dark">
                        <tr>
                            <th>
                                Order date
                            </th>
                            <th>
                                Total price
                            </th>
                            <th>
                                Status
                            </th>
                            <th>
                                Shipping address
                            </th>
                            <th>
                                Payment method
                            </th>
                            <th>
                                Payment status
                            </th>
                            <th>
                                Action
                            </th>
                        </tr>
                    </thead>

                    @foreach ($orders as $order)
                        <tr>
                            <td>
                                {{ $order->order_date }}
                            </td>
                            <td>
                                {{ number_format($order->total_price) }}
                            </td>
                            <td>
                                {{ $order->status }}
                            </td>
                            <td>
                                {{ $order->shipping_address }}
                            </td>
                            <td>
                                {{ $order->payment_method }}
                            </td>
                            <td>
                                {{ $order->payment_status }}
                            </td>
                            <td>
                                <a href="{{ route('customer.orders.show', $order) }}" class="btn btn-primary">Detail</a>
                            </td>

                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
        <div class="d-flex justify-content-center">
            {{ $orders->links() }}
        </div>
        <button class="btn btn-outline-secondary mb-2" type="button" onclick="history.back()">Back</button>
    </div>


@endsection
