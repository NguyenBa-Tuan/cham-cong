<!DOCTYPE html>
<html>

<head>
    <title>Welcome Email</title>
</head>

<body>
    <p>
        Bạn nhận được yêu cầu xin nghỉ phép từ {{$store->user->name}}, với lý do: {{$store->reason}}.
        Mời bạn click vào <a href="{{route('admin.onleave.index')}}">link này</a> để phê duyệt yêu cầu.
    </p>

</body>

</html>