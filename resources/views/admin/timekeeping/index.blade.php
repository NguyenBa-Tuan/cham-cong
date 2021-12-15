@extends('admin.app')
@section('active_time_keeping', 'active')
@section('header_content', 'Chấm công hành chính')
@push('styles')
    <style>
       

    </style>
@endpush
@section('content')
    <div class="myTab-content">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button"
                    role="tab" aria-controls="home" aria-selected="true">Tải lên bảng chấm công</button>
            </li>
            @if(request()->active == 'sheet')
                
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="sheet-tab" data-bs-toggle="tab" data-bs-target="#sheet" type="button"
                    role="tab" aria-controls="sheet" aria-selected="false">Bảng chấm công hành chính</button>
            </li>
                
            @else
            <li class="nav-item" role="presentation">
                <a href="{{ route('time_keeping_index', ['active' => 'sheet']) }}">
                <button class="nav-link" id="sheet-tab" data-bs-toggle="tab" data-bs-target="#sheet" type="button"
                    role="tab" aria-controls="sheet" aria-selected="false">Bảng chấm công hành chính</button>
                </a>
            </li>
            @endif
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                @include('admin.timekeeping.create')
            </div>
            <div class="tab-pane fade" id="sheet" role="tabpanel" aria-labelledby="sheet-tab">
                @if(request()->active == 'sheet')
                @include('admin.timekeeping.show')
                @endif
            </div>
        </div>
    </div>
@endsection
