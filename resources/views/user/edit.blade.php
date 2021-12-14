@extends('layouts.app')
@section('page')
    <div class="container">
        <h1 style="font-size: 30px; margin-top: 50px; text-align: center">Edit information</h1>
        <form action="{{route('user_update')}}" method="POST">
            @if ($errors->any())
                <div class="alert alert-danger alert-block">
                    <ul style="margin: 0; list-style-type: none; padding: 0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" placeholder="Name" name="name"
                       value="{{$user->name}}">
            </div>

            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" class="form-control" id="address" placeholder="Address" name="address"
                       value="{{$user->address}}">
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="dayOfBirth">Name</label>
                        <input type="date" class="form-control" id="dayOfBirth" placeholder="Day of Birth"
                               name="dayOfBirth" value="{{$user->dayOfBirth}}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="dayOfJoin">Day of Join</label>
                        <input type="date" class="form-control" id="dayOfJoin" placeholder="password" name="dayOfJoin"
                               value="{{$user->dayOfJoin}}">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" class="form-control" id="phone" placeholder="phone" name="phone"
                       value="{{$user->phone}}">
            </div>

            <div class="form-group">
                <label for="level">Level</label>
                <select class="form-control" id="level" name="level">
                    @foreach($levels as $key=>$level)
                        <option value="{{$key}}">{{$level}}</option>
                    @endforeach
                </select>
            </div>

            <button class="btn btn-primary" type="submit" style="width: 100%; margin-top: 1rem">Create User</button>
        </form>

        <a href="{{route('adminUserIndex')}}">Back</a>
    </div>
@endsection
