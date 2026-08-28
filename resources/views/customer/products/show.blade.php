@extends('customer.layouts.app')

@section('title', 'Product Detail')
@section('style')
    <style>
        #tbl tr th {
            background-color: #4188f3;
        }
    </style>
@endsection
@section('content')
    <div class="container">
        <div class="card shadow-sm">
            <div class="card-header">
                <h5>
                    Product Detail
                </h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped" id="tbl">
                    <tr>

                        <th>Name</th>

                        <td>{{ $product->name }}</td>

                    </tr>

                    <tr>

                        <th>Category</th>

                        <td>{{ $product->category->name }}</td>

                    </tr>

                    <tr>

                        <th>Price</th>

                        <td>{{ number_format($product->price) }}</td>

                    </tr>

                    <tr>

                        <th>Stock</th>

                        <td>{{ $product->stock }}</td>

                    </tr>

                    <tr>

                        <th>Description</th>

                        <td>{{ $product->description }}</td>

                    </tr>
                    @if ($product->image)
                        <tr>
                            <th>Image</th>
                            <td><img src = "{{ asset('storage/' . $product->image) }}" class="img-fuild w-50"></td>
                        </tr>
                    @endif

                </table>
                <br><br>
                @if ($product->stock > 0)
                    <form action="{{ route('customer.cart.store') }}" method = 'POST'>
                        @csrf
                        <div class="d-flex mb-3 align-content-center">
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <label class="me-3">Quantity</label>
                            <input class="form-control" type="number" name="quantity" value="1" min="1"
                                max="{{ $product->stock }}" style="width: 100px">
                        </div>
                        <button type="submit" class="btn btn-outline-success">
                            Add to Cart
                        </button>
                    </form>
                @else
                    <p><strong>Out of stock</strong></p>
                @endif


                <br>


            </div>
        </div>
        <a href="{{ route('customer.products.index') }}" class="btn btn-outline-secondary mt-2">

            Back

        </a>
    </div>

@endsection
