@extends('layouts.app')
@section('page-name', 'Chấm công hành chính')
@section('page')
<a href="{{route('user_edit')}}">Edit</a>
<a href="{{route('user_timesheet')}}" style="margin-left: 20px">Timesheet</a>
<p>{{$user->name}}</p>
<p>{{$user->phone}}</p>
<p>{{$user->address}}</p>
<p>{{$user->dayOfBirth}}</p>
<p>{{$user->dayOfJoin}}</p>
<p>{{\App\Enums\UserLevel::getDescription($user->level)}}</p>
<a href="{{route('logout')}}">Logout</a>
@endsection
