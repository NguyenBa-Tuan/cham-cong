@extends('admin.app')
@section('aside_user', 'active')
@section('header_content', 'Thông tin cá nhân')
@section('title', 'Thông tin cá nhân')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/atomic.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('lib/icofont.min.css') }}">
    <style>
        .myTab-content .nav-item:first-child {
            width: 160px;
        }
        .myTab-content .nav-item:last-child {
            width: 210px;
        }

        .myTab-content .nav-item button {
            width: 100%;
        }

        @media screen and (max-width: 400px) {
            .myTab-content .nav-item:first-child, .myTab-content .nav-item:last-child  {
                width: unset;
            }
        }

    </style>
@endpush
@section('content')
    <div class="myTab-content">
        @if (request()->active == 'sheet')
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a href="{{ route('adminUserIndex') }}">
                        <button class="nav-link" id="home-tab" data-bs-toggle="tab" data-bs-target="#home"
                            type="button" role="tab" aria-controls="home" aria-selected="true">Tạo tài khoản
                        </button>
                    </a>
                </li>
                <li class="nav-item" role="presentation">

                    <button class="nav-link active" id="sheet-tab" data-bs-toggle="tab" data-bs-target="#sheet" type="button"
                        role="tab" aria-controls="sheet" aria-selected="false">Danh sách tài khoản
                    </button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade " id="home" role="tabpanel" aria-labelledby="home-tab">
                    @include('admin.user.create')
                </div>
                <div class="tab-pane fade show active" id="sheet" role="tabpanel" aria-labelledby="sheet-tab">
                    @include('admin.user.show')
                </div>
            </div>
        @else
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button"
                        role="tab" aria-controls="home" aria-selected="true">
                        {{ isset($user->id) ? 'Sửa tài khoản' : 'Tạo tài khoản' }}
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <a href="{{ route('adminUserIndex', ['active' => 'sheet']) }}">
                        <button class="nav-link" id="sheet-tab" data-bs-toggle="tab" data-bs-target="#sheet"
                            type="button" role="tab" aria-controls="sheet" aria-selected="false">Danh sách tài khoản
                        </button>
                    </a>
                </li>

            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    @if (isset($user))
                        @include('admin.user.edit')
                    @else
                        @include('admin.user.create')

                    @endif
                </div>
                <div class="tab-pane fade" id="sheet" role="tabpanel" aria-labelledby="sheet-tab">

                </div>
            </div>
        @endif
    </div>
@endsection
