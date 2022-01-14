@extends('admin.app')
@section('active_time_keeping', 'active')
@section('header_content', 'Chấm công hành chính')
@section('title', 'Chấm công hành chính')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/timekeeping.css') }}">

    <!-- fix responsive tran item 14/01/2022 -->
    <style>
        .myTab-content .nav-item:first-child {
            width: 210px;
        }
        .myTab-content .nav-item:last-child {
            width: 250px;
        }

        .myTab-content .nav-item button {
            width: 100%;
        }

        @media screen and (max-width: 460px) {
            .myTab-content .nav-item:first-child, .myTab-content .nav-item:last-child{
                width: unset;
            }
        }

        @media screen and (max-width: 364px) {

            .myTab-content .nav-link,
            .myTab-content .nav-link .active {
                font-size: 13px !important;
            }

        }

        @media screen and (max-width: 325px) {

            .myTab-content .nav-link,
            .myTab-content .nav-link.active {
                font-size: 12px !important;
            }
        }

    </style>
@endpush

@section('content')
    <div class="myTab-content">
        @if (request()->active == 'sheet')
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button"
                        role="tab" aria-controls="home" aria-selected="true">Tải lên bảng chấm công</button>
                </li>
                <li class="nav-item" role="presentation">

                    <button class="nav-link active" id="sheet-tab" data-bs-toggle="tab" data-bs-target="#sheet" type="button"
                        role="tab" aria-controls="sheet" aria-selected="false">Bảng chấm công hành chính</button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade " id="home" role="tabpanel" aria-labelledby="home-tab">
                    @include('admin.timekeeping.create')
                </div>
                <div class="tab-pane fade show active" id="sheet" role="tabpanel" aria-labelledby="sheet-tab">
                    @include('admin.timekeeping.show')
                </div>
            </div>
        @else
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button"
                        role="tab" aria-controls="home" aria-selected="true">Tải lên bảng chấm công</button>
                </li>
                <li class="nav-item" role="presentation">
                    <a href="{{ route('time_keeping_index', ['active' => 'sheet']) }}">
                        <button class="nav-link" id="sheet-tab" data-bs-toggle="tab" data-bs-target="#sheet"
                            type="button" role="tab" aria-controls="sheet" aria-selected="false">Bảng chấm công hành
                            chính</button>
                    </a>
                </li>

            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    @include('admin.timekeeping.create')
                </div>
                <div class="tab-pane fade" id="sheet" role="tabpanel" aria-labelledby="sheet-tab">

                </div>
            </div>
        @endif
    </div>
@endsection
