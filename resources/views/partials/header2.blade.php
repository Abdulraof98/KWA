	<!--PreLoader-->
    <div class="loader">
        <div class="loader-inner">
            <div class="circle"></div>
        </div>
    </div>
    <!--PreLoader Ends-->
	<!-- header -->
   	<div class="top-header-area" id="--sticker" >
		<div class=" header-navbar container-fluid">
			<div class="row">
				<div class="col-lg-12 col-sm-12 text-center">
					<div class="main-menu-wrap">
						<!-- logo -->
						
						<div class="site-logo">
						
							<a href="{{route('kwa_home')}}" class="">
							<h2 class="color-white" >KWA</h2>
								<!-- <img src="{{URL::asset('public/assets/img/company-logos/kwa_white.png')}}" alt=""> -->
							</a>
						</div>
						<!-- logo -->
						<!-- donate button -->
						<!-- <button id="donate-click">click</button> -->
						<!-- <div id="donate-button2" class="" ></div> -->
						<!-- menu start -->
						<nav class="main-menu" style=" letter-spacing: 2px;">
					
							<ul id="headers">
								
								<li class="{{ (in_array(Route::currentRouteName(), ['kwa_home','/'])) ? 'active' : '' }}" ><a href="{{route('kwa_home')}}">{{__('header.Home')}}</a>
								</li>
								<li class="{{ (in_array(Route::currentRouteName(), ['kwa_projects','single_project'])) ? 'active' : '' }}"><a href="{{route('kwa_projects')}}">{{__('header.Projects')}}</a></li>
								<li class="{{ (in_array(Route::currentRouteName(), ['kwa_events','single_event'])) ? 'active' : '' }}"><a href="{{route('kwa_events')}}">{{__('header.Events')}}</a></li>
								<li class="{{ (in_array(Route::currentRouteName(), ['kwa_contact'])) ? 'active' : '' }}"><a href="{{route('kwa_contact')}}">{{__('header.Contact')}}</a></li>
								<li class="{{ (in_array(Route::currentRouteName(), ['kwa_gallery'])) ? 'active' : '' }}"><a href="{{route('kwa_gallery')}}">{{__('header.Photo Gallery')}}</a></li>
								<li class="{{ (in_array(Route::currentRouteName(), ['kwa_about'])) ? 'active' : '' }}" ><a href="{{route('kwa_about')}}">{{__('header.About')}}</a></li>
								<!-- <li class="{{ (Request::route()->getName() == 'kwa_news') ? 'active': ''}}"><a href="{{route('kwa_news')}}">{{__('header.Blogs')}}</a></li> -->
		
								<li ><a href="#">{{__('header.Languages')}}</a>
									<ul class="sub-menu">
										<li><a href="{{route('lang',['en']) }}" class="dropdown-item"><b>English</b></a></li>
										<li><a href="{{route('lang',['dr']) }}" class="dropdown-item"><b>فارسی</b></a></li>
									</ul>
								</li>
								<li class="main_menu_right">
								<a href="#" data-toggle="modal" data-target="#loginModal" class="bordered-btn register-btn " >{{__('header.Register')}}</a>
								</li>
								<li class="main_menu_right" id="donate-button-container" style="margin-top: 4px;" >
								<!-- <a  id="donate-click" class="donate-btn header-icons" >Donate</a> -->
									<div id="donate-button1" class="" ></div>
								</li>
								
								<!-- <li>
								<a href="#" data-toggle="modal" data-target="#loginModal" class="bordered-btn ">{{__('header.Login')}}</a>
								</li> -->
								
							</ul>
						</nav>
						<!-- <a class="mobile-show search-bar-icon" href="#"><i class="fas fa-search"></i></a> -->
						<div class="mobile-menu">
						<span id="donate-button2" class="" ></span>
						</div>
						<!-- menu end -->
					</div>
				</div>
			</div>
		</div>
	</div>

	<script src="https://www.paypalobjects.com/donate/sdk/donate-sdk.js" charset="UTF-8"></script>
	
	<script>
	PayPal.Donation.Button({
	env:'production',
	hosted_button_id:'D5Y4TCJ76QD26',
	image: {
	src:'https://www.paypalobjects.com/en_US/i/btn/btn_donate_LG.gif',
	alt:'Donate with PayPal button',
	title:'PayPal - The safer, easier way to pay online!',
	}
	}).render('#donate-button1');
	PayPal.Donation.Button({
	env:'production',
	hosted_button_id:'D5Y4TCJ76QD26',
	image: {
	src:'https://www.paypalobjects.com/en_US/i/btn/btn_donate_LG.gif',
	alt:'Donate with PayPal button',
	title:'PayPal - The safer, easier way to pay online!',
	}
	}).render('#donate-button2');

	
	</script>
	<!-- end header -->