@push('styles')
<link rel="stylesheet" href="{{ asset('css/style.css')}}">
<link rel="stylesheet" href="{{ asset('css/atomic.css')}}">
<link rel="stylesheet" href="{{ asset('css/custom-bootstrap4.css')}}">
<style>
    .tk-table td {
        padding-left: 10px;
        padding-right: 10px;
    }
</style>
@endpush
<div class="tk-content">
    <div class="tk-search" style="display: flex; justify-content: center">
        <div class="tk-search-btn tk-search-ot">
            <select class="tk-select tk-overtime" name="month">
                @for ($i = 1; $i <= 12; $i++) <option value="{{($i<10) ? '0' . $i : $i}}" {{ $i == request()->month ? 'selected' : '' }}>
                    Tháng {{ $i }}</option>
                    @endfor
            </select>
        </div>
        <hr style="border: 1px solid #4B545C; width: 6px; margin: 22px 5px; height: 0">
        <div class="tk-search-btn tk-search-ot">
            <select class="tk-select tk-overtime" name="year">
                @foreach ($listYear as $item)
                <option value="{{ $item }}" {{ $item == request()->year ? 'selected' : '' }}>
                    Năm {{ $item }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="tk-table">
        <div class="table-responsive">
            <table class="table-bordered">
                <tr>
                    <td class="tk-title w-80">Ngày</td>
                    @foreach($arrDate as $date)
                    <td class="tk-date">{{date('d', strtotime($date))}}</td>
                    @endforeach
                </tr>

                <tr>
                    <td class="tk-title w-80">Thứ</td>
                    @foreach($arrDate as $date)
                    @if(\App\Enums\Day::getDescription(Carbon\Carbon::parse($date)->dayOfWeek)=='T7' ||\App\Enums\Day::getDescription(Carbon\Carbon::parse($date)->dayOfWeek)=='Cn' )
                    <td class="tk-day bg-light-pink">{{\App\Enums\Day::getDescription(Carbon\Carbon::parse($date)->dayOfWeek)}}</td>
                    @else
                    <td class="tk-day bg-light-green">{{\App\Enums\Day::getDescription(Carbon\Carbon::parse($date)->dayOfWeek)}}</td>
                    @endif
                    @endforeach
                </tr>
                <tr>
                    <td class="tk-title w-80" style="padding: 15px 14px 21px 15px">Giờ Checkin</td>
                    @foreach($arrCheckin as $key=>$data)
                    @if($data==false)
                    <td></td>
                    @else
                    @foreach($data as $d)
                    <td class="text-center f-14 font-400">{{date('H:i', strtotime($d))}}<br></td>
                    @endforeach
                    @endif
                    @endforeach

                </tr>
                <tr>
                    <td class="tk-title w-80" style="padding: 15px 10px 21px">Giờ Checkout</td>
                    @foreach($arrCheckout as $key=>$data)
                    @if($data==false)
                    <td></td>
                    @else
                    @foreach($data as $d)
                    <td class="text-center f-14 font-400">{{date('H:i', strtotime($d))}}<br></td>
                    @endforeach
                    @endif
                    @endforeach
                </tr>
                <tr>
                    <td class="tk-title w-80" style="padding: 15px 12px 21px 10px">Tổng thời gian</td>
                    @foreach($arrTotalTime as $key=>$data)
                    @if($data==false)
                    <td></td>
                    @else
                    @foreach($data as $d)
                    <td class="text-center f-14 font-700">{{date('H:i', strtotime($d))}}<br></td>
                    @endforeach
                    @endif
                    @endforeach
                </tr>
                <tr>
                    <td class="tk-title w-80" style="padding: 15px 10px 21px 9px">Dự án đang làm</td>
                    @foreach($arrProjectName as $key=>$data)
                    @if($data==false)
                    <td></td>
                    @else
                    @foreach($data as $d)
                    <td class="text-center f-14 font-400">{{$d}}<br></td>
                    @endforeach
                    @endif
                    @endforeach
                </tr>
                <tr>
                    <td class="tk-title w-80" style="padding: 26px 16px 27px 15px">Ghi chú</td>
                    @foreach($arrNote as $key=>$data)
                    @if($data==false)
                    <td></td>
                    @else
                    @foreach($data as $d)
                    <td class="text-center f-14 font-400">{{$d}}<br></td>
                    @endforeach
                    @endif
                    @endforeach
                </tr>
            </table>
        </div>
    </div>
    <div class="mt-60">
        <table class="tk-table w-210 mx-auto">
            <tr>
                <td class="tk-general font-700 f-18 line-h-21">Tổng giờ làm đêm</td>
            </tr>
            <tr>
                <td class="bg-light-green" style="padding: 23px 22px; color: #151515; font-weight: 700; font-size: 20px; text-align: center">
                    {{$getTotal}}
                </td>
            </tr>
        </table>
    </div>
</div>

@push('scripts')
<script>
    $('.tk-search-ot').change(function() {
        let month = $('select[name=month]').val();
        console.log(month);
        let year = $('select[name=year]').val();

        location.assign(`{{ route('user_overtime') }}?active=sheet&year=${year}&month=${month}`);
    });
</script>
@endpush