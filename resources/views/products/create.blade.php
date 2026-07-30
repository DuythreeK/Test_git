@extends('layouts.app')

@section('content')
    <h2>Create Product</h2>

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">

        @csrf

        <p>

            Name

            <input type="text" name="name" value="{{ old('name') }}">

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
            <input type="number" step="any" name="price">
        </p>

        <p>
            Stock
            <input type="number" name="stock">
        </p>

        <p>
            Description
            <textarea name="description"></textarea>
        </p>

        <p>
            Image
            <input type="file" name="image">
        </p>

        <button>Create</button>

    </form>
@endsection
