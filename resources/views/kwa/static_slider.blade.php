
	<!-- hero area -->
	<span><img class="company_logo" src="{{URL::asset('public/assets/img/company-logos/kwa_white.png')}}"  alt="" > </span>
	@foreach($slide as $sl)
	<div class="hero-area hero-bg " style=" background-image:url({{URL::asset('public/uploads/admin/event/'.$sl->image)}})">
		<div class="container">
			<div class="row">
				<div class="col-lg-9 offset-lg-2 text-center">
					<div class="hero-text">
						<div class="hero-text-tablecell">
							<p class="subtitle">Kabul Washington Association</p>
							
							<h2 class="english">{{$sl->title_en}}</h2>
								<h2 class="persian">{{$sl->title_dr}}</h2>
								
							<div class="hero-btns">
							        <a href="#" class="boxed-btn">{{__('header.Read More')}}</a>
									<a href="{{route('kwa_contact')}}" class="bordered-btn">{{__('header.Contact Us')}}</a>
							</div>
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	@endforeach
	<!-- end hero area -->
