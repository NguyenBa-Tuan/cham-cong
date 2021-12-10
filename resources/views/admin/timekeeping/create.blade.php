@extends('layouts.app')

@section('page')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="container">
        <div class="card bg-light mt-3">
            <div class="card-header">
                Laravel 8 Import Export Excel to database Example - ItSolutionStuff.com
            </div>
            <div class="card-body">
                <form action="{{ route('time_keeping_import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <label for="">Excel file</label>
                    <input type="file" name="file" class="form-control">
                    <label for="">Month</label>
                    <input type="month" name="month" class="form-control">
                    <button class="btn btn-success" style="margin-top: 30px">Import User Data</button>
                </form>
            </div>
        </div>
    </div>
    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif
    @if (session()->has('warning'))
        <div class="alert alert-warning alert-block">
           {{ session()->get('warning')  }}
        </div>
    @endif
    <a href="{{route('time_keeping_index')}}">Back to timekeeping sheet</a>
@endsection
