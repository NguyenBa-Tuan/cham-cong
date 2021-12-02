<form action="{{route('user_update')}}" method="POST">
    @csrf
    <div>
        <label>Name</label>
        <input type="text" placeholder="address" name="name" value="{{$user->name}}">
    </div>
    <div>
        <label>Phone</label>
        <input type="text" placeholder="address" name="phone" value="{{$user->phone}}">
    </div>
    <div>
        <label>Address</label>
        <input type="text" placeholder="address" name="address" value="{{$user->address}}">
    </div>
    <div>
        <label>DayOfBirth</label>
        <input type="date" placeholder="address" name="dayOfBirth" value="{{$user->dayOfBirth}}">
    </div>
    <div>
        <label>DayOfJoin</label>
        <input type="date" placeholder="address" name="dayOfJoin" value="{{$user->dayOfJoin}}">
    </div>
    <div>
        <label>Level</label>
        <input type="text" placeholder="address" name="level" value="{{$user->level}}">
    </div>
    <button type="submit">Change</button>
</form>
<a href="{{route('user_index')}}">back</a>
