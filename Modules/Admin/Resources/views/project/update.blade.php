@extends('admin::layouts.main')

@section('breadcrumb')
<li> <a href="{{ Route('admin-manageclasses') }}">Classes</a></li>
<li> </li>
<li class="active">Update</li>
@stop

@section('content')
<div class="cms-update">
    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-edit font-green-haze" aria-hidden="true"></i>
                <span class="caption-subject font-green-haze bold uppercase">Update Class</span>
            </div>
        </div>
        <div class="portlet-body form">
            <form class="form-horizontal form-row-seperated" action="{{route('admin-updateproject,$model->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-body">
                    <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                        
                        <label class="col-md-2 control-label">Image </label>
                        <div class="col-md-4">
                           
                            <input type="file" class="form-control" name="image">
                        </div>
                        <label for="image" class="col-md-2"></label>
                        <div class="col-md-4">
                        <img class="img-responsive" style="width:200px; height:auto;" src="{{ URL::asset('public/alifba/class_img/'.$model->image ) }}" alt="">
                        </div>
                        
                    </div>
                    <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                        <label class="col-md-2 control-label">Class Name English </label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="class_name_en" value="{{isset($model->class_name_en)? $model->class_name_en : old('class_name_en') }}" required >
                            @if ($errors->has('class_name_en'))
                                <div class="help-block">{{ $errors->first('name') }}</div>
                                @endif
                        </div>
                        <label class="col-md-2 control-label"> Class Name Persian</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="class_name_dr" value="{{isset($model->class_name_dr)? $model->class_name_dr : old('class_name_dr')  }}" required >
                            @if ($errors->has('surname'))
                                <div class="help-block">{{ $errors->first('surname') }}</div>
                                @endif
                        </div>
                       
                    </div>
                    <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                        <label class="col-md-2 control-label">Age of Kids </label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="age" value="{{isset($model->age)? $model->age : old('age') }}"  >
                            @if ($errors->has('age'))
                                <div class="help-block">{{ $errors->first('age') }}</div>
                                @endif
                        </div>
                        <label class="col-md-2 control-label"> Total Seats</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="total_seat" value="{{isset($model->total_seat)? $model->total_seat : old('total_seat')  }}"   >
                            @if ($errors->has('total_seat'))
                                <div class="help-block">{{ $errors->first('total_seat') }}</div>
                                @endif
                        </div>
                       
                    </div>
                    <div class="form-group {{ $errors->has('time') ? ' has-error' : '' }}">
                        <label class="col-md-2 control-label">Class Time </label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="time" value="{{isset($model->time)? $model->time : old('time') }}"  >
                            @if ($errors->has('time'))
                                <div class="help-block">{{ $errors->first('time') }}</div>
                                @endif
                        </div>
                        <label class="col-md-2 control-label"> Tution Fee $</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" onkeyup="this.value=this.value.replace(/[^\d]/,'')" name="fee" value="{{isset($model->fee)? $model->fee : old('fee')  }}"   >
                            @if ($errors->has('fee'))
                                <div class="help-block">{{ $errors->first('fee') }}</div>
                                @endif
                        </div>
                    </div>
                    </div>
                    
                    
               
                    <div class="form-group {{ $errors->has('content_en') ? ' has-error' : '' }}">
                        <label class="col-md-2 control-label">Content English <span class="required">*</span></label>
                        <div class="col-md-9">
                            <textarea class="form-control ckeditor" name="content_en" placeholder="Content" required >{!! $model->content_en !!}</textarea>
                         
                            <div class="help-block">{{ $errors->first('content_en') }}</div>
                      
                          
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('content_dr') ? ' has-error' : '' }}">
                        <label class="col-md-2 control-label">Content Persian <span class="required">*</span></label>
                        <div class="col-md-9">
                            <textarea class="form-control ckeditor" name="content_dr" placeholder="Content" required >{!! $model->content_dr !!}</textarea>
                            <div class="help-block">{{ $errors->first('content_dr') }}</div>
                    </div>
                </div>
                <label class="col-md-2 control-label">Status <span class="required">*</span></label>
                <div class="col-md-4">
                    <div class="radio-list">
                        <label class="radio-inline">
                            <input type="radio" name="status" value="1" {{ (isset($model->status) && ($model->status ==1)) ? 'checked' : ''}} > Active
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="status" value="0" {{ (isset($model->status) && ($model->status ==0)) ? 'checked' : ''}} > Inactive
                        </label>
                        <!-- <label class="radio-inline">
                            <input type="radio" name="status" value="2" {{ (isset($model->status) && ($model->status ==2)) ? 'checked' :  ''}} > Suspended
                        </label> -->
                        
                        @if ($errors->has('status'))
                        <div class="help-block">{{ $errors->first('status') }}</div>
                        @endif
                        
                    </div>
                </div>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-3 col-md-6">
                            <button type="submit" class="btn green">Update</button>
                            <a href="{{route('admin-manageclasses')}}" class="btn default">Back</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@stop