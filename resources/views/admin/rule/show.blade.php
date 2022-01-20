@push('styles')
    <link rel="stylesheet" href="{{ asset('css/atomic.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('lib/icofont.min.css') }}">
    <style>
        th {
            text-align: center;
            padding: 24px 10px;
            font-size: 14px;
            border: 1px solid #999999;
        }

        td {
            padding: 16px 10px !important;
            font-size: 14px;
            line-height: 19px;
            color: #4B545C;

        }

        td a {
            font-size: 18px;
            line-height: 18px;
            color: #4B545C;
        }

    </style>
@endpush
<div class="content">
    <table class="" style="width: 100%">
        <thead>
            <tr>
                <th class="bg-light-green">STT</th>
                <th class="bg-light-green">Chức vụ</th>
                <th class="bg-light-green">Tên file</th>
                <th class="bg-light-green text-center">Hiển thị</th>
            </tr>
        </thead>

        <tbody>
            @php($i = 0)
            @forelse ($listFile as $item)
                @php($i++)
                <tr>
                    <td>{{ $i }}</td>
                    <td>
                        {{ isset($levels[$item->level]) ? $levels[$item->level] : '' }}
                    </td>
                    <td>{{ $item->name }}</td>
                    <td class="text-center"><a target="_blank" href="{{ asset(Storage::url($item->url)) }}"><i class="icofont-file-pdf"></i></a>
                    </td>
                    {{-- <td class="text-center"><a href="{{ route('admin.rule.download', [$item->id]) }}"><i class="icofont-file-pdf"></i></a> --}}

                </tr>
            @empty

            @endforelse
        </tbody>
    </table>
</div>
