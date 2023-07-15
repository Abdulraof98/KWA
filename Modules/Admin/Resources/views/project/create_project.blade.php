@extends('admin::layouts.main')

@section('breadcrumb')
<li> <a href="{{ Route('admin-manageclasses') }}">Classes</a></li>
<li> </li>
<li class="active">Create</li>
@stop

@section('content')
<div class="cms-update">
    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-edit font-green-haze" aria-hidden="true"></i>
                <span class="caption-subject font-green-haze bold uppercase">Create Class</span>
            </div>
        </div>
        <div class="portlet-body form">
            <form class="form-horizontal form-row-seperated" action="{{route('admin-addclass')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-body">
                    <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                        <label class="col-md-2 control-label">Image <span class="required">*</span></label>
                        <div class="col-md-4">
                            <input type="file" class="form-control" id="image" name="image" onchange="readURL(this)" required>
                            <span>Image size must be 300 x 300 pixels</span>
                        </div>
                        <label for="image" class="col-md-2"></label>
                        <div class="col-md-4">
                            <img class="img-responsive" style="width:200px; height:auto;" id="img"  alt="">
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                        <label class="col-md-2 control-label">Class Name English <span class="required">*</span> </label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="class_name_en" value="{{isset($user->name)? $user->name : old('name') }}" required >
                            @if ($errors->has('name'))
                                <div class="help-block">{{ $errors->first('name') }}</div>
                                @endif
                        </div>
                        <label class="col-md-2 control-label"> Class Name Persian <span class="required">*</span></label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="class_name_dr" value="{{isset($user->surname)? $user->surname : old('surname')  }}" required >
                            @if ($errors->has('surname'))
                                <div class="help-block">{{ $errors->first('surname') }}</div>
                                @endif
                        </div>
                       
                    </div>
                    <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                        <label class="col-md-2 control-label">Age of Kids </label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="age" value="{{isset($user->name)? $user->name : old('name') }}" >
                            @if ($errors->has('name'))
                                <div class="help-block">{{ $errors->first('name') }}</div>
                                @endif
                        </div>
                        <label class="col-md-2 control-label"> Total Seats</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="total_seat" value="{{isset($user->surname)? $user->surname : old('surname')  }}"  >
                            @if ($errors->has('surname'))
                                <div class="help-block">{{ $errors->first('surname') }}</div>
                                @endif
                        </div>
                       
                    </div>
                    <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                        <label class="col-md-2 control-label">Class Time </label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="time" value="{{isset($user->name)? $user->name : old('name') }}"  >
                            @if ($errors->has('name'))
                                <div class="help-block">{{ $errors->first('name') }}</div>
                                @endif
                        </div>
                        <label class="col-md-2 control-label"> Tution Fee $</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" onkeyup="this.value=this.value.replace(/[^\d]/,'')" name="fee" value="{{isset($user->surname)? $user->surname : old('surname')  }}" >
                            @if ($errors->has('surname'))
                                <div class="help-block">{{ $errors->first('surname') }}</div>
                                @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('content_body') ? ' has-error' : '' }}">
                        <label class="col-md-2 control-label">Content English <span class="required">*</span></label>
                        <div class="col-md-9">
                            <textarea class="form-control ckeditor" name="content_en" placeholder="Content" required ></textarea>
                         
                            <div class="help-block">{{ $errors->first('content_body') }}</div>
                      
                          
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('content_body') ? ' has-error' : '' }}">
                        <label class="col-md-2 control-label">Content Persian <span class="required">*</span></label>
                        <div class="col-md-9">
                            <textarea class="form-control ckeditor" name="content_dr" placeholder="Content" required ></textarea>
                            
                            <div class="help-block">{{ $errors->first('content_body_dr') }}</div>
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
                            <a href="admin-manageclasses" class="btn default">Back</a>
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