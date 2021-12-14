@extends('admin.app')
@section('active_overtime', 'active')
@section('header_content', 'Chấm công làm đêm')

@section('content')
    <div class="page">
        <div class="content">
            <div class="container">
                <div class="dropdown">
                    <input class="text-box" type="text" placeholder="Select on" readonly>
                    <div class="options">
                        @foreach ($monthList as $monthItem)
                            <div class="items">
                                <a href="{{ route('overtime_index_mount', $monthItem->collect) }}"
                                    onclick="show('{{ $monthItem->collect }}')">{{ $monthItem->collect }}</a>
                            </div>
                        @endforeach
                    </div>
                </div>
                <table class="table table-bordered">
                    <tr>
                        <td>User</td>
                        <td>Date</td>
                        <td colspan="2">Check in</td>
                        <td colspan="2">Check out</td>
                        <td>Total Time</td>
                        <td colspan="2">Note</td>
                    </tr>
                    @foreach ($data as $d)
                        <tr>
                            <td>{{ $d->overtimeUser->name }}</td>
                            <td>{{ date('d-m-Y', strtotime($d->date)) }}</td>
                            <td>{{ date('d-m-Y', strtotime($d->checkin)) }}</td>
                            <td>{{ date('H:i', strtotime($d->checkin)) }}</td>

                            <td>{{ date('d-m-Y', strtotime($d->checkout)) }}</td>
                            <td>{{ date('H:i', strtotime($d->checkout)) }}</td>
                            <td>{{ $d->totalTime }}</td>
                            <td>{{ $d->note }}</td>
                            <td>
                                <a href="{{ route('overtime_index_edit', $d->id) }}">Edit Note</a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection
