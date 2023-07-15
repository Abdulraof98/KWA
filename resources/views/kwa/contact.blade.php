@extends('layouts.main2')
@section('content')

	
	
    <!--PreLoader Ends-->

	<!-- breadcrumb-section -->
	<div class="breadcrumb-section breadcrumb-bg breadcrumb-single-bg">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="breadcrumb-text">
						<p class="english">KABUL WASHINGTON ASSOCIATION</p>
						<h1>{{__('header.Contact Us')}}</h1>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end breadcrumb section -->

	<!-- contact form -->
	<div class="contact-from-section mt-150 mb-150">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 mb-5 mb-lg-0">
					<div class="form-title">
						<h2 class="english">Have you any question?</h2>
						<h2 class="persian text-right">سوالی دارید؟</h2>
						<p class="english">If you have any question, sugestion for us you can contact us through the bellow form and we will reach you as soon as possible. </p>
						<p class="persian text-right">اگر سوالی دارید، پیشنهادی برای ما دارید، می توانید از طریق فرم زیر با ما تماس بگیرید و ما در اسرع وقت با شما تماس خواهیم گرفت</p>
					</div>
				 	<div id="form_status"></div>
					<div class="contact-form" style="direction:rtl;">
						<form type="POST" id="fruitkha-contact" >
							@csrf
							<p>
								<input type="text" placeholder="{{__('forms.Name')}}" name="name" id="name" required>
								<input type="email" placeholder="{{__('forms.Email')}}" name="email" id="email" required>
							</p>
							<p>
								<input type="tel" placeholder="{{__('forms.Phone')}}" name="phone_no" id="phone" required>
								<input type="text" placeholder="{{__('forms.Subject')}}" name="subject" id="subject" required>
							</p>
							<p><textarea name="message" id="message" cols="30" rows="10" placeholder="{{__('forms.Message')}}" required></textarea></p>
							
							<p><input type="submit" value="{{__('forms.Submit')}}"></p>
						</form>
					</div>
				</div>
				<div class="col-lg-4 mt-140 mb-lg-0">
				<div class="d-flex">
                        <i class="fa fa-map-marker-alt d-inline-flex align-items-center justify-content-center bg-blue  rounded-circle" style="width: 45px; height: 45px;"></i>
                        <div class="pl-3 information">
                            <h5>{{__('footer.Address')}}</h5>
                            <p>34/8, seattle, washington, United State</p>
                        </div>
                    </div>
                    <div class="d-flex">
                        <i class="fa fa-envelope d-inline-flex align-items-center justify-content-center bg-blue  rounded-circle" style="width: 45px; height: 45px;"></i>
                        <div class="pl-3 information" >
                            <h5>{{__('footer.Email')}}</h5>
                            <p>info@kabulwashington.org</p>
                        </div>
                    </div>
                    <div class="d-flex">
                        <i class="fa fa-phone d-inline-flex align-items-center justify-content-center bg-blue  rounded-circle" style="width: 45px; height: 45px;"></i>
                        <div class="pl-3 information">
                            <h5>{{__('footer.Phone')}}</h5>
                            <p>+93782228844</p>
                        </div>
                    </div>
                    <div class="d-flex">
                        <i class="far fa-clock d-inline-flex align-items-center justify-content-center bg-blue  rounded-circle" style="width: 45px; height: 45px;"></i>
                        <div class="pl-3 information">
                            <h5>{{__('footer.Opening Hours')}}</h5>
                            <strong>Saturday - Thursday:</strong>
                            <p class="m-0">08:00 AM - 08:00 PM </p>
                        </div>
                    </div>
				</div>
			</div>
		</div>
	</div>
	<!-- end contact form -->
	
	<!-- find our location -->
	<div class="find-location blue-bg">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 text-center">
					<p> <i class="fas fa-map-marker-alt"></i> Find Our Location</p>
				</div>
			</div>
		</div>
	</div>
	<!-- end find our location -->

	<!-- google map section -->
	<div class="embed-responsive embed-responsive-21by9">
	<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2689.870308998705!2d-122.30172421691218!3d47.37783208665801!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x54905b6446da5377%3A0x540f41cdc95149b0!2zS2FidWwgV2FzaGluZ3RvbiBBc3NvY2lhdGlvbiDYp9mG2KzZhdmGINqp2KfYqNmEINmI2KfYtNmG2q_YqtmG!5e0!3m2!1sen!2sin!4v1662534305225!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>	
</div>
	<!-- end google map section -->


	
    @stop
	@section('js')
	<script>
			$('#fruitkha-contact').submit(function(e){ 
			if($("form")[0].checkValidity()) {
				e.preventDefault();
				var data = new FormData($(this)[0]);
				var url="{{route('add-contact')}}";
				$.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                        url: url,
                        type: 'POST',
                        dataType: 'json',
                        processData: false,
                        contentType: false,
                        data: data,
                        success: function (resp) {
                            console.log(resp);
                            if (resp.status == 'success') {
                                swal({
									    showConfirmButton: false, 
                                        title: resp.success ,
                                        icon: "success",
										timer: 2000,
                                    });
                            }else if(resp.status=='errors'){
                                $('.login-error').css('display','block');
                            }
                        },
                        
                    });
			}else console.log("invalid form");
            });
        </script>   
	@stop