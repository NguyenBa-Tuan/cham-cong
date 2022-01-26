@push('styles')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/atomic.css') }}">
    <!--ico font -->
    <link rel="stylesheet" href="{{ asset('lib/icofont.min.css') }}">
    <style>
        .main-create {
            height: calc(100vh - 160px);
            padding-top: 30px;
        }

        .level {
            height: 48px !important;
            margin-bottom: 15px;
        }

        .mb-30 {
            margin-bottom: 30px;
        }

    </style>
@endpush

<div class="main-content main-create">
    <div class="mb-30">
        <span style="color: red">(*) Sau khi upload file nội quy mới, file cũ sẽ bị xóa!</span>
    </div>
    @if (session()->has('success'))
        <div class="alert alert-success w-377">
            {{ session()->get('success') }}
        </div>
    @endif

    <form action="{{ route('admin.rule.store') }}" class="frmSm" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="dFile">
            <label class="d-block tk-label">Tải lên file PDF</label>
            <input type="file" name="file" id="file" class="w-377 d-none">
            <label for="file" class="lFile w-377">Chọn tệp tin</label>
            <span>
                Chưa có tệp tin
            </span>
            <i>Định dạng tệp tin tải lên (.pdf)</i>
        </div>
        {{-- <label for="">Month</label>
        <input type="month" name="month" class="form-control"> --}}
        <div>
            <button class="btn btn-primary w-377 mt-50">Tải lên</button>
        </div>
    </form>

</div>
@push('scripts')
    <script>
        $('.frmSm').submit(e => {

            let file = $('#file').val();

            if (!file) {
                $('.dFile span').css('color', 'red');
                $('.dFile span').html('(*) Vui lòng thêm 1 file pdf');

                e.preventDefault();
            }

        })
        $('input[type=file]').change(function() {
            let file = $('input[type=file]').val().split('\\').pop();
            let arrFile = file.split('.');
            let type = arrFile[arrFile.length - 1];
            if (type == 'pdf') {
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
