@extends('user.app')
@section('header_content', 'Chấm công hành chính')
@section('active_user_timesheet', 'active')
@section('content')
@push('styles')
<link rel="stylesheet" href="{{ asset('css/style.css')}}">
<link rel="stylesheet" href="{{ asset('css/atomic.css')}}">
<link rel="stylesheet" href="{{ asset('css/custom-bootstrap4.css')}}">
<style>
    .data-sheet table td {
        padding-left: 10px !important;
        padding-right: 10px !important;
    }

    .tk-general-lb {
        /* padding-left: 435px; */
        text-align: center;
    }

    .general-row {
        display: flex;
        justify-content: space-between;
    }

    .general-sign-row {
        display: flex;
        justify-content: space-between;
    }

    .general-right {
        margin-right: 175px;
    }

    .tk-general {
        padding-left: 20px !important;
        padding-right: 20px !important;
    }

    /*responsive*/

    @media screen and (max-width: 1440px) {
        .general-right {
            margin-right: 0;
        }
    }

    @media screen and (max-width: 1024px) {
        .general-row {
            display: block;
        }

        .tk-general-lb {
            padding-left: 0;
            text-align: center;
        }

        .tk-general-table {
            width: 100%;
        }

        .general-right{
            margin-top: 20px;
        }
    }

    @media screen and (max-width: 768px) {}
</style>
@endpush

<div class="tk-pt-41">
    <div class="tk-px-30">
        <div class="tk-content">
            <h2>bảng chấm công hành chính</h2>
            <div class="tk-search" style="display: flex; justify-content: center">
                <div class="tk-search-btn tk-timesheet">
                    <select class="tk-select" name="month">
                        @for ($i = 1; $i <= 12; $i++) <option value="{{ $i<10 ? '0' .$i : $i }}" {{ $i == request()->month ? 'selected' : '' }}>
                            Tháng {{ $i }}</option>
                            @endfor
                    </select>
                </div>
                <hr style="border: 1px solid #4B545C; width: 6px; margin: 22px 5px; opacity: 1;box-sizing: border-box;">
                <div class="tk-search-btn tk-timesheet">
                    <select class="tk-select" name="year">
                        @foreach ($listYear as $item)
                        <option value="{{ $item }}" {{ $item == request()->year ? 'selected' : '' }}>
                            Năm {{ $item }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="data-sheet" style="overflow: auto">
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
                            <td class="tk-title" style="padding: 15px 0 22px">Ngày công</td>
                            @forelse($data as $key =>$d)
                            @if(\App\Enums\Day::getDescription(\Carbon\Carbon::parse($d->date)->dayOfWeek)=='T7'||\App\Enums\Day::getDescription(\Carbon\Carbon::parse($d->date)->dayOfWeek)=='Cn')
                            <td class="tk-data bg-light-pink">{{$d->data}}</td>
                            @else
                            <td class="tk-data">{{$d->data}}</td>
                            @endif
                            @empty
                            @foreach($arrDate as $key=>$value)
                            @if(\App\Enums\Day::getDescription(Carbon\Carbon::parse($value)->dayOfWeek)=='T7'||\App\Enums\Day::getDescription(Carbon\Carbon::parse($value)->dayOfWeek)=='Cn')
                            <td class="tk-day bg-light-pink"></td>
                            @else
                            <td class="tk-day "></td>
                            @endif
                            @endforeach
                            @endforelse
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="general">
                <div class="general-row">
                    <div class="general-left">
                        <h3 class="mb-15">Ký hiệu chấm công</h3>
                        <div class="general--sign">
                            <div class="general-sign-row">
                                <div class="">
                                    <p>Đủ công</p>
                                    <p>Nửa công</p>
                                    <p>Nghỉ phép</p>
                                    <p>Nghỉ không phép</p>
                                    <p>Nghỉ có lương</p>
                                    <p>Nghỉ lễ có lương</p>
                                </div>
                                <div class="">
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

                    <div class="general-right">
                        <h3 class="mb-30 tk-general-lb">Tổng hợp</h3>
                        <table class="table-responsive tk-table tk-general-table">
                            <thead>
                                <tr>
                                    <td class="tk-general">Đủ công</td>
                                    <td class="tk-general">Nửa công</td>
                                    <td class="tk-general">Nghỉ có lương</td>
                                    <td class="tk-general">Nghỉ phép</td>
                                    <td class="tk-general">Không phép</td>
                                    <td class="tk-general">Tổng cộng</td>
                                    <td class="tk-general">Ghi chú</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="tk-data-general">
                                    <td class="font-500">{{$dataX}}</td>
                                    <td class="font-500">{{$dataX_2}}</td>
                                    <td class="font-500">{{$dataPL}}</td>
                                    <td class="font-500">{{$dataP}}</td>
                                    <td class="font-500">{{$dataKP}}</td>
                                    <td class="bg-light-green font-700">{{$total}}</td>
                                    @foreach($note as $d)
                                    <td class="f-500">{{$d->note}}</td>
                                    @endforeach
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    $('.tk-timesheet').change(function() {
        let month = $('select[name=month]').val();
        let year = $('select[name=year]').val();
        location.assign(`{{ route('user_timesheet') }}?year=${year}&month=${month}`)
    });
</script>
@endpush