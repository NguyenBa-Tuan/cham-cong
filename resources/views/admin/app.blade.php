@extends('layouts.master')

@section('title', 'Trang chủ')

@section('aside_content')
    <li class="nav-item">
        <a href="{{route('time_keeping_index')}}" class="nav-link @yield('active_time_keeping')">
            <p>Chấm công hành chính</p>
        </a>
    </li>
    <li class="nav-item ">
        <a href="{{route('overtime_index')}}" class="nav-link @yield('active_overtime')">
            <p>Chấm công làm đêm</p>
        </a>
    </li>
    <li class="nav-item ">
        <a href="{{ route('adminUserIndex') }}" class="nav-link @yield('aside_user')">
            <p>Thông tin cá nhân</p>
        </a>
    </li>
    <li class="nav-item ">
        <a href="{{ route('admin.rule.index') }}" class="nav-link @yield('active_rule')">
            <p>Nội quy công ty</p>
        </a>
    </li>
@endsection
