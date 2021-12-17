@extends('layouts.master')

@section('title', 'Trang chủ')

@section('aside_content')
    <li class="nav-item">
        <a href="{{route('user_timesheet')}}" class="nav-link">
            Chấm công hành chính
        </a>
    </li>
    <li class="nav-item ">
        <a href="{{route('user_overtime')}}" class="nav-link">
            Chấm công làm đêm
        </a>
    </li>
    <li class="nav-item ">
        <a href="{{ route('user_edit') }}" class="nav-link">
            Thông tin cá nhân
        </a>
    </li>
@endsection
