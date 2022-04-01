@push('styles')

<style>
    .tk-table {
        width: 1550px;
    }
</style>
@endpush
<div class="tk-content">
    <div class="tk-search" style="display: flex; justify-content: center">
        <div class="tk-search-btn tk-search-ot">
            <select class="tk-select tk-overtime" name="month">
                @for ($i = 1; $i <= 12; $i++) <option value="{{ $i < 10 ? '0' . $i : $i }}" {{ $i == request()->month ? 'selected' : '' }}>
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

    <div class="data-sheet" style="overflow-x:auto;">
        <table class="tk-table">
            <thead>
                <tr>
                    <td class="tk-title">Ngày</td>
                    @foreach($arrDate as $key=>$value)
                    <td class="tk-date">{{Carbon\Carbon::parse($value)->day}}</td>
                    @endforeach
                </tr>
                <tr>
                    <td class="tk-title w-80">Thứ</td>
                    @foreach ($arrDate as $date)
                    @if (\App\Enums\Day::getDescription(Carbon\Carbon::parse($date)->dayOfWeek) == 'T7' || \App\Enums\Day::getDescription(Carbon\Carbon::parse($date)->dayOfWeek) == 'Cn')
                    <td class="tk-day bg-light-pink">
                        {{ \App\Enums\Day::getDescription(Carbon\Carbon::parse($date)->dayOfWeek) }}
                    </td>
                    @else
                    <td class="tk-day bg-light-green">
                        {{ \App\Enums\Day::getDescription(Carbon\Carbon::parse($date)->dayOfWeek) }}
                    </td>
                    @endif
                    @endforeach
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="tk-title w-80" style="padding: 15px 10px 21px">Time start</td>
                    @foreach ($arrTimeStart as $key => $data)
                    @if ($data == false)
                    <td></td>
                    @else
                    @foreach ($data as $d)
                    <td class="text-center f-14 font-400">{{ date('H:i', strtotime($d)) }}<br></td>
                    @endforeach
                    @endif
                    @endforeach
                </tr>
                <tr>
                    <td class="tk-title w-80" style="padding: 15px 10px 21px">Time End</td>
                    @foreach ($arrTimeEnd as $key => $data)
                    @if ($data == false)
                    <td></td>
                    @else
                    @foreach ($data as $d)
                    <td class="text-center f-14 font-400">{{ date('H:i', strtotime($d)) }}<br></td>
                    @endforeach
                    @endif
                    @endforeach
                </tr>
                <tr>
                    <td class="tk-title w-80" style="padding: 15px 10px 21px">Reason</td>
                    @foreach ($arrReason as $datas)
                    @if ($datas == false)
                    <td></td>
                    @else
                    @foreach ($datas as $data)
                    <td class="text-center f-14 font-400">{{$data}}</td>
                    @endforeach
                    @endif
                    @endforeach
                </tr>
                <tr>
                    <td class="tk-title w-80" style="padding: 15px 10px 21px">Status</td>
                    @foreach ($arrStatus as $datas)
                    @if ($datas == false)
                    <td></td>
                    @else
                    @foreach ($datas as $data)

                    @if($data===1)
                    <td class="text-center f-14" style="color: #3B89CF;">Đã duyệt</td>
                    @elseif($data===2)
                    <td class="text-center f-14" style="color: #F79646;">Chờ duyệt</td>
                    @elseif($data===0)
                    <td class="text-center f-14" style="color: #F44336;">Từ chối</td>
                    @endif

                    @endforeach
                    @endif
                    @endforeach
                </tr>
            </tbody>
        </table>
    </div>
</div>

@push('scripts')

<script>
    $('.tk-search-ot').change(function() {
        let month = $('select[name=month]').val();
        console.log(month);
        let year = $('select[name=year]').val();

        location.assign(`{{ route('user.onleave.index') }}?active=sheet&year=${year}&month=${month}`);
    });
</script>
@endpush