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
</head>
<body>
<div class="wrapper">
    @include('layouts.sidebar')
    <div class="main">
        @include('layouts.header')
        <div class="page relative">
            <div class="content">
                @yield('page')
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous"></script>
<script>
    $(document).ready(function () {
        $('#data_table').ready(function () {
            $('#data_table tr').each(function () {
                var data = $(this).find(".tk-day").text();
                if (data === 'T7') {
                    $('.tk-day').removeClass('bg-light-green').addClass('bg-light-pink');
                }
            });
        });
    });
</script>
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
</script>
</body>
</html>
