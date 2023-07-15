@extends('admin::layouts.main')

@section('breadcrumb')
<li> <a href="{{ Route('admin-manage-users') }}">Users</a></li>
<li class="active">Create</li>
@stop

@section('content')
<div class="users-update">
    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-edit font-green-haze" aria-hidden="true"></i>
                <span class="caption-subject font-green-haze bold uppercase">Create New User</span>
            </div>
        </div>
        <div class="portlet-body form">
            <form class="form-horizontal form-row-seperated" action="{{route('create_user_post')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-body">
                    <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                        <label class="col-md-2 control-label">Name <span class="required">*</span></label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="first_name" value="{{old('first_name') }}" placeholder="Name" required>
                            @if ($errors->has('first_name'))
                                <div class="help-block">{{ $errors->first('first_name') }}</div>
                                @endif
                        </div>
                        <label class="col-md-2 control-label"> Surname</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="last_name" value="{{ old('last_name')  }}" placeholder="Nick Name" >
                            @if ($errors->has('last_name'))
                                <div class="help-block">{{ $errors->first('last_name') }}</div>
                                @endif
                        </div>
                       
                    </div>
                    <div class="form-group {{ $errors->has('Gender') ? ' has-error' : '' }}">
                    
                    <label class="col-md-2 control-label">Gender <span class="required">*</span></label>
                        <div class="col-md-4">
                            <select name="gender" id="" class="form-control" required>
                                <option value="" style="display:none;">Select</option>
                                <option value="M" >Male</option>
                                <option value="F" >Female</option>
                                
                            </select>
                            @if ($errors->has('gender'))
                                <div class="help-block">{{ $errors->first('gender') }}</div>
                                @endif
                        </div>
                        <label class="col-md-2 control-label">Contact No.<span class="required">*</span></label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="phone" value="{{ old('phone') }}" placeholder="(+93) 770-000-000" required>
                           
                            @if ($errors->has('phone'))
                                <div class="help-block">{{ $errors->first('phone') }}</div>
                                @endif
                           
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('location') ? ' has-error' : '' }}">
                        <label class="col-md-2 control-label">Email Address<span class="required">*</span></label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="email" value="{{old('email') }}" placeholder="name@gmail.com" required>
                            @if ($errors->has('email'))
                                <div class="help-block">{{ $errors->first('email') }}</div>
                                @endif
                        </div>
                   
                        <label class="col-md-2 control-label">Birthday</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="dob" value="{{old('dob')}}"  placeholder="dd/mm/yyyy">
                            @if ($errors->has('dob'))
                                <div class="help-block">{{ $errors->first('dob') }}</div>
                                @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('size') ? ' has-error' : '' }}">
                        <label class="col-md-2 control-label">Position<span class="required">*</span></label>
                        <div class="col-md-4">
                            <select name="type_id" id="" class="form-control" required>
                                <option value=" " style="display:none;" >Select Position</option>
                                @foreach($userTypes as $ut)
                                  <option value="{{$ut->id}}" >{{$ut->type}}</option>
                                  @endforeach
                            </select>
                            @if ($errors->has('position'))
                                <div class="help-block">{{ $errors->first('position') }}</div>
                                @endif
                        </div>
                        <!-- <label class="col-md-2 control-label">Identity Card (Tazkira) </label>
                        <div class="col-md-4">
                        <img class="media-object" src="{{ URL::asset('public/backend/assets/layouts/layout/img/avatar3.jpg') }}" alt="...">
                        <input type="file" class="form-control" name="identity" value="{{isset($user->identity)? $user->identity : '' }}" placeholder="location">
                        @if ($errors->has('identity'))
                                <div class="help-block">{{ $errors->first('identity') }}</div>
                                @endif
                    </div> -->
                    <label class="col-md-2 control-label">Photo </label>
                        <div class="col-md-4">
                         <input type="file" class="form-control" name="profile_picture" value="{{isset($user->profile_picture)? $user->profile_picture : '' }}" placeholder="Photo">
                         <img class="img-responsive" style="width:200px; height:auto;" id="img"  alt="">
                       
                         @if ($errors->has('profile_picture'))
                                <div class="help-block">{{ $errors->first('profile_picture') }}</div>
                                @endif
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('budget') ? ' has-error' : '' }}">
                        
                        <label class="col-md-2 control-label">Status <span class="required">*</span></label>
                        <div class="col-md-4">
                            <div class="radio-list">
                                <label class="radio-inline">
                                    <input type="radio" name="status" value="1" > Active
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="status" value="0"> Inactive
                                </label>
                                <!-- <label class="radio-inline">
                                    <input type="radio" name="status" value="2"  > Suspended
                                </label> -->
                             
                                @if ($errors->has('status'))
                                <div class="help-block">{{ $errors->first('status') }}</div>
                                @endif
                               
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-3 col-md-6">
                            <button type="submit" class="btn green {{isset($view)? 'hide' : '' }}" >{{ isset($update) ? 'Update' : 'Create'}}</button>
                            <a href="{{ Route('admin-manage-users') }}" class="btn default">Back</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
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
@stop