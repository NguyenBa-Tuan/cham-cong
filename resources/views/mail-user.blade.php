<!DOCTYPE html>
<html>

<head>
    <title>Welcome Email</title>
</head>

<body>
    <h2>Welcome to the site {{$user['email']}}</h2>
    <br />
    Your registered email is {{$user['email']}}<br>
    <p>You must change your password in
    <a href="{{route('reset_password_index', $token->token)}}">there</a>
    </p>
    <p>Sau 1 ngày, link này sẽ mất hiệu lực</p>
</body>

</html>
