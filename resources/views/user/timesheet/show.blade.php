{{--@extends('layouts.app')--}}
{{--@section('page-name', 'Chấm công hành chính')--}}
{{--@section('page')--}}
@extends('layouts.app')
@section('page-name', 'Chấm công hành chính')
@section('page')
    <div class="tab-content">
        <h2>bảng chấm công hành chính</h2>
        <div class="tk-search" style="display: flex; justify-content: center">
            <div class="tk-search-btn">
                <select class="tk-select">
                    <option selected>Tháng 12</option>
                    <option>2</option>
                </select>
            </div>
            <hr style="border: 1px solid #4B545C; width: 6px; margin: 22px 5px">
            <div class="tk-search-btn">
                <select class="tk-select">
                    <option selected>Năm 2021</option>
                    <option>2</option>
                </select>
            </div>

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
                        @if(\App\Enums\Day::getDescription(Carbon\Carbon::parse($value)->dayOfWeek)=='T7'||\App\Enums\Day::getDescription(Carbon\Carbon::parse($value)->dayOfWeek)=='Cn')
                            <td class="tk-day bg-light-pink">{{\App\Enums\Day::getDescription(Carbon\Carbon::parse($value)->dayOfWeek)}}</td>
                        @else
                            <td class="tk-day bg-light-green">{{\App\Enums\Day::getDescription(Carbon\Carbon::parse($value)->dayOfWeek)}}</td>
                        @endif
                    @endforeach
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="tk-title">Ngày công</td>
                    @foreach($data as $key =>$d)
                        @if(\App\Enums\Day::getDescription(\Carbon\Carbon::parse($d->date)->dayOfWeek)=='T7'||\App\Enums\Day::getDescription(\Carbon\Carbon::parse($d->date)->dayOfWeek)=='Cn')
                            <td class="tk-data bg-light-pink">{{$d->data}}</td>
                        @else
                            <td class="tk-data">{{$d->data}}</td>
                        @endif
                    @endforeach
                </tr>
                </tbody>
            </table>
        </div>
        <div class="general">
            <div class="row">
                <div class="col-md-3">
                    <h3 class="mb-15">Ký hiệu chấm công</h3>
                    <div class="general--sign">
                        <div class="row">
                            <div class="col-md-5">
                                <p>Đủ công</p>
                                <p>Nửa công</p>
                                <p>Nghỉ phép</p>
                                <p>Nghỉ không phép</p>
                                <p>Nghỉ có lương</p>
                                <p>Nghỉ lễ có lương</p>
                            </div>
                            <div class="col-md-7">
                                <p>X</p>
                                <p>X/2</p>
                                <p>P</p>
                                <p>KP</p>
                                <p>PL</p>
                                <div class="bg-orange mt-2"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-9">
                    <h3 class="mb-30" style="margin-left: 407px">Tổng hợp</h3>
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
                            <td class="tk-data-general">{{$dataX}}</td>
                            <td class="tk-data-general">{{$dataX_2}}</td>
                            <td class="tk-data-general">{{$dataPL}}</td>
                            <td class="tk-data-general">{{$dataP}}</td>
                            <td class="tk-data-general">{{$dataKP}}</td>
                            <td class="tk-data-general bg-light-green">{{$total}}</td>
                            <td class="tk-data-general"></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
