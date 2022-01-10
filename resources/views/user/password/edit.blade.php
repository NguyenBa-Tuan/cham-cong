<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ env('APP_NAME') }} | Đổi mật khẩu</title>
    <link rel="stylesheet" href="{{ asset('css/OverlayScrollbars.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
    <!-- @stack('styles') -->
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
            <form action="{{route('reset_password_update', $user->id)}}" method="POST" class="login-form">
                @csrf
                <h2>Đổi mật khẩu</h2>
                <div class="login-field">
                    @if (session()->has('warning'))
                    <div class="alert alert-danger alert-block">
                        {{ session()->get('warning') }}
                    </div>
                    @endif
                </div>
                <div class="login-field">
                    <label for="password" class="login-label">Password</label>
                    <input id="password" placeholder="●●●●●●●●" class="login-input" type="password" name="password">
                    @error('password')
                    <div class="rp-error">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="login-field">
                    <label for="password" class="login-label">Confirm password</label>
                    <input id="password" placeholder="●●●●●●●●" class="login-input" type="password" name="password_confirmation">
                    @error('password_confirmation')
                    <div class="rp-error">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <button type="submit" class="login-btn">Thay đổi mật khẩu</button>
            </form>
        </div>
    </div>
</body>

</html>