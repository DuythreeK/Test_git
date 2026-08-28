@extends('customer.layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">
                            Product List
                        </h5>
                        <p class="card-text">
                            View all available products
                        </p>
                        <button class="btn btn-outline-dark">
                            <a href="{{ route('customer.products.index') }}">
                                Product List
                            </a>
                        </button>

                    </div>

                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">
                            Cart
                        </h5>
                        <p class="card-text">
                            View products in your cart
                        </p>
                        <button class="btn btn-outline-dark">
                            <a href="{{ route('customer.cart.index') }}">
                                Cart
                            </a>
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>
    {{-- <h2>Home</h2> --}}

    {{-- <ul>

        <li>
            <a href="{{ route('customer.products.index') }}">
                Product List
            </a>
        </li>
        <li>
            <a href="{{ route('customer.cart.index') }}">
                Cart
            </a>
        </li> --}}

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

    {{-- </ul> --}}
@endsection
