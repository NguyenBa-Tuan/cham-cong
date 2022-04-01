@extends('admin.app')
@section('active_onleave', 'active')
@section('header_content', 'Nghỉ phép')
@section('title', 'Nghỉ phép')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin/timekeeping.css') }}">
<link rel="stylesheet" href="{{ asset('css/atomic.css') }}">
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<link rel="stylesheet" href="{{ asset('lib/icofont.min.css') }}">
<style>
    .bg-top {
        height: 40px;
        background: #E8EDF4;
        width: 100%;
    }

    .card {
        box-shadow: unset;
        border-color: #ffffff;
        margin: 0 30px;
        border-radius: 0;
        padding: 60px 30px 47px;
    }

    .content-header {
        font-weight: bold;
        font-size: 28px;
        text-align: center;
        color: #151515;
        padding: 0;
        margin-bottom: 20px;
    }

    .form-month {
        width: 120px !important;
        display: inline !important;
        background-color: #ffffff;
        padding: 10px 29px 11px 10px !important;
        font-weight: 500;
        font-size: 16px;
        line-height: 19px;
        color: #222222;
        background-image: url("data:image/svg+xml,<svg height='10px' width='10px' viewBox='0 0 16 16' fill='%23000000' xmlns='http://www.w3.org/2000/svg'><path d='M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/></svg>");
        background-position: calc(100% - 7px);
    }

    .mt-25 {
        margin-top: 25px;
    }

    .table-main td,
    .table-main th {
        border: 1px solid #999999 !important;
        font-weight: bold;
        font-size: 14px;
        line-height: 16px;
        color: #4B545C;
        padding: 12px 9px;
        text-align: center;
    }

    .table-main td {
        font-size: 14px;
        line-height: 16px;

        color: #4B545C;
        font-weight: 400;
    }

    .table-main td a {
        color: #4B545C;
    }

    .table-main td a:hover {
        color: #3490dc;
        text-decoration: underline !important;
    }

    .date {
        background: #D0DFF5;
        font-weight: 700 !important;
    }

    .bg-green1 {
        background: #DEF5DC;
    }

    .bg-blue1 {
        background: #E8EDF4;
    }

    .open-modal {
        background-color: rgba(128, 128, 128, .7);
        /*opacity: .1;*/
        position: fixed;
        left: 0;
        right: 0;
        top: 0;
        bottom: 0;
    }

    .hidden {
        display: none;
    }

    .modal-body {
        padding: 0;
    }

    .td-middle {
        vertical-align: middle !important;
    }

    .bg-td1 {
        background: #D0DFF5 !important;
        font-weight: bold;
        font-size: 14px;
        line-height: 16px;
        vertical-align: middle !important;

    }

    .bg-td2 {
        background: #DEF5DC;
        font-weight: 500;
        font-size: 14px;
        text-align: center;
        color: #4B545C;
    }

    .close {
        font-size: 14px;
        line-height: 16px;
        color: #333333 !important;
        opacity: 1;
    }

    .icofont-close-line-circled {
        font-size: 22px;
        opacity: 1;
        margin-right: 6px;
        position: relative;
        top: 2px;
    }


    @media only screen and (max-width: 600px) {
        #main {
            padding: 30px 10px !important;
        }

        .content-header {
            font-size: 16px;
        }
    }

    .modal-dialog {
        margin: auto;
    }

    .table-main .checkout {
        position: relative;
    }



    .table-main .checkout:hover .btn-edit {
        display: unset;

    }

    .btn-edit {
        display: none;
        cursor: pointer;
        position: absolute;
        top: 0;
        right: 0;
        font-size: 12px;
    }

    td {
        vertical-align: middle !important;
    }

    .checkout .badge {
        padding: 4px !important;
    }
</style>

@endpush
@section('content')
<div class="myTab-content">
    @if (request()->active == 'sheet')
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Phê duyệt</button>
        </li>
        <li class="nav-item" role="presentation">

            <button class="nav-link active" id="sheet-tab" data-bs-toggle="tab" data-bs-target="#sheet" type="button" role="tab" aria-controls="sheet" aria-selected="false">Bảng xin nghỉ phép</button>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade " id="home" role="tabpanel" aria-labelledby="home-tab">
            @include('admin.onleave.request')
        </div>
        <div class="tab-pane fade show active" id="sheet" role="tabpanel" aria-labelledby="sheet-tab">
            @include('admin.onleave.show')
        </div>
    </div>
    @else
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Phê duyệt</button>
        </li>
        <li class="nav-item" role="presentation">
            <a href="{{ route('admin.onleave.index', ['active' => 'sheet']) }}">
                <button class="nav-link" id="sheet-tab" data-bs-toggle="tab" data-bs-target="#sheet" type="button" role="tab" aria-controls="sheet" aria-selected="false">Bảng xin nghỉ phép</button>
            </a>
        </li>

    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            @include('admin.onleave.request')
        </div>
        <div class="tab-pane fade" id="sheet" role="tabpanel" aria-labelledby="sheet-tab">

        </div>
    </div>
    @endif
</div>
@endsection