@extends('layouts.app')
@section('page')
    <table class="table table-bordered">
        <tr>
            @foreach($month as $m)
                <td>
                    <a href="{{route('user_timesheet_show', $m->id)}}">
                        {{$m->month}}
                    </a>
                </td>
            @endforeach
        </tr>
    </table>
    <a href="{{route('user_index')}}">Back to Dashboard</a>
@endsection

