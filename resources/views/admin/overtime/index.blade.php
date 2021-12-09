@extends('layouts.app')
@section('page')
    <div class="container">
        <div class="input-group mb-3">
            <select class="custom-select" id="inputGroupSelect02">
                <option selected>Choose...</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
            </select>
            <div class="input-group-append">
                <label class="input-group-text" for="inputGroupSelect02">Select month</label>
            </div>
        </div>

        <table class="table table-bordered">
            <tr>
                <td>User</td>
                <td>Date</td>
                <td colspan="2">Check in</td>
                <td colspan="2">Check out</td>
                <td>Total Time</td>
                <td colspan="2">Note</td>
            </tr>
            @foreach($data as $d)
                <tr>
                    <td>{{$d->overtimeUser->name}}</td>
                    <td>{{date("d-m-Y", strtotime($d->date))}}</td>
                    <td>{{date('d-m-Y', strtotime($d->checkin))}}</td>
                    <td>{{date('H:i', strtotime($d->checkin))}}</td>

                    <td>{{date('d-m-Y', strtotime($d->checkout))}}</td>
                    <td>{{date('H:i', strtotime($d->checkout))}}</td>
                    <td>{{$d->totalTime}}</td>
                    <td>{{$d->note}}</td>
                    <td>
                        <a href="{{route('overtime_index_edit', $d->id)}}">Edit Note</a>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
