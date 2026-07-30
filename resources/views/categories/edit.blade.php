@extends('layouts.app')

@section('content')
    <h2>Edit Category</h2>


    <form action="{{ route('categories.update', $category) }}" method="POST">
        @csrf
        @method('PUT')

        <p>
            Name
            <input type="text" name="name" value="{{ old('name', $category->name) }}">
        </p>

        <p>
            Description
            <textarea name="description">{{ old('description', $category->description) }}</textarea>
        </p>

        <button type="submit">Update</button>

        <a href="{{ route('categories.index') }}">
            Cancel
        </a>
    </form>
@endsection
