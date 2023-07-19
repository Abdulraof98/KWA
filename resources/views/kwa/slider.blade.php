<!-- home page slider -->
<!-- <span><img class="company_logo" src="{{URL::asset('public/assets/img/company-logos/kwa_white.png')}}"  alt="" > </span> -->
<div class="homepage-slider">
	@foreach($slide as $sl)
	<div class="single-homepage-slider"
		style=" background-image:url({{URL::asset('public/uploads/admin/slide/'.$sl->image)}})">
		
	</div>
	@endforeach
		
</div>
<script>

$('.homepage-slider').owlCarousel({
  // other options...
  autoplay: true,
  autoplayTimeout: 500, // Adjust this value to change the speed (e.g., 2000 for 2 seconds)
});

</script>
	<!-- end home page slider -->
