<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{aurl("/")}}" class="nav-link">الرئيسية</a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav mr-auto-navbav">
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link notifications-btn" style="cursor: pointer">
                <i class="far fa-bell"></i>
                <span class="badge badge-danger navbar-badge notifications-badge {{ admin()->user()->unreadNotifications->count() == 0 ? "d-none" : ""}}">
                    <span class="notifications-count">{{admin()->user()->unreadNotifications->count() }}</span>
                </span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right drop-min-width notifications-dropdown">
                <span class="dropdown-item dropdown-header text-center">الاشعارات الجديدة  
                    <span class="notifications-count">{{admin()->user()->unreadNotifications->count() }}</span></span>
                <div class="notifications-body">
                    @foreach( admin()->user()->notifications as $notification)
                        <div class="dropdown-divider"></div>
                        <a href="{{aurl(NotificationsTypeURL($notification))}}" class="dropdown-item                         {{$notification->unread() == 1 ? "unread" : ""}}
                            {{$notification->unread() == 1 ? "unread" : " "}}">
                            <i class="{{$notification->data['icon']}} mr-2"></i> 
                            {{$notification->data['text']}}
                            <span class="float-right text-muted text-sm">{{ $notification->created_at->diffForHumans() }}</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        @break($loop->index > admin()->user()->unreadNotifications->count() + 5)
                    @endforeach
                </div>
                <a class="dropdown-item dropdown-footer text-center">مرر للمزيد من الاشعارات</a>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{aurl('logout')}}" title="تسجيل خروج">
                <i class="fas fa-sign-out-alt"></i>
            </a>
        </li>
    </ul>
</nav>