<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Thêm User</title>
</head>
<body>

    <h2>Thêm User</h2>

    <form action="{{ route('users.store') }}" method="POST">
        @csrf

        <div>
            <label>Tên</label><br>
            <input type="text" name="name">
        </div>

        <br>

        <div>
            <label>Email</label><br>
            <input type="email" name="email">
        </div>

        <br>

        <div>
            <label>Mật khẩu</label><br>
            <input type="password" name="password">
        </div>

        <br>

        <button type="submit">Lưu</button>

    </form>

    <br>

    <a href="{{ route('users.index') }}">Quay lại danh sách</a>

</body>
</html>
