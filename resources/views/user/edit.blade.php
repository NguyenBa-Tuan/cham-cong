@extends('user.app')
@section('header_content', 'Thông tin cá nhân')
@section('title', 'Thông tin cá nhân')
@section('active_user', 'active')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/style.css')}}">
    <link rel="stylesheet" href="{{ asset('css/atomic.css')}}">
    <link rel="stylesheet" href="{{ asset('css/custom-bootstrap4.css')}}">
    <!--ico font -->
    <link rel="stylesheet" href="{{ asset('lib/icofont.min.css')}}">
@endpush

@section('content')
    <div class="tk-pt-41">
        <div class="tk-px-30">
            <div class="tk-content">
                <form action="{{route('user_update')}}" method="POST" style="width: 337px">
                    @if ($errors->any())
                        <div class="alert alert-danger alert-block">
                            <ul style="margin: 0; list-style-type: none; padding: 0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @csrf
                    <div class="form-group">
                        <label for="name" class="tk-label">Họ tên</label>
                        <input type="text" class="form-control" id="name" placeholder="Họ tên" name="name"
                               value="{{$user->name}}">
                    </div>

                    <div class="form-group">
                        <label for="phone" class="tk-label">Số điện thoại</label>
                        <input type="text" class="form-control" id="phone" placeholder="Số điện thoại" name="phone"
                               value="{{$user->phone}}">
                    </div>

                    <div class="form-group">
                        <label for="address" class="tk-label">Địa chỉ</label>
                        <textarea type="text" class="form-control" id="address" placeholder="Nhập địa chỉ"
                                  name="address"
                                  rows="4">{{$user->address}}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="dayOfBirth" class="tk-label">Ngày sinh</label>
                        <div class="relative">
                            <input type="date" class="form-control" id="dayOfBirth" name="dayOfBirth"
                                   value="{{$user->dayOfBirth}}">
                            <div class="tk-icon">
                                <i class="icofont-clock-time"></i>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="dayOfJoin" class="tk-label">Ngày vào công ty</label>
                        <div class="relative">
                            <input type="date" class="form-control" id="dayOfJoin" name="dayOfJoin"
                                   value="{{$user->dayOfJoin}}">
                            <div class="tk-icon">
                                <i class="icofont-calendar"></i>
                            </div>
                        </div>
                    </div>

                    <div class="form-group" id="select-level">
                        <label for="level" class="tk-label">Chức vụ</label>
                        <div class="relative">
                            <select class="form-control" id="level" name="level">
                                <option selected
                                        value="{{$user->level}}">{{\App\Enums\UserLevel::getDescription($user->level)}}</option>
                                @foreach($levels as $key=>$level)
                                    <option value="{{$key}}">{{$level}}</option>
                                @endforeach
                            </select>
                            <div class="tk-icon">
                                <i class="icofont-caret-down"></i>
                            </div>
                        </div>
                    </div>
                    <button class="btn tk-btn" type="submit">Xong</button>
                </form>
            </div>
        </div>
    </div>
@endsection
