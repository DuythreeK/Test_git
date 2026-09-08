@extends('customer.layouts.app')

@section('title', 'Product Detail')
@section('style')
    <style>
        #tbl tr th {
            background-color: black;
            color: white;
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

                        <th>Description</th>

                        <td>{{ $product->description }}</td>

                    </tr>
                    @if ($product->image)
                        <tr>
                            <th>Image</th>
                            <td><img src="{{ asset('storage/' . $product->image) }}" class="img-fuild w-50"></td>
                        </tr>
                    @endif

                </table>
                <br>
                @if ($product->variants->count() > 0)
                    <form action="{{ route('customer.cart.store') }}" method='POST'>
                        @csrf
                        {{-- Size --}}
                        <div class="mb-3">
                            <label class="form-label">
                                <strong>Size</strong>
                            </label>
                            <div class="d-flex gap-2 flex-wrap">
                                @foreach ($product->variants as $variant)
                                    <input type="radio" class="btn-check" name="product_variant_id"
                                        id="size-{{ $variant->id }}" value="{{ $variant->id }}"
                                        {{ $variant->stock <= 0 ? 'disabled' : '' }} autocomplete="off">
                                    <label class="btn btn-outline-primary size-option" for="size-{{ $variant->id }}">
                                        Size {{ $variant->size->name }}
                                        @if ($variant->stock <= 0)
                                            <small class="d-block"> Out of stock </small>
                                        @else
                                            <small class="d-block"> Stock: {{ $variant->stock }} </small>
                                        @endif
                                    </label>
                                @endforeach
                            </div>
                        </div>
                        <div class="d-flex mb-3 align-content-center">
                            <label class="me-3">Quantity</label>
                            <input class="form-control" type="number" name="quantity" value="1" min="1"
                                style="width: 100px">
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
