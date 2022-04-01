<!DOCTYPE html>
<html>

<head>
    <title>Welcome Email</title>
</head>

<body>
    @if($update->status==1)
    <p>Yêu cầu xin nghỉ việc của bạn ĐÃ ĐƯỢC chấp thuận.</p>
    @elseif($update->status==0)
    <p>Yêu cầu xin nghỉ việc của bạn KHÔNG ĐƯỢC chấp thuận!</p>
    @endif
</body>

</html>