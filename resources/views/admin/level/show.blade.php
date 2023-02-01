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

        .download {
            font-size: 20px;
            color: red;
        }

        .download:hover {
            color: #f28484;
        }

        .edit {
            font-size: 20px;
            color: rgb(0, 160, 0);
        }

        .edit:hover {
            color: rgb(117, 173, 137)
        }

    </style>
@endpush
<div class="content" style="overflow: auto">
    <table class="" style="width: 100%">
        <thead>
            <tr>
                <th class="bg-light-green">STT</th>
                <th class="bg-light-green">Chức vụ</th>
                <th class="bg-light-green text-center">Action</th>
            </tr>
        </thead>

        <tbody>
            @php($i = 0)
            @forelse ($levels as $item)
                @php($i++)
                <tr>
                    <td class="text-center">{{ $i }}</td>
                    <td>
                        {{ $item->name }}
                    </td>
                    <td >

                        <div style="display:inline-block; width: 40%;">
                            <a class="edit ml-1" href="{{ route('admin.level.edit', $item->id) }}"><i
                                    class="icofont-edit"></i></a>
                        </div>
                    </td>
                    {{-- <td class="text-center"><a href="{{ route('admin.rule.download', [$item->id]) }}"><i class="icofont-file-pdf"></i></a> --}}

                </tr>
            @empty

            @endforelse
        </tbody>
    </table>
</div>
