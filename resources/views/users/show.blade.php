<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Thong tin User</title>
</head>
<body>

    <h1>Thong tin User</h1>

    <table border="1" cellpadding="10">
        <tr>
            <th>ID</th>
            <th>Tên</th>
            <th>Email</th>
        </tr>

        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>

        </tr>

    </table>

</body>
</html>
