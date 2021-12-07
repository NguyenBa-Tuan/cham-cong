@extends('layouts.app')
@section('page')
    <table class="table table-bordered">

        @foreach($data as $d)

            <tr>
                @foreach($d->timesheet->pluck('date') as $date)
                    <td> {{$date}}</td>
                @endforeach
            </tr>
            <tr>
                @foreach($d->timesheet->pluck('data') as $data)
                    <td>{{$data ?? 'null'}}</td>
                @endforeach
                <td>
                    {{$check->note->note}}
                </td>
            </tr>
        @endforeach
    </table>
    <a href="{{route('user_index')}}">Back to Dashboard</a>
@endsection

