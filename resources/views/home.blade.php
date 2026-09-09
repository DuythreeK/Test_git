@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="text-center">
            <h2>Home</h2>
            <p>Welcome to the shop management system</p>
        </div>
    </div>
    <div class="row g-4">
        <div class="col-md-6 col-lg-3">
            <div class="card shadow-sm h-100">
                <div class="card-body text-center d-flex flex-column">
                    <h5 class="card-title">Dashboard</h5>
                    <p class="card-text">View shop statistics and overview.</p>
                    <a class="btn btn-outline-primary mt-auto" href="{{ route('dashboard.index') }}">
                        Go to Dashboard
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="card shadow-sm h-100">
                <div class="card-body text-center d-flex flex-column">
                    <h5 class="card-title">
                        Manage Products
                    </h5>
                    <p class="card-text">Manage products in your shop.</p>
                    <a class="btn btn-outline-primary mt-auto" href="{{ route('products.index') }}">
                        Go to Manage Products
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="card shadow-sm h-100">
                <div class="card-body text-center d-flex flex-column">
                    <h5 class="card-title">
                        Manage Categories
                    </h5>
                    <p class="card-text">Manage product categories.</p>
                    <a class="btn btn-outline-primary mt-auto" href="{{ route('categories.index') }}">
                        Go to Manage Categories
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="card shadow-sm h-100">
                <div class="card-body text-center d-flex flex-column">
                    <h5 class="card-title">
                        Manage Orders
                    </h5>
                    <p class="card-text">
                        Manage customer orders.
                    </p>
                    <a class="btn btn-outline-primary mt-auto" href="{{ route('orders.index') }}">
                        Go to Manage Orders
                    </a>
                </div>
            </div>
        </div>

    </div>
@endsection