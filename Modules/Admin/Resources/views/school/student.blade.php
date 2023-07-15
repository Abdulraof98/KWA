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
                <span class="caption-subject font-green-haze bold uppercase">{{ isset($update) ? 'Update' : (isset($view)? 'View' : 'Create New')}} User</span>
            </div>
        </div>
        <div class="portlet-body form">
            <form class="form-horizontal form-row-seperated" action="{{isset($update)? route('admin-manage-users',['id'=>$id,'update'=>$update]):route('admin-manage-users')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-body">
                    <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                        <label class="col-md-2 control-label">Name </label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="first_name" value="{{isset($user->first_name)? $user->first_name : old('first_name') }}" placeholder="Name">
                            @if ($errors->has('first_name'))
                                <div class="help-block">{{ $errors->first('first_name') }}</div>
                                @endif
                        </div>
                        <label class="col-md-2 control-label"> Surname</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="surname" value="{{isset($user->surname)? $user->surname : old('surname')  }}" placeholder="Nick Name">
                            @if ($errors->has('surname'))
                                <div class="help-block">{{ $errors->first('surname') }}</div>
                                @endif
                        </div>
                       
                    </div>
                    <div class="form-group {{ $errors->has('Gender') ? ' has-error' : '' }}">
                    
                    <label class="col-md-2 control-label">Study Level </label>
                        <div class="col-md-4">
                            <select name="study_level" id="" class="form-control">
                                <option value="" style="display:none;">Choose study  level</option>
                                <option value="1" >12th</option>
                                <option value="2" >Pre graduate</option>
                                <option value="3" {{ old('islamic_level') == '3' ? "selected" : "" }}>Post Gradute</option>
                                <option value="3" {{ old('islamic_level') == '3' ? "selected" : "" }}>PHD</option>
                                
                            </select>
                            @if ($errors->has('study_level'))
                                <div class="help-block">{{ $errors->first('study_level') }}</div>
                                @endif
                        </div>
                        <label class="col-md-2 control-label">Level of Islamic knowledge </label>
                        <div class="col-md-4">
                            <select name="study_level" id="" class="form-control">
                                <option value="" style="display:none;">{{__('forms.Level of Islamic knowledge')}}</option>
                                <option value="1" {{ old('islamic_level') == '1' ? "selected" : "" }}>{{__('forms.Low')}}</option>
                                <option value="2" {{ old('islamic_level') == '2' ? "selected" : "" }}>{{__('forms.Medium')}}</option>
                                <option value="3" {{ old('islamic_level') == '3' ? "selected" : "" }}>{{__('forms.High')}}</option>
                                
                            </select>
                            @if ($errors->has('study_level'))
                                <div class="help-block">{{ $errors->first('study_level') }}</div>
                                @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('location') ? ' has-error' : '' }}">
                        
                        <label class="col-md-2 control-label">Email Address</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="email" value="{{isset($user->email)? $user->email : '' }}" placeholder="name@gmail.com">
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
                        <label class="col-md-2 control-label">Selected Courses</label>
                        <div class="col-md-4">
                        <input type="text" class="form-control" name="course" value="{{isset($user->course)? $user->course : '' }}"  placeholder="">
                            @if ($errors->has('course'))
                                <div class="help-block">{{ $errors->first('course') }}</div>
                                @endif
                        </div>
                        <label class="col-md-2 control-label">WhatsApp No.</label>
                        <div class="col-md-4">
                        <!-- <img class="media-object" src="{{ URL::asset('public/backend/assets/layouts/layout/img/avatar3.jpg') }}" alt="..."> -->
                        <input type="text" class="form-control" name="phone_no" value="{{isset($user->phone_no)? $user->phone_no : '' }}" >
                        @if ($errors->has('phone_no'))
                                <div class="help-block">{{ $errors->first('phone_no') }}</div>
                                @endif
                    </div>
                    </div>
                    <div class="form-group {{ $errors->has('size') ? ' has-error' : '' }}">
                        <label class="col-md-2 control-label">Country</label>
                        <div class="col-md-4">
                        <input type="text" class="form-control" name="country" value="{{isset($user->counter)? $user->country : '' }}" >
                            @if ($errors->has('course'))
                                <div class="help-block">{{ $errors->first('course') }}</div>
                                @endif
                        </div>
                        <label class="col-md-2 control-label">City </label>
                        <div class="col-md-4">
                        <!-- <img class="media-object" src="{{ URL::asset('public/backend/assets/layouts/layout/img/avatar3.jpg') }}" alt="..."> -->
                        <input type="text" class="form-control" name="city" value="{{isset($user->city)? $user->city : '' }}" placeholder="location">
                        @if ($errors->has('city'))
                                <div class="help-block">{{ $errors->first('city') }}</div>
                                @endif
                    </div>
                    </div>
                    <div class="form-group {{ $errors->has('size') ? ' has-error' : '' }}">
                        <label class="col-md-2 control-label">Class Timing</label>
                        <div class="col-md-4">
                        <input type="text" class="form-control" name="afg_class_time" value="{{isset($user->afg_class_time)? $user->afg_class_time : '' }}" >
                            @if ($errors->has('afg_class_time'))
                                <div class="help-block">{{ $errors->first('afg_class_time') }}</div>
                                @endif
                        </div>
                        
                    <label class="col-md-2 control-label">Identity Card (Tazkira) </label>
                        <div class="col-md-4">
                        <!-- <img class="media-object" src="{{ URL::asset('public/backend/assets/layouts/layout/img/avatar3.jpg') }}" alt="..."> -->
                        <input type="file" class="form-control" name="tazkira" value="{{isset($user->tazkira)? $user->tazkira : '' }}" placeholder="location">
                        @if ($errors->has('tazkira'))
                                <div class="help-block">{{ $errors->first('tazkira') }}</div>
                                @endif
                    </div>
                    </div>

                    <div class="form-group {{ $errors->has('budget') ? ' has-error' : '' }}">
                        <label class="col-md-2 control-label">Photo </label>
                        <div class="col-md-4">
                         <input type="file" class="form-control" name="photo" value="{{isset($user->photo)? $user->profile_picture : '' }}" placeholder="Photo">
                         @if ($errors->has('photo'))
                                <div class="help-block">{{ $errors->first('photo') }}</div>
                                @endif
                        </div>
                        <label class="col-md-2 control-label">Payment </label>
                        <div class="col-md-4">
                            <div class="radio-list">
                                <label class="radio-inline">
                                    <input type="radio" name="status" value="1" {{ (isset($user->status) && ($user->status ==1)) ? 'checked' : ''}} > NOT PAID
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="status" value="0" {{ (isset($user->status) && ($user->status ==0)) ? 'checked' : ''}} > PAID
                                </label>
                               
                             
                                @if ($errors->has('status'))
                                <div class="help-block">{{ $errors->first('status') }}</div>
                                @endif
                               
                            </div>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('budget') ? ' has-error' : '' }}">
                       
                        <label class="col-md-2 control-label">Status </label>
                        <div class="col-md-4">
                            <div class="radio-list">
                                <label class="radio-inline">
                                    <input type="radio" name="status" value="1" {{ (isset($user->status) && ($user->status ==1)) ? 'checked' : ''}} > Active
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="status" value="0" {{ (isset($user->status) && ($user->status ==0)) ? 'checked' : ''}} > Inactive
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="status" value="2" {{ (isset($user->status) && ($user->status ==2)) ? 'checked' :  ''}} > Suspended
                                </label>
                             
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
@stop