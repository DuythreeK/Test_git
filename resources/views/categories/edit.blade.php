@extends('layouts.app')

@section('content')

    <div class="container mt-4">

        <div class="card shadow-sm">

            <div class="card-header">
                <h2 class="mb-0">Edit Category</h2>
            </div>

            <div class="card-body">

                {{-- Validation error --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form action="{{ route('categories.update', $category) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- Name --}}
                    <div class="mb-3">
                        <label for="name" class="form-label fw-bold">
                            Name
                        </label>

                        <input type="text" name="name" id="name" class="form-control"
                            value="{{ old('name', $category->name) }}" placeholder="Enter category name">
                    </div>

                    {{-- Description --}}
                    <div class="mb-3">
                        <label for="description" class="form-label fw-bold">
                            Description
                        </label>

                        <textarea name="description" id="description" class="form-control" rows="4"
                            placeholder="Enter description">{{ old('description', $category->description) }}</textarea>
                    </div>

                    {{-- Buttons --}}
                    <div class="d-flex gap-2">

                        <button type="submit" class="btn btn-primary">
                            Update
                        </button>

                        <a href="{{ route('categories.index') }}" class="btn btn-secondary">
                            Cancel
                        </a>

                    </div>

                </form>

            </div>

        </div>

    </div>

@endsection