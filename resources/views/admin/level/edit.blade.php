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

        input[name="level"] {
            height: 48px;
            font-size: 16px;
        }

        .back-create {
            font-size: 16px;
            color: #747171;
            font-weight: 600;
        }

    </style>
@endpush

<div class="main-content main-create">
    <div class="mb-30">
        <a href="{{ route('admin.level.index') }}" class="back-create"><i class="icofont-stylish-left"></i> Thêm
            mới</a>
    </div>
    @if (session()->has('success'))
        <div class="alert alert-success w-377">
            {{ session()->get('success') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="alert alert-danger w-377">
            {{ session()->get('error') }}
        </div>
    @endif

    <form action="{{ route('admin.level.update', $level->id) }}" class="frmSm" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="_method" value="PUT">
        @csrf
        <div class="w-377">
            <label class="tk-label" for="level">Chức vụ</label>
            <input type="text" name="level" class="form-control" value="{{ $level->name }}" required>
        </div>

        <div>
            <button class="btn btn-primary w-377 mt-50">Cập nhật</button>
        </div>
    </form>

</div>
@push('scripts')
    <script>
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
