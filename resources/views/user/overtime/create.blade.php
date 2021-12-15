{{--@extends('layouts.app')--}}
{{--@section('page')--}}
<<<<<<< HEAD
    <div class="row">
        <div class="col-md-3">
            <form action="{{route('user_overtime_store')}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="date">Ngày</label>
                    <input type="date" class="form-control" id="date" name="date">
                </div>
                <div class="form-group">
                    <label for="project">Project</label>
                    <input type="text" class="form-control" id="project" name="projectName">
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="checkin">Check in</label>
                            <input type="datetime-local" class="form-control" id="checkin" name="checkin">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="checkout">Check out</label>
                            <input type="datetime-local" class="form-control" id="checkout" name="checkout">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Note</label>
                    <textarea class="form-control" id="" rows="3" name="note"></textarea>
                </div>
                <button class="btn btn-primary" type="submit" style="width: 100%; margin-top: 1rem">Xong</button>
            </form>
        </div>
    </div>
=======
<div class="row">
    <div class="col-md-3">
        <form action="{{route('user_overtime_store')}}" method="POST">
            @csrf
            <div class="form-group">
                <label for="date" class="tk-label">Ngày</label>
                <input type="date" class="form-control" id="date" name="date">
                <i class="icofont-calendar"></i>
            </div>
            <div class="form-group">
                <label for="checkin" class="tk-label">Giờ Checkin</label>
                <input type="datetime-local" class="form-control" id="checkin" name="checkin">
            </div>
            <div class="form-group">
                <label for="checkout" class="tk-label">Giờ Checkout</label>
                <input type="datetime-local" class="form-control" id="checkout" name="checkout">
            </div>

            <div class="form-group">
                <label for="project" class="tk-label">Tổng thời gian (h)</label>
                <input type="text" class="form-control" id="project" name="projectName" disabled>
            </div>
            <div class="form-group">
                <label for="project" class="tk-label">Dự án đang làm</label>
                <textarea class="form-control" id="project" name="projectName" rows="3" placeholder="Dự án"></textarea>
            </div>

            <div class="form-group">
                <label for="note" class="tk-label">Ghi chú</label>
                <textarea class="form-control" id="note" rows="3" name="note" placeholder="Nội dung ghi chú"></textarea>
            </div>
            <button class="btn btn-primary" type="submit" style="width: 100%; margin-top: 1rem">Xong</button>
        </form>
    </div>
</div>
>>>>>>> 7cb24b7 (fe user)
{{--@endsection--}}
