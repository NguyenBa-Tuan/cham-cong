@extends('user.app')
@section('header_content', 'Chấm công hành chính')
@section('title', 'Chấm công hành chính')
@section('active_user_overtime', 'active')
@section('content')
    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/style.css')}}">
        <link rel="stylesheet" href="{{ asset('css/atomic.css')}}">
        <link rel="stylesheet" href="{{ asset('css/custom-bootstrap4.css')}}">
    @endpush
    <div class="myTab-content">
        @if(request()->active == 'sheet')
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button"
                            role="tab" aria-controls="home" aria-selected="true">Đăng ký làm đêm
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="sheet-tab" data-bs-toggle="tab" data-bs-target="#sheet"
                            type="button"
                            role="tab" aria-controls="sheet" aria-selected="false"> Bảng chấm công làm đêm
                    </button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade " id="home" role="tabpanel" aria-labelledby="home-tab">
                    @include('user.overtime.create')
                </div>
                <div class="tab-pane fade show active" id="sheet" role="tabpanel" aria-labelledby="sheet-tab">
                    @include('user.overtime.show')
                </div>
            </div>
        @else
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home"
                            type="button"
                            role="tab" aria-controls="home" aria-selected="true"> Đăng ký làm đêm
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <a href="{{ route('user_overtime', ['active' => 'sheet']) }}">
                        <button class="nav-link" id="sheet-tab" data-bs-toggle="tab" data-bs-target="#sheet"
                                type="button"
                                role="tab" aria-controls="sheet" aria-selected="false">Bảng chấm công làm đêm
                        </button>
                    </a>
                </li>

            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    @include('user.overtime.create')
                </div>
                <div class="tab-pane fade" id="sheet" role="tabpanel" aria-labelledby="sheet-tab">

                </div>
            </div>
        @endif
    </div>
@endsection
