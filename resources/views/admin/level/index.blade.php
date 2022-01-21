@extends('admin.app')
@section('active_level', 'active')
@section('header_content', 'Chức vụ')
@section('title', 'Chức vụ')

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

            .myTab-content .nav-item:first-child,
            .myTab-content .nav-item:last-child {
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
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button"
                    role="tab" aria-controls="home"
                    aria-selected="true">{{ isset($level) ? 'Sửa chức vụ' : 'Thêm chức vụ' }}</button>
            </li>
            <li class="nav-item" role="presentation">

                <button class="nav-link " id="sheet-tab" data-bs-toggle="tab" data-bs-target="#sheet" type="button"
                    role="tab" aria-controls="sheet" aria-selected="false">Danh sách chức vụ</button>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                @if (isset($level))
                    @include('admin.level.edit')

                @else
                    @include('admin.level.create')

                @endif
            </div>
            <div class="tab-pane fade " id="sheet" role="tabpanel" aria-labelledby="sheet-tab">
                @include('admin.level.show')
            </div>
        </div>

    </div>
@endsection
