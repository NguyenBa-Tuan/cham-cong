<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ env('APP_NAME') }} | @yield('title')</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/OverlayScrollbars.min.css') }}">
    {{-- <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/atomic.css')}}"> --}}
    @stack('styles')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    @include('layouts.partial.nav')
    @include('layouts.partial.aside')
    <div class="content-wrapper">

        @yield('content')
    </div><!-- /.container-fluid -->
</body>

<script src="{{ asset('js/app.js') }}"></script>
@stack('scripts')
</html>
