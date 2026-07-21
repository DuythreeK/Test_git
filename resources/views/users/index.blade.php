<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Danh sách User</title>
</head>
<body>

    <h1>Danh sách User</h1>

    <table border="1" cellpadding="10">
        <tr>
            <th>ID</th>
            <th>Tên</th>
            <th>Email</th>
        </tr>

        @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
            </tr>
        @endforeach
    </table>
    <a href="{{ route('users.create') }}">
        <button>
            Tao moi
        </button>
    </a>
    {{ $users -> links() }}



</body>
</html>
