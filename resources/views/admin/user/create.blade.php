@push('styles')
    <link rel="stylesheet" href="{{ asset('css/style.css')}}">
    <link rel="stylesheet" href="{{ asset('css/atomic.css')}}">
    <link rel="stylesheet" href="{{ asset('css/custom-bootstrap4.css')}}">
    <!--ico font -->
    <link rel="stylesheet" href="{{ asset('lib/icofont.min.css')}}">
    <style>
        .form-control {
            padding: 12px 15px 11px;
            height: -webkit-fill-available !important;
        }

        .form-control:focus {
            outline: none;
            box-shadow: none;
            border: 1px solid #ced4da;
        }

        .admin-btn {
            border: 1px solid #3B89CF;
            width: 337px;
            margin: 20px 0 0 170px;
        }
    </style>
@endpush
<div class="tk-content">
    <div class="row">
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
        <div class="col-md-6">
            @if ($errors->any())
                <div class="alert alert-danger alert-block">
                    <ul style="margin: 0; list-style-type: none; padding: 0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{route('adminUserStore')}}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6 pr-130">
                        <div class="form-group">
                            <label class="tk-label" for="email">Email</label>
                            <input class="form-control" type="email" placeholder="" id="email" name="email">
                        </div>
                        <div class="form-group">
                            <label class="tk-label" for="password">Mật khẩu</label>
                            <input class="form-control" type="password" placeholder="●●●●●●●●" id="password"
                                   name="password">
                        </div>
                        <div class="form-group">
                            <label class="tk-label" for="password_confirmation">Nhập lại mật khẩu</label>
                            <input class="form-control" type="password" placeholder="●●●●●●●●"
                                   name="password_confirmation">
                        </div>
                        <div class="form-group">
                            <label class="tk-label" for="name">Họ tên</label>
                            <input class="form-control" type="text" placeholder="" id="name" name="name">
                        </div>
                        <div class="form-group">
                            <label class="tk-label" for="phone">Số điện thoại</label>
                            <input class="form-control" type="text" placeholder="" id="phone" name="phone">
                        </div>
                    </div>
                    <div class="col-md-6 pr-130">
                        <div class="form-group">
                            <label class="tk-label" for="address">Địa chỉ</label>
                            <textarea class="form-control" placeholder="Nhập địa chỉ" rows="5" id="address"
                                      name="address"></textarea>
                        </div>
                        <div class="form-group">
                            <label class="tk-label" for="dateOfBirth">Ngày sinh</label>
                            <div class="relative">
                                <input class="form-control" type="date" placeholder="" id="dateOfBirth"
                                       name="dateOfBirth">
                                <div class="tk-icon">
                                    <i class="icofont-clock-time"></i>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="tk-label" for="dateOfjoin">Ngày vào công ty</label>
                            <div class="relative">
                                <input class="form-control" type="date" placeholder="" id="dateOfjoin"
                                       name="dateOfjoin">
                                <div class="tk-icon">
                                    <i class="icofont-calendar"></i>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="tk-label" for="level">Chức vụ</label>
                            <div class="relative">
                                <select class="form-control" id="level" name="level">
                                    @foreach($levels as $key=>$level)
                                        <option value="{{$key}}">{{$level}}</option>
                                    @endforeach
                                </select>
                                <div class="tk-icon">
                                    <i class="icofont-caret-down"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="tk-btn admin-btn" type="submit">Đăng ký</button>
                </div>
            </form>
        </div>
    </div>
</div>
