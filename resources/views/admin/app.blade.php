@extends('layouts.master')

@section('title', 'Trang chủ')

@section('aside_content')

<li class="nav-item">
    <a href="{{ route('time_keeping_index') }}" class="nav-link @yield('active_time_keeping')">
        <i class="icofont-building-alt"></i>
        <p class="d-inline-block">Chấm công hành chính</p>
    </a>
</li>

<li class="nav-item ">
    <a href="{{ route('overtime_index') }}" class="nav-link @yield('active_overtime')">
        <i class="icofont-home"></i>
        <p>Chấm công làm đêm</p>
    </a>
</li>


<li class="nav-item ">
    <a href="{{ route('adminUserIndex') }}" class="nav-link @yield('aside_user')">
        <i class="icofont-search-user"></i>
        <p>Thông tin nhân viên</p>
    </a>
</li>
<li class="nav-item ">
    <a href="{{ route('admin.rule.index') }}" class="nav-link @yield('active_rule')">
        <i class="icofont-law-document"></i>
        <p>Nội quy công ty</p>
    </a>
</li>
<li class="nav-item ">
    <a href="{{ route('admin.level.index') }}" class="nav-link @yield('active_level')">
        <i class="icofont-layers"></i>
        <p>Chức vụ</p>
    </a>
</li>
<li class="nav-item ">
    <a href="{{ route('payroll.index') }}" class="nav-link @yield('active_payroll')">
        <i class="icofont-bill"></i>
        <p>Bảng lương</p>
    </a>
</li>
<li class="nav-item ">
    <a href="{{ route('admin.onleave.index') }}" class="nav-link @yield('active_onleave')">
        <i class="icofont-page"></i>
        <p>Xin nghỉ phép</p>
    </a>
</li>
@endsection