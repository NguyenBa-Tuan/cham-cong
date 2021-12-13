@extends('layouts.app')
@section('page-name', 'Chấm công hành chính')
@section('page')
    <h2>bảng chấm công hành chính</h2>
    <div class="tk-search">
        t-12-2021
    </div>
    <div class="data-sheet">
        <table class="tk-table" id="data_table">
            <thead>
            <tr>
                <td class="tk-title">Ngày</td>
                @foreach($arrDate as $key=>$value)
                    <td class="tk-date">{{Carbon\Carbon::parse($value)->day}}</td>
                @endforeach
            </tr>
            <tr>
                <td class="tk-title">Thứ</td>
                @foreach($arrDate as $key=>$value)
                    <td class="tk-day bg-light-green">{{\App\Enums\Day::getDescription(Carbon\Carbon::parse($value)->dayOfWeek)}}</td>
                @endforeach
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="tk-title">Ngày công</td>
                @foreach($data as $d)
                    <td class="tk-data">{{$d->data}}</td>
                @endforeach
            </tr>
            </tbody>
        </table>
    </div>
    <div class="general">
        <h3>Tổng hợp</h3>
        <table class="tk-table">
            <thead>
            <tr>
                <td class="tk-general w-105">Đủ công</td>
                <td class="tk-general w-105">Nửa công</td>
                <td class="tk-general w-105">Nghỉ có lương</td>
                <td class="tk-general w-105">Nghỉ phép</td>
                <td class="tk-general w-105">Không phép</td>
                <td class="tk-general w-105">Tổng cộng</td>
                <td class="tk-general w-283">Ghi chú</td>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="tk-data-general">22</td>
                <td class="tk-data-general">22</td>
                <td class="tk-data-general">22</td>
                <td class="tk-data-general">22</td>
                <td class="tk-data-general">22</td>
                <td class="tk-data-general bg-light-green">22</td>
                <td class="tk-data-general"></td>
            </tr>
            </tbody>
        </table>
    </div>








    {{--    <p>{{$month->month}}</p>--}}
    {{--    <table class="table table-bordered">--}}
    {{--        <tr>--}}
    {{--            @foreach($arrDate as $key=>$value)--}}
    {{--                <td>{{Carbon\Carbon::parse($value)->day}}</td>--}}
    {{--            @endforeach--}}
    {{--            <td>Note</td>--}}
    {{--        </tr>--}}
    {{--        <tr>--}}
    {{--            @foreach($arrDate as $key=>$value)--}}
    {{--                <td>{{\App\Enums\Day::getDescription(Carbon\Carbon::parse($value)->dayOfWeek)}}</td>--}}
    {{--            @endforeach--}}
    {{--        </tr>--}}
    {{--        <tr>--}}
    {{--            @foreach($data as $d)--}}
    {{--                <td>{{$d->data}}</td>--}}
    {{--            @endforeach--}}
    {{--            <td>--}}
    {{--                @foreach($note as $n)--}}
    {{--                    {{$n->note}}--}}
    {{--                @endforeach--}}
    {{--            </td>--}}
    {{--        </tr>--}}
    {{--    </table>--}}


@endsection
