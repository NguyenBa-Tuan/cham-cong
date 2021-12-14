@extends('layouts.app')
@section('page')
    <div class="container">
        <div>
            <a href="{{route('adminUserIndex')}}">User list</a>
        </div>
        <div>
            <a href="{{route('time_keeping_index')}}">Timekeeping</a>
        </div>
        <div>
            <a href="{{route('overtime_index')}}">Overtime</a>
        </div>
    </div>
@endsection
