@extends('layouts.master')

@section('title', 'Trang chủ')

@section('aside_content')
    <li class="nav-item">
        <a href="{{route('user_timesheet')}}" class="nav-link @yield('active_user_timesheet')">
            Chấm công hành chính
        </a>
    </li>
    <li class="nav-item ">
        <a href="{{route('user_overtime')}}" class="nav-link @yield('active_user_overtime')">
            Chấm công làm đêm
        </a>
    </li>
    <li class="nav-item ">
        <a href="{{ route('user_edit') }}" class="nav-link @yield('active_user')">
            Thông tin cá nhân
        </a>
    </li>
@endsection
