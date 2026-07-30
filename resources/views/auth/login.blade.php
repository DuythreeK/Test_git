<h2>Đăng nhập</h2>

@if (session('success'))
    <p>{{ session('success') }}</p>
@endif

@if ($errors->any())
    <p>{{ $errors->first() }}</p>
@endif

<form action="{{ route('login.post') }}" method="POST">

    @csrf

    <p>Email</p>
    <input type="email" name="email" value="{{ old('email') }}">

    <p>Password</p>
    <input type="password" name="password">

    <br><br>

    <button type="submit">
        Đăng nhập
    </button>

</form>

<p>
    Chưa có tài khoản?

    <a href="{{ route('register') }}">
        Đăng ký
    </a>
</p>
