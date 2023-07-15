@extends('layouts.main1')
@section('content')
    <!-- Header Start -->
    <div class="container-fluid bg-primary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 200px">
            <h3 class="display-3 font-weight-bold text-white">{{__('header.Blogs')}}</h3>
            <div class="d-inline-flex text-white">
                <p class="m-0"><a class="text-white" href="{{route('/')}}">{{__('header.Home')}}</a></p>
                <p class="m-0 px-2">/</p>
                <p class="m-0">{{__('header.Blogs')}}</p>
            </div>
        </div>
    </div>
    <!-- Header End -->


           <!-- Dynamic Blog  start -->
    <div class="container-fluid pt-5">
        <div class="container">
            <div class="text-center pb-2">
                <p class="section-title px-5"><span class="px-2">{{__('header.Latest Blog')}}</span></p>
            
            </div>
            <div class="row pb-3">
                @foreach($blogs as $val)
                <div class="col-lg-4 mb-4">
                    <div class="card border-0 shadow-sm mb-2">
                        <img class="card-img-top mb-2" src="{{URL::asset('public/uploads/admin/blog/'.$val->image)}}" alt="" style=" height: 280px;">
                        <div class="card-body bg-light text-center p-4">
                            <h4 class="">{{ $val->title}}</h4>
                            <div class="d-flex justify-content-center mb-3">
                                <small class="mr-3"><i class="fa fa-user text-primary"></i> Admin</small>
                                <small class="mr-3"><i class="fa fa-folder text-primary"></i> Management</small>
                                <!-- <small class="mr-3"><i class="fa fa-comments text-primary"></i> 15</small> -->
                            </div>
                            @php
                           $getlength = strlen($val->description);
                            $maxLength = 300;
                            if ($getlength > $maxLength) { 
                            echo substr($val->description, 0, strpos($val->description, ' ', $maxLength));
                            echo "...";    
                        } else {
                                echo $val->description;
                            }
                            @endphp
                            </p>
                            <a href="{{route('show-blog',['id'=>$val->id])}}" class="btn btn-primary px-4 mx-auto my-2">{{__('Header.Read More')}}</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Dynamic Blog End  -->
        



@stop