@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h5>Edit Product</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data">

                    @csrf
                    @method('PUT')
                    <div class="row g-2">
                        <div class="col-md-6">
                            <label for="name" class="form-label">Name</label>
                            <input class="form-control" type="text" name="name" id="name"
                                value="{{ old('name', $product->name) }}">
                        </div>


                        <div class="col-md-6">
                            <label for="category" class="form-label">Category</label>
                            <select class="form-select" name="category_id" id="category">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">

                                        {{ $category->name }}

                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="price" class="form-label">Price</label>
                            <input class="form-control" type="number" name="price" id="price"
                                value="{{ old('price', $product->price) }}" step="any">
                        </div>

                        <div class="col-md-6">
                            <label for="description" class="form-label"></label>Description
                            <textarea rows="5" cols="50" class="form-control" name="description" id="description">{{ old('description', $product->description) }}</textarea>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="image" class="form-label">Image</label>
                            <input class="form-control" type="file" name="image" id="image">
                        </div>
                    </div>
                    <button class="btn btn-primary" style="width: 100px; display: block;">Update</button>
                </form>
            </div>
        </div>
        <a href="{{ route('products.index') }}" class="btn btn-outline-secondary mt-2">Back</a>
    </div>
@endsection
