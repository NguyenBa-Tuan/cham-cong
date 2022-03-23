@push('meta')
<meta name="csrf-token-x" content="{{csrf_token()}}">
@endpush
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
    @if (isset(session('errorUser')['date_error']) || isset(session('errorUser')['date_exist']))
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


    @if (session()->has('upload'))
    @isset(session('upload')['upload'])
    <div class="alert alert-success">
        Upload bảng lương thành công!
    </div>
    @endisset
    @isset(session('upload')['override'])
    <div class="alert alert-success">
        Thay đổi bảng lương thành công!
    </div>
    @endisset
    @endif

<<<<<<< HEAD
    <form action="{{ route('payroll.store') }}" method="POST" enctype="multipart/form-data" id="form-main">
=======
    <form action="{{ route('payroll.store') }}" method="POST" enctype="multipart/form-data">
>>>>>>> 25f48fc (fix)
        @csrf
        <div class="dFile">
            <label class="d-block">Dữ liệu tải lên</label>
            <input type="file" name="file" id="file" class="w-377 d-none" required>
            <label for="file" class="lFile w-377">Chọn tệp tin</label>
            <span>
                Chưa có tệp tin
            </span>
            <i>Định dạng tệp tin tải lên (.csv; .xlsx)</i>
        </div>
        <div>
            <button class="btn btn-primary w-377 mt-50">Tải lên</button>
        </div>
    </form>
    @if(session()->has('check_data'))
    @isset(session('check_data')['data_e'])
    <p id="dcheck" style="background-color: red; font-size: 23px">already uploaded!</p>
    @endisset
    @endif
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

</div>
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $('#form-main input[type=file]').change(function() {
        let file = $('#form-main input[type=file]').val().split('\\').pop();
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

    // $('input[type=file]').change(function() {
    //     $.ajaxSetup({
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token-x"]').attr('content')
    //         }
    //     });

    //     var datacheck = $('#dcheck').text();
    //     console.log(datacheck);
    //     $.ajax({
    //         type: 'post',
    //         url: '{{route("check-override")}}',
    //         dataType: 'html',
    //         data: {
    //             datacheck,
    //             _token: '{{ csrf_token() }}',
    //         },
    //         contentType: false,
    //         processData: false,
    //         success: function(data) {
    //             if (data) $('form').attr('action', '{{route("override-payroll")}}');
    //         },
    //         error: function(data) {
    //             console.log(data);
    //         }
    //     });
    // });
</script>
@endpush