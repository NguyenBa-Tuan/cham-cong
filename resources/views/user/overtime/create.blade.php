@push('styles')
    <link rel="stylesheet" href="{{ asset('css/style.css')}}">
    <link rel="stylesheet" href="{{ asset('css/atomic.css')}}">
    <link rel="stylesheet" href="{{ asset('css/custom-bootstrap4.css')}}">
    <!--ico font -->
    <link rel="stylesheet" href="{{ asset('lib/icofont.min.css')}}">
@endpush

<div class="tk-content">

    <div class="row">
        <div class="col-md-3">
            <form action="{{route('user_overtime_store')}}" method="POST" id="user_overtime_form">
                @csrf
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
                        <input type="time" class="form-control relative" id="checkin" name="checkin" required>
                        <div class="tk-icon">
                            <i class="icofont-clock-time"></i>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="checkout" class="tk-label">Giờ Checkout</label>
                    <div class="relative">
                        <input type="time" class="form-control" id="checkout" name="checkout" required>
                        <div class="tk-icon">
                            <i class="icofont-clock-time"></i>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="totalTime" class="tk-label">Tổng thời gian (h)</label>
                    <input type="text" class="form-control w-95" id="totalTime" name="projectName" disabled required
                           style="padding: 13px 26px;">
                </div>
                <div class="form-group">
                    <label for="project" class="tk-label">Dự án đang làm</label>
                    <textarea class="form-control" id="project" name="projectName" rows="3" required
                              placeholder="Dự án"></textarea>
                </div>

                <div class="form-group">
                    <label for="note" class="tk-label">Ghi chú</label>
                    <textarea class="form-control" id="note" rows="3" name="note"
                              placeholder="Nội dung ghi chú"></textarea>
                </div>
                <button class="btn tk-btn" type="submit">Đăng ký</button>
            </form>
        </div>
    </div>
</div>
