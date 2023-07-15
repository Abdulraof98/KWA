
    <!-- Footer Start -->
    <div class="container-fluid bg-secondary text-white mt-5 py-5 px-sm-3 px-md-5" >
        <div class="row pt-5">
            <div class="col-lg-3 col-md-6 mb-5">
                <a href="" class="navbar-brand font-weight-bold text-primary m-0 mb-4 p-0" style="font-size: 40px; line-height: 40px;">
                    <i class="flaticon-043-teddy-bear"></i>
                    <span class="text-white">Alif-Ba</span>
                </a>
                @php
                  $footer= \App\Models\Cms::where('slug','header_slide')->first();
                @endphp
                @if(app()->getLocale()=='en')
                {!! $footer->content_body_en !!}
                @elseif(app()->getLocale()=='dr')
                {!! $footer->content_body_dr !!}
                @endif
                <div class="d-flex justify-content-start mt-4" >
                    <a class="btn btn-outline-primary rounded-circle text-center mr-2 px-0"
                        style="width: 38px; height: 38px;" href="#"><i class="fab fa-twitter"></i></a>
                    <a class="btn btn-outline-primary rounded-circle text-center mr-2 px-0"
                        style="width: 38px; height: 38px;" href="#"><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-outline-primary rounded-circle text-center mr-2 px-0"
                        style="width: 38px; height: 38px;" href="#"><i class="fab fa-linkedin-in"></i></a>
                    <a class="btn btn-outline-primary rounded-circle text-center mr-2 px-0"
                        style="width: 38px; height: 38px;" href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-5">
                <h3 class="text-primary mb-4 textRight">{{__('footer.Get In Touch')}}</h3>
                <div class="d-flex">
                    <h4 class="fa fa-map-marker-alt text-primary"></h4>
                    <div class="pl-3">
                        <h5 class="text-white">{{__('footer.Address')}}</h5>
                        <p>3rd Part Khairkhana, Kabul, Afghanistan</p>
                    </div>
                </div>
                <div class="d-flex">
                    <h4 class="fa fa-envelope text-primary"></h4>
                    <div class="pl-3">
                        <h5 class="text-white">{{__('footer.Email')}}</h5>
                        <p>info@alifbaonline.com</p>
                    </div>
                </div>
                <div class="d-flex">
                    <h4 class="fa fa-phone-alt text-primary"></h4>
                    <div class="pl-3">
                        <h5 class="text-white">{{__('footer.Phone')}}</h5>
                        <p>+93766212133</p>
                    </div>
                </div>
            </div>
            <!-- Quick Links  -->
            <div class="col-lg-3 col-md-6 mb-5">
                <h3 class="text-primary mb-4">{{__('footer.Quick Links')}}</h3>
                <div class="d-flex flex-column justify-content-start">
                    <!-- <a class="text-white mb-2" href="{{route('/')}}"><i class="fa fa-angle-right mr-2"></i>{{__('footer.Home')}}</a> -->
                    <a class="text-white mb-2" href="{{route('about')}}"><i class="fa fa-angle-right mr-2"></i>{{__('footer.About Us')}}</a>
                    <a class="text-white mb-2" href="{{route('class')}}"><i class="fa fa-angle-right mr-2"></i>{{__('footer.Our Classes')}}</a>
                    <!-- <a class="text-white mb-2" href="{{route('team')}}"><i class="fa fa-angle-right mr-2"></i>{{__('footer.Our Teachers')}}</a> -->
                    <!-- <a class="text-white mb-2" href="{{URL::route('/')}}"><i class="fa fa-angle-right mr-2"></i>Our Blog</a> -->
                    <a class="text-white" href="{{URL::route('contact')}}"><i class="fa fa-angle-right mr-2"></i>{{__('footer.Contact Us')}}</a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-5" style="@if(app()->getLocale()=='dr') direction: rtl; @else direction: ltr; @endif">
                <h3 class="text-primary mb-4 textRight">{{__('footer.Need Help ?')}}</h3>
                <form action="{{route('new_inquiry')}}" method="post">
                    @csrf
                    <!-- <div class="form-group">
                        <input type="text" class="form-control border-0 py-4" name="name" placeholder="{{__('footer.Your Name')}}" required="required" />
                    </div> -->
                    <div class="form-group">
                        <input type="email" class="form-control border-0 py-4" name="email" placeholder="{{__('footer.Your Email')}}"
                            required="required" />
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control border-0 py-4" name="phone" placeholder="{{__('footer.Your WhatsApp')}}" 
                            required="required" />
                    </div>
                    <div class="form-group">
                        <textarea type="text" class="form-control border-0 py-4" name="phone" placeholder="{{__('footer.Your Inquiry')}}" 
                            required="required" ></textarea>
                    </div>
                    <div>
                        <button class="btn btn-primary btn-block border-0 py-3" type="submit">{{__('footer.Submit Now')}} </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="container-fluid pt-5" style="border-top: 1px solid rgba(23, 162, 184, .2);;">
            <p class="m-0 text-center text-white">
                &copy; <a class="text-primary font-weight-bold" href="#">Alif-Ba</a>. All Rights Reserved. Designed
                by
                <a class="text-primary font-weight-bold" href="#">Abdul Raof</a>
            </p>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary p-3 back-to-top"><i class="fa fa-angle-double-up"></i></a>
   
