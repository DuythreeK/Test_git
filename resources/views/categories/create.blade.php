@extends('layouts.app')

@section('content')
    <h2>Create Category</h2>

    <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">

        @csrf

        <p>

            Name

            <input type="text" name="name" value="{{ old('name') }}">

        </p>

        <p>
            Description
            <textarea name="description"></textarea>
        </p>
        <button>Create</button>

    </form>
@endsection
