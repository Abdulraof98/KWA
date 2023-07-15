<li  class="u-nav-item nav-item" style="padding-top: 10px;">    
    <ul class="d-flex align-items-center" style="list-style-type: none;">
        <li class="language dropdown">
        @if($current_locale == 'en')
            <a href="javascript:void(0)" class="dropdown-toggle" data-bs-toggle="dropdown" role="button" ><img width="30px" height="30px" style="border-radius: 50%; position: relative;" src="{{URL::asset('public/frontend/images/flag1.png')}}" /></a>
             @else
             <a href="javascript:void(0)" class="dropdown-toggle" data-bs-toggle="dropdown" role="button" ><img width="30px" height="30px" style="border-radius: 50%; position: relative;" src="{{URL::asset('public/frontend/images/flag_afg.png')}}" /></a>
             @endif
            <ul class="dropdown-menu text-center " >
                <li style=" margin-bottom: 10px;"><a href="{{route('lang',['en']) }}" style=" text-decoration: none; color: inherit; " ><img width="40px" height="40px" style="border-radius: 50%; display: block; margin: auto; " src="{{URL::asset('public/frontend/images/flag1.png')}}"/> English</a></li>
                <li><a href="{{route('lang',['dr']) }}" style="display: block; margin: auto; text-decoration: none; color: inherit;" ><img width="40px" height="40px" style="border-radius: 50%; display: block; margin: auto;" src="{{URL::asset('public/frontend/images/flag_afg.png')}}"/> دری</a></li>
                
            </ul>
        </li>
    </ul>
</li>
