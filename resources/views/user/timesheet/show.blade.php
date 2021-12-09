@extends('layouts.app')
@section('page')
    <p>{{$month->month}}</p>
    <table class="table table-bordered">
        <tr>
            @foreach($arrDate as $key=>$value)
                <td>{{Carbon\Carbon::parse($value)->day}}</td>
            @endforeach
            <td>Note</td>
        </tr>
        <tr>
            @foreach($arrDate as $key=>$value)
                <td>{{\App\Enums\Day::getDescription(Carbon\Carbon::parse($value)->dayOfWeek)}}</td>
            @endforeach
        </tr>
        <tr>
            @foreach($data as $d)
                <td>{{$d->data}}</td>
            @endforeach
            <td>
                @foreach($note as $n)
                    {{$n->note}}
                @endforeach
            </td>
        </tr>
    </table>
@endsection
