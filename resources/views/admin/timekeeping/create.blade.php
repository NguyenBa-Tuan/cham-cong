@push('styles')
    <style>
        .w-377 {
            width: 377px;
        }

        .main-content {
            padding: 68px 30px;
        }

        .lFile {
            height: 46px;
            background: #FFFFFF;
            border: 1px solid #CED4DA;
            box-sizing: border-box;
            border-radius: 3px;
            margin: 0;
            text-align: center;
            line-height: 44px;
            font-weight: 500 !important;
            font-size: 16px;
            text-decoration: underline;
            color: #444444;
            cursor: pointer;
        }

        .dFile i {
            font-size: 14px;
            line-height: 16px;
            color: #555555;
            font-weight: 400;
            display: block;
        }

        .dFile span {
            font-size: 16px;
            line-height: 19px;
            font-weight: 400;
            color: #333333;
            margin-left: 10px;
        }

        .mt-50 {
            margin-top: 50px;
        }

        @media only screen and (min-width: 768px) and (max-width: 1024px)  {
            .w-377 {
                width: 250px !important;
            }
        }

        @media only screen and (max-width: 767px) {
            .dFile span {
                display: block;
                margin-left: 0;
            }

            .w-377 {
                width: 100% !important;
            }
        }

        .main-content ul {
            margin-bottom: 0 !important;
            padding-bottom: 0 !important;
        }

    </style>
@endpush
<div class="main-content">
    @if ($errors->any())
        <div class="alert alert-danger w-377">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if (session()->has('errorUser'))
        <div class="alert alert-danger w-377">
            <ul>
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
