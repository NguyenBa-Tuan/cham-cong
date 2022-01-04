@push('styles')
    <link rel="stylesheet" href="{{ asset('css/atomic.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('lib/icofont.min.css') }}">
    <style>
        th {
            text-align: center;
            padding-top: 24px;
            padding-bottom: 24px;
        }

        td {
            padding: 16px 10px !important;
            font-size: 16px;
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
    <table class="table-responsive">
        <thead>
            <tr>
                <th class="bg-light-green" style="width: 36px">STT</th>
                <th class="bg-light-green" style="width: 60px">ID</th>
                <th class="bg-light-green" style="width: 60px">USERNAME</th>
                <th class="bg-light-green" style="width: 60px">EMAIL</th>
                <th class="bg-light-green" style="width: 166px">HỌ TÊN</th>
                <th class="bg-light-green" style="width: 134px; white-space:nowrap">SỐ ĐIỆN THOẠI</th>
                <th class="bg-light-green" style="width: 689px">ĐỊA CHỈ</th>
                <th class="bg-light-green" style="width: 132px">NGÀY SINH</th>
                <th class="bg-light-green" style="width: 134px; ">NGÀY VÀO CÔNG TY</th>
                <th class="bg-light-green" style="width: 134px">CHỨC VỤ</th>
                <th class="bg-light-green" style="width: 134px">chỉnh sửa</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($users as $key => $user)
                <tr>
                    <td class="py-17 text-center text-center font-700">{{ $key + 1 }}</td>
                    <td class="py-17 pl-10 font-500 text-center">{{ $user->user_id }}</td>
                    <td class="py-17 pl-10 font-500 text-center">{{ $user->username }}</td>
                    <td class="py-17 pl-10 font-500">{{ $user->email }}</td>
                    <td class="py-17 pl-10 font-500">{{ $user->name }}</td>
                    <td class="py-17 text-center font-400">{{ $user->phone }}</td>
                    <td class="py-17 pl-10 font-400">{{ $user->address }}</td>
                    <td class="py-17 pl-28 font-400">
                        {{ $user->dayOfBirth ? date('d/m/Y', strtotime($user->dayOfBirth)) : '' }}</td>
                    <td class="py-17 pl-28 font-400">
                        {{ $user->dayOfJoin ? date('d/m/Y', strtotime($user->dayOfJoin)) : '' }}</td>
                    <td class="py-17 text-center font-400">{{ \App\Enums\UserLevel::getDescription($user->level) }}
                    </td>
                    <td class="py-17 text-center">
                        <a href="{{ route('admin.user.edit', $user->id) }}"><i class="icofont-pencil-alt-1"></i></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
