@extends('layouts.app')

@section('content')
    <h2>Orders</h2>

    <table border="1">

        <tr>

            <th>ID</th>

            <th>User</th>

            <th>Total</th>

            <th>Status</th>

            <th>Create at</th>

        </tr>

        @foreach ($orders as $order)
            <tr>

                <td>{{ $order->id }}</td>

                <td>{{ $order->user->name }}</td>

                <td>{{ $order->total_price }}</td>

                <td>{{ $order->status }}</td>

                <td>{{ $order->created_at }}</td>

                <td>

                    <a href="{{ route('orders.show', $order) }}">

                        View

                    </a>

                </td>

            </tr>
        @endforeach

    </table>
    {{ $orders->links() }}
@endsection
