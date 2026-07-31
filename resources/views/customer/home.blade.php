@extends('customer.layouts.app')

@section('content')
    <h2>Home</h2>

    <ul>

        <li>
            <a href="{{ route('customer.products.index') }}">
                Product List
            </a>
        </li>
        <li>
            <a href="{{ route('customer.cart.index') }}">
                Cart
            </a>
        </li>

        {{-- <li>
            <a href="{{ route('categories.index') }}">
                Manage Categories
            </a>
        </li>

        <li>
            <a href="{{ route('orders.index') }}">
                Manage Orders
            </a>
        </li> --}}

    </ul>
@endsection
