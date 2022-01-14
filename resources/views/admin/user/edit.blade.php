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
<form action="{{ route('admin.user.destroy', $user->id) }}" class="frmDelete" method="POST">
    @csrf
    <input type="hidden" value="DELETE" name="_method">
</form>
<form action="{{ route('admin.user.update', $user->id) }}" method="POST">
    @csrf
    <input type="hidden" value="PUT" name="_method">
    <input type="hidden" value="{{ $user->id }}" name="id">
    <div class="content-user">
        <div class="content-group content-group-button">
            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
            @endif
        </div>
        <div>
            <div class="float-left">
                <span style="color:#FF0000;font-size: 16px; ">
                    ※ Chỉnh sửa thông tin
                </span>
            </div>
            <div class="float-right d-delete">
                <button class="btn btn-primary btn-delete" type="button">Xóa tài khoản</button>
            </div>
        </div>
        <div style="clear: both"></div>
        <div class="content-group">
            <div class="default-width">
                <label for="">ID</label>
                <input type="text" name="user_id" value="{{ $user->user_id }}" class="form-control">
                @error('user_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="space-content"></div>
            <div class="default-width">
                <label for="">Số điện thoại</label>
                <input type="text" name="phone" value="{{ $user->phone }}" class="form-control">
            </div>
        </div>
        <div class="content-group">
            <div class="default-width">
                <div>
                    <label class="tk-label" for="username">Username</label>
                    <input class="form-control" type="text" placeholder="" id="username" name="username"
                        value="{{ $user->username }}">
                    @error('username')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mt-30">
                    <label class="tk-label" for="email">Email</label>
                    <input class="form-control" type="email" placeholder="" id="email" name="email"
                        value="{{ $user->email }}">
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
                    name="address">{{ $user->address }}</textarea>
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
                        value="{{ $user->dayOfBirth }}">
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
                        value="{{ $user->dayOfJoin }}">
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
                    value="{{ $user->name }}">
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
                            <option value="{{ $key }}" {{ $user->level == $key ? 'selected' : '' }}>
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
            <button class="tk-btn admin-btn" type="submit">Cập nhật</button>
        </div>

    </div>
</form>
@push('scripts')
    <script>
        $('.btn-delete').click(() => {
            if (confirm('Dữ liệu xóa sẽ không thể khôi phục ?')) {
                $('.frmDelete').submit();
            }
        });
    </script>
@endpush
