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
<script src="{{asset('js/dropdown.js')}}"></script>
<script>
    $(document).ready(function () {
        // $('#data_table').ready(function (){
        //     let findVAC=$(this).find(" .tk-day").text();
        //     if (findVAC==='t7'||findVAC==='Cn'){
        //         console.log('d');
        //         $('.tk-day').addClass('extra-color');
        //     }
        // });
    });
</script>
</body>
</html>
