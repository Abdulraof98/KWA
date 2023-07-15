@extends('layouts.main1')
@section('content')
    <!-- Header Start -->
    <div class="container-fluid bg-primary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 100px">
            <h3 class="display-3 font-weight-bold text-white">{{__('header.Blog')}}</h3>
            <div class="d-inline-flex text-white">
                <p class="m-0"><a class="text-white" href="{{route('/')}}">{{__('header.Home')}}</a></p>
                <p class="m-0 px-2">/</p>
                <p class="m-0">{{__('header.Blog')}}</p>
            </div>
        </div>
    </div>
    <!-- Header End -->
           <!-- Dynamic Blog  start -->
    <div class="container-fluid pt-5">
        <div class="container">
            </div>
                <div class=" mb-4">
                    <div class="card border-0 shadow-sm mb-2">
                        <img class="card-img-top mb-2" src="{{URL::asset('public/uploads/admin/blog/'.$blog->image)}}" alt="" >
                        <div class="card-body bg-light text-center p-4" id="blog_description">
                            <h4 class="">{{ $blog->title}}</h4>
                            {!! $blog->description !!}
                           
                            <!-- <a href="" class="btn btn-primary px-4 mx-auto my-2">Read More</a> -->
                        </div>
                    </div>
                </div>
    </div>
    <!-- Dynamic Blog End  -->
        



@stop
@section('js')
<script>
// $('#blog_description')
</script>
@stop