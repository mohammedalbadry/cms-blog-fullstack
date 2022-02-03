<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{aurl("/")}}" class="brand-link">
        <img src="{{ $setting->logo_path }}" alt="AdminLTE Logo" 
        class="brand-image img-circle elevation-3 mr-3">
        <span class="brand-text font-weight-light">{{ $setting->name }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image pr-3">
            <img src="{{ admin()->user()->image_path }}" class="img-circle elevation-2" alt="{{ admin()->user()->name }}">
        </div>
        <div class="info">
            <a href="{{aurl("admins/" . admin()->user()->id . "/edit")}}" class="d-block">{{ admin()->user()->name }}</a>
        </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->

            <li class="nav-item">
                <a href="{{aurl('posts')}}" class="nav-link">
                    <i class="fas fa-newspaper nav-icon"></i>
                    <p>التدوينات</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{aurl('pages')}}" class="nav-link">
                    <i class="fas fa-clone nav-icon"></i>
                    <p>الصفحات</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{aurl('users')}}" class="nav-link">
                    <i class="fas fa-users nav-icon"></i>
                    <p>المستخدمين</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{aurl('admins')}}" class="nav-link">
                    <i class="fas fa-users-cog nav-icon"></i>
                    <p>المشرفين</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{aurl('tags')}}" class="nav-link">
                    <i class="fas fa-tags nav-icon"></i>
                    <p>الوسم</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{aurl('categories')}}" class="nav-link">
                    <i class="fas fa-th-list nav-icon"></i>
                    <p>الاقسام</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{aurl('media-view')}}" class="nav-link">
                    <i class="fas fa-photo-video nav-icon"></i>
                    <p>الوسائط</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{aurl('comments')}}" class="nav-link">
                    <i class="fas fa-comments nav-icon"></i>
                    <p>تعليقات</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{aurl('contacts')}}" class="nav-link">
                    <i class="fas fa-envelope nav-icon"></i>
                    <p>الرسائل</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{aurl('reports')}}" class="nav-link">
                    <i class="fas fa-ban nav-icon"></i>
                    <p>الابلاغات</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{aurl('statistics')}}" class="nav-link">
                    <i class="fas fa-chart-line nav-icon"></i>
                    <p>الاحصائيات</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{aurl('setting')}}" class="nav-link">
                    <i class="fas fa-cogs nav-icon"></i>
                    <p>الاعدادات</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{aurl('sitemap')}}" class="nav-link">
                    <i class="fas fa-sitemap nav-icon"></i>
                    <p>فهرسة التدوينات</p>
                </a>
            </li>
            

        </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>