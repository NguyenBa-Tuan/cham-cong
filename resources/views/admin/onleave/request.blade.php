@push('styles')
<link rel="stylesheet" href="{{ asset('css/atomic.css') }}">
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<link rel="stylesheet" href="{{ asset('lib/icofont.min.css') }}">
<style>
    .ol-table {
        width: 1533px;
    }

    .ol-table-head,
    .ol-table-body {
        width: 100%;
    }

    .ol-row {
        display: flex;
        border-top: 1px solid #999999;
        border-bottom: none;
        width: 100%;
    }

    .ol-table-body .ol-row:last-child {
        border-bottom: 1px solid #999999;
    }

    .ol-head {
        background: #DEF5DC;
        padding-top: 17px;
        padding-bottom: 17px;
    }

    .ol-item {
        padding-top: 17px;
        padding-bottom: 17px;
    }

    .ol-head,
    .ol-item {
        border-left: 1px solid #999999;
        border-right: none;
    }

    .ol-head:last-child,
    .ol-item:last-child {
        border-right: 1px solid #999999;
    }

    .ol-form-item {
        padding-right: 20px;
        padding-left: 13px;
        position: relative;
    }

    .ol-form-item::before {
        position: absolute;
        content: '';
        width: 1px;
        height: 100%;
        background: #999999;
        right: 46%;
        top: 0;
    }

    .ol-form {
        display: flex;
        justify-content: space-between;
    }

    .ol-form select {
        width: 98px;
        padding-left: 15px;
        padding-right: 26px;
        -moz-appearance: none;
        -webkit-appearance: none;
        background: url("{{asset('images/dropdown.svg')}}");
        background-repeat: no-repeat;
        background-position-x: 94%;
        background-position-y: 8px;
        cursor: pointer;
        border: none;
    }

    .ol-form select:focus {
        outline: none;
    }

    .ol-form button {
        background: #3B89CF;
        border-radius: 3px;
        color: #FFFFFF;
        font-weight: 500;
        font-size: 16px;
        line-height: 19px;
        width: 64px;
        height: 26px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: none;
        transition: all 300ms ease-in-out;
    }

    .ol-form button:hover {
        background: white;
        color: #3B89CF;
        border: 1px solid #3B89CF;
    }

    .content {
        min-height: 530px;
    }

    @media screen and (max-width: 1440px) {
        .responsive-scroll-x {
            overflow: scroll;
        }
    }
</style>
@endpush
<div class="content">
    @if (session()->has('status'))
    <div class="alert alert-success alert-block">
        {{ session()->get('status') }}
    </div>
    @endif
    @if(count($request_employee)==0)
    <p>Không có yêu cầu xin nghỉ phép của nhân viên.</p>
    @else
    <div class="responsive-scroll-x">

        <div class="ol-table">
            <div class="ol-table-head">
                <div class="ol-row">
                    <div class="ol-head text-center" style="width: 35px;">STT</div>
                    <div class="ol-head text-center" style="width: 166px;">Họ tên</div>
                    <div class="ol-head text-center" style="width: 15%;">Giờ, ngày bắt đầu xin nghỉ</div>
                    <div class="ol-head text-center" style="width: 15%;">Giờ, ngày kết thúc xin nghỉ</div>
                    <div class="ol-head text-center" style="width: 21%;">Lý do xin nghỉ</div>
                    <div class="ol-head text-center" style="width: 21%;">Dự án đang làm</div>
                    <div class="ol-head text-center" style="width: 8%;">Trạng thái</div>
                    <div class="ol-head text-center" style="width: 7%;">Phê duyệt</div>
                </div>
            </div>

            <div class="ol-table-body">@php($i=1)
                @foreach($request_employee as $item)
                <div class="ol-row">
                    <div class="ol-item text-center" style="width: 35px;">{{$i++}}</div>
                    <div class="ol-item pl-10" style="width: 166px;">{{$item->user->name}}</div>
                    <div class="ol-item text-center" style="width: 15%;">{{Carbon\Carbon::parse($item->timeStart)->format('H:i, d-m-Y');}}</div>
                    <div class="ol-item text-center" style="width: 15%;">{{Carbon\Carbon::parse($item->timeEnd)->format('H:i, d-m-Y');}}</div>
                    <div class="ol-item pl-10" style="width: 21%;">{{$item->reason}}</div>
                    <div class="ol-item pl-10" style="width: 21%;">{{$item->ongoing}}</div>
                    <div class="ol-item ol-form-item" style="width: 15%;">
                        <form action="{{route('admin.onleave.update', $item->id)}}" method="POST" class="ol-form">
                            @csrf
                            <select name="status">
                                <option value="1">Duyệt</option>
                                <option value="0">Từ chối</option>
                            </select>
                            <button type="submit">Duyệt</button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif
</div>