<form action="{{route('login_check')}}" method="POST">
    @csrf
    <div>
        <label>Email</label>
        <input type="email" placeholder="Enter your email" name="email">

    </div>
    <div>
        <label>Password</label>
        <input type="password" placeholder="Enter your password" name="password">

    </div>
    <button type="submit">Login</button>
</form>
