@extends('layouts.main2')
@section('content')
	


	
	<!-- breadcrumb-section -->
	<div class="breadcrumb-section breadcrumb-bg breadcrumb-single-bg">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="breadcrumb-text">
						<p class="english">{{__('header.Kabul washington Association')}}</p>
						<h1>{{__('header.Stories')}}</h1>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end breadcrumb section -->

	<!-- latest news -->
	<div class="latest-news mt-50 mb-150">
		<div class="container">
			<div class="row">
				@foreach($stories as $story)
				<div class="col-lg-4 col-md-6">
					<div class="single-latest-news">
					<a href="{{route('single_story',['id'=>$story->id])}}"><div class="latest-events-bg " style="background-image: url('{{URL::asset('public/uploads/admin/story/'.$story->image)}}')"></div></a>
						<div class="news-text-box">
							<h3 class="english"><a href="{{route('single_story',['id'=>$story->id])}}">{{$story->title_en}}</a></h3>
							<h3 class="persian"><a href="{{route('single_story',['id'=>$story->id])}}">{{$story->title_dr}}</a></h3>
						
							@php
								if(app()->getLocale()=='en'){
									$getlength = strlen($story->description_en);
									$maxLength = 500;
									if ($getlength > $maxLength) { 
									echo strip_tags(substr($story->description_en, 0, strpos($story->description_en, ' ', $maxLength)));
									echo "...";      
									} else {
										echo strip_tags($story->description_en);
									}
								}else{
									$getlength = strlen($story->description_dr);
									$maxLength = 500;
									if ($getlength > $maxLength) { 
									echo strip_tags(substr($story->description_dr, 0, strpos($story->description_dr, ' ', $maxLength)));
									echo "...";    
									} else {
										echo strip_tags($story->description_dr);
									}
								}
							@endphp
							<!-- <p class="excerpt">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatibus laborum autem, dolores inventore, beatae nam.</p> -->
							<a href="{{route('single_story',['id'=>$story->id])}}" class="read-more-btn">read more <i class="fas fa-angle-right"></i></a>
						</div>
					</div>
				</div>
            @endforeach
			</div>

			
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