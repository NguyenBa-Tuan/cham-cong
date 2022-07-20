<link rel="stylesheet" href="{{ asset('css/atomic.css') }}">
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<link rel="stylesheet" href="{{ asset('lib/icofont.min.css') }}">
<style>
    .ol-table-show th {
        background: #DEF5DC;
        border-right: 1px solid #999999;
        font-weight: 700;
        font-size: 14px;
        line-height: 16px;
        text-align: center;
        padding: 8px 0;
    }

    .ol-table-show th:last-child {
        border-right: none;
    }

    .ol-table-show td {
        height: 68px;
        color: #4B545C;
        font-weight: 400;
        font-size: 16px;
        line-height: 19px;
    }

    .text-left-11 {
        padding-left: 11px;
    }

    .responsive-scroll-x {
        width: 100%;
    }

    .ol-data {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 67px;
    }

    .ol_update {
        background-color: #F44336;
        color: #FFFFFF;
        height: 100%;
        padding-top: 13px;
        transition: all 300ms ease-in-out;
    }

    .ol_update_accept{
        background: #3B89CF;
    }

    .ol_update:hover {
        color: red;
        background-color: #FFFFFF;
    }

    .ol_update_accept:hover{
        color: #3B89CF;
    }

    @media screen and (max-width: 1440px) {
        .responsive-scroll-x {
            overflow: scroll;

        }

        .ol-table-show {
            width: 1533px;
        }
    }

    .ol-table-show tr a i {
        color: #4B545C;
    }

    /*modal*/
    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgb(0, 0, 0);
        background-color: rgba(0, 0, 0, .4);
        z-index: 100000;
    }

    .modal-content {
        background-color: #fefefe;
        margin: auto;
        padding: 25px 20px 20px;
        border: 1px solid #888;
        width: 500px;
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
    }

    .modal-content>span {
        position: absolute;
        top: 20px;
        right: 20px;
    }

    .modal-content form input,
    .modal-content form textarea,
    .modal-content form select {
        width: 100%;
    }

    .modal-content form textarea {
        resize: none;
    }

    .modal-content form select {
        background: url("{{asset('images/dropdown.svg')}}");
        background-repeat: no-repeat;
        background-position-x: 98%;
        background-position-y: 14px;
        cursor: pointer;
    }

    .modal-content form button {
        width: 100%;
        background: #3B89CF;
        border-radius: 3px;
        color: #FFFFFF;
        text-align: center;
        font-weight: 700;
        font-size: 18px;
        line-height: 21px;
        padding-top: 13px;
        padding-bottom: 12px;
        border: 1px solid #3B89CF;
        transition: all 400ms ease-in-out;
        /* margin-top: 25px; */
    }

    .modal-content form button:focus {
        outline: none;
    }

    .modal-content form button:hover {
        border: 1px solid #3B89CF;
        background: #FFFFFF;
        color: #3B89CF;
    }

    .modal-content form label {
        display: block;
        text-align: left;
    }

    .close {
        color: #aaaaaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
    }


    .day {
        width: 49px;
    }

    .name {
        min-width: 180px;
    }

    .number {
        width: 35px;
    }

    @media screen and (max-width: 540px) {
        .modal-content {
            width: 320px;
        }
    }
</style>
<div class="content">
    <div class="dropdown">
        <div class="text-center d-flex" style="justify-content: center">
            <select name="month" class="form-select form-month">
                @for ($i = 1; $i <= 12; $i++) <option value="{{ $i < 10 ? '0' . $i : $i }}" {{ $i == request()->month ? 'selected' : '' }}>Tháng
                    {{ $i }}
                    </option>
                    @endfor
            </select>
            <hr style="border: 1px solid #4B545C; width: 6px; margin: 22px 5px; opacity: 1;box-sizing: border-box;">
            <select name="year" class="form-select form-month">
                @forelse ($listYear as $item)
                <option value="{{ $item }}" {{ $item == request()->year ? 'selected' : '' }}>Năm
                    {{ $item }}
                </option>
                @empty

                @endforelse
            </select>
        </div>
    </div>
    @if(count($listOnleaveAccept)==0)
    <div class="mt-25">
        <p>Tháng này không có dữ liệu.</p>
    </div>
    @else

    <div class="mt-25">
        @if (session()->has('success'))
        <div class="alert alert-success alert-block">
            {{ session()->get('success') }}
        </div>
        @endif
        <div class="responsive-scroll-x">
            <table id="table1" class="ol-table-show">
                <thead>
                    <tr>
                        <th rowspan="2" class="number">STT</th>
                        <th rowspan="2" class="name">Họ tên</th>
                        @foreach ($arrDate as $item)
                        <th class="day">{{ $item['day'] }}</th>
                        @endforeach
                    </tr>
                    <tr>
                        @foreach ($arrDate as $item)
                        <th class="unset-border-top {{ in_array($item['day_of_week'], ['T7', 'CN']) ? 'weekend' : 'not-weekend' }}">
                            {{ $item['day_of_week'] }}
                        </th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @php($i=1)
                    @foreach($listUser as $idUser=>$itemUser)
                    <tr>
                        <td class="text-center">{{$i++}}</td>
                        <td class="name pl-10">{{$itemUser}}</td>
                        @foreach ($arrDate as $itemDate)
                        @if(isset($arrData[$idUser][$itemDate['date']]))
                        <td class="text-center ol-data">
                            <div class="modal">
                                <div class="modal-content">
                                    <span class="close">&times;</span>
                                    <form class="form-group" action="{{route('admin.onleave.update', $arrData[$idUser][$itemDate['date']]['id'])}}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label>Họ tên</label>
                                            <input type="text" value="{{$arrData[$idUser][$itemDate['date']]['name']}}" disabled readonly class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Thời gian bắt đầu nghỉ</label>
                                            <input type="text" value="{{Carbon\Carbon::parse($arrData[$idUser][$itemDate['date']]['timeStart'])->format('H:i, d-m-Y')}}" disabled readonly class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Thời gian kết thúc nghỉ</label>
                                            <input type="text" value="{{Carbon\Carbon::parse($arrData[$idUser][$itemDate['date']]['timeEnd'])->format('H:i, d-m-Y')}}" disabled readonly class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Lý do nghỉ</label>
                                            <textarea rows="2" disabled readonly class="form-control">{{$arrData[$idUser][$itemDate['date']]['reason']}}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Dự án đang làm</label>
                                            <textarea rows="2" disabled readonly class="form-control">{{$arrData[$idUser][$itemDate['date']]['ongoing']}}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Trạng thái</label>
                                            <select name="status" class="form-control">
                                                @if($arrData[$idUser][$itemDate['date']]['status']===0)
                                                <option selected disabled hidden>Từ chối</option>
                                                @elseif($arrData[$idUser][$itemDate['date']]['status']===1)
                                                <option selected disabled hidden>Đã duyệt</option>
                                                @endif
                                                <option value="0">Từ chối</option>
                                                <option value="1">Đã duyệt</option>
                                            </select>
                                        </div>
                                        <button type="submit">Thay đổi</button>
                                    </form>
                                </div>
                            </div>
                            @if($arrData[$idUser][$itemDate['date']]['status']==1)

                            <a href="javascript:void(0)" title="Đã duyệt" class="ol_update ol_update_accept">Đã duyệt</a>

                            @elseif($arrData[$idUser][$itemDate['date']]['status']==0)

                            <a href="javascript:void(0)" title="Từ chối" class="ol_update">Từ chối</a>

                            @endif
                        </td>
                        @else
                        <td></td>
                        @endif

                        @endforeach
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @endif
</div>
@push('scripts')
<script>
    $(document).ready(function() {
        $('.form-month').change(function() {
            let month = $('select[name=month]').val();
            let year = $('select[name=year]').val();
            location.assign(`{{ route('admin.onleave.index') }}?active=sheet&year=${year}&month=${month}`)
        });
    });

    //modal
    $(document).ready(function() {

        var count_data = $('#count_data');

        var modal = $('.modal');
        var btn = $('.ol_update');
        var span = $('.close');

        // btn.on(click, function() {
        //     $(this).parents('ol_tr').find('.modal').show();
        // });

        btn.click(function() {
            // console.log($(this).parents('.ol_tr').find('.modal'));
            // modal.show();
            $(this).parent().find('.modal').show();
        });

        span.click(function() {
            modal.hide();
        });

        $(window).on('click', function(e) {
            if ($(e.target).is('.modal')) {
                modal.hide();
            }
        });
    });
</script>
@endpush