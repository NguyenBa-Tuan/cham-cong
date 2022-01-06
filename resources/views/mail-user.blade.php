<!DOCTYPE html>
<html>

<head>
    <title>Welcome Email</title>
</head>

<body>
    <h2>Welcome to the site {{ $user['email'] }}</h2>
    <br />
    Your registered email is {{ $user['email'] }}<br>
    <p>You must create your password in
        <a href="{{ route('userEditPassword', $user['id']) }}">there</a>
        {{-- sau 1 tieng link expride --}}
    </p>
</body>

</html>
