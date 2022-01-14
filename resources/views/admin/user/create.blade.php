@push('styles')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/atomic.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom-bootstrap4.css') }}">
    <!--ico font -->
    <link rel="stylesheet" href="{{ asset('lib/icofont.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/user.css') }}">
    <style>


    </style>
@endpush
<form action="{{ route('adminUserStore') }}" method="POST">
    @csrf
    <div class="content-user">
        <div class="content-group content-group-button">
            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
            @endif
        </div>
        
        <div class="content-group">
            <div class="default-width">
                <label for="">ID</label>
                <input type="text" name="user_id" value="{{ old('user_id') }}" class="form-control">
                @error('user_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="space-content"></div>
            <div class="default-width">
                <label for="">Số điện thoại</label>
                <input type="text" name="phone" value="{{ old('phone') }}" class="form-control">
            </div>
        </div>
        <div class="content-group">
            <div class="default-width">
                <div>
                    <label class="tk-label" for="username">Username</label>
                    <input class="form-control" type="text" placeholder="" id="username" name="username"
                        value="{{ old('username') }}">
                    @error('username')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mt-30">
                    <label class="tk-label" for="email">Email</label>
                    <input class="form-control" type="email" placeholder="" id="email" name="email"
                        value="{{ old('email') }}">
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

            </div>
            <div class="space-content"></div>
            <div class="default-width">
                <label class="tk-label" for="address">Địa chỉ</label>
                <textarea class="form-control" placeholder="Nhập địa chỉ" id="address"
                    name="address">{{ old('address') }}</textarea>
            </div>
        </div>
        <div class="content-group">
            <div class="default-width">
                <label class="tk-label" for="password">Mật khẩu</label>
                <input class="form-control" type="password" placeholder="●●●●●●●●" id="password" name="password">
                @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="space-content"></div>
            <div class="default-width">
                <label class="tk-label" for="password_confirmation">Nhập lại mật khẩu</label>
                <input class="form-control" type="password" placeholder="●●●●●●●●" name="password_confirmation">
                @error('password_confirmation')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
           
        </div>
        <div class="content-group">
            <div class="default-width">
                <label class="tk-label" for="dayOfBirth">Ngày sinh</label>
                <div class="relative">
                    <input class="form-control" type="date" placeholder="" id="dayOfBirth" name="dayOfBirth"
                        value="{{ old('dayOfBirth') }}">
                    <div class="tk-icon">
                        <i class="icofont-clock-time"></i>
                    </div>
                </div>
            </div>
            <div class="space-content"></div>
            <div class="default-width">
                <label class="tk-label" for="dayOfJoin">Ngày vào công ty</label>
                <div class="relative">
                    <input class="form-control" type="date" placeholder="" id="dayOfJoin" name="dayOfJoin"
                        value="{{ old('dayOfJoin') }}">
                    <div class="tk-icon">
                        <i class="icofont-calendar"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-group">
            <div class="default-width">
                <label class="tk-label" for="name">Họ tên</label>
                <input class="form-control" type="text" placeholder="" id="name" name="name"
                    value="{{ old('name') }}">
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            </div>
            <div class="space-content"></div>
            <div class="default-width">
                <label class="tk-label" for="level">Chức vụ</label>
                <div class="relative">
                    <select class="form-control" id="level" name="level">
                        @foreach ($levels as $key => $level)
                            <option value="{{ $key }}" {{ old('name') == $key ? 'selected' : '' }}>
                                {{ $level }}</option>
                        @endforeach
                    </select>
                    <div class="tk-icon">
                        <i class="icofont-caret-down"></i>
                    </div>
                </div>
                @error('level')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="content-group content-group-button text-center">
            <button class="tk-btn admin-btn" type="submit">Đăng ký</button>
        </div>

    </div>
</form>
