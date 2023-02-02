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
</style>
<link rel="stylesheet" href="{{ asset('css/datatables/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/datatables/fixedColumns.bootstrap4.min.css') }}">
@endpush
<div class="main-content main-list">
    <p class="text-center content-title">BẢNG CHẤM CÔNG HÀNH CHÍNH</p>
    <div class="text-center d-flex" style="justify-content: center">
        <div class="mt-25">
            @foreach($data as $key => $value)
            {{$value['month']}}
            <table id="table1" class="table">
                <thead>
                    <tr>
                        <th>Tên</th>
                        <th>Số ngày công</th>
                        <th>Lương tháng</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($value['data'] as $data)
                    <tr>
                        <td>{{\App\Models\User::where('id', $data->user_id)->first()->name}}</td>
                        <td>{{$data->data}}</td>
                        <td>{{$data->salary_per_month}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endforeach
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
        });
    </script>
    @endpush