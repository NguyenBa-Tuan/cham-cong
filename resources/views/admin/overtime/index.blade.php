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

    </style>
    <link rel="stylesheet" href="{{asset('css/atomic.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('lib/icofont.min.css')}}">
@endpush
@section('content')
    <div class="bg-top"></div>
    <div class="card" id="main">
        <div class="card-body">
            <p class="content-header">BẢNG CHẤM CÔNG LÀM ĐÊM</p>
            <div class="text-center">
                <select name="month" class="form-select form-month ad-ot">
                    @for ($i = 1; $i <= 12; $i++)
                        <option value="{{ $i<10 ? '0' .$i : $i }}" {{ $i == request()->month ? 'selected' : '' }}>Tháng
                            {{ $i }}</option>
                    @endfor
                </select>
                <span> - </span>
                <select name="year" class="form-select form-month ad-ot">
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
                        <th rowspan="2" class="date" style="width: 50px">Ngày</th>
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
                                    <a class="timeCheck href-modal"
                                       data-day="{{ $itemDate['day'] }}"
                                       data-name="{{$name}}"
                                       data-checkin="{{ isset($arrData[$idUser][$itemDate['date']]) ? $arrData[$idUser][$itemDate['date']]['checkin'] : '' }}"
                                       data-checkout="{{ isset($arrData[$idUser][$itemDate['date']]) ? $arrData[$idUser][$itemDate['date']]['checkout'] : '' }}"
                                       data-note="{{ isset($arrData[$idUser][$itemDate['date']]) ? $arrData[$idUser][$itemDate['date']]['note'] : '' }}"
                                       data-total="{{ isset($arrData[$idUser][$itemDate['date']]) ? $arrData[$idUser][$itemDate['date']]['total_time'] : '' }}"
                                       data-project="{{ isset($arrData[$idUser][$itemDate['date']]) ? $arrData[$idUser][$itemDate['date']]['project_name'] : '' }}"
                                       href="javascript:void(0)">{{ isset($arrData[$idUser][$itemDate['date']]) ? $arrData[$idUser][$itemDate['date']]['checkin'] : '' }}</a>
                                </th>
                                <td class="{{ $i % 2 == 0 ? 'bg-blue1' : '' }}">
                                    <a class="timeCheck href-modal"
                                       data-day="{{ $itemDate['day'] }}"
                                       data-name="{{$name}}"
                                       data-checkin="{{ isset($arrData[$idUser][$itemDate['date']]) ? $arrData[$idUser][$itemDate['date']]['checkin'] : '' }}"
                                       data-checkout="{{ isset($arrData[$idUser][$itemDate['date']]) ? $arrData[$idUser][$itemDate['date']]['checkout'] : '' }}"
                                       data-note="{{ isset($arrData[$idUser][$itemDate['date']]) ? $arrData[$idUser][$itemDate['date']]['note'] : '' }}"
                                       data-total="{{ isset($arrData[$idUser][$itemDate['date']]) ? $arrData[$idUser][$itemDate['date']]['total_time'] : '' }}"
                                       data-project="{{ isset($arrData[$idUser][$itemDate['date']]) ? $arrData[$idUser][$itemDate['date']]['project_name'] : '' }}"
                                       href="javascript:void(0)">{{ isset($arrData[$idUser][$itemDate['date']]) ? $arrData[$idUser][$itemDate['date']]['checkout'] : '' }}</a>
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
                                {{ isset($arrData[$idUser]['total']) ? $getTotal : '' }}
                            </th>
                        @endforeach
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    <div class="open-modal hidden">
        <div class="modal ad-ot-table" style="overflow: hidden">
            <div class="ad-table-head"></div>
            <table class="text-center mx-auto" style="margin-top: 30px;" id="ot_detail">
                <tr>
                    <th rowspan="2" class="at-ot-date" style="width: 68px;">Ngày</th>
                    <td colspan="5" class="font-700"
                        style="width: 580px;  padding: 15px 0 14px; font-size: 18px; line-height: 21px">
                    </td>
                </tr>
                <tr>
                    <td class="bg-light-green ad-ot-title py-16">Checkin</td>
                    <td class="bg-light-green ad-ot-title">Checkout</td>
                    <td class="bg-light-green ad-ot-title" style="width: 82px;">Tổng thời gian
                    </td>
                    <td class="bg-light-green ad-ot-title" style="width: 150px;">Dự án đang
                        làm
                    </td>
                    <td class="bg-light-green ad-ot-title">Ghi chú</td>
                </tr>

            </table>
            <div class="ad-ot-close">
                <div class="close" style="padding: 27px 0 26px 0; cursor: pointer">
                    <i class="icofont-close-line-circled"></i>
                    <span>Đóng</span>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $('.ad-ot').change(function () {
            let month = $('select[name=month]').val();
            let year = $('select[name=year]').val();
            location.assign(`{{ route('overtime_index') }}?year=${year}&month=${month}`)
        });
    </script>
    <script>
        $(document).ready(function () {
            var modal = $('.ad-ot-table');
            var btn = $('.href-modal');
            var span = $('.close');

            btn.click(function () {
                modal.show();
                $('.open-modal').removeClass('hidden');
            });

            span.click(function () {
                modal.hide();
                $('.open-modal').addClass('hidden');
            });

            $(window).on('click', function (e) {
                if ($(e.target).is('.ad-ot-table')) {
                    modal.hide();
                    $('.open-modal').addClass('hidden');
                }
            });

            $('.timeCheck').on('click', function () {
                var dataName = $(this).data('name');
                var dataCheckin = $(this).data('checkin');
                var dataCheckout = $(this).data('checkout');
                var dataNote = $(this).data('note');
                var dataDay = $(this).data("day");
                var total = $(this).data("total");
                var project = $(this).data("project");

                var checkIn = dataCheckin.split(' ')[1];
                var checkOut = dataCheckout.split(' ')[1];

                /*check AM or PM*/
                // var checkInType = (checkIn >= 12) ? 'PM' : "AM";
                // var checkOutType = (checkOut >= 12) ? 'PM' : "AM";

                var count = total * 60;

                var countHour = Math.floor(count / 60);
                var countMin = Math.floor(count % 60) < 10 ? '0' : '';

                var countTotal = countHour + ':' + countMin;

                $(".remove").remove();

                $('#ot_detail').append(
                    '<tr class="at-ot-date p-30 remove">' +
                    '<td class=" p-30">' + dataDay + '</td>' +
                    '<td class=" p-30">' + checkIn + '</td>' +
                    '<td class=" p-30">' + checkOut + '</td>' +
                    '<td class=" p-30" style="color: #333333; font-weight: bold;">' + countTotal + '</td>' +
                    '<td class=" p-30">' + project + '</td>' +
                    '<td class=" p-30">' + dataNote + '</td>' +
                    '</tr>'
                );
            })
        });
    </script>
@endpush
