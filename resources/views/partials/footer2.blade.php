
	<!-- footer -->
	<div class="footer-area">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-6">
					<div class="footer-box about-widget">
						<h2 class="widget-title english">About us</h2>
						<h2 class="widget-title persian">در باره ما</h2>

					<!-- <p>Ut enim ad minim veniam perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae.</p> -->
					@php
                  $footer= \App\Models\Cms::where('slug', 'like', '%logo_content*%')->first();
                @endphp
                @if(app()->getLocale()=='en')
                {!! $footer->content_body_en !!}
                @elseif(app()->getLocale()=='dr')
                {!! $footer->content_body_dr !!}
                @endif
				</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="footer-box get-in-touch">
						<h2 class="widget-title english">Get in Touch</h2>
						<h2 class="widget-title persian">در تماس باشید</h2>
						<ul>
							<li>24860 Pacific Hwy S Suite 102, Kent, WA 98032, USA</li>
							<li><a href="mailto:info@kabulwashington.org"><u>info@kabulwashington.org</u></a></li>
							<li>+12065036729</li>
						</ul>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="footer-box pages">
						<h2 class="widget-title english">Pages</h2>
						<h2 class="widget-title persian">صفحه ها</h2>
						<ul>
							<li><a href="{{route('kwa_home')}}">{{__('header.Home')}}</a></li>
							<li><a href="{{route('kwa_projects')}}">{{__('header.Projects')}}</a></li>
							<li><a href="{{route('kwa_events')}}">{{__('header.Events')}}</a></li>
							<li><a href="{{route('kwa_events')}}">{{__('header.Contact')}}</a></li>
						</ul>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="footer-box subscribe">
						<h2 class="widget-title">{{__('footer.Need Help ?')}}</h2>
						<p>{{__('footer.You can ask your queries here')}}</p>
						<form action="{{route('add-inquiry')}}" method="post" id="inquiry_id" enctype="multipart/form-data">
							@csrf
							<div class="form-group">
							<input type="text" class="form-control" name="name" placeholder="{{__('footer.Your Name')}}" required>
							</div>
							<div class="form-group">
                                <input type="email" class="form-control border-0 py-4" name="email" placeholder="{{__('footer.Your Email')}}"
                                required />
                            </div>
							<textarea class="form-control" name="comment" rows="5" placeholder="" required></textarea>
							
							
								<button class="btn btn-primary btn-block border-0 py-3" type="submit">{{__('footer.Send Message')}} </button>
						
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end footer -->
	
	<!-- copyright -->
	<div class="copyright">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-md-12">
					<!-- <p>Copyrights &copy; 2019 - <a href="https://imransdesign.com/">Imran Hossain</a>,  All Rights Reserved.</p> -->
				</div>
				<div class="col-lg-6 text-right col-md-12">
					<div class="social-icons">
						<ul>
							<li><a href="https://www.facebook.com/KabulWAA/" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
							<li><a href="#" target="_blank"><i class="fab fa-twitter"></i></a></li>
							<li><a href="#" target="_blank"><i class="fab fa-instagram"></i></a></li>
							<li><a href="#" target="_blank"><i class="fab fa-linkedin"></i></a></li>
							<li><a href="#" target="_blank"><i class="fab fa-dribbble"></i></a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	 <!-- Back to Top -->
	 <a href="#" class="btn btn-primary p-3 back-to-top"><i class="fa fa-angle-double-up"></i></a>

	 <script>
			$('#inquiry_id').submit(function(e){ 
			if($("form")[0].checkValidity()) {
				e.preventDefault();
				var data = new FormData($(this)[0]);
				var url="{{route('add-inquiry')}}";
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
		<script>
		// trigger 
	$("#donate-click").click(function(){
		// $('#donate-button').trigger('click');
		console.log('paypal cliked');
	});
	</script> 