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
	<!-- end search arewa -->
	
	<!-- breadcrumb-section -->
	<div class="breadcrumb-section breadcrumb-bg breadcrumb-single-bg">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="breadcrumb-text">
						<p class="english">{{__('header.Kabul washington Association')}}</p>
						<h1>{{__('header.Projects')}}</h1>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end breadcrumb section -->

	<!-- latest news -->
	<div class="latest-news mt-150 mb-150">
		<div class="container">
			<div class="row">
				@foreach($projects as $pro)
				<div class="col-lg-4 col-md-6">
					<div class="single-latest-news">
					<a href="{{route('single_project',['id'=>$pro->id])}}"><div class="latest-events-bg " style="background-image: url('{{URL::asset('public/uploads/admin/project/'.$pro->image)}}')"></div></a>
						<div class="news-text-box">
							<h3 class="english"><a href="{{route('single_project',['id'=>$pro->id])}}">{{$pro->title_en}}</a></h3>
							<h3 class="persian"><a href="{{route('single_project',['id'=>$pro->id])}}">{{$pro->title_dr}}</a></h3>
							<!--<p class="blog-meta">-->
							<!--	<span class="author"><i class="fas fa-user"></i> Admin</span>-->
							<!--	<span class="date"><i class="fas fa-calendar"></i> 27 December, 2019</span>-->
							<!--</p>-->
							@php
								if(app()->getLocale()=='en'){
									$getlength = strlen($pro->description_en);
									$maxLength = 500;
									if ($getlength > $maxLength) { 
									echo strip_tags(substr($pro->description_en, 0, strpos($pro->description_en, ' ', $maxLength)));
									echo "...";      
									} else {
										echo strip_tags($pro->description_en);
									}
								}else{
									$getlength = strlen($pro->description_dr);
									$maxLength = 500;
									if ($getlength > $maxLength) { 
									echo strip_tags(substr($pro->description_dr, 0, strpos($pro->description_dr, ' ', $maxLength)));
									echo "...";    
									} else {
										echo strip_tags($pro->description_dr);
									}
								}
							@endphp
							<!-- <p class="excerpt">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatibus laborum autem, dolores inventore, beatae nam.</p> -->
							<a href="{{route('single_project',['id'=>$pro->id])}}" class="read-more-btn">read more <i class="fas fa-angle-right"></i></a>
						</div>
					</div>
				</div>
            @endforeach
			</div>

			<!-- <div class="row">
				<div class="container">
					<div class="row">
						<div class="col-lg-12 text-center">
							<div class="pagination-wrap">
								<ul>
									<li><a href="#">Prev</a></li>
									<li><a href="#">1</a></li>
									<li><a class="active" href="#">2</a></li>
									<li><a href="#">3</a></li>
									<li><a href="#">Next</a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div> -->
		</div>
	</div>
	<!-- end latest news -->

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