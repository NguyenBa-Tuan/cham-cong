@extends('layouts.app')

@section('page')
    <div class="container">
        <div class="card bg-light mt-3">
            <div class="card-header">
                Laravel 8 Import Export Excel to database Example - ItSolutionStuff.com
            </div>
            <div class="card-body">
                <form action="{{ route('time_keeping_import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="file" class="form-control">
                    <br>
{{--                    <input type="month" name="month">--}}
                    <button class="btn btn-success">Import User Data</button>
                    {{--                    <a class="btn btn-warning" href="{{ route('time_keeping_export') }}">Export User Data</a>--}}
                </form>
            </div>
        </div>
    </div>
    <div class="container">
        <table class="table table-bordered">

{{--            <tr>--}}
{{--                @foreach($datas as $d)--}}
{{--                    <td>{{$d->date}}</td>--}}
{{--                @endforeach--}}
{{--            </tr>--}}
{{--            <tr>--}}
{{--                @foreach($datas as $d)--}}
{{--                    <td>{{\App\Enums\Day::getDescription($d->day->day)}}</td>--}}
{{--                @endforeach--}}
{{--            </tr>--}}


        </table>
    </div>
@endsection
