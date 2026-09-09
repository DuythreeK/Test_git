@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="text-center">
            <h2>Dashboard</h2>
            <p>Overview of your shop</p>
        </div>
        <div class="row g-4 mb-5"> <!-- Total Products -->
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h6 class="text-muted">Total Products</h6>
                        <h3 class="fw-bold mb-0"> {{ $totalProducts }} </h3>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h6 class="text-muted">Total Category</h6>
                        <h3 class="fw-bold">{{ $totalCategories }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h6 class="text-muted">Total User</h6>
                        <h3 class="fw-bold">{{ $totalUsers }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h6 class="text-muted">Total Order</h6>
                        <h3 class="fw-bold">{{ $totalOrders }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h6 class="text-muted">Total Revenue</h6>
                        <h3 class="fw-bold">{{ number_format($totalRevenue, 2) }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h6 class="text-muted">Total Inventory Value</h6>
                        <h3 class="fw-bold">{{ number_format($totalInventoryValue, 2) }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-5">
            <div class="card-header">
                <h5>5 Sản phẩm đắt nhất</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-striped align-middle mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Stock</th>
                                <th>Order Items Count</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($topExpensiveProducts as $product)
                                <tr>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ number_format($product->price, 2) }}</td>
                                    <td>{{ $product->variants->sum('stock') }}</td>
                                    <td>{{ $product->order_items_count }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card mb-5">
            <div class="card-header">
                <h5>5 Sản phẩm bán chạy nhất</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th>Name</th>
                                <th>Sold Quantity</th>
                                <th>Price</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($topSellingProducts as $item)
                                <tr>
                                    <td>{{ $item->variant->product ? $item->variant->product->name : '' }}</td>
                                    <td>{{ $item->total_sold }}</td>
                                    <td>{{ number_format($item->variant->product ? $item->variant->product->price : 0, 2) }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5>5 Sản phẩm tồn kho nhiều nhất</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>Name</th>
                                <th>Stock</th>
                                <th>Price</th>
                            </tr>
                        <tbody>
                            @foreach ($topStockProducts as $product)
                                <tr>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->variants_sum_stock }}</td>
                                    <td>{{ number_format($product->price, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
