@if(count($blogs)>0) 
@foreach($blogs as $val)
    <div class="col-lg-4 mb-4">
        <div class="card border-0 shadow-sm mb-2">
            <img class="card-img-top mb-2" src="{{URL::asset('public/uploads/admin/blog/'.$val->image)}}" alt="" style=" height: 280px;">
            <div class="card-body bg-light text-center p-4">
                <h4 class="">{{ $val->title}}</h4>
                <div class="d-flex justify-content-center mb-3">
                    <!-- <small class="mr-3"><i class="fa fa-user text-primary"></i> Admin</small> -->
                    <!-- <small class="mr-3"><i class="fa fa-folder text-primary"></i> Management</small> -->
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
                <a href="{{route('show-blog',['id'=>$val->id])}}" class="btn btn-primary px-4 mx-auto my-2">{{__('header.Read More')}}</a>
            </div>
        </div>
    </div>
@endforeach
@endif