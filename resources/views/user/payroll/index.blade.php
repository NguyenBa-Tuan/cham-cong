@extends('user.app')
@section('header_content', 'Chấm công hành chính')
@section('active_user_payroll', 'active')
@push('styles')
<link rel="stylesheet" href="{{ asset('css/style.css')}}">
<link rel="stylesheet" href="{{ asset('css/atomic.css')}}">
<style>
    #data_table thead tr {
        border-bottom: none;
    }

    #data_table thead th {
        background-color: #E8EDF4;
        border: 1px solid #999999;
        border-bottom: none;
    }

    #data_table tbody tr {
        border-top: none;
        text-align: center;
    }
</style>
@endpush
@section('content')
<div class="tk-pt-41">
    <div class="tk-px-30">
        <div class="tk-content">
            <h2>Bảng lương</h2>
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
            <div class="table-responsive">
                <div class="data-sheet" style="overflow: auto">
                    <table class="tk-table table" id="data_table">
                        <thead>
                            <tr>
                                <th>Lương cơ bản</th>
                                <th> Ngày chuẩn</th>
                                <th> Lương theo ngày</th>
                                <th>Nghỉ lễ có lương</th>
                                <th>Ngày tăng ca</th>
                                <th>Lương tăng ca (120%) </th>
                                <th>Số ngày làm việc </th>
                                <th>Phạt</th>
                                <th>Thưởng</th>
                                <th>Làm đêm (giờ) </th>
                                <th>Lương đêm/giờ ( 150% giờ LCB) </th>
                                <th>Lương thực nhận </th>
                                <th>Trích bhxh </th>
                                <th>Ghi chú</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($listSalary as $d)
                            <tr>
                                <td>{{$d->basic_salary}}</td>
                                <td>{{$d->standard_date}}</td>
                                <td>{{$d->daily_salary}}</td>
                                <td>{{$d->paid_leave}}</td>
                                <td>{{$d->overtime_date}}</td>
                                <td>{{$d->overtime_salary}}</td>
                                <td>{{$d->number_working_day}}</td>
                                <td>{{$d->punish}}</td>
                                <td>{{$d->bonus}}</td>
                                <td>{{$d->overtime}}</td>
                                <td>{{$d->hourly_overtime}}</td>
                                <td>{{$d->salary}}</td>
                                <td>{{$d->bhxh}}</td>
                                <td>{{$d->note}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
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
        location.assign(`{{ route('user.payroll') }}?year=${year}&month=${month}`)
    });
</script>
@endpush