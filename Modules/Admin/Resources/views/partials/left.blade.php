<ul class="page-sidebar-menu  page-header-fixed page-sidebar-menu-hover-submenu " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
    <li class="nav-item {{ (Request::route()->getName() === 'admin-dashboard') ? 'active' : '' }}">
        <a href="{{ Route('admin-dashboard') }}" class="nav-link nav-toggle">
            <i class="icon-home"></i>
            <span class="title">Dashboard</span>
            <span class="selected"></span>
            <span class="arrow open"></span>
        </a>
    </li>
    @if(auth()->guard('backend')->user()->type_id != 3)
    <li class="nav-item {{ (in_array(Route::currentRouteName(), ['create_user','admin-manage-users'])) ? 'active' : '' }}">
        <a href="{{route('admin-manage-users')}}" class="nav-link nav-toggle">
            <i class="fa fa-users"></i>
            <span class="title">Users</span>
            <span class="selected"></span>
            <span class="arrow"></span>
        </a>
        <ul class="sub-menu">
            <li class="nav-item {{ (in_array(Route::currentRouteName(), ['create_user','admin-updateclient','create_user'])) ? 'active' : '' }}">
                <a href="{{ Route('create_user') }}" class="nav-link">
                    <i class="fa fa-user"></i>
                    <span class="title">Create User</span>
                </a>
            </li>
            <li class="nav-item {{ (in_array(Route::currentRouteName(), ['admin-manage-users'])) ? 'active' : '' }}">
                <a href="{{ Route('admin-manage-users') }}" class="nav-link">
                    <i class="fa fa-user"></i>
                    <span class="title">Manage Users</span>
                </a>
            </li>
        </ul>
    </li>
    @endif
    <li class="nav-item {{ (in_array(Route::currentRouteName(), ['list-subscribers','admin-subscriber'])) ? 'active' : '' }}">
        <a href="{{route('admin-subscriber')}}" class="nav-link nav-toggle">
            <i class="fa fa-users"></i>
            <span class="title">Subscribers</span>
            <span class="selected"></span>
            <span class="arrow"></span>
        </a>
    </li>
    <li class="nav-item {{ (in_array(Route::currentRouteName(), ['list-students','admin-inquiry'])) ? 'active' : '' }}">
        <a href="{{route('admin-inquiry')}}" class="nav-link nav-toggle">
            <i class="fa fa-question-circle"></i>
            <span class="title">Inquiries</span>
            <span class="selected"></span>
            <span class="arrow"></span>
        </a>
    </li>
    <li class="nav-item {{ (in_array(Route::currentRouteName(), ['admin-slide','aeditslider','admin-addslide'])) ? 'active' : '' }}" >
        <a href="{{ Route('admin-slide') }}" class="nav-link nav-toggle" >
            <i class="fa fa-photo"></i>
            <span class="title">Slides</span>
            <span class="selected"></span>
            <span class="arrow"></span>
        </a>
    </li>
    <li class="nav-item {{ (in_array(Route::currentRouteName(), ['admin-event','admin-addevent','admin-editevent','admin-viewevent','admin-subcategory','admin-updatesubcategory'])) ? 'active' : '' }}">
        <a href="{{ Route('admin-event') }}" class="nav-link nav-toggle">
            <i class="fa fa-photo"></i>
            <span class="title">Events</span>
            <span class="selected"></span>
            <span class="arrow"></span>
        </a>
    </li>
    <li class="nav-item {{ (in_array(Route::currentRouteName(), ['admin-story','admin-addstory','admin-editstory','admin-viewstory','admin-subcategory','admin-updatesubcategory'])) ? 'active' : '' }}">
        <a href="{{ Route('admin-story') }}" class="nav-link nav-toggle">
            <i class="fa fa-photo"></i>
            <span class="title">Stories</span>
            <span class="selected"></span>
            <span class="arrow"></span>
        </a>
    </li>
    <li class="nav-item {{ (in_array(Route::currentRouteName(), ['admin-addproject','admin-project'])) ? 'active' : '' }}">
        <a href="{{route('admin-project')}}" class="nav-link nav-toggle">
            <i class="fa fa-users"></i>
            <span class="title">Projects</span>
            <span class="selected"></span>
            <span class="arrow"></span>
        </a>
        <ul class="sub-menu">
        
        </ul>
    </li>
    <li class="nav-item {{ (in_array(Route::currentRouteName(), ['admin-contact','admin-contacts'])) ? 'active' : '' }}">
        <a href="{{route('admin-contact')}}" class="nav-link nav-toggle">
            <i class="fa fa-phone"></i>
            <span class="title">Contact Us</span>
            <span class="selected"></span>
            <span class="arrow"></span>
        </a>
    </li>
    <li class="nav-item {{ (in_array(Route::currentRouteName(), ['admin-gallery','admin-gallery'])) ? 'active' : '' }}">
        <a href="{{route('admin-gallery')}}" class="nav-link nav-toggle">
            <i class="fa fa-picture-o"></i>
            <span class="title">Gallery</span>
            <span class="selected"></span>
            <span class="arrow"></span>
        </a>
    </li>
    
    <li class="nav-item {{ (in_array(Route::currentRouteName(), ['admin-cms', 'admin-viewcms', 'admin-updatecms'])) ? 'active' : '' }}">
        <a href="{{ Route('admin-cms') }}" class="nav-link nav-toggle">
            <i class="fa fa-picture-o"></i>
            <span class="title">CMS</span>
            <span class="selected"></span>
            <span class="arrow"></span>
        </a>
    </li>
    
    

</ul>