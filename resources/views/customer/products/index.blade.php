@extends('customer.layouts.app')

@section('title', 'Products')

@section('content')
    <div class="container">
        <div class="card shadow-sm mb-4">
            <div class="card-header">
                <h5>
                    Filter Products
                </h5>
            </div>
            <div class="card-body">
                <form method="GET" action="{{ route('customer.products.index') }}">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="search" class="form-label">Search</label>
                            <input class="form-control" type="text" name="search" id="search" value="{{ request('search') }}">
                        </div>
                        <div class="col-md-6">
                            <label for="category" class="form-label">Category</label>

                            <select class="form-select" name="category" id="category">

                                <option value="">All</option>

                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ request('category') == $category->id ? 'selected' : '' }}>

                                        {{ $category->name }}

                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="min_price" class="form-label">Min Price</label>
                            <input class="form-control" type="number" name="min_price" id="min_price" value="{{ request('min_price') }}">
                        </div>


                        <div class="col-md-6">
                            <label for="max_price" class="form-label" >Max Price</label>
                            <input class="form-control" type="number" name="max_price" id="max_price" value="{{ request('max_price') }}">
                        </div>

                        <div class="col-md-6">
                            <label for="sort" class="form-label" >Sort</label>
                            <select class="form-select" name="sort" id="sort">
                                <option value="">Default</option>
                                <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>
                                    Price Low -> High
                                </option>
                                <option value="desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>
                                    Price High -> Low
                                </option>
                            </select>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-outline-primary mt-4">

                        Filter

                    </button>

                </form>
            </div>
        </div>
        <div class="card shadow-sm mb-4">
            <div class="card-header">
                <h5>Product List</h5>
            </div>
            <div class="card-body">
                <div class="row g-4">
                    @forelse($products as $product)
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                            <div class="card h-100 shadow-sm">
                                <img class="card-img-top" src="{{ asset('storage/' . $product->image) }}" alt="Product image"
                                    style="height: 200px; object-fit: contain;">

                                <div class="card-body bg-light">
                                    <h4 class="card-title">
                                        {{ $product->name }}
                                    </h4>

                                    <p class="card-text">
                                        <strong>Category:</strong>
                                        {{ $product->category->name }}
                                    </p>

                                    <p class="card-text">
                                        <strong>Price:</strong>
                                        <span style="color: goldenrod;">{{ number_format($product->price) }} VNĐ</span>
                                    </p>

                                    <p class="card-text">
                                        <strong>Stock:</strong>
                                        {{ $product->stock }}
                                    </p>

                                    <a href="{{ route('customer.products.show', $product) }}" class="btn btn-primary">
                                        Detail
                                    </a>



                                </div>

                            </div>

                        </div>



                    @empty

                        <div class="col-12">
                            <div class="alert alert-info">
                                No products
                            </div>
                        </div>
                    @endforelse

                </div>
            </div>
            <div class="d-flex justify-content-center mt-4">
                {{ $products->appends(request()->query())->links() }}
            </div>

        </div>
    </div>
@endsection
