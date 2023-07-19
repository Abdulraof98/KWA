@extends('layouts.main2')
@section('content')

	<!-- breadcrumb-section -->
	<div class="breadcrumb-section-single breadcrumb-single-bg">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="breadcrumb-text">
						<p>Read the Details</p>
						<h1>Story</h1>
					</div>
				</div>
			</div>
		</div>
	</div>
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
                                <img src="{{URL::asset('public/uploads/admin/story/'.$model->image)}}"  alt="">
                                <hr>
                                @if(app()->getLocale()=='en')
                            {!! $model->description_en !!}	
                            @else
                            {!! $model->description_dr !!}	
                            @endif
						</div>
					</div>
				</div>
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