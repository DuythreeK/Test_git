@extends('customer.layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">
                            Danh sách sản phẩm
                        </h5>
                        <p class="card-text">
                            Xem những sản phẩm có sẵn
                        </p>
                        <button class="btn btn-outline-dark">
                            <a class="nav-link text-primary" href="{{ route('customer.products.index') }}">
                                Đến xem các sản phẩm
                            </a>
                        </button>

                    </div>

                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">
                            Giỏ hàng
                        </h5>
                        <p class="card-text">
                            Xem những sản phẩm trong giỏ hàng
                        </p>
                        <button class="btn btn-outline-dark">
                            <a class="nav-link text-primary" href="{{ route('customer.cart.index') }}">
                                Đi tới giỏ hàng
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
