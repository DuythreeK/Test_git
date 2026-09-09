@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card shadow-sm">
            <div class="card-header">
                <h2>Create Category</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">

                    @csrf

                    <div class="mb-2">

                        <label for="name" class="form-label">Name</label>

                        <input class="form-control" type="text" name="name" id="name"
                            value="{{ old('name') }}">

                    </div>

                    <div class="mb-2">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" name="description" id="description"></textarea>
                    </div>
                    <button class="btn btn-primary">Create</button>

                </form>
            </div>
        </div>
        <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary mt-2">Back</a>
    </div>
@endsection
