@extends('layouts.app')
@section('page')
    <table class="table table-bordered">
        <tr>
            <td rowspan="2">{{$month->month}}</td>
            @foreach($arrDate as $key=>$value)
                <td>{{Carbon\Carbon::parse($value)->day}}</td>
            @endforeach
        </tr>
        <tr>
            @foreach($arrDate as $key=>$value)
                <td>{{\App\Enums\Day::getDescription(Carbon\Carbon::parse($value)->dayOfWeek)}}</td>
            @endforeach
        </tr>

        @foreach($users as $user)
            <tr>
                <td>
                    {{$user->name}}
                </td>
                @foreach($data as $d)
                    <td>{{$d->data}}</td>
                @endforeach
            </tr>
        @endforeach

    </table>
    <a href="{{route('time_keeping_index')}}">Back to timekeeping sheet</a>
@endsection
