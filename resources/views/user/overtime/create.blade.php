@push('styles')
<!--ico font -->
<link rel="stylesheet" href="{{ asset('lib/icofont.min.css')}}">
{{--<link rel="stylesheet" href="{{ asset('css/lib/jquery.timepicker.min.css')}}">--}}
{{--<link rel="stylesheet" href="{{ asset('css/lib/bootstrap-datetimepicker.min.css')}}">--}}
<link rel="stylesheet" href="{{ asset('css/lib/DateTimePicker.css')}}">
<style>
    .custom-color {
        background-color: #ffffff !important;
    }

    .dtpicker-components .dtpicker-compValue {
        padding: 0 !important;
    }

    /* .checkin_form_fix {
        height: 48px;
        position: absolute;
        left: 0;
        top: 0;
        width: 61%;
        pointer-events: none;
        
    }

    .show_data{
        z-index: 10000 !important;
        display: block !important;
    } */
</style>
@endpush

<div class="tk-content">
    <div class="row">
        <div class="col-md-3">
            <form action="{{route('user_overtime_store')}}" method="POST" id="user_overtime_form" autocomplete="off" class="form-custom">
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
                        <input type="text" data-field="date" class="form-control relative custom-color" id="date" name="date" required data-format="yyyy-MM-dd">
                        <div id="checkin_date"></div>
                        <div class="tk-icon">
                            <i class="icofont-calendar"></i>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="checkin" class="tk-label">Giờ Checkin</label>
                    <div class="relative">
                        <span class="checkin_form_fix"></span>
                        <input type="text" data-field="time" id="checkin" name="checkin" class="form-control relative custom-color" data-format="HH:mm" required>
                        <div id="checkin_form"></div>

                        <div class="tk-icon">
                            <i class="icofont-clock-time"></i>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="checkout" class="tk-label">Giờ Checkout</label>
                    <div class="relative">
                        <input type="text" data-field="datetime" id="checkout" name="checkout" class="form-control relative custom-color" data-format="yyyy-MM-dd hh:mm">
                        <div id="checkout_form"></div>

                        <div class="tk-icon">
                            <i class="icofont-clock-time"></i>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="totalTime" class="tk-label">Tổng thời gian (h)</label>
                    <input class="form-control w-95" id="totalTime" name="totalInput" disabled required style="padding: 13px 26px;">
                </div>
                <div class="form-group">
                    <label for="project" class="tk-label">Dự án đang làm</label>
                    <textarea class="form-control" id="project" name="projectName" rows="3" required placeholder="Dự án"></textarea>
                </div>

                <div class="form-group">
                    <label for="note" class="tk-label">Ghi chú</label>
                    <textarea class="form-control" id="note" rows="3" name="note" placeholder="Nội dung ghi chú"></textarea>
                </div>
                <button class="btn tk-btn" type="submit" id="ot_submit">Đăng ký</button>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script src="{{asset('js/lib/DateTimePicker.js')}}"></script>
<script src="{{asset('js/lib/date.js')}}"></script>
<script src="{{asset('js/user-overtime-fix.js')}}"></script>
@endpush