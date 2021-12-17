@push('styles')
    <style>


    </style>
    <link rel="stylesheet" href="{{ asset('css/datatables/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/datatables/fixedColumns.bootstrap4.min.css') }}">
@endpush
<div class="main-content main-list">
    <p class="text-center content-title">BẢNG CHẤM CÔNG HÀNH CHÍNH</p>
    <div class="text-center">
        <select name="month" class="form-select form-month">
            @for ($i = 1; $i <= 12; $i++)
                <option value="{{ ($i < 10) ? '0' . $i : $i }}" {{ $i == request()->month ? 'selected' : '' }}>Tháng
                    {{ $i }}</option>
            @endfor
        </select>
        <span>-</span>
        <select name="year" class="form-select form-month">
            @foreach ($listYear as $item)
                <option value="{{ $item }}" {{ $item == request()->year ? 'selected' : '' }}>Năm
                    {{ $item }}</option>
            @endforeach
        </select>
    </div>
    <div class="mt-25">
        <table id="table1" class="table">
            <thead>
                <tr>
                    <th rowspan="2">STT</th>
                    <th rowspan="2">Họ tên</th>
                    @foreach ($arrDate as $item)
                        <th class="day">{{ $item['day'] }}</th>
                    @endforeach
                    <th rowspan="2">Đủ công</th>
                    <th rowspan="2">Nửa Công</th>
                    <th rowspan="2">Nghỉ có lương</th>
                    <th rowspan="2">Nghỉ phép</th>
                    <th rowspan="2">Không phép</th>
                    <th rowspan="2">Tổng cộng</th>
                    <th rowspan="2" class="border-right">Ghi chú</th>
                </tr>
                <tr>
                    @foreach ($arrDate as $item)
                        <th
                            class="unset-border-top {{ in_array($item['day_of_week'], ['T7', 'CN']) ? 'weekend' : 'not-weekend' }}">
                            {{ $item['day_of_week'] }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @php($i = 1)
                @foreach ($listUser as $idUser => $itemUser)
                    <tr>
                        <td class="stt">{{ $i++ }}</td>
                        <td class="name">{{ $itemUser }}</td>
                        @foreach ($arrDate as $itemDate)
                            <td>{{ isset($arrData[$idUser][$itemDate['date']]) ? $arrData[$idUser][$itemDate['date']]['data'] : '' }}
                            </td>
                        @endforeach
                        <td>{{ $x = isset($arrData[$idUser]['X']) ? ($x = $arrData[$idUser]['X']) : 0 }}</td>
                        <td>{{ $x2 = isset($arrData[$idUser]['X/2']) ? $arrData[$idUser]['X/2'] : 0 }}</td>
                        <td>{{ $pl = isset($arrData[$idUser]['PL']) ? $arrData[$idUser]['PL'] : 0 }}</td>
                        <td>{{ $p = isset($arrData[$idUser]['P']) ? $arrData[$idUser]['P'] : 0 }}</td>
                        <td>{{ $kp = isset($arrData[$idUser]['KP']) ? $arrData[$idUser]['KP'] : 0 }}</td>
                        <td class="font-weight-bold">{{ $x + $x2 / 2 + $pl }}</td>

                        <td class="border-right text-left1">{{ isset($arrData[$idUser]['note']) ? $arrData[$idUser]['note'] : ''  }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div>
        <p class="note w-198">KÝ HIỆU CHẤM CÔNG</p>
        <table class="w-198 table-note">
            <tr>
                <td>Đủ công</td>
                <td class="fw-500">X</td>
            </tr>
            <tr>
                <td>Nửa công</td>
                <td class="fw-500">X/2</td>
            </tr>
            <tr>
                <td>Nghỉ phép</td>
                <td class="fw-500">P</td>
            </tr>
            <tr>
                <td>Nghỉ không phép</td>
                <td class="fw-500">KP</td>
            </tr>
            <tr>
                <td>Nghỉ có lương</td>
                <td class="fw-500">PL</td>
            </tr>
            <tr>
                <td>Nghỉ lễ có lương</td>
                <td>
                    <div style="width:24px; height: 16px; background: #F79646"></div>
                </td>
            </tr>
        </table>
    </div>
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

            location.assign(`{{ route('time_keeping_index') }}?active=sheet&year=${year}&month=${month}`)
        })
    </script>
@endpush
