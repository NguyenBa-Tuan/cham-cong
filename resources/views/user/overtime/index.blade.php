@extends('layouts.app')
@section('page-name', 'Chấm công làm đêm')
@section('page')
    <div class="tab-wrapper absolute">
        <ul class="tab">
            <li>
                <a href="#tab-image">Bảng chấm công làm đêm</a>
            </li>

{{--            dao nguoc lai--}}

            <li>
                <a href="#tab-main-info">Đăng ký làm đêm</a>
            </li>

        </ul>
    </div>
    <div class="tab-item" id="tab-main-info">
        @include('user.overtime.create')
    </div>
    <div class="tab-item" id="tab-image">
        @include('user.overtime.show')
    </div>
@endsection

