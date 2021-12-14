<form action="{{route('userUpdatePassword', $user->id)}}" method="POST">
    @csrf
    <div>
        <label>password</label>
        <input type="text" placeholder="password" name="password">
    </div>
    <div>
        <label>Confirm password</label>
        <input type="text" placeholder="confirm password" name="password_confirmation">
    </div>
    <button type="submit">Create User</button>
</form>
