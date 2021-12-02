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
        <label>Level</label>
        <input type="text" placeholder="level" name="level">
    </div>
    <div>
        <label for="role">Role</label>
        <select id="role" name="role">
            <option value="0">Admin</option>
            <option value="1">User</option>
        </select>
    </div>

    <button type="submit">Create User</button>
</form>
<a href="{{route('adminUserIndex')}}">Back</a>
