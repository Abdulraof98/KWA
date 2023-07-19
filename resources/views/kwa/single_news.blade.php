@extends('layouts.main2')
@section('content')

	<!-- breadcrumb-section -->
	<div class="breadcrumb-section-single breadcrumb-single-bg">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="breadcrumb-text">
						<p class="english">Read the Details</p>
						<h1>{{__('header.Event')}}</h1>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end breadcrumb section -->
	
	<!-- single article section -->
	<div class="mt-150 mb-150">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
				<div class="single-article-section dd da">
							
                            @if(app()->getLocale()=='en')
							<h2>{{$model->title_en}}</h2>
                        @else
                        <h2>{{$model->title_dr}}</h2>
                        @endif
                      
                        <div class="single-article-text" >
                            <p class="blog-meta">
                                <span class="author"><i class="fas fa-user"></i> {{ optional($model->user)->name ?? 'Admin' }} </span>
                                <span class="date"><i class="fas fa-calendar"></i>    
                                {{ \Carbon\Carbon::parse($model->created_at)->format('d F, Y') }}</span>
                            
                            </p><br><hr>
                                <img src="{{URL::asset('public/uploads/admin/event/'.$model->image)}}"  alt="">
                                <hr>
                                @if(app()->getLocale()=='en')
                            {!! $model->description_en !!}	
                            @else
                            {!! $model->description_dr !!}	
                            @endif
						</div>
					</div>
				</div>
				<!-- <div class="col-lg-4">
					<div class="sidebar-section">
						<div class="recent-posts">
							<h4>Recent Posts</h4>
							<ul>
								<li><a href="single-news.html">You will vainly look for fruit on it in autumn.</a></li>
								<li><a href="single-news.html">A man's worth has its season, like tomato.</a></li>
								<li><a href="single-news.html">Good thoughts bear good fresh juicy fruit.</a></li>
								<li><a href="single-news.html">Fall in love with the fresh orange</a></li>
								<li><a href="single-news.html">Why the berries always look delecious</a></li>
							</ul>
						</div>
						<div class="archive-posts">
							<h4>Archive Posts</h4>
							<ul>
								<li><a href="single-news.html">JAN 2019 (5)</a></li>
								<li><a href="single-news.html">FEB 2019 (3)</a></li>
								<li><a href="single-news.html">MAY 2019 (4)</a></li>
								<li><a href="single-news.html">SEP 2019 (4)</a></li>
								<li><a href="single-news.html">DEC 2019 (3)</a></li>
							</ul>
						</div>
						<div class="tag-section">
							<h4>Tags</h4>
							<ul>
								<li><a href="single-news.html">Apple</a></li>
								<li><a href="single-news.html">Strawberry</a></li>
								<li><a href="single-news.html">BErry</a></li>
								<li><a href="single-news.html">Orange</a></li>
								<li><a href="single-news.html">Lemon</a></li>
								<li><a href="single-news.html">Banana</a></li>
							</ul>
						</div>
					</div>
				</div> -->
			</div>
		</div>
	</div>
	<!-- end single article section -->

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