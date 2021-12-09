@extends('layouts.app')
@section('page')

    <table class="table table-bordered">
        <tr>
            <td rowspan="2">{{$month->month}}</td>
            @foreach($arrDate as $key=>$value)
                <td>{{Carbon\Carbon::parse($value)->day}}</td>
            @endforeach
            <td rowspan="2">Note</td>
        </tr>
        <tr>
            @foreach($arrDate as $key=>$value)
                <td>{{\App\Enums\Day::getDescription(Carbon\Carbon::parse($value)->dayOfWeek)}}</td>
            @endforeach
        </tr>

        @foreach($users as $user)
            <tr>
                <td>{{$user->name}}</td>
                @foreach($data as $d)
                    @if($d->user_id==$user->id)
                        <td>{{$d->data}}</td>
                    @endif
                @endforeach
                @foreach($note as $n)
                    @if($n->user_id==$user->id)
                        <td>{{$n->note}}</td>
                    @endif
                @endforeach
            </tr>
        @endforeach
    </table>
    <a href="{{route('time_keeping_index')}}">Back to timekeeping sheet</a>
@endsection
