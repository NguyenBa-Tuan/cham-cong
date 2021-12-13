@extends('layouts.app')
@section('page')
    <div class="container" style="margin-top: 250px">
        <h1 style="text-align: center; font-size: 30px">Login</h1>
        <form action="{{route('login_check')}}" method="POST">
            @csrf
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" placeholder="Enter your email" name="email">
            </div>
            <div class="form-group">
                <label for="pwd">Password:</label>
                <input type="password" class="form-control" id="pwd" placeholder="Enter your password" name="password">
            </div>
            @if (session()->has('alert'))
                <div class="alert alert-danger alert-block">
                    {{ session()->get('alert')  }}
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger alert-block">
                    <ul style="margin: 0; list-style-type: none; padding: 0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <button type="submit" class="btn btn-primary" style="width: 100%">Submit</button>
        </form>
    </div>
@endsection
