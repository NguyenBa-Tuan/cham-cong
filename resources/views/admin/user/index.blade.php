@extends('admin.app')
@section('aside_user', 'active')
@section('header_content', 'Thông tin cá nhân')
@push('styles')
    <link rel="stylesheet" href="{{asset('css/atomic.css')}}">
    <link rel="stylesheet" href="{{asset('css/atomic.css')}}">
    <link rel="stylesheet" href="{{asset('lib/icofont.min.css.css')}}">
@endpush
@section('content')


    <i class="icofont-pencil-alt-1"></i>
    <div class="page">
        <div class="content">
            <a href="{{ route('adminUserCreate') }}">Create new User</a>
            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
            @endif
            <div class="container">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Address</th>
                            <th scope="col">Day of Birth</th>
                            <th scope="col">Day of Join</th>
                            <th scope="col">Level</th>
                            <th scope="col">Role</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($users as $key => $user)
                            <tr>
                                <th scope="row">{{ $users->firstItem() + $key }}</th>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone }}</td>
                                <td>{{ $user->address }}</td>
                                <td>{{ $user->dayOfBirth ? date('d/m/Y', strtotime($user->dayOfBirth)) : '' }}</td>
                                <td>{{ $user->dayOfJoin ? date('d/m/Y', strtotime($user->dayOfJoin)) : '' }}</td>
                                <td>{{ \App\Enums\UserLevel::getDescription($user->level) }}</td>
                                <td>{{ \App\Enums\UserRole::getDescription($user->role) }}</td>
                            </tr>

                        @endforeach
                    </tbody>

                </table>
                {{ $users->links() }}
                <a href="{{ route('admin_index') }}">Back to dashboard</a>
            </div>
        </div>
    </div>
@endsection
