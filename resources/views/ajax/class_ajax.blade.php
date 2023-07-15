@if(count($classes)>0)
@foreach($classes as $class)
<div class="col-lg-4 mb-5">
    <div class="card border-0 bg-light shadow-sm pb-2">
        <img class="card-img-top mb-2" src="{{URL::asset('public/alifba/class_img/'.$class->image)}}" alt="600X400" style=" height: 280px;">
        <div class="card-body text-center">
            <h4 class="card-title">@if(app()->getLocale()=='en') {{$class->class_name_en}} @else {{$class->class_name_dr}} @endif</h4>
            <!-- <p class="card-text">asdsad</p> -->
            @if(app()->getLocale()=='en') {!! $class->content_en !!} @else {!! $class->content_dr !!} @endif
        </div>
        <div class="card-footer bg-transparent py-4 px-5">
        @if($class->age)
            <div class="row border-bottom">
                <div class="col-6 py-1 text-right border-right"><strong> {{__('class.Age of Kids')}}</strong></div>
                <div class="col-6 py-1">{{$class->age}} {{__('class.Years')}}</div>
            </div>
            @endif
            @if($class->total_seat)
            <div class="row border-bottom">
                <div class="col-6 py-1 text-right border-right"><strong>{{__('class.Total Seats')}}</strong></div>
                <div class="col-6 py-1">{{$class->total_seat}} {{__('class.Seats')}}</div>
            </div>
            @endif
            @if($class->time)
            <div class="row border-bottom">
                <div class="col-6 py-1 text-right border-right"><strong>{{__('class.Class Time')}}</strong></div>
                <div class="col-6 py-1">{{$class->time }}</div>
            </div>
            @endif
            @if($class->fee)
            <div class="row">
                <div class="col-6 py-1 text-right border-right"><strong>{{__('class.Tution Fee')}}</strong></div>
                <div class="col-6 py-1">{{$class->fee}} $  / {{__('class.Month')}}</div>
            </div>
            @endif
        </div>
        <!-- <li class="u-nav-item"><a href="javascript:void(0);" onclick="pay_with_paypal(this)" data-id="{{$class->id}}" >Pay</a></li>  -->
        <a href="{{route('register_block',['id'=>$class->id])}}" class="btn btn-primary px-4 mx-auto mb-4" data-id={{$class->id }}>{{__('class.Join Now')}}</a>
    </div>
</div>
@endforeach
@endif