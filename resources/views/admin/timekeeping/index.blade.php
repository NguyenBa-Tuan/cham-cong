@extends('layouts.app')
@section('page')
@section('page-name', 'Chấm công hành chính')
<h2>bảng chấm công hành chính</h2>
<div class="timekeeping-search">
    tháng 12-năm 2021
</div>

<table class="timekeeping-table">
    <thead>
    <tr>
        <td rowspan="2">STT</td>
        <td rowspan="2">Họ tên</td>
        <td>1</td>

    </tr>
    <tr>
        <td>2</td>
    </tr>
    </thead>
    <tbody>
        <tr>
            <td>1</td>
            <td>Lê Hữu Phước</td>
        </tr>
    <tr>
        <td>2</td>
        <td>Lê Hữu Phước</td>
    </tr>
    </tbody>
</table>


<table class="table">
    <tr>
        @foreach($month as $m)
            <td>
                <a href="{{route('time_keeping_show', $m->id)}}">{{$m->month}}</a>
            </td>
        @endforeach
    </tr>
</table>
<a href="{{route('time_keeping_create')}}">upload sheet</a>
@endsection
