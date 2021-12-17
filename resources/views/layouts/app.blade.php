<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/atomic.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/tab.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/lib/icofont.css')}}">
</head>
<body>
<div class="wrapper">
    @include('layouts.sidebar')
    <div class="main">
        @include('layouts.header')
        <div class="page">
            <div class="content">
                @yield('page')
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.21.0/moment.min.js" type="text/javascript"></script>

<script>
    function activeTab(obj) {
        $('.tab-wrapper ul li').removeClass('active');

        $(obj).addClass('active');

        var id = $(obj).find('a').attr('href');

        $('.tab-item').hide();

        $(id).show();
    }

    $('.tab li').click(function () {
        activeTab(this);
        return false;
    });

    activeTab($('.tab li:first-child'));
</script>

<script src="{{asset('js/user-overtime.js')}}"></script>

<script>
    $('.tk-timesheet').change(function () {
        let month = $('select[name=month]').val();
        let year = $('select[name=year]').val();
        location.assign(`{{ route('user_timesheet') }}?year=${year}&month=${month}`)
    });
    $('.tk-overtime').change(function () {
        let month = $('select[name=month]').val();
        let year = $('select[name=year]').val();console.log(year);


        location.assign(`{{ route('user_overtime') }}?year=${year}&month=${month}`)
    });
</script>
</body>
</html>
