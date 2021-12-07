@extends('layouts.app')
@section('page')
    <table class="table">
        @foreach($users as $user)
            <tr>
                <td><td>{{$user->timesheet->pluck('date')}}</td></td>
            </tr>
            <tr>
                <td>    {{$user->name}}</td>
                <td>{{$user->timesheet->pluck('data')}}</td>
            </tr>
        @endforeach
    </table>

@endsection
