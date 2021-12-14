<div class="tk-search" style="display: flex; justify-content: center">
    <div class="tk-search-btn">
        <select class="tk-select">
            <option selected>Tháng 12</option>
            <option>2</option>
        </select>
    </div>
    <hr style="border: 1px solid #4B545C; width: 6px; margin: 22px 5px">
    <div class="tk-search-btn">
        <select class="tk-select">
            <option selected>Năm 2021</option>
            <option>2</option>
        </select>
    </div>

</div>
<div class="tk-table">
    <table class="table table-bordered">
        <tr>
            <td class="tk-title">Ngày</td>
            @foreach($arrDate as $date)
                @foreach($data as $d)
                    @if(date('m', strtotime($d->checkout))==Carbon\Carbon::parse($date)->day)
                    <td class="tk-date">{{date('m', strtotime($d->checkout))}}</td>
                    @else
                        <td class="tk-date">{{Carbon\Carbon::parse($date)->day}}</td>
                    @endif
                @endforeach
            @endforeach
        </tr>
        <tr>

            <td class="tk-title">Thứ</td>


            @foreach($arrDate as $date)
                @if(\App\Enums\Day::getDescription(Carbon\Carbon::parse($date)->dayOfWeek)=='T7' ||\App\Enums\Day::getDescription(Carbon\Carbon::parse($date)->dayOfWeek)=='Cn' )
                    <td class="tk-day bg-light-pink">{{\App\Enums\Day::getDescription(Carbon\Carbon::parse($date)->dayOfWeek)}}</td>
                @else
                    <td class="tk-day bg-light-green">{{\App\Enums\Day::getDescription(Carbon\Carbon::parse($date)->dayOfWeek)}}</td>
                @endif
            @endforeach
        </tr>
        <tr>
            <td class="tk-title">Giờ Checkin</td>

            @foreach($data as $key=>$d)
                <td>{{date('H:i', strtotime($d->checkin))}}</td>
            @endforeach

        </tr>
        <tr>
            <td class="tk-title">Giờ Checkout</td>
            @foreach($data as $d)
                <td>{{date('H:i', strtotime($d->checkout))}}</td>
            @endforeach
        </tr>
        <tr>
            <td class="tk-title">Tổng giờ</td>
            @foreach($data as $d)
                <td>{{$d->totalTime}}</td>
            @endforeach
        </tr>
        <tr>
            <td class="tk-title">Dự án đang làm</td>
            @foreach($data as $d)
                <td>{{$d->projectName}}</td>
            @endforeach
        </tr>
        <tr>
            <td class="tk-title">Ghi chú</td>
            @foreach($data as $d)
                <td>{{$d->note}}</td>
            @endforeach
        </tr>
    </table>
    <div class="mt-60">
        <table class="tk-table w-210 mx-auto">
            <tr>
                <td class="tk-general">Tổng giờ làm đêm</td>
            </tr>
            <tr>
                <td class="bg-light-green"
                    style="padding: 23px 22px; color: #151515; font-weight: 700; font-size: 20px; text-align: center">22
                </td>
            </tr>
        </table>
    </div>
</div>


