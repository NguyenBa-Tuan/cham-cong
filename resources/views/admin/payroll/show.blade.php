@push('styles')
    <style>
        .main-list .form-month {
            background-image: url("data:image/svg+xml,<svg height='10px' width='10px' viewBox='0 0 16 16' fill='%23000000' xmlns='http://www.w3.org/2000/svg'><path d='M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/></svg>");
            background-position: calc(100% - 7px);
        }

        .DTFC_LeftHeadWrapper,
        .DTFC_LeftBodyWrapper {
            width: calc(100% + 0.5px) !important;
        }

        .DTFC_LeftBodyLiner {
            width: 100% !important;
            overflow-y: hidden !important;
            padding: 0 !important;
        }

        .DTFC_Cloned {
            border-right: 1px solid #999999 !important;
        }

        thead tr {
            background-color: #E8EDF4 !important;
        }
        .main-list td.text-right {
            text-align: right !important;
        }
        .main-list td.text-left {
            text-align: left !important;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('css/datatables/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/datatables/fixedColumns.bootstrap4.min.css') }}">
@endpush
<div class="main-content main-list">
    <p class="text-center content-title">BẢNG LƯƠNG</p>
    <div class="text-center d-flex" style="justify-content: center">
        <select name="month" class="form-select form-month">
            @for ($i = 1; $i <= 12; $i++)
                <option value="{{ $i < 10 ? '0' . $i : $i }}" {{ $i == request()->month ? 'selected' : '' }}>Tháng
                    {{ $i }}</option>
            @endfor
        </select>
        <hr style="border: 1px solid #4B545C; width: 6px; margin: 22px 5px; opacity: 1;box-sizing: border-box;">
        <select name="year" class="form-select form-month">
            @forelse ($listYear as $item)
                <option value="{{ $item }}" {{ $item == request()->year ? 'selected' : '' }}>Năm
                    {{ $item }}</option>
            @empty

            @endforelse
        </select>
    </div>
    <div class="mt-25">
        <table id="table1" class="table">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>HỌ TÊN</th>
                    <th>Lương cơ bản</th>
                    <th>Ngày chuẩn </th>
                    <th>Lương theo ngày</th>
                    <th>Nghỉ lễ có lương</th>
                    <th>Ngày tăng ca</th>
                    <th>Lương tăng ca (120%)</th>
                    <th>Số ngày làm việc</th>
                    <th>Phạt</th>
                    <th>Thưởng</th>
                    <th>Làm đêm (giờ)</th>
                    <th>Lương đêm/giờ ( 150% giờ LCB)</th>
                    <th>Lương thực nhận</th>
                    <th>Trích bhxh</th>
                    <th>Ghi chú</th>
                </tr>
            </thead>
            <tbody>
                @php($i = 1)
                @foreach ($listUser as $idUser => $itemUser)
                    @isset($arrData[$idUser])
                        <tr>
                            <td class="stt">{{ $i++ }}</td>
                            <td class="name">{{ $itemUser }}</td>
                            <td class="text-right"> {{ number_format($arrData[$idUser]['basic_salary']) }}</td>
                            <td class="text-right">{{ ($arrData[$idUser]['standard_date']) }}</td>
                            <td class="text-right">{{ number_format($arrData[$idUser]['daily_salary']) }}</td>
                            <td class="text-right">{{ number_format($arrData[$idUser]['paid_leave']) }}</td>
                            <td class="text-right">{{ $arrData[$idUser]['overtime_date'] }}</td>
                            <td class="text-right">{{ number_format($arrData[$idUser]['overtime_salary']) }}</td>
                            <td class="text-right">{{ $arrData[$idUser]['number_working_day'] }}</td>
                            <td class="text-right">{{ number_format($arrData[$idUser]['punish']) }}</td>
                            <td class="text-right">{{ number_format($arrData[$idUser]['bonus']) }}</td>
                            <td class="text-right">{{ ($arrData[$idUser]['overtime']) }}</td>
                            <td class="text-right">{{ number_format($arrData[$idUser]['hourly_overtime']) }}</td>
                            <td class="text-right">{{ number_format($arrData[$idUser]['salary']) }}</td>
                            <td class="text-right">{{ number_format($arrData[$idUser]['bhxh']) }}</td>
                            <td class="text-left">{{ ($arrData[$idUser]['note']) }}</td>
                        </tr>
                    @endisset

                @endforeach
            </tbody>
        </table>
    </div>

    @push('scripts')
        <script src="{{ asset('js/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('js/datatables/dataTables.fixedColumns.min.js') }}"></script>
        <script>
            $(document).ready(function() {
                $('#table1').DataTable({
                    "paging": false,
                    "searching": false,
                    "ordering": false,
                    "info": false,
                    scrollY: true,
                    scrollX: true,
                    scrollCollapse: true,
                    fixedColumns: {
                        leftColumns: 2,
                    }
                });
            });
            $('.form-month').change(function() {
                let month = $('select[name=month]').val();
                let year = $('select[name=year]').val();

                location.assign(`{{ route('payroll.index') }}?active=sheet&year=${year}&month=${month}`)
            });
        </script>
    @endpush
