@push('styles')
    <style>
        .main-create {
            height: calc(100vh - 160px);
        }

    </style>
@endpush
<div class="main-content main-create">
    @if ($errors->any())
        <div class="alert alert-danger w-377">
            <ul style="margin-bottom: 0px">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if (session()->has('errorUser'))
        <div class="alert alert-danger w-377">
            <ul style="margin-bottom: 0px">
                @isset(session('errorUser')['date_error'])
                    <li>
                        Bắt buộc cột tháng X5, Cột năm (AA-AB)5
                    </li>
                @endisset
                @isset(session('errorUser')['date_exist'])
                    <li>
                        Tháng này đã được thêm
                    </li>
                @endisset
            </ul>
        </div>
    @endif

    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif



    <form action="{{ route('time_keeping_import') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="dFile">
            <label class="d-block">Dữ liệu tải lên</label>
            <input type="file" name="file" id="file" class="w-377 d-none">
            <label for="file" class="lFile w-377">Chọn tệp tin</label>
            <span>
                Chưa có tệp tin
            </span>
            <i>Định dạng tệp tin tải lên (.csv; .xlsx)</i>
        </div>
        {{-- <label for="">Month</label>
        <input type="month" name="month" class="form-control"> --}}
        <div>
            <button class="btn btn-primary w-377 mt-50">Tải lên</button>
        </div>
    </form>

    @if (session()->has('errorUser'))
        <div class="row">
            @isset(session('errorUser')['user_none'])

                <div class="col-md-6">
                    <div class="w-377 mt-3">
                        <span class="alert-danger">(*) Có {{ count(session('errorUser')['user_none']) }} nhân viên không
                            có trong database </span>
                    </div>
                    <table class="table w-377">
                        <thead>
                            <tr>
                                <td>STT</td>
                                <td>Nhân Viên</td>
                            </tr>
                        </thead>
                        <tbody>
                            @php($i = 1)
                            @foreach (session('errorUser')['user_none'] as $item)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $item }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endisset

            @isset(session('errorUser')['user_missing'])
                <div class="col-md-6">
                    <div class="w-377 mt-3">
                        <span class="alert-danger">(*) Có {{ count(session('errorUser')['user_missing']) }} nhân viên
                            không
                            có
                            trong bảng chấm công</span>
                    </div>
                    <table class="table table-hover w-377">
                        <thead>
                            <tr>
                                <td>STT</td>
                                <td>Nhân Viên</td>
                            </tr>
                        </thead>
                        <tbody>
                            @php($i = 1)
                            @foreach (session('errorUser')['user_missing'] as $item)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $item }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endisset
        </div>
    @endif
    {{-- <a href="{{ route('time_keeping_index') }}">Back to timekeeping sheet</a> --}}
</div>
@push('scripts')
    <script>
        $('input[type=file]').change(function() {
            let file = $('input[type=file]').val().split('\\').pop();
            let arrFile = file.split('.');
            let type = arrFile[arrFile.length - 1];
            if (type == 'csv' || type == 'xlsx') {
                $('.dFile span').css('color', '#333333');
                $('.dFile span').html(file);
            } else {
                $('.dFile span').css('color', 'red');
                $('.dFile span').html('(*) file không đúng định dạng');
                $(this).val('');
            }
        });
    </script>
@endpush
