@push('styles')
<link rel="stylesheet" href="{{ asset('css/style.css')}}">
<link rel="stylesheet" href="{{ asset('css/atomic.css')}}">
<link rel="stylesheet" href="{{ asset('css/custom-bootstrap4.css')}}">
<!--ico font -->
<link rel="stylesheet" href="{{ asset('lib/icofont.min.css')}}">
<link rel="stylesheet" href="{{ asset('css/lib/jquery.timepicker.min.css')}}">

@endpush

<div class="tk-content">
    <div class="row">
        <div class="col-md-3">
            <form action="{{route('user_overtime_store')}}" method="POST" id="user_overtime_form" autocomplete="off">
                @csrf

                @if (session()->has('error'))
                <div class="alert alert-danger alert-block">
                    {{ session()->get('error') }}
                </div>
                @endif

                @if (session()->has('success'))
                <div class="alert alert-success alert-block">
                    {{ session()->get('success') }}
                </div>
                @endif

                <div class="form-group relative">
                    <label for="date" class="tk-label">Ngày</label>
                    <div class="relative">
                        <input type="date" class="form-control " id="date" name="date" required>
                        <div class="tk-icon">
                            <i class="icofont-calendar"></i>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="checkin" class="tk-label">Giờ Checkin</label>
                    <div class="relative">
                        <input autocomplete="off" class="form-control relative" jt-timepicker="" time="model.time" time-string="model.timeString" default-time="model.options.defaultTime" time-format="model.options.timeFormat" start-time="model.options.startTime" min-time="model.options.minTime" max-time="model.options.maxTime" interval="model.options.interval" dynamic="model.options.dynamic" scrollbar="model.options.scrollbar" dropdown="model.options.dropdown" id="checkin" name="checkin">
                        <!-- <input type="time" class="form-control relative" id="checkin" name="checkin"> -->
                        <div class="tk-icon">
                            <i class="icofont-clock-time"></i>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="checkout" class="tk-label">Giờ Checkout</label>
                    <div class="relative">
                        <input autocomplete="off" class="form-control relative" jt-timepicker="" time="model.time" time-string="model.timeString" default-time="model.options.defaultTime" time-format="model.options.timeFormat" start-time="model.options.startTime" min-time="model.options.minTime" max-time="model.options.maxTime" interval="model.options.interval" dynamic="model.options.dynamic" scrollbar="model.options.scrollbar" dropdown="model.options.dropdown" id="checkout" name="checkout">
                        <!-- <input type="time" class="form-control" id="checkout" name="checkout"> -->
                        <div class="tk-icon">
                            <i class="icofont-clock-time"></i>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="totalTime" class="tk-label">Tổng thời gian (h)</label>
                    <input class="form-control w-95" id="totalTime" name="projectName" disabled required style="padding: 13px 26px;">
                </div>
                <div class="form-group">
                    <label for="project" class="tk-label">Dự án đang làm</label>
                    <textarea class="form-control" id="project" name="projectName" rows="3" required placeholder="Dự án"></textarea>
                </div>

                <div class="form-group">
                    <label for="note" class="tk-label">Ghi chú</label>
                    <textarea class="form-control" id="note" rows="3" name="note" placeholder="Nội dung ghi chú"></textarea>
                </div>
                <button class="btn tk-btn" type="submit">Đăng ký</button>
            </form>
        </div>
    </div>
</div>

@push('scripts')

<script src="{{asset('js/lib/jquery.timepicker.min.js')}}"></script>
<script>
    $("#checkin").timepicker({
        timeFormat: 'H:mm',
        interval: 10,
        minTime: '0',
        maxTime: '23:50',
        // defaultTime: '11',
        startTime: '00:00',
        dynamic: false,
        dropdown: true,
        scrollbar: true,
        change: () => {
            var date = $("input#date").val();
            var checkin = $("input#checkin").val();
            var checkout = $("input#checkout").val();

            var startCheckPrev = new Date("1/1/1900 " + "18:00:00");
            var endCheckPrev = new Date("1/1/1900 " + "23:59:00");
            var startCheckNext = new Date("1/1/1900 " + "00:00:00");
            var endCheckNext = new Date("1/1/1900 " + "7:00:00");

            var startDate = new Date("1/1/1900 " + checkin);
            var endDate = new Date("1/1/1900 " + checkout);
            if (!empty(document.getElementById('checkout').value)) {
                if (startDate < startCheckPrev || startDate <= startCheckNext) {
                    alert('Giờ checkout phải lớn hơn giờ checkin!');
                    document.getElementById('checkout').value = "";
                    document.getElementById('checkin').value = "";
                }

                if (checkout <= checkin) {
                    alert('Giờ checkout phải lớn hơn giờ checkin!');
                    document.getElementById('checkout').value = "";
                    document.getElementById('checkin').value = "";
                }
            }
        }
    });

    $("#checkout").timepicker({
        timeFormat: 'H:mm',
        interval: 10,
        minTime: '0',
        maxTime: '23:50',
        // defaultTime: '11',
        startTime: '00:00',
        dynamic: false,
        dropdown: true,
        scrollbar: true,
        change: () => {
            var date = $("input#date").val();
            var checkin = $("input#checkin").val();
            var checkout = $("input#checkout").val();

            var startCheckPrev = new Date("1/1/1900 " + "18:00:00");
            var endCheckPrev = new Date("1/1/1900 " + "23:59:00");
            var startCheckNext = new Date("1/1/1900 " + "00:00:00");
            var endCheckNext = new Date("1/1/1900 " + "7:00:00");

            var startDate = new Date("1/1/1900 " + checkin);
            var endDate = new Date("1/1/1900 " + checkout);

            if (startDate >= startCheckPrev && endDate <= endCheckPrev || endDate <= endCheckNext && startDate >= startCheckNext) {
                total = NaN;

                if (checkout > checkin) {

                    var totalHour = Math.floor((endDate - startDate) / 1000 / 60 / 60);
                    var totalMin = (endDate - startDate) / 1000 / 60 % 60;

                    var total = totalHour + ':' + totalMin;

                    if (totalHour > 12) {
                        alert('thoi gian lam ot khong duoc qua 12 tieng!');
                        document.getElementById('checkin').value = "";
                        document.getElementById('checkout').value = "";
                        $('#totalTime').val();
                    } else {
                        $('#totalTime').val(total);
                    }
                } else {
                    alert('Giờ checkout phải lớn hơn giờ checkin!');
                    document.getElementById('checkout').value = "";
                    document.getElementById('checkin').value = "";
                }
            } else {
                alert('Khung giờ làm đêm là từ 18:00 đến 23:59, hoặc 0:00 đến 7:00 của ngày hôm sau!');
                document.getElementById('checkin').value = "";
                document.getElementById('checkout').value = "";
            }
        },
    });

    $('input#checkin').timepicker({
        change: (time) => {
            alert();
        },
    });
</script>
@endpush