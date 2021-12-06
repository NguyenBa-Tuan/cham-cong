<a href="{{route('user_edit')}}">Edit</a>
<p>{{$user->name}}</p>
<p>{{$user->phone}}</p>
<p>{{$user->address}}</p>
<p>{{$user->dayOfBirth}}</p>
<p>{{$user->dayOfJoin}}</p>
<p>{{\App\Enums\UserLevel::getDescription($user->level)}}</p>
<a href="{{route('logout')}}">Logout</a>
