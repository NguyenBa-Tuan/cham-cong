@extends('layouts.app')
@section('page')
    <div class="container">
        <div style="margin-top: 50px">
            <form action="{{route('user_overtime_store')}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="project">Project</label>
                    <input type="text" class="form-control" id="project" name="projectName">
                </div>
                <div class="form-group">
                    <label for="date">Date</label>
                    <input type="date" class="form-control" id="date" name="date">
                </div>
                <div class="form-group">
                    <label for="checkin">Check in</label>
                    <input type="datetime-local" class="form-control" id="checkin" name="checkin">
                </div>
                <div class="form-group">
                    <label for="checkout">Check out</label>
                    <input type="datetime-local" class="form-control" id="checkout" name="checkout">
                </div>

                <div class="form-group">
                    <label for="">Note</label>
                    <textarea class="form-control" id="" rows="3" name="note"></textarea>
                </div>
                <button class="btn btn-primary" type="submit" style="width: 100%; margin-top: 1rem">Submit form</button>
            </form>
        </div>
    </div>
@endsection
