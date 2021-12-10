@extends('layouts.app')
@section('page')
    <div class="container">
        <div class="dropdown">
            <input class="text-box" type="text" placeholder="Select on" readonly>
            <div class="options">
                @foreach($monthList as $monthItem)
                    <div class="items">
                        <a href="{{route('overtime_index_mount', $monthItem->collect)}}"
                           onclick="show('{{$monthItem->collect}}')">{{$monthItem->collect}}</a>
                    </div>
                @endforeach
            </div>
        </div>

        <table class="table table-bordered">
            <tr>
                <td>Date</td>
                <td colspan="2">Check in</td>
                <td colspan="2">Check out</td>
                <td>Total Time</td>
                <td>Note</td>
            </tr>
            @foreach($data as $d)
                <tr>
                    <td>{{date("d-m-Y", strtotime($d->date))}}</td>
                    <td>{{date('d-m-Y', strtotime($d->checkin))}}</td>
                    <td>{{date('H:i', strtotime($d->checkin))}}</td>

                    <td>{{date('d-m-Y', strtotime($d->checkout))}}</td>
                    <td>{{date('H:i', strtotime($d->checkout))}}</td>
                    <td>{{$d->totalTime}}</td>
                    <td>{{$d->note}}</td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
