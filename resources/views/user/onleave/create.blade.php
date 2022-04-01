@push('styles')
<link rel="stylesheet" href="{{ asset('lib/icofont.min.css') }}">
<link rel="stylesheet" href="{{ asset('lib/datetimepicker2/jquery.datetimepicker.css') }}">
<style>
    .xdsoft_time_variant {
        margin: 0 !important;
    }

    .form-group input {
        background: #ffffff !important;
    }

    .form-group input:focus {
        background: #F8F8F8 !important;
    }

    .xdsoft_today_button {
        display: none;
    }
</style>
@endpush
<div class="tk-content">
    <div class="row">
        <div class="col-md-3">
            <form action="{{route('user.onleave.store')}}" method="POST" autocomplete="off" id="onleave_form" class="form-custom">
                @csrf
                <input id="check_date" value="{{\Carbon\Carbon::now()->addDays(1)->toDateString()}}" style="display: none">
                <input id="check_date_only" value="{{\Carbon\Carbon::now()->toDateString()}}" style="display: none">
                <input id="date_time_now" value="{{\Carbon\Carbon::now('Asia/Ho_Chi_Minh')}}" style="display: none;">
                @if (session()->has('fail'))
                <div class="alert alert-danger alert-block">
                    {{ session()->get('fail') }}
                </div>
                @endif
                @if (session()->has('success'))
                <div class="alert alert-success alert-block">
                    {{ session()->get('success') }}
                </div>
                @endif
                <div class="form-group">
                    <label for="time_start" class="tk-label">Từ ngày</label>
                    <div class="relative">
                        <input type="text" name="timeStart" readonly id="get_date_start" class="form-control relative pointer">
                        <div class="tk-icon">
                            <i class="icofont-clock-time"></i>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="time_end" class="tk-label">Đến ngày</label>
                    <div class="relative">
                        <input type="text" name="timeEnd" readonly required id="get_date_end" class="form-control relative pointer">
                        <div class="tk-icon">
                            <i class="icofont-clock-time"></i>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="reason" class="tk-label">Lý do xin nghỉ</label>
                    <textarea rows="5" name="reason" id="reason" value="Lý do xin nghỉ" required class="form-control relative"></textarea>
                </div>
                <div class="form-group">
                    <label for="on_going" class="tk-label">Dự án đang làm</label>
                    <textarea rows="2" name="on_going" id="on_going" value="Dự án đang làm" required class="form-control relative"></textarea>
                </div>
                <button class="btn tk-btn" type="submit">Đăng ký</button>
            </form>
        </div>
    </div>
</div>
@push('scripts')
<script src="{{ asset('lib/datetimepicker2/jquery.datetimepicker.full.min.js') }}"></script>
<script src="{{ asset('lib/dateformat/jquery-dateformat.min.js')}}"></script>
<script>
    $(document).ready(function() {
        var check_date = $('#check_date').val();
        var date_time_now = $('#date_time_now').val();
        var time_now = $.format.date(date_time_now, "HH:mm");

        var date_now = $.format.date(date_time_now, "yyyy-MM-dd");
        var date_time_8pm = $.format.date(date_now + ' 20:00:00', "yyyy-MM-dd HH:mm:ss");
        var date_tomorrow = new Date(date_now);

        date_tomorrow.setDate(date_tomorrow.getDate() + 1);

        var check_date_only = $('#check_date_only').val();

        var d = $('#get_date_start').datetimepicker({
            minDate: check_date,
            allowTimes: [
                '07:30',
                '13:30',
            ],
            setDate: check_date,
            defaultTime: '07:30',
            defaultDate: check_date,
        });

        $('#get_date_end').datetimepicker({
            minDate: check_date,
            allowTimes: [
                '11:30',
                '17:30',
            ],
            setDate: check_date,
            defaultDate: check_date,
            defaultTime: '17:30',
        });

        $('#get_date_start').change(function(e) {
            var date_start = $('#get_date_start').val();
            var date_end = $('#get_date_end').val();
            var date_start_only = new Date(date_start);

            if (date_end != "") {
                if (date_start > date_end) {
                    $("#get_date_start").val("");
                    $("#get_date_end").val("");
                    alert('Thời gian kết thúc nghỉ phải sau thời gian bắt đầu xin nghỉ!');
                }
            }

            // console.log($.format.date(date_start_only.setDate(date_start_only.getDate()), "yyyy-MM-dd"));
            // console.log($.format.date(date_tomorrow.setDate(date_tomorrow.getDate()), "yyyy-MM-dd"));

            // console.log(date_time_now);
            // console.log(date_time_8pm);

            if (date_time_now > date_time_8pm) {

                if ($.format.date(date_start_only.setDate(date_start_only.getDate()), "yyyy-MM-dd") === $.format.date(date_tomorrow.setDate(date_tomorrow.getDate()), "yyyy-MM-dd")) {
                    $("#get_date_start").val("");
                    $("#get_date_end").val("");
                    alert('Không được đăng ký ngày bắt đầu nghỉ là ngày mai sau 8h tối ngày hôm nay! Hiện tại là' + time_now + '>' + '20:00' + ' !');
                }
            }

            // if (date_now === $.format.date(date_start_only.setDate(date_start_only.getDate()), "yyyy-MM-dd")) {
            //     $("#get_date_start").val("");
            //     $("#get_date_end").val("");
            //     alert('Không được đăng ký ngày hôm nay!');
            // }
        });

        $('#get_date_end').change(function() {
            var date_start = $('#get_date_start').val();
            var date_end = $('#get_date_end').val();
            var text_again = check_date + '07:30';
            if (date_start != "") {
                if (date_start > date_end) {
                    $("#get_date_start").val("");
                    $("#get_date_end").val("");
                    alert('Thời gian kết thúc nghỉ phải sau thời gian bắt đầu xin nghỉ!');
                }
            }
        });
    });
</script>
@endpush