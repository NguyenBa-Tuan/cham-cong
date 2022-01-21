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

        .delete {
            font-size: 20px;
            color: #f61700;
        }

        .delete:hover {
            color: #f28484;
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
                <th class="bg-light-green text-center">Áction</th>
            </tr>
        </thead>

        <tbody>
            @php($i = 0)
            @forelse ($listFile as $item)
                @php($i++)
                <tr>
                    <td class="text-center">{{ $i }}</td>
                    <td>
                        {{ $item->level->name ?? '' }}
                    </td>
                    <td>{{ $item->name }}</td>
                    <td class="text-center">
                        <a target="_blank" class="download" href="{{ asset(Storage::url($item->url)) }}"><i
                                class="icofont-file-pdf"></i></a>
                        <a class="delete ml-1" href="#" data-id="{{ $item->id }}"><i
                                class="icofont-ui-delete"></i></a>
                    </td>
                    {{-- <td class="text-center"><a href="{{ route('admin.rule.download', [$item->id]) }}"><i class="icofont-file-pdf"></i></a> --}}

                </tr>
            @empty

            @endforelse
        </tbody>
    </table>
</div>

@push('scripts')
    <script>
        $('.delete').click(function() {
            var $parent = $(this).parent().parent();
            if (confirm('Dữ liệu đã xóa không thể phục hồi, vẫn tiếp tục ?')) {
                $.ajax({
                    url: `{{ route('admin.rule.index') }}/${ $(this).data('id') }`,
                    method: 'POST',
                    dataType: 'json',
                    data: {
                        _token: '{{ csrf_token() }}',
                        _method: 'DELETE',
                    },
                    success: function(data) {
                        $parent.css('background', '#e7414121');
                        setTimeout(() => {
                            $parent.remove();
                        }, 300);
                    },
                    error: function(data) {
                        alert('Xóa không thất bại!');
                    },
                });
            }
        })
    </script>
@endpush
