@extends('admin::layouts.main')

@section('breadcrumb')
<li> <a href="{{ Route('admin-manage-users') }}">Manage Users</a></li>
<li class="active">Update</li>
@stop

@section('content')
<div class="users-update">
    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-edit font-green-haze" aria-hidden="true"></i>
                <span class="caption-subject font-green-haze bold uppercase">Update User</span>
            </div>
        </div>
        <div class="portlet-body form">
            <form class="form-horizontal form-row-seperated" action="{{ route('update-user',['id'=>$user->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-body">
                    <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                        <label class="col-md-2 control-label">Name <span class="required">*</span></label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="first_name" value="{{isset($user->first_name)? $user->first_name : old('first_name') }}" placeholder="Name" required>
                            @if ($errors->has('first_name'))
                                <div class="help-block">{{ $errors->first('first_name') }}</div>
                                @endif
                        </div>
                        <label class="col-md-2 control-label"> Surname</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="last_name" value="{{isset($user->last_name)? $user->last_name : old('last_name')  }}" placeholder="Nick Name" required>
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
                                <option value="M" {{ (isset($user->gender) && ($user->gender =='M')) ? 'selected' : ''}}>Male</option>
                                <option value="F" {{ (isset($user->gender) && ($user->gender =='F')) ? 'selected' : ''}}>Female</option>
                                
                            </select>
                            @if ($errors->has('gender'))
                                <div class="help-block">{{ $errors->first('gender') }}</div>
                                @endif
                        </div>
                        <label class="col-md-2 control-label">Contact No.<span class="required">*</span></label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="phone" value="{{isset($user->phone)? $user->phone : '' }}" placeholder="(+93) 770-000-000" required>
                           
                            @if ($errors->has('phone'))
                                <div class="help-block">{{ $errors->first('phone') }}</div>
                                @endif
                           
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('location') ? ' has-error' : '' }}">
                        <label class="col-md-2 control-label">Email Address<span class="required">*</span></label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="email" value="{{isset($user->email)? $user->email : '' }}" placeholder="name@gmail.com" required>
                            @if ($errors->has('email'))
                                <div class="help-block">{{ $errors->first('email') }}</div>
                                @endif
                        </div>
                   
                        <label class="col-md-2 control-label">Birthday</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="dob" value="{{isset($user->dob)? $user->dob : '' }}"  placeholder="dd/mm/yyyy">
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
                                  <option value="2" {{ (isset($user->type_id) && ($user->type_id ==2)) ? 'selected' : ''}}>Admin</option>
                                  <option value="3" {{ (isset($user->type_id) && ($user->type_id ==3)) ? 'selected' : ''}}>User</option>
                                  <option value="4" {{ (isset($user->type_id) && ($user->type_id ==4)) ? 'selected' : ''}}>Teacher</option>
                            </select>
                            @if ($errors->has('position'))
                                <div class="help-block">{{ $errors->first('position') }}</div>
                                @endif
                        </div>
                       
                    <label class="col-md-2 control-label">Photo </label>
                        <div class="col-md-4">
                        <img class="img-responsive" style="width:200px; height:auto;" id="img"  alt="">
                         <input type="file" class="form-control" name="profile_picture" value="{{isset($user->profile_picture)? $user->profile_picture : '' }}" placeholder="Photo">
                         <img class="img-responsive" style="width:200px; height:auto;"  src="{{ URL::asset('public/' . $user->profile_picture) }}" alt="{{ $user->profile_picture }}">
                        
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
                                    <input type="radio" name="status" value="1" {{ (isset($user->status) && ($user->status ==1)) ? 'checked' : ''}} > Active
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="status" value="0" {{ (isset($user->status) && ($user->status ==0)) ? 'checked' : ''}} > Inactive
                                </label>
                                <!-- <label class="radio-inline">
                                    <input type="radio" name="status" value="2" {{ (isset($user->status) && ($user->status ==2)) ? 'checked' :  ''}} > Suspended
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
                            <button type="submit" class="btn green {{isset($view)? 'hide' : '' }}" >Update</button>
                            <a href="{{ Route('admin-manage-users') }}" class="btn default">Back</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@stop