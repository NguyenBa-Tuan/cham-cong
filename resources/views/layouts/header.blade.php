<div class="header">
    <div>
        <h1>@yield('page-name')</h1>
    </div>
    <div class="header--user">
        @if(Auth::check())
            <a href="">{{Auth::user()->name}}</a>
        <span class="header--border"></span>
            <a href="{{route('logout')}}">Logout</a>
        @endif
    </div>
</div>
