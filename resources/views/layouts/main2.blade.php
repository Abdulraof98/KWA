<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Responsive website testing ">
	<!-- title -->
	<title>KWA</title>
	<!-- favicon -->
	<link rel="shortcut icon" type="image/png" href="{{URL::asset('public/assets/img/company-logos/logo.jpeg')}}">
	<!-- google font -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
	<!-- fontawesome -->
	<link rel="stylesheet" href="{{URL::asset('public/assets/css/all.min.css')}}">
	<!-- bootstrap -->
	<link rel="stylesheet" href="{{URL::asset('public/assets/bootstrap/css/bootstrap.min.css')}}">
	<!-- owl carousel -->
	<link rel="stylesheet" href="{{URL::asset('public/assets/css/owl.carousel.css')}}">
	<!-- magnific popup -->
	<link rel="stylesheet" href="{{URL::asset('public/assets/css/magnific-popup.css')}}">
	<!-- animate css -->
	<link rel="stylesheet" href="{{URL::asset('public/assets/css/animate.css')}}">
	<!-- mean menu css -->
	<link rel="stylesheet" href="{{URL::asset('public/assets/css/meanmenu.min.css')}}">
	<!-- main style -->
	<link rel="stylesheet" href="{{URL::asset('public/assets/css/main.css')}}">
	<!-- responsive -->
	<link rel="stylesheet" href="{{URL::asset('public/assets/css/responsive.css')}}">
	<link rel="stylesheet" href="{{URL::asset('public/assets/css/style.css')}}">
		<!-- sweet alert  -->
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" 
	type="text/javascript"></script>

</head>
<body>
	
	@include('partials.header2')

@yield('content')
   <!-- sign up  -->
   @include('kwa.register')
<script type="text/javascript">
                var full_path = '<?= url('/') . '/'; ?>';
            </script>
@include('partials.footer2')
<!-- jquery -->
<script src="{{URL::asset('public/assets/js/jquery-1.11.3.min.js')}}"></script>
	<!-- bootstrap -->
	<script src="{{URL::asset('public/assets/bootstrap/js/bootstrap.min.js')}}"></script>
	<!-- count down -->
	<script src="{{URL::asset('public/}assets/js/jquery.countdown.js')}}"></script>
	<!-- isotope -->
	<script src="{{URL::asset('public/assets/js/jquery.isotope-3.0.6.min.js')}}"></script>
	<!-- waypoints -->
	<script src="{{URL::asset('public/assets/js/waypoints.js')}}"></script>
	<!-- owl carousel -->
	<script src="{{URL::asset('public/assets/js/owl.carousel.min.js')}}"></script>
	<!-- magnific popup -->
	<script src="{{URL::asset('public/assets/js/jquery.magnific-popup.min.js')}}"></script>
	<!-- mean menu -->
	<script src="{{URL::asset('public/assets/js/jquery.meanmenu.min.js')}}"></script>
	<!-- sticker js -->
	<script src="{{URL::asset('public/assets/js/sticker.js')}}"></script>
	<!-- main js -->
	<script src="{{URL::asset('public/assets/js/main.js')}}"></script>
	<script src="{{URL::asset('public/assets/js/scroll.js')}}"></script>
	<script>
       @if(app()->getLocale()=='dr')
    $('.textRight').css('text-align','right');
    $('.english').attr('style','display:none !important');
    @elseif(app()->getLocale()=='en')
    $('.persian').attr('style','display:none !important');
    @endif
    </script>
	@yield('js')
</body>
</html>