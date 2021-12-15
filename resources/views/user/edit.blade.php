@extends('layouts.master')
@section('header_content', 'Thông tin cá nhân')
@section('content')
    <div class="tab-content">
        <div class="row">
            <div class="col-md-3">
                <form action="{{route('user_update')}}" method="POST">
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
                        <input type="text" class="form-control" id="name" placeholder="Name" name="name"
                               value="{{$user->name}}">
                    </div>

                    <div class="form-group">
                        <label for="phone" class="tk-label">Số điện thoại</label>
                        <input type="text" class="form-control" id="phone" placeholder="phone" name="phone"
                               value="{{$user->phone}}">
                    </div>

                    <div class="form-group">
                        <label for="address" class="tk-label">Địa chỉ</label>
                        <textarea type="text" class="form-control" id="address" placeholder="Address" name="address"
                                  rows="4">{{$user->address}}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="dayOfBirth" class="tk-label">Ngày sinh</label>
                        <input type="date" class="form-control" id="dayOfBirth" placeholder="Day of Birth"
                               name="dayOfBirth" value="{{$user->dayOfBirth}}">
                    </div>

                    <div class="form-group">
                        <label for="dayOfJoin" class="tk-label">Ngày vào công ty</label>
                        <input type="date" class="form-control" id="dayOfJoin" placeholder="password" name="dayOfJoin"
                               value="{{$user->dayOfJoin}}">
                    </div>

                    <div class="form-group">
                        <label for="level" class="tk-label">Chức vụ</label>
                        <select class="form-control" id="level" name="level">
                            @foreach($levels as $key=>$level)
                                <option value="{{$key}}">{{$level}}</option>
                            @endforeach
                        </select>
                    </div>

                    <button class="btn tk-btn" type="submit">Xong</button>
                </form>
            </div>
        </div>
    </div>
@endsection
