<!DOCTYPE html>

<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="card shadow-sm" style="width: 450px;">
            <div class="card-header text-center bg-dark text-white">
                <h2>Đăng nhập</h2>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-sucess">{{ session('success') }}</div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">{{ $errors->first() }}</div>
                @endif
                <form action="{{ route('login.post') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input class="form-control" placeholder="Nhập email" type="email" name="email" id="email"
                            value="{{ old('email') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input class="form-control" placeholder="Nhập password" type="password" name="password"
                            required>
                    </div>
                    <div class="d-grid mb-3">
                        <button class="btn btn-dark" type="submit">
                            Đăng nhập
                        </button>
                    </div>


                </form>

                <div class="text-center">
                    Chưa có tài khoản?

                    <a href="{{ route('register') }}">
                        Đăng ký
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>