<style>
    .username,
    .logout {
        font-weight: 500;
        font-size: 16px;
        line-height: 19px;
        color: #4B545C !important;
    }

    .username {
        padding-left: 0 !important;
        padding-right: 0 !important;
    }

    .logout {
        padding-left: 0 !important;
        padding-right: 22px !important;
    }

    .border-right {
        border-right: 1px solid #E8EDF4;
        height: 27px;
        margin: auto;
        margin-left: 25px;
        margin-right: 25px;
    }
    .nav-right .nav-link{
        height: auto !important;
    }
</style>
<nav class="main-header navbar navbar-expand navbar-white navbar-light nav-header">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link pushmenu" data-widget="pushmenu" href="#">
                <div class="pushmenu1"></div>
                <div class="pushmenu2"></div>
                <div class="pushmenu3"></div>
            </a>
        </li>

    </ul>
    <ol class="navbar-nav">
        <li class="breadcrumb-item"><a href="" class="header-content">@yield('header_content')</a></li>

    </ol>
    <!-- Right navbar links -->
    <ol class="navbar-nav ml-auto nav-right">
        <li class="nav-item  d-flex hidden-mobile">
            <a class="nav-link username" href="" role="button">
                {{ Auth::user()->name ?? '' }}
            </a>
            <div class="border-right"></div>

        </li>
        <li class="nav-item">
            <a class="nav-link logout" href="{{route('logout')}}">
                Đăng xuất
            </a>
        </li>

    </ul>
</nav>