@extends('layouts.app')
@section('page')
    <div class="container">
        <div style="margin-top: 50px">
            <form action="{{route('overtime_index_update', $data->id)}}" method="POST">
                @csrf
                <fieldset disabled>
                    <div class="form-group">
                        <label for="project">Project</label>
                        <input type="text" class="form-control" id="project" value="{{$data->projectName}}"  style="cursor: not-allowed">
                    </div>
                    <div class="form-group">
                        <label for="date">Date</label>
                        <input type="date" class="form-control" id="date" value="{{$data->date}}"  style="cursor: not-allowed">
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="checkinDate">Check in date</label>
                                <input type="text" class="form-control" id="checkinDate"
                                       value="{{date('d-m-Y', strtotime($data->checkin))}}"  style="cursor: not-allowed">
                            </div>
                            <div class="col-md-6">
                                <label for="checkinTime">Check in time</label>
                                <input type="text" class="form-control" id="checkinTime"
                                       value="{{date('H:i', strtotime($data->checkin))}}"  style="cursor: not-allowed">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="checkoutDate">Check in date</label>
                                <input type="text" class="form-control" id="checkoutDate"
                                       value="{{date('d-m-Y', strtotime($data->checkout))}}"  style="cursor: not-allowed">
                            </div>
                            <div class="col-md-6">
                                <label for="checkoutTime">Check in time</label>
                                <input type="text" class="form-control" id="checkoutTime"
                                       value="{{date('H:i', strtotime($data->checkout))}}"  style="cursor: not-allowed">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="date">Total time</label>
                        <input type="text" class="form-control" id="date" value="{{$data->totalTime}}"  style="cursor: not-allowed">
                    </div>
                </fieldset>
                <div class="form-group">
                    <label for="">Note</label>
                    <textarea class="form-control" id="" rows="3" name="note">{{$data->note}}</textarea>
                </div>
                <button class="btn btn-primary" type="submit" style="width: 100%; margin-top: 1rem">Submit form</button>
            </form>
        </div>
    </div>
@endsection
