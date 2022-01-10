<form action="{{route('reset_password_update', $user->id)}}" method="POST">
    @csrf
    <div>
        <label>password</label>
        <input type="password" placeholder="password" name="password">
    </div>
    <div>
        <label>Confirm password</label>
        <input type="password" placeholder="confirm password" name="password_confirmation">
    </div>
    <button type="submit">Change password</button>
</form>

