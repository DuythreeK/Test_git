@extends('layouts.app')

@section('content')
    <h2>Category</h2>
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

    <a href="{{ route('categories.create') }}">
        Create
    </a>

    <table border="1">

        <tr>

            <th>ID</th>

            <th>Name</th>

            <th>Action</th>


        </tr>

        @foreach ($categories as $category)
            <tr>

                <td>{{ $category->id }}</td>

                <td>{{ $category->name }}</td>

                <td>

                    <a href="{{ route('categories.edit', $category) }}">
                        Edit

                    </a>
                    <form action="{{ route('categories.destroy', $category) }}" method="POST" style="display:inline"
                        onsubmit="return confirm('Are you sure you want to delete this category?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>

                </td>

            </tr>
        @endforeach

    </table>
    {{ $categories->links() }}
@endsection
