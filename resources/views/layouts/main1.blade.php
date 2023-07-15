<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Alif-Ba</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta http-equiv="Content-Language" content="en,fa">
        <meta content="روس اسلامی بطور انلاین" name="keywords">
        <meta content="Online Islamic courses for your kids and women worldwide with men and women teachers from Afghanistan with languages like Arabic, Dari, and Pashto. "  name="description">
        <meta content="دوره های آنلاین اسلامی برای کودکان و زنان شما در سراسر جهان با معلمان زن و مرد از افغانستان با زبان هایی مانند عربی، دری و پشتو."  name="description">
        
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <!-- Favicon -->
        <link href="{{URL::asset('public/frontend/images/logo.jpg')}}" rel="icon"  class="rounded-circle">
        <!-- <img src="{{URL::asset('public/frontend/images/logo.jpg')}}" width="100" height="100"  alt="" class="rounded-circle"> -->

        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Handlee&family=Nunito&display=swap" rel="stylesheet">

        <!-- Font Awesome -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

        <!-- Flaticon Font -->
        <!-- <link href="lib/flaticon/font/flaticon.css" rel="stylesheet"> -->
        <link href="{{URL::asset('public/alifba/lib/flaticon/font/flaticon.css')}}" rel="stylesheet" type="text/css">
        <!-- Libraries Stylesheet -->
        <!-- <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
        <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet"> -->
        <link href="{{URL::asset('public/alifba/lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">
        <link href="{{URL::asset('public/alifba/lib/lightbox/css/lightbox.min.css')}}" rel="stylesheet">
 

        <!-- bootsrap with owl -->
        <link rel="stylesheet"
        href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css"
        integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb"
        crossorigin="anonymous">
        <!-- Customized Bootstrap Stylesheet -->
        <link href="{{URL::asset('public/alifba/css/style.css')}}" rel="stylesheet">
       
        @yield('css')
            
            <script type="text/javascript">
                var full_path = '<?= url('/') . '/'; ?>';
            </script>
    </head>
    <body>
    @include('partials.dash_header1')
    
    @yield('content')
<!-- <style>
    .modal-header {
    border-bottom: 0 none;
}
.modal-footer {
    border-top: 0 none;
}
</style> -->
     <!-- sign up  -->
   @include('alifba.signup')
   @include('alifba.login')
		</div>
    @include('partials.footer1')
    </div>
  <!-- JavaScript Libraries -->
  <script src="{{URL::asset('public/frontend/js/lib/toastr.min.js')}}"></script>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="{{URL::asset('public/alifba/lib/easing/easing.min.js') }}"></script>
    <script src="{{URL::asset('public/alifba/lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{URL::asset('public/alifba/lib/isotope/isotope.pkgd.min.js') }}"></script>
    <script src="{{URL::asset('public/alifba/lib/lightbox/js/lightbox.min.js') }}"></script>
    <!-- <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/isotope/isotope.pkgd.min.js"></script>
    <script src="lib/lightbox/js/lightbox.min.js"></script> -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- Contact Javascript File -->
    <script src="{{URL::asset('public/alifba/mail/jqBootstrapValidation.min.js') }}"></script>
    <script src="{{URL::asset('public/alifba/mail/contact.js') }}"></script>

    <!-- paypal javascript   -->
    <script src="{{URL::asset('public/alifba/js/payment.js') }}"></script>
    <!-- Template Javascript -->
    <script src="{{URL::asset('public/alifba/js/main.js') }}"></script>
    @yield('js')
    <script>
    function readURL(input) {
    if (input.files && input.files[0]) {
    
      var reader = new FileReader();
      reader.onload = function (e) { 
        document.querySelector("#img").setAttribute("src",e.target.result);
      };

      reader.readAsDataURL(input.files[0]); 
    }
  }
 
</script>
    @if(Session::has('success'))
    <input type="hidden" id="success_msg" value="{{ Session::get('success') }}"/> 
    <script>
        var success_msg = $('#success_msg').val();
        console.log(success_msg);
        toastr.options ={
                    "closeButton" : true,
                    "progressBar" : true,
                    'timeOut': 1000
                }
                toastr.success(success_msg);
        // swal({
        //     title: success_msg,
        //     icon: "success",
        //     buttons: false,
        //     timer: 3000,
        //   });
//        notie.alert({
//            type: 'success',
//            text: '<i class="fa fa-check"></i> ' + success_msg,
//            time: 3
//        });
    </script>
    @endif 
    @if(Session::has('error'))
    <input type="hidden" id="error_msg" value="{{ Session::get('error') }}"/> 
    <script>
        var error_msg = $('#error_msg').val();
        toastr.options ={
                    "closeButton" : true,
                    "progressBar" : true,
                    'timeOut': 1000
                }
                toastr.error(error_msg);
                // toastr($message, 'error') is equivalent to toastr()->error($message)
    </script>
    @endif 
    
    <script>
       @if(app()->getLocale()=='dr')
    $('.textRight').css('text-align','right');
    $('.english').attr('style','display:none !important');
    @elseif(app()->getLocale()=='en')
    $('.persian').attr('style','display:none !important');
    @endif
    </script>
    </body>
</html>
