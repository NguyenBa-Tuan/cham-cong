<div class="sidebar">
    <div class="sidebar--header">Hệ thống chấm công</div>
    <div class="sidebar--list">
        @if(Auth::check())
            @if(Auth::user()->role==\App\Enums\UserRole::ADMIN)
                <a href="{{route('time_keeping_index')}}" class="sidebar--item active">Chấm công hành chính</a>
                <a href="{{route('overtime_index')}}" class="sidebar--item">Chấm công làm đêm</a>
                <a href="" class="sidebar--item">Thông tin cá nhân</a>
            @elseif(Auth::user()->role==\App\Enums\UserRole::USER)
                <a href="{{route('user_timesheet')}}" class="sidebar--item active">Chấm công hành chính</a>
                <a href="{{route('user_overtime')}}" class="sidebar--item">Chấm công làm đêm</a>
                <a href="{{route('user_edit')}}" class="sidebar--item">Thông tin cá nhân</a>
            @endif
        @endif
    </div>
</div>
