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
        }

        .bg-td2 {
            background: #DEF5DC;
            font-weight: 500;
            font-size: 14px;
            line-height: 16px;
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
            .form-month {
                width: 114px !important;
            }
            .content-header {
                font-size: 16px;
            }
        }

    </style>
    <link rel="stylesheet" href="{{ asset('css/atomic.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('lib/icofont.min.css') }}">
@endpush
@section('content')
    <div class="bg-top"></div>
    <div class="card" id="main">
        <div class="card-body">
            <p class="content-header">BẢNG CHẤM CÔNG LÀM ĐÊM</p>
            <div class="text-center d-flex" style="justify-content: center">
                <select name="month" class="form-select form-month ad-ot">
                    @for ($i = 1; $i <= 12; $i++)
                        <option value="{{ $i < 10 ? '0' . $i : $i }}" {{ $i == request()->month ? 'selected' : '' }}>
                            Tháng
                            {{ $i }}</option>
                    @endfor
                </select>
                <hr style="border: 1px solid #4B545C; width: 6px; margin: 22px 5px; opacity: 1;box-sizing: border-box;">
                <select name="year" class="form-select form-month ad-ot">
                    @forelse ($listYear as $item)
                        <option value="{{ $item }}" {{ $item == request()->year ? 'selected' : '' }}>Năm
                            {{ $item }}</option>
                    @empty
                        
                    @endforelse
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
                                        <a class="timeCheck href-modal" data-day="{{ $itemDate['day'] }}"
                                            data-name="{{ $name }}"
                                            data-checkin="{{ isset($arrData[$idUser][$itemDate['date']]) ? $arrData[$idUser][$itemDate['date']]['checkin'] : '' }}"
                                            data-checkout="{{ isset($arrData[$idUser][$itemDate['date']]) ? $arrData[$idUser][$itemDate['date']]['checkout'] : '' }}"
                                            data-note="{{ isset($arrData[$idUser][$itemDate['date']]) ? $arrData[$idUser][$itemDate['date']]['note'] : '' }}"
                                            data-total="{{ isset($arrData[$idUser][$itemDate['date']]) ? round($arrData[$idUser][$itemDate['date']]['total_time'], 1) : '' }}"
                                            data-project="{{ isset($arrData[$idUser][$itemDate['date']]) ? $arrData[$idUser][$itemDate['date']]['project_name'] : '' }}"
                                            href="javascript:void(0)">{{ isset($arrData[$idUser][$itemDate['date']]) ? $arrData[$idUser][$itemDate['date']]['checkin'] : '' }}</a>
                                        </th>
                                    <td class="{{ $i % 2 == 0 ? 'bg-blue1' : '' }}">
                                        <a class="timeCheck href-modal" data-day="{{ $itemDate['day'] }}"
                                            data-name="{{ $name }}"
                                            data-checkin="{{ isset($arrData[$idUser][$itemDate['date']]) ? $arrData[$idUser][$itemDate['date']]['checkin'] : '' }}"
                                            data-checkout="{{ isset($arrData[$idUser][$itemDate['date']]) ? $arrData[$idUser][$itemDate['date']]['checkout'] : '' }}"
                                            data-note="{{ isset($arrData[$idUser][$itemDate['date']]) ? $arrData[$idUser][$itemDate['date']]['note'] : '' }}"
                                            data-total="{{ isset($arrData[$idUser][$itemDate['date']]) ? round($arrData[$idUser][$itemDate['date']]['total_time'], 1) : '' }}"
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
                                    {{ isset($arrData[$idUser]['total']) ? round($arrData[$idUser]['total'], 1) : '' }}
                                </th>
                            @endforeach
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog modal-lg">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-body">
                    <div style="height: 26px; background:#3B89CF; border: 1px solid #ffffff"></div>
                    <div style="padding: 0 10px; overflow: auto">
                        <table class="table text-center mx-auto" style="margin-top: 30px;" id="ot_detail">
                            <tr>
                                <th rowspan="2" class="at-ot-date td-middle bg-td1"
                                    style="width: 68px; border-top: 1px solid #999999;">Ngày</th>
                                <td colspan="5" class="font-700 td-middle"
                                    style="padding: 15px 0 14px; font-size: 18px; line-height: 21px; border-top: 1px solid #999999">
                                    <span id="name"></span>
                                </td>
                            </tr>
                            <tr class="bg-td2">
                                <td class="bg-light-green ad-ot-title py-16 td-middle">Checkin</td>
                                <td class="bg-light-green ad-ot-title td-middle">Checkout</td>
                                <td class="bg-light-green ad-ot-title td-middle" style="width: 82px;">Tổng thời gian
                                </td>
                                <td class="bg-light-green ad-ot-title td-middle" style="width: 150px;">Dự án đang
                                    làm
                                </td>
                                <td class="bg-light-green ad-ot-title td-middle">Ghi chú</td>
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
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        $('.close').click(e => {
            $('#myModal').modal('hide');
        })
        $('.ad-ot').change(function() {
            let month = $('select[name=month]').val();
            let year = $('select[name=year]').val();
            location.assign(`{{ route('overtime_index') }}?year=${year}&month=${month}`)
        });
    </script>
    <script>
        $('.timeCheck').on('click', function() {
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

            // var count = total * 60;

            // var countHour = Math.floor(count / 60);
            // var countMin = Math.floor(count % 60) < 10 ? '0' : '';

            // var countTotal = countHour + ':' + countMin;

            $('#name').html(dataName);

            $(".remove").remove();

            $('#ot_detail').append(
                '<tr class="at-ot-date p-30 remove">' +
                '<td class=" p-30 bg-td1">' + dataDay + '</td>' +
                '<td class=" p-30">' + checkIn + '</td>' +
                '<td class=" p-30">' + checkOut + '</td>' +
                '<td class=" p-30" style="color: #333333; font-weight: bold;">' + total + '</td>' +
                '<td class=" p-30">' + project + '</td>' +
                '<td class=" p-30">' + dataNote + '</td>' +
                '</tr>'
            );
            $('#myModal').modal('show');
        })
    </script>
@endpush
