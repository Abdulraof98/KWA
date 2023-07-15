<!-- home page slider -->
<span><img class="company_logo" src="{{URL::asset('public/assets/img/company-logos/kwa_white.png')}}"  alt="" > </span>
<div class="homepage-slider">

		<!-- single home slider -->
		<!-- @foreach($slide as $sl)
		<div class="single-homepage-slider homepage-bg-1"
		style=" background-image:url({{URL::asset('public/assets/img/company-logos/commingsoon.png')}})">
			<div class="container">
				<div class="row">
					<div class="col-md-12 col-lg-7 offset-lg-1 offset-xl-0">
						<div class="hero-text">
							<div class="hero-text-tablecell">
								<p class="subtitle">Lorem ipsum dolor sit amet. </p>
								
							<h2 class="english">{{$sl->title_en}}</h2>
								<h2 class="persian">{{$sl->title_dr}}</h2>
								
							<div class="hero-btns">
							        <a href="{{route('kwa_about')}}" class="boxed-btn">{{__('header.Read More')}}</a>
									<a href="" class="bordered-btn">{{__('header.Contact Us')}}</a>
							</div>
							
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		@endforeach -->
		<!-- single home slider -->
		@foreach($slide as $sl)
		<div class="single-homepage-slider"
		style=" background-image:url({{URL::asset('public/uploads/admin/event/'.$sl->image)}})">
		
			<div class="container">
				<div class="row">
					<div class="col-lg-10 offset-lg-1 text-center">
						<div class="hero-text">
							<div class="hero-text-tablecell">
							<p class="subtitle">Kabul Washington Association </p>
                          
							<h2 class="english">{{$sl->title_en}}</h2>
								<h2 class="persian">{{$sl->title_dr}}</h2>
							
								<div class="hero-btns">
									<a href="{{route('single_event',$sl->id)}}" class="boxed-btn">{{__('header.Read More')}}</a>
									<a href="{{route('kwa_contact')}}" class="bordered-btn">{{__('header.Contact Us')}}</a>
								</div>
                            
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		@endforeach
		<!-- single home slider -->
		<!-- <div class="single-homepage-slider homepage-bg-3">
			<div class="container">
				<div class="row">
					<div class="col-lg-10 offset-lg-1 text-right">
						<div class="hero-text">
							<div class="hero-text-tablecell">
							<p class="subtitle">Lorem ipsum dolor sit amet. </p>
								<h1>Lorem ipsum dolor sit amet. </h1>
								<div class="hero-btns">
									<a href="#" class="boxed-btn">{{__('header.Read More')}}</a>
									<a href="{{route('kwa_contact')}}" class="bordered-btn">Contact Us</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div> -->
	</div>
	<!-- end home page slider -->
