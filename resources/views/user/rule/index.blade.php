@extends('user.app')
@section('header_content', 'Nội quy công ty')
@section('title', 'Nội quy công ty')
@section('active_rule', 'active')
@section('content')
    <div class="myTab-content">

        @if (request()->active == 'sheet')
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a href="{{ route('user.rule.index') }}">
                        <button class="nav-link" id="home-tab" data-bs-toggle="tab" data-bs-target="#home"
                            type="button" role="tab" aria-controls="home" aria-selected="true">Nội quy công ty
                        </button>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="sheet-tab" data-bs-toggle="tab" data-bs-target="#sheet" type="button"
                        role="tab" aria-controls="sheet" aria-selected="false"> Nội quy chức vụ
                    </button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade " id="home" role="tabpanel" aria-labelledby="home-tab">
                </div>
                <div class="tab-pane fade show active" id="sheet" role="tabpanel" aria-labelledby="sheet-tab">
                    @include('user.rule.group')
                </div>
            </div>
        @else
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button"
                        role="tab" aria-controls="home" aria-selected="true"> Nội quy công ty
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <a href="{{ route('user.rule.index', ['active' => 'sheet']) }}">
                        <button class="nav-link" id="sheet-tab" data-bs-toggle="tab" data-bs-target="#sheet"
                            type="button" role="tab" aria-controls="sheet" aria-selected="false">Nội quy chức vụ
                        </button>
                    </a>
                </li>

            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    @include('user.rule.company')
                </div>
                <div class="tab-pane fade" id="sheet" role="tabpanel" aria-labelledby="sheet-tab">

                </div>
            </div>
        @endif

    </div>
@endsection
