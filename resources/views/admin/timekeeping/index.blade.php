@extends('layouts.app')
@section('page')

    <table class="table">
        <tr>
            @foreach($month as $m)
                <td>
                    <a href="{{route('time_keeping_show', $m->id)}}">{{$m->month}}</a>
                </td>
            @endforeach
        </tr>
    </table>
    <a href="{{route('time_keeping_create')}}">upload sheet</a>
@endsection
