@extends('layouts.app')

@section('content')

    <div class="container-fluid mt-4">

        <div class="card shadow-sm">

            <div class="card-header">
                <h2 class="mb-0">Create Product</h2>
            </div>

            <div class="card-body">

                {{-- Success message --}}
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- Error message --}}
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                {{-- Validation errors --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">

                    @csrf

                    <div class="row g-3">

                        {{-- Name --}}
                        <div class="col-md-6">
                            <label for="name" class="form-label fw-bold">
                                Name
                            </label>

                            <input type="text" name="name" id="name" class="form-control"
                                value="{{ old('name') }}" placeholder="Enter product name">
                        </div>

                        {{-- Category --}}
                        <div class="col-md-6">
                            <label for="category_id" class="form-label fw-bold">
                                Category
                            </label>

                            <select name="category_id" id="category_id" class="form-select">
                                <option value="">-- Select Category --</option>

                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Price --}}
                        <div class="col-md-6">
                            <label for="price" class="form-label fw-bold">
                                Price
                            </label>

                            <input type="number" step="any" name="price" id="price" class="form-control"
                                value="{{ old('price') }}" placeholder="Enter price">
                        </div>

                        {{-- Description --}}
                        <div class="col-12">
                            <label for="description" class="form-label fw-bold">
                                Description
                            </label>

                            <textarea name="description" id="description" class="form-control" rows="4"
                                placeholder="Enter product description">{{ old('description') }}</textarea>
                        </div>

                        {{-- Image --}}
                        <div class="col-12">
                            <label for="image" class="form-label fw-bold">
                                Image
                            </label>

                            <input type="file" name="image" id="image" class="form-control">
                        </div>

                    </div>

                    {{-- Buttons --}}
                    <div class="mt-4 d-flex gap-2">

                        <button type="submit" class="btn btn-primary">
                            Create
                        </button>

                        <a href="{{ route('products.index') }}" class="btn btn-secondary">
                            Cancel
                        </a>

                    </div>

                </form>

            </div>

        </div>

    </div>

@endsection
