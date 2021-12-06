<a href="{{route('adminUserCreate')}}">Create new User</a>
@foreach($users as $user)
    <div style="background-color: lightblue; margin-bottom: 10px;">
        <p><span style="margin-right: 40px">Name</span>{{$user->name}}</p>
        <p><span style="margin-right: 40px">Email</span>{{$user->email}}</p>
        <p><span style="margin-right: 40px">Phone</span>{{$user->phone}}</p>
        <p><span style="margin-right: 40px">Address</span>{{$user->address}}</p>
        <p><span style="margin-right: 40px">Day of Birth</span>{{$user->dayOfBirth}}</p>
        <p><span style="margin-right: 40px">Day of Join</span>{{$user->dayOfJoin}}</p>
        <p><span style="margin-right: 40px">Level</span>{{\App\Enums\UserLevel::getDescription($user->level)}}</p>
        <p><span style="margin-right: 40px">Role</span>{{\App\Enums\UserRole::getDescription($user->role)}}</p>
    </div>
@endforeach
<a href="{{route('admin_index')}}">Back to dashboard</a>
<a href="{{route('logout')}}">Logout</a>
