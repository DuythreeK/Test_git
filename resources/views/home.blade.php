@extends('layouts.app')

@section('content')
    <h2>Dashboard</h2>

    <ul>

        <li>
            <a href="{{ route('products.index') }}">
                Manage Products
            </a>
        </li>

        <li>
            <a href="{{ route('categories.index') }}">
                Manage Categories
            </a>
        </li>

        <li>
            <a href="{{ route('orders.index') }}">
                Manage Orders
            </a>
        </li>

    </ul>
@endsection
