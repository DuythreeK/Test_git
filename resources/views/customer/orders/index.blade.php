@extends('customer.layouts.app')

@section('title', 'Order List')

@section('content')

    <h2>Order List</h2>

    <table border="1px solid" cellpadding=10 cellspacing=0>
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
                Note
            </th>
            <th>
                Created at
            </th>
        </tr>
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
                    {{ $order->note }}
                </td>
                <td>
                    {{ $order->created_at }}
                </td>
            </tr>
        @endforeach
    </table>

    <button type="button" onclick="history.back()">Back</button>

@endsection
