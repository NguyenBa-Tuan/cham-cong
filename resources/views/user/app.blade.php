@extends('layouts.master')

@section('title', 'Trang chủ')

@section('aside_content')
    <li class="nav-item">
        <a href="{{route('user_timesheet')}}" class="nav-link @yield('active_user_timesheet')">
            <p>Chấm công hành chính</p>
        </a>
    </li>
    <li class="nav-item ">
        <a href="{{route('user_overtime')}}" class="nav-link @yield('active_user_overtime')">
            <p>Chấm công làm đêm</p>
        </a>
    </li>
    <li class="nav-item ">
        <a href="{{ route('user_edit') }}" class="nav-link @yield('active_user')">
            <p>Thông tin cá nhân</p>
        </a>
    </li>
@endsection
