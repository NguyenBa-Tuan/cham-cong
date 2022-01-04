<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ env('APP_NAME') }} | Đăng nhập</title>
    <link rel="stylesheet" href="{{ asset('css/OverlayScrollbars.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
    @stack('styles')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>

<body>
    <div class="login-bg">
        <div>
            <h1>
                Anothemes
                <span class="login-span">-</span>
                Hệ thống chấm công
            </h1>
            <form action="{{ route('login_check') }}" method="POST" class="login-form">
                @csrf
                <h2>Đăng nhập</h2>
                <div class="login-field">
                    @if ($errors->any())
                        <div class="alert alert-danger alert-block">
                            <ul style="margin: 0; list-style-type: none; padding: 0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (session()->has('alert'))
                        <div class="alert alert-danger alert-block">
                            {{ session()->get('alert') }}
                        </div>
                    @endif
                </div>
                <div class="login-field">
                    <label for="username" class="login-label">Username</label>
                    <input id="username" placeholder="Vui lòng nhập tên tài khoản hoặc email" class="login-input"
                        type="email" name="email">
                </div>
                <div class="login-field">
                    <label for="password" class="login-label">Mật khẩu</label>
                    <input id="password" placeholder="●●●●●●●●" class="login-input" type="password" name="password">
                </div>
                <button type="submit" class="login-btn">Đăng nhập</button>
            </form>



        </div>
    </div>
</body>

</html>
