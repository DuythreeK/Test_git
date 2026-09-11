@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="text-center">
            <h2>Orders</h2>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-striped mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>User</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Create at</th>
                                <th>Action</th>
                            </tr>

                        </thead>

                        <tbody>
                            @foreach ($orders as $order)
                                <tr>

                                    <td>{{ $order->id }}</td>

                                    <td>{{ $order->user->name }}</td>

                                    <td>{{ number_format($order->total_price) }}</td>
                                    <td>
                                        <form action="{{ route('orders.updateStatus', $order) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <select class="form-select" name="status" onchange="this.form.submit()">
                                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>
                                                    pending
                                                </option>
                                                <option value="processing"
                                                    {{ $order->status == 'processing' ? 'selected' : '' }}>
                                                    processing
                                                </option>
                                                <option value="shipping"
                                                    {{ $order->status == 'shipping' ? 'selected' : '' }}>
                                                    shipping
                                                </option>
                                                <option value="completed"
                                                    {{ $order->status == 'completed' ? 'selected' : '' }}>
                                                    completed
                                                </option>
                                            </select>
                                        </form>
                                    </td>

                                    {{-- <td>{{ $order->status }}</td> --}}

                                    <td>{{ $order->created_at }}</td>

                                    <td>

                                        <a class="btn btn-primary" href="{{ route('orders.show', $order) }}">
                                            View
                                        </a>

                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center mt-2">
            {{ $orders->links() }}
        </div>
    </div>
@endsection
