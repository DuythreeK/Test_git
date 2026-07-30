<h2>Đăng ký</h2>

@if ($errors->any())

    <ul>

        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach

    </ul>

@endif

<form action="{{ route('register.post') }}" method="POST">

    @csrf

    <p>Họ tên</p>

    <input type="text" name="name" value="{{ old('name') }}">

    <p>Email</p>

    <input type="email" name="email" value="{{ old('email') }}">

    <p>Mật khẩu</p>

    <input type="password" name="password">

    <p>Nhập lại mật khẩu</p>

    <input type="password" name="password_confirmation">

    <br><br>

    <button type="submit">

        Đăng ký

    </button>

</form>

<p>

    Đã có tài khoản?

    <a href="{{ route('login') }}">
        Đăng nhập
    </a>

</p>
