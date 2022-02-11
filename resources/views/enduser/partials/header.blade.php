<header>
    <!-- Header desktop -->
    <div class="container-menu-desktop">
        <div class="topbar">
            <div class="content-topbar container h-100">
                @guest
                    <div class="left-topbar">
                        <a href="{{url('/register')}}" class="left-topbar-item">
                            انشاء حساب
                        </a>

                        <a href="{{url('/login')}}" class="left-topbar-item">
                            تسجيل دخول
                        </a>
                    </div>
                @endguest
                @auth
                    <div class="left-topbar">
                        <img src="{{Auth::user()->image_path}}" style="width: 30px; height:30px" alt="">
                        <a href="{{url('profile')}}" class="m-r-10 text-light">{{Auth::user()->name}}</a>
                    </div>
                @endauth

                <div class="right-topbar d-flex">
                    @guest
                        <!-- السوشيال مستقبلا -->
                    @endguest
                    @auth
                        <div class="dropdown">
                            <button class="btn text-light dropdown-toggle notifications-bell notifications-btn" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell"></i>
                                <span class="notifications-count notifications-badge {{ auth()->user()->unreadNotifications->count() == 0 ? "d-none" : ""}}">
                                    {{ auth()->user()->unreadNotifications->count() }}
                                </span>
                            </button> 
                            <div class="dropdown-menu bg-dark" aria-labelledby="dropdownMenuButton" style="width:320px;z-index:9999">
                                <div class="notifications-body">
                                    @forelse( auth()->user()->notifications as $notification )
                                        <a href="{{url(NotificationsTypeURL($notification))}}" class="dropdown-item m-0">
                                            <i class="{{$notification->data['icon']}} mr-2"></i> {{$notification->data['text']}}
                                            <span class="float-right text-muted text-sm">{{ $notification->created_at->diffForHumans() }}</span>
                                        </a>
                                        @break($loop->index > auth()->user()->unreadNotifications->count() + 5)
                                    @empty
                                        <a href="#" class="dropdown-item m-0 text-center btn disabled" >
                                            <i class="fas fa-bell-slash mr-2"></i> لا يوجد اشعارات
                                            <span class="float-right text-muted text-sm"></span>
                                        </a>
                                    @endforelse
                                </div> 
                            </div>
                        </div>
                        <form method="POST" action="{{ route('logout')}}">
                            @csrf
                            <button class="btn btn-dark" title="تسجيل خروج">
                                <i class="fas fa-sign-out-alt"></i>
                            </button>
                        </form>
                    @endauth
                </div>
            </div>
        </div>

        <!-- Header Mobile -->
        <div class="wrap-header-mobile">
            <!-- Logo moblie -->		
            <div class="logo-mobile">
                <a href="{{url('/')}}"><img src="{{$setting->logo_path}}" alt="{{$setting->name}}"></a>
            </div>

            <!-- Button show menu -->
            <div class="btn-show-menu-mobile hamburger hamburger--squeeze m-r--8">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </div>
        </div>

        <!-- Menu Mobile -->
        <div class="menu-mobile">
            <ul class="topbar-mobile @auth auth-mobile @endauth">
                @guest
                    <li class="left-topbar" style="justify-content: center;">
                        <a href="{{url('/register')}}" class="left-topbar-item">
                            انشاء حساب
                        </a>

                        <a href="{{url('/login')}}" class="left-topbar-item">
                            تسجيل دخول
                        </a>
                    </li>
                @endguest

                @auth
                    <div class="left-topbar">
                        <img src="{{Auth::user()->image_path}}" style="width: 30px; height:30px" alt="">
                        <a href="{{url('profile')}}" class="m-r-10 text-light">{{Auth::user()->name}}</a>
                    </div>
                    <div class="right-topbar d-flex">
                        @auth
                            <div class="dropdown">
                                <button class="btn text-light dropdown-toggle notifications-bell notifications-btn" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-bell"></i>
                                    <span class="notifications-count notifications-badge {{ auth()->user()->unreadNotifications->count() == 0 ? "d-none" : ""}}">
                                        {{ auth()->user()->unreadNotifications->count() }}
                                    </span>
                                </button> 
                                <div class="dropdown-menu bg-dark" aria-labelledby="dropdownMenuButton" style="width:320px;z-index:9999">
                                    <div class="notifications-body">
                                        @forelse( auth()->user()->notifications as $notification )
                                            <a href="{{url(NotificationsTypeURL($notification))}}" class="dropdown-item m-0">
                                                <i class="{{$notification->data['icon']}} mr-2"></i> {{$notification->data['text']}}
                                                <span class="float-right text-muted text-sm">{{ $notification->created_at->diffForHumans() }}</span>
                                            </a>
                                            @break($loop->index > auth()->user()->unreadNotifications->count() + 5)
                                        @empty
                                            <a href="#" class="dropdown-item m-0 text-center btn disabled" >
                                                <i class="fas fa-bell-slash mr-2"></i> لا يوجد اشعارات
                                                <span class="float-right text-muted text-sm"></span>
                                            </a>
                                        @endforelse
                                    </div> 
                                </div>
                            </div>
                            <form method="POST" action="{{url('/logout')}}">
                                @csrf
                                <button class="btn btn-dark" title="تسجيل خروج">
                                    <i class="fas fa-sign-out-alt"></i>
                                </button>
                            </form>
                        @endauth
                    </div>
                @endauth

            </ul>

            <ul class="main-menu-m text-center">
                <li>
                    <a href="{{url('/')}}">الرئيسية</a>
                </li>

                <li>
                    <a href="{{url('tags')}}">الوسوم</a>
                </li>

                <li>
                    <a href="{{url('categories')}}">الاقسام </a>
                </li>

                <li>
                    <a href="{{url('/contact')}}">اتصل بنا  </a>
                </li>

                <li>
                    <a href="{{url('/about')}}">من نحن </a>
                </li>
            </ul>
        </div>
        
        <!--  -->
        <div class="wrap-logo container">
            <!-- Logo desktop -->		
            <div class="logo">
                <a href="{{url('/')}}" style="height: 100%">
                    <img src="{{$setting->logo_path}}" alt="{{$setting->name}}" style="max-height: 100%;">
                </a>
            </div>	

            <!-- Banner -->
            <div class="banner-header">
            <a href="#"><img src="{{url('uploads/banner/default.png')}}" alt="IMG"></a>
            </div>
        </div>	
        
        <!--  -->
        <div class="wrap-main-nav">
            <div class="main-nav">
                <!-- Menu desktop -->
                <nav class="menu-desktop">
                    <a class="logo-stick" href="index.html">
                        <img src="{{$setting->logo_path}}" alt="{{$setting->name}}">
                    </a>

                    <ul class="main-menu">
                        <li class="main-menu-active">
                            <a href="{{url('/')}}">الرئيسية</a>
                        </li>

                        <li class="mega-menu-item">
                            <a href="{{url('/tags')}}">الوسوم</a>
                        </li>

                        <li class="mega-menu-item">
                            <a href="{{url('/categories')}}">الاقسام</a>
                        </li>

                        <li class="mega-menu-item">
                            <a href="{{url('/contact')}}">اتصل بنا</a>
                        </li>

                        <li class="mega-menu-item">
                            <a href="{{url('/about')}}">من نحن</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>	
    </div>
</header>