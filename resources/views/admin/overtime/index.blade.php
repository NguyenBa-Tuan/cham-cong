@extends('admin.app')
@section('active_overtime', 'active')
@section('header_content', 'Chấm công làm đêm')
@section('title', 'Chấm công làm đêm')
@push('styles')
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
            width: 114px !important;
            display: inline !important;
            background-color: #ffffff;
            padding: 10px 29px 11px 10px !important;
            font-weight: 500;
            font-size: 16px;
            line-height: 19px;
            color: #222222;
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

    </style>
@endpush
@section('content')
    <div class="bg-top"></div>
    <div class="card">
        <div class="card-body">
            <p class="content-header">BẢNG CHẤM CÔNG LÀM ĐÊM</p>
            <div class="text-center">
                <select name="month" class="form-select form-month">
                    @for ($i = 1; $i <= 12; $i++)
                        <option value="{{ $i }}" {{ $i == request()->month ? 'selected' : '' }}>Tháng
                            {{ $i }}</option>
                    @endfor
                </select>
                <span> - </span>
                <select name="year" class="form-select form-month">
                    @foreach ($listYear as $item)
                        <option value="{{ $item }}" {{ $item == request()->year ? 'selected' : '' }}>Năm
                            {{ $item }}</option>
                    @endforeach
                </select>
            </div>
            <div class="content-main mt-25 overflow-auto">
                <table class="table-main w-100">
                    <thead>
                        <tr>
                            <th rowspan="2" class="date">Ngày</th>
                            @foreach ($listUser as $item)
                                <th colspan="2">{{ $item }}</th>
                            @endforeach
                        </tr>
                        <tr>
                            @php($i = 0)
                            @foreach ($listUser as $item)
                                @php($i++)
                                <th class="{{ $i % 2 == 0 ? 'bg-blue1' : 'bg-green1' }}">Checkin</th>
                                <th class="{{ $i % 2 == 0 ? 'bg-blue1' : 'bg-green1' }}">Checkout</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($arrDate as $itemDate)
                            <tr>
                                <td class="date">{{ $itemDate['day'] }}</td>
                                @php($i = 0)
                                @foreach ($listUser as $idUser => $name)
                                @php($i++)
                                    <td class="{{ $i % 2 == 0 ? 'bg-blue1' : '' }}">
                                        <a class="timeCheck" href="javascript:void(0)">{{ isset($arrData[$idUser][$itemDate['date']]) ? $arrData[$idUser][$itemDate['date']]['checkin'] : '' }}</a>
                                        </th>
                                    <td class="{{ $i % 2 == 0 ? 'bg-blue1' : '' }}">
                                        <a class="timeCheck" href="javascript:void(0)">{{ isset($arrData[$idUser][$itemDate['date']]) ? $arrData[$idUser][$itemDate['date']]['checkout'] : '' }}</a>
                                        </th>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th class="date">Tổng</th>
                            @foreach ($listUser as $idUser => $name)
                                <th colspan="2" class="bg-green1">
                                    {{ isset($arrData[$idUser]['total']) ? round($arrData[$idUser]['total'], 1) : '' }}
                                </th>
                            @endforeach
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    
@endpush
