<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>Đăng ký</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="card shadow-sm" style="width: 450px">
            <div class="card-header text-center bg-dark text-white">
                <h2>Đăng ký</h2>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>

                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach

                        </ul>
                    </div>
                @endif

                <form action="{{ route('register.post') }}" method="POST">

                    @csrf
                    <div class="mb-3">
                        <label class="form-label" for="name">Họ tên</label>
                        <input class="form-control" placeholder="Nhập họ tên" type="text" name="name" id="name"
                            value="{{ old('name') }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="email">Email</label>
                        <input class="form-control" placeholder="Nhập email" type="email" name="email" id="email"
                            value="{{ old('email') }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="password">Mật khẩu</label>
                        <input class="form-control" placeholder="Nhập mật khẩu" type="password" name="password"
                            id="password" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="password_confirmation">Nhập lại mật khẩu</label>
                        <input class="form-control" placeholder="Nhập lại mật khẩu" type="password"
                            name="password_confirmation" id="password_confirmation" required>
                    </div>
                    <div class="d-grid mb-3">
                        <button class="btn btn-dark" type="submit">
                            Đăng ký
                        </button>
                    </div>
                </form>
                <div class="grid text-center">
                    <p>
                        Đã có tài khoản?

                        <a href="{{ route('login') }}">
                            Đăng nhập
                        </a>

                    </p>
                </div>

            </div>
        </div>
    </div>
</body>

</html>