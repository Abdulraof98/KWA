@extends('admin::layouts.main')

@section('breadcrumb')
<li> <a href="{{ Route('manage-students') }}">Students</a></li>
<li class="active">Create</li>
@stop

@section('content')
<div class="users-update">
    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-edit font-green-haze" aria-hidden="true"></i>
                <span class="caption-subject font-green-haze bold uppercase">Create New Student</span>
            </div>
        </div>
        <div class="portlet-body form">
            <form class="form-horizontal form-row-seperated" action="{{ route('create-student')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-body">
                    <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                        <label class="col-md-2 control-label">Name <span class="required">*</span></label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Name" required>
                            @if ($errors->has('name'))
                                <div class="help-block">{{ $errors->first('name') }}</div>
                                @endif
                        </div>
                        <label class="col-md-2 control-label"> Surname</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="surname" value="{{ old('surname')  }}" placeholder="Surname">
                            @if ($errors->has('surname'))
                                <div class="help-block">{{ $errors->first('surname') }}</div>
                                @endif
                        </div>
                       
                    </div>
                    <div class="form-group {{ $errors->has('study_level') ? ' has-error' : '' }}">
                    
                    <label class="col-md-2 control-label">Study Level <span class="required">*</span></label>
                        <div class="col-md-4">
                            <select name="study_level" id="" class="form-control" required>
                                <option value="" style="display:none;">Choose study  level</option>
                               @foreach($selects as $val)
                               @if(app()->getLocale() =='en')
                               <option value="{{ $val->tbl_id}}">{{$val->name_en }}</option>
                               @else
                               <option value="{{ $val->tbl_id}}">{{$val->name_dr }}</option>
                               @endif
                               @endforeach
                            </select>
                            @if ($errors->has('study_level'))
                                <div class="help-block">{{ $errors->first('study_level') }}</div>
                                @endif
                        </div>
                        <label class="col-md-2 control-label">Level of Islamic knowledge <span class="required">*</span></label>
                        <div class="col-md-4">
                            <select name="islamic_level" id="" class="form-control" required>
                                <option value="" style="display:none;">{{__('forms.Level of Islamic knowledge')}}</option>
                                <option value="1" {{ old('islamic_level') == '1' ? "selected" : "" }}>{{__('forms.Low')}}</option>
                                <option value="2" {{ old('islamic_level') == '2' ? "selected" : "" }}>{{__('forms.Medium')}}</option>
                                <option value="3" {{ old('islamic_level') == '3' ? "selected" : "" }}>{{__('forms.High')}}</option>
                                
                            </select>
                            @if ($errors->has('islamic_level'))
                                <div class="help-block">{{ $errors->first('islamic_level') }}</div>
                                @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                        
                        <label class="col-md-2 control-label">Email Address<span class="required">*</span></label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="email" value="{{ old('email')  }}" placeholder="name@gmail.com" required>
                            @foreach ($errors->get('email') as $message) 
                                <div class="help-block">{{ $message }}</div>
                                @endforeach
                        </div>
                   
                        <label class="col-md-2 control-label">Birthday</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="dob" value="{{('dob')  }}"  placeholder="dd/mm/yyyy">
                            @if ($errors->has('dob'))
                                <div class="help-block">{{ $errors->first('dob') }}</div>
                                @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('course') ? ' has-error' : '' }}">
                        <label class="col-md-2 control-label">Selected Courses<span class="required">*</span></label>
                        <div class="col-md-4">
                        <select name="course" id="" class="form-control" required>
                        <option value=" " style="display:none">{{__('forms.Choose Your Courses')}}</option>
                        @foreach($classes as $key=>$val)
                                <option value="{{$val->id}}" {{(old('course') == $val->id) ? 'selected': '' }} >{{ $val->class_name_en }}</option>
                                @endforeach
                                
                            </select>     @if ($errors->has('course'))
                                <div class="help-block">{{ $errors->first('course') }}</div>
                                @endif
                        </div>
                        <label class="col-md-2 control-label">Class Type<span class="required">*</span></label>
                        <div class="col-md-4">
                        <select name="class_type" id="" class="form-control" required>
                        <option value=" " style="display:none">Choose Class Type</option>
                        <option value="1" {{(old('course') == $val->id) ? 'selected':'' }} >Group</option>
                        <option value="2" {{(old('course') == $val->id) ? 'selected':'' }} >Individual</option>
                            </select>    
                             @if ($errors->has('class_type'))
                                <div class="help-block">{{ $errors->first('class_type') }}</div>
                                @endif
                        </div>
                        
                    </div>
                    <div class="form-group {{ $errors->has('country') ? ' has-error' : '' }}">
                        <label class="col-md-2 control-label">Country</label>
                        <div class="col-md-4">
                        <input type="text" class="form-control" name="country" value="{{old('country')  }}" placeholder="Country">
                            @if ($errors->has('country'))
                                <div class="help-block">{{ $errors->first('country') }}</div>
                                @endif
                        </div>
                        <label class="col-md-2 control-label">City </label>
                        <div class="col-md-4">
                        <!-- <img class="media-object" src="{{ URL::asset('public/backend/assets/layouts/layout/img/avatar3.jpg') }}" alt="..."> -->
                        <input type="text" class="form-control" name="city" value="{{old('city')  }}" placeholder="City">
                        @if ($errors->has('city'))
                                <div class="help-block">{{ $errors->first('city') }}</div>
                                @endif
                    </div>
                    </div>
                    <div class="form-group {{ $errors->has('afg_class_time') ? ' has-error' : '' }}">
                      
                        <label class="col-md-2 control-label">WhatsApp No.</label>
                        <div class="col-md-4">
                        <!-- <img class="media-object" src="{{ URL::asset('public/backend/assets/layouts/layout/img/avatar3.jpg') }}" alt="..."> -->
                        <input type="text" class="form-control" name="phone_no" value="{{ old('phone_no')  }}" placeholder="(0093) 77X XXX XXX" required>
                        @if ($errors->has('phone_no'))
                                <div class="help-block">{{ $errors->first('phone_no') }}</div>
                                @endif
                    </div>
                    <label class="col-md-2 control-label">Class Timing</label>
                        <div class="col-md-4">
                        <input type="text" class="form-control" name="afg_class_time" value="{{ old('afg_class_time')  }}" placeholder="11:00 AM to 01:00 PM" required>
                            @if ($errors->has('afg_class_time'))
                                <div class="help-block">{{ $errors->first('afg_class_time') }}</div>
                                @endif
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('photo') ? ' has-error' : '' }}">
                    <label class="col-md-2 control-label">Identity Card (Tazkira) </label>
                        <div class="col-md-4">
                        <!-- <img class="media-object" src="{{ URL::asset('public/backend/assets/layouts/layout/img/avatar3.jpg') }}" alt="..."> -->
                        <input type="file" class="form-control" name="tazkira" value="{{ old('tazkira')  }}" placeholder="tazkira">
                        @foreach ($errors->get('tazkira') as $message) 
                                <div class="help-block">{{ $message }}</div>
                                @endforeach
                    </div>
                        <label class="col-md-2 control-label">Photo </label>
                        <div class="col-md-4">
                         <input type="file" class="form-control" name="photo" value="{{ old('photo')  }}" placeholder="Photo">
                         @foreach ($errors->get('photo') as $message) 
                                <div class="help-block">{{ $message }}</div>
                                @endforeach
                        </div>
                        
                    </div>
                    <div class="form-group {{ $errors->has('status') ? ' has-error' : '' }}">
                        <label class="col-md-2 control-label">Status <span class="required">*</span></label>
                        <div class="col-md-4">
                            <div class="radio-list">
                                <label class="radio-inline">
                                    <input type="radio" name="status" value="1" {{ old('status') == '1' ? 'checked' :'checked'}}  > Active
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="status" value="0" {{old('status') == '0' ? 'checked' :''}} > Inactive
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
                            <button type="submit" class="btn green {{isset($view)? 'hide' : '' }}" >Create</button>
                            <a href="{{ Route('admin-manage-users') }}" class="btn default">Back</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@stop
@section('js')

@stop