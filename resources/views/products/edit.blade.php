@extends('layouts.app')

@section('content')
    <h2>Edit Product</h2>

    <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <p>

            Name

            <input type="text" name="name" value="{{ old('name', $product->name) }}">

        </p>

        <p>

            Category
            <select name="category_id">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">

                        {{ $category->name }}

                    </option>
                @endforeach
            </select>
        </p>

        <p>
            Price
            <input type="number" name="price" value="{{ old('price', $product->price) }}" step="any">
        </p>

        <p>
            Stock
            <input type="number" name="stock" value="{{ old('stock', $product->stock) }}">
        </p>

        <p>
            Description
            <textarea name="description">{{ old('description', $product->description) }}</textarea>
        </p>

        <p>
            Image
            <input type="file" name="image">
        </p>

        <button>Update</button>

    </form>
@endsection
