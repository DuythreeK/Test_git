@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="text-center">
            <h2>Category</h2>
        </div>
        @if (session('error'))
            <div style="color: red;">
                {{ session('error') }}
            </div>
        @endif

        @if (session('success'))
            <div style="color: green;">
                {{ session('success') }}
            </div>
        @endif

        <a class="btn btn-outline-primary" href="{{ route('categories.create') }}">
            Create
        </a>

        <div class="card">
            <div class="body text-center">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($categories as $category)
                                <tr>

                                    <td>{{ $category->id }}</td>

                                    <td>{{ $category->name }}</td>

                                    <td>

                                        <a class="btn btn-success" href="{{ route('categories.edit', $category) }}">
                                            Edit

                                        </a>
                                        <form action="{{ route('categories.destroy', $category) }}" method="POST"
                                            style="display:inline"
                                            onsubmit="return confirm('Are you sure you want to delete this category?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger" type="submit">Delete</button>
                                        </form>

                                    </td>

                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center mt-4">
            {{ $categories->links() }}
        </div>
    </div>
@endsection
