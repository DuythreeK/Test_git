@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="mb-4">
            <h2>Add New Size</h2>
        </div>

        <div class="card col-md-6">
            <div class="card-body">
                <form action="{{ route('sizes.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Size Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="e.g. S, M, L, XL, 39, 40..." required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-success">Save</button>
                        <a href="{{ route('sizes.index') }}" class="btn btn-secondary">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
