@extends('layouts.master')

@section('title', 'Trang chủ')

@section('aside_content')
    <li class="nav-item">
        <a href="{{route('time_keeping_index')}}" class="nav-link @yield('active_time_keeping')">
            Chấm công hành chính
        </a>
    </li>
    <li class="nav-item ">
        <a href="{{route('overtime_index')}}" class="nav-link @yield('active_overtime')">
            Chấm công làm đêm
        </a>
    </li>
    <li class="nav-item ">
        <a href="{{ route('adminUserIndex') }}" class="nav-link @yield('aside_user')">
            Thông tin cá nhân
        </a>
    </li>
    
@endsection
