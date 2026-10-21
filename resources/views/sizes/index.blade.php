@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Size Management</h2>
            <a class="btn btn-primary" href="{{ route('sizes.create') }}">
                + Add New Size
            </a>
        </div>

        <div class="card">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0">Size List</h5>
            </div>
            <div class="card-body text-center">
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Size Name</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($sizes as $size)
                                <tr>
                                    <td>{{ $size->id }}</td>
                                    <td><span>{{ $size->name }}</span></td>
                                    <td>{{ $size->created_at ? $size->created_at->format('d/m/Y H:i') : 'N/A' }}</td>
                                    <td>
                                        <a class="btn btn-sm btn-warning me-1" href="{{ route('sizes.edit', $size) }}">
                                            Edit
                                        </a>
                                        <form action="{{ route('sizes.destroy', $size) }}" method="POST"
                                            style="display:inline"
                                            onsubmit="return confirm('Are you sure you want to delete this size?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger" type="submit">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-muted">No sizes found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center mt-4">
            {{ $sizes->links() }}
        </div>
    </div>
@endsection
