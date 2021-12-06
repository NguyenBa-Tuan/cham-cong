<form action="{{route('adminUserStore')}}" method="POST">
    @csrf
    <div>
        <label>Name</label>
        <input type="text" placeholder="name" name="name">
    </div>
    <div>
        <label>Email</label>
        <input type="text" placeholder="email" name="email">
    </div>
    <div>
        <label>Address</label>
        <input type="text" placeholder="address" name="address">
    </div>
    <div>
        <label>Password</label>
        <input type="text" placeholder="password" name="password">
    </div>
    <div>
        <label>Day of Birth</label>
        <input type="date" placeholder="dayOfBirth" name="dayOfBirth">
    </div>
    <div>
        <label>Day of Join</label>
        <input type="date" placeholder="dayOfJoin" name="dayOfJoin">
    </div>
    <div>
        <label>Phone</label>
        <input type="text" placeholder="phone" name="phone">
    </div>
    <div>
        <label>Role</label>
        <select id="role" name="role">
            @foreach($roles as $key=>$role)
                <option value="{{$key}}">{{$role}}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label for="role">Level</label>
        <select id="role" name="level">
            @foreach($levels as $key=>$level)
                <option value="{{$key}}">{{$level}}</option>
            @endforeach
        </select>
    </div>

    <button type="submit">Create User</button>
</form>
<a href="{{route('adminUserIndex')}}">Back</a>
