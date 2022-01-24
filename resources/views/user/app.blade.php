@extends('layouts.master')

@section('title', 'Trang chủ')

@section('aside_content')
    <li class="nav-item">
        <a href="{{route('user_timesheet')}}" class="nav-link @yield('active_user_timesheet')">
            <i class="icofont-building-alt"></i>
            <p class="d-inline-block">Chấm công hành chính</p>
        </a>
    </li>
    <li class="nav-item ">
        <a href="{{route('user_overtime')}}" class="nav-link @yield('active_user_overtime')">
            <i class="icofont-home"></i>
            <p>Chấm công làm đêm</p>
        </a>
    </li>
    <li class="nav-item ">
        <a href="{{ route('user_edit') }}" class="nav-link @yield('active_user')">
            <i class="icofont-search-user"></i>
            <p>Thông tin cá nhân</p>
        </a>
    </li>
    <li class="nav-item ">
        <a href="{{ route('user.rule.index') }}" class="nav-link @yield('active_rule')">
            <i class="icofont-law-document"></i>
            <p>Nội quy công ty</p>
        </a>
    </li>
@endsection
