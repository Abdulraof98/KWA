      <!-- Navbar Start -->
    <div class="container-fluid bg-light position-relative shadow"
      style="@if(app()->getLocale()=='dr') direction: rtl; @else direction: ltr; @endif">
        <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0 px-lg-5">
            <a href="" class="navbar-brand font-weight-bold text-secondary" style="font-size: 50px;">
                <!-- <i class="flaticon-043-teddy-bear"></i> -->
                <img src="{{URL::asset('public/frontend/images/logo.jpg')}}" width="100" height="100"  alt="" class="rounded-circle">
                @if(app()->getLocale()=='en')
                <span class="text-primary">Alif-Ba</span>
                @else
                <span class="text-primary">الفبـا</span>
                @endif
            </a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                <div class="navbar-nav font-weight-bold mx-auto py-0">
                    <a href="{{route('/')}}" 
                    class="nav-item nav-link  {{ (Request::route()->getName() == '/') ? 'active': ''}}">
                    {{__('header.Home')}}</a>
                    <a href="{{route('about')}}" 
                    class="nav-item nav-link {{ (Request::route()->getName() == 'about') ? 'active': ''}}">
                    {{__('header.About')}}</a>
                    <a href="{{route('class')}}" 
                    class="nav-item nav-link {{ (Request::route()->getName() == 'class') ? 'active': ''}}">
                    {{__('header.Classes')}}</a>
                    <a href="{{route('blogs')}}" 
                    class="nav-item nav-link {{ (Request::route()->getName() == 'blogs') ? 'active': ''}}">
                    {{__('header.Blogs')}}</a>

                    @if(!auth()->guard('frontend')->guest())
                    <a href="{{route('team')}}" 
                    class="nav-item nav-link {{ (Request::route()->getName() == 'team') ? 'active': ''}}">
                    {{__('header.Teachers')}}</a>

                    <a href="{{route('register')}}" 
                    class="nav-item nav-link {{ (Request::route()->getName() == 'register') ? 'active': ''}}">
                    {{__('header.Register')}}</a>

                    <a href="{{route('gallery')}}" 
                    class="nav-item nav-link {{ (Request::route()->getName() == 'gallery') ? 'active': ''}}">
                    {{__('header.Gallery')}}</a>
                    @else

                    <a href="#" data-toggle="modal" data-target="#loginModal"
                    class="nav-item nav-link {{ (Request::route()->getName() == 'team') ? 'active': ''}}">
                    {{__('header.Teachers')}}</a>
                    <!-- <a href="#" data-toggle="modal" data-target="#loginModal"
                    class="nav-item nav-link {{ (Request::route()->getName() == 'register') ? 'active': ''}}">
                    {{__('header.Register')}}</a> -->
                   
                    <!-- <a href="#" data-toggle="modal" data-target="#loginModal"
                    class="nav-item nav-link {{ (Request::route()->getName() == 'gallery') ? 'active': ''}}">
                    {{__('header.Gallery')}}</a> -->
                    @endif
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">{{__('header.Languages')}}</a>
                        <div class="dropdown-menu rounded-0 m-0">
                            <a href="{{route('lang',['en']) }}" class="dropdown-item"><b>English</b></a>
                            <a href="{{route('lang',['dr']) }}" class="dropdown-item"><b>فارسی</b></a>
                        </div>
                    </div>
                    <a href="{{route('contact')}}" 
                    class="nav-item nav-link {{ (Request::route()->getName() == 'contact') ? 'active': ''}}">
                    {{__('header.Contact')}}</a>
                </div>
                @if(Auth()->guard('frontend')->guest())
                <a href="#" data-toggle="modal" data-target="#loginModal" class="btn btn-secondary mx-2 px-3">{{__('header.Login')}}</a>
                <a href="#" data-toggle="modal" data-target="#signupModal" class="btn btn-primary px-4">{{__('header.Sign Up')}}</a>
                 @else
                 <span class="text-uppercase">Hi {{ auth()->guard('frontend')->user()->name }} </span>
                 <div class="mx-4">
                 <a href="{{route('logout')}}"  class="btn btn-danger px-4">Log out</a>
                 </div>
                 
                 @endif
            </div>
        </nav>
    </div>     
      </header>