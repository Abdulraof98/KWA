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
						<p  class="english"> Our Events</p>
						<h1>{{__('header.Events')}}</h1>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end breadcrumb section -->
	<div class="container">
            <div class="row ">
                @foreach($events as $ev)
                    <div class="col-lg-4 col-md-6 mt-80">
					<div class="single-latest-news">
						<a href="{{route('single_event',['id'=>$ev->id])}}"><div class="latest-events-bg " style="background-image: url('{{URL::asset('public/uploads/admin/event/'.$ev->image)}}')">></div></a>
						<div class="news-text-box">
							<h3><a href="{{route('single_event',['id'=>$ev->id])}}">@if(app()->getLocale()=='en'){{$ev->title_en}}@else  {{$ev->title_dr}}@endif</a></h3>
							<p class="blog-meta">
							<span class="author"><i class="fas fa-map-marker" style="color:#ffe200;"></i> 34/8, seattle, washington, United stated.</span>
								<span class="date"><i class="fas fa-calendar"></i> 27 December, 2022</span>
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
							<!-- @if(app()->getLocale()=='en') {!!$ev->description_en!!} @else  {!!$ev->description_dr!!}  @endif -->
							<!-- <p class="excerpt">Vivamus lacus enim, pulvinar vel nulla sed, scelerisque rhoncus nisi. Praesent vitae mattis nunc, egestas viverra eros.</p> -->
							<a href="{{route('single_event',['id'=>$ev->id])}}" class="read-more-btn">read more <i class="fas fa-angle-right"></i></a>
						</div>
					</div>
				</div> 
				@endforeach
				</div>
            </div>
        </div>
	
		

@stop