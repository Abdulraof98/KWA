@extends('layouts.main2') 
@section('content')
	
	
	<!-- search area -->
	<div class="search-area">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<span class="close-btn"><i class="fas fa-window-close"></i></span>
					<div class="search-bar">
						<div class="search-bar-tablecell">
							<h3>Search For:</h3>
							<input type="text" placeholder="Keywords">
							<button type="submit">Search <i class="fas fa-search"></i></button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<!-- end search area -->
	@if($slide->count() > '1')
    @include('kwa.slider')
	@elseif($slide->count()=='1')
	@include('kwa.static_slider')
	@endif

	<!-- end testimonail-section -->
	<div></div>
	<!-- advertisement section -->
	<div class="abt-section mt-80 mt-5">
		<div class="container" style="@if(app()->getLocale()=='dr') direction: rtl; @else direction: ltr; @endif">
			<div class="row">
				<!-- <div class="col-lg-6 col-md-12">
					<div class="abt-bg">
						<a href="https://www.youtube.com/watch?v=mPRXhNFPgwo" class="video-play-btn popup-youtube"><i class="fas fa-play"></i></a>
					</div>
				</div> -->
				<div class="col-lg-12 col-md-12">
					<div class="abt-text">
						<p class="top-sub text-center">{{__('header.About Us')}}</p>
						<h2 class="english"><span class="orange-text ">Kabul</span> -Washington Association</h2>
						<h2 class="persian text-right"><span class="orange-text ">انجمن </span> - کابل واشنگتن </h2>
						@if(app()->getLocale()=='en')
						{!! $aboutus->content_body_en!!}
						@else
						{!! $aboutus->content_body_dr!!}
						@endif
						<div class="text-center"> 
						<a href="{{route('kwa_about')}}" class="boxed-btn mt-4">{{__('header.know more')}}</a>
						</div>
						
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end advertisement section -->
	<!-- latest news -->
	<div class="latest-news  ">
		<div class="container">

			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="section-title">	
						<h3 class="english"><span class="orange-text">Our</span> Events</h3>
						<h3 class="persian"><span class="orange-text">مناسبت</span> های ما</h3>
						<p class="english"> The recent events which we hold in our association </p>
						<p class="persian">رویدادهای اخیری که در انجمن خود برگزار می کنیم</p>
					</div>
				</div>
			</div>

			<div class="row">
				@foreach($events as $ev)
				<div class="col-lg-4 col-md-6">
					<div class="single-latest-news">
						<a href="{{route('single_event',['id'=>$ev->id])}}"><div class="latest-news-bg news-bg-1"
						style=" background-image:url({{URL::asset('public/uploads/admin/event/'.$ev->image)}})"></div></a>
						<div class="news-text-box">
							@if(app()->getLocale()=='en')
							<h3><a href="{{route('single_event',['id'=>$ev->id])}}">{{$ev->title_en}}</a></h3>
							@else
							<h3><a href="{{route('single_event',['id'=>$ev->id])}}">{{$ev->title_dr}}</a></h3>
							@endif
							<p class="blog-meta">
								<!-- <span class="author"><i class="fas fa-user"></i> Admin</span> -->
								<h3><span class="date " style="color:#239cd2"><i class="fas fa-calendar" style="margin-right: 10px;"> </i> {{ date('Y M d h:i A', strtotime($ev->start_date))}}</span></h3>
							</p>
							@php
								if(app()->getLocale()=='en'){
									$getlength = strlen($ev->description_en);
									$maxLength = 500;
									if ($getlength > $maxLength) { 
									echo substr($ev->description_en, 0, strpos($ev->description_en, ' ', $maxLength));
									echo "...";      
									} else {
										echo $ev->description_en;
									}
								}else{
									$getlength = strlen($ev->description_dr);
									$maxLength = 500;
									if ($getlength > $maxLength) { 
									echo substr($ev->description_dr, 0, strpos($ev->description_dr, ' ', $maxLength));
									echo "...";    
									} else {
										echo $ev->description_dr;
									}
								}
							@endphp
							<!-- {!! $ev->description_en !!} -->
							<a href="{{route('single_event',['id'=>$ev->id])}}" class="read-more-btn">{{__('header.read more')}} <i class="fas fa-angle-right"></i></a>
						</div>
					</div>
				</div>
				@endforeach
            </div>
			<div class="row">
				<div class="col-lg-12 text-center">
					<a href="{{route('kwa_events')}}" class="boxed-btn">{{__('header.Load More')}}</a>
				</div>
			</div>
		</div>
	</div>
	<!-- end latest news -->

	<!-- latest projects  -->
	<div class="latest-news mt-80">
		<div class="container">

			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="section-title">	
						<h3 class="english"><span class="orange-text">Our</span> Projects</h3>
						<h3 class="persian"><span class="orange-text">پروژه</span> های ما</h3>
						<p class="english"> The projects we are working on </p>
						<p class="persian">پروژه هایی که روی آنها کار می کنیم</p>
					</div>
				</div>
			</div>

			<div class="row">
				@foreach($projects as $ev)
				<div class="col-lg-4 col-md-6">
					<div class="single-latest-news">
						<a href="{{route('single_project',['id'=>$ev->id])}}"><div class="latest-news-bg news-bg-1"
						style=" background-image:url({{URL::asset('public/uploads/admin/project/'.$ev->image)}})"></div></a>
						<div class="news-text-box">
							@if(app()->getLocale()=='en')
							<h3><a href="{{route('single_project',['id'=>$ev->id])}}">{{$ev->title_en}}</a></h3>
							@else
							<h3><a href="{{route('single_project',['id'=>$ev->id])}}">{{$ev->title_dr}}</a></h3>
							@endif
							<!-- <p class="blog-meta">
								<span class="author"><i class="fas fa-user"></i> Admin</span>
								<h3><span class="date " style="color:#239cd2"><i class="fas fa-calendar" style="margin-right: 10px;"> </i> {{ date('Y M d h:i A', strtotime($ev->start_date))}}</span></h3>
							</p> -->
							@php
								if(app()->getLocale()=='en'){
									$getlength = strlen($ev->description_en);
									$maxLength = 500;
									if ($getlength > $maxLength) { 
									echo substr($ev->description_en, 0, strpos($ev->description_en, ' ', $maxLength));
									echo "...";      
									} else {
										echo $ev->description_en;
									}
								}else{
									$getlength = strlen($ev->description_dr);
									$maxLength = 500;
									if ($getlength > $maxLength) { 
									echo substr($ev->description_dr, 0, strpos($ev->description_dr, ' ', $maxLength));
									echo "...";    
									} else {
										echo $ev->description_dr;
									}
								}
							@endphp
							
							<a href="{{route('single_project',['id'=>$ev->id])}}" class="read-more-btn">{{__('header.read more')}} <i class="fas fa-angle-right"></i></a>
						</div>
					</div>
				</div>
				@endforeach
				
			</div>
			<div class="row">
				<div class="col-lg-12 text-center">
					<a href="{{route('kwa_projects')}}" class="boxed-btn">{{__('header.Load More')}}</a>
				</div>
			</div>
		</div>
	</div>
	<!-- End latest project  -->
	<!-- logo carousel -->
	<div class="logo-carousel-section">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="logo-carousel-inner">
						<div class="single-logo-item">
							<img src="assets/img/company-logos/1.png" alt="">
						</div>
						<div class="single-logo-item">
							<img src="assets/img/company-logos/2.png" alt="">
						</div>
						<div class="single-logo-item">
							<img src="assets/img/company-logos/3.png" alt="">
						</div>
						<div class="single-logo-item">
							<img src="assets/img/company-logos/4.png" alt="">
						</div>
						<div class="single-logo-item">
							<img src="assets/img/company-logos/5.png" alt="">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end logo carousel -->

    @stop