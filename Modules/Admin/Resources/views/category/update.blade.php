@extends('admin::layouts.main')

@section('breadcrumb')
<li> <a href="{{ Route('admin-category') }}">Category</a></li>
<li class="active">Update</li>
@stop

@section('content')
<div class="users-update">
    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-edit font-green-haze" aria-hidden="true"></i>
                <span class="caption-subject font-green-haze bold uppercase">Updating details of {{ $model->name }}</span>
            </div>
        </div>
        <div class="portlet-body form">
            <form class="form-horizontal form-row-seperated" action="{{ Route('admin-updatecategory', ['id' => $model->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-body">
                    <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label">Category Name <span class="required">*</span></label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="name" value="{{ (old('name') != "") ? old('name') : $model->name }}" placeholder="Plan Name">
                                   @if ($errors->has('name'))
                                   <div class="help-block">{{ $errors->first('name') }}</div>
                            @endif
                        </div>
                    </div>
                    <!-- <div class="form-group {{ $errors->has('image') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label">Change Picture <span class="required">*</span></label>
                        <div class="col-md-4">
                            <input type="file" class="form-control" name="image" >
                                   @if ($errors->has('image'))
                                   <div class="help-block">{{ $errors->first('image') }}</div>
                            @endif
                        </div>
                        <div class="col-md-4">
                            <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                <img src="{{ ($model->image != '') ? URL::asset('public/uploads/admin/category_image/' . $model->image) : URL::asset('public/backend/assets/pages/img/admin-default.jpg') }}" alt="" style="width: 200px; height: 150px;"> 
                            </div>
                        </div>
                    </div> -->
                    
                    <div class="form-group {{ $errors->has('status') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label">Status <span class="required">*</span></label>
                        <div class="col-md-8">
                            <div class="radio-list">
                                <label class="radio-inline">
                                    <input type="radio" name="status" value="1" {{ ($model->status == '1') ? 'checked' : '' }}> Active
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="status" value="0" {{ ($model->status == '0') ? 'checked' : '' }}> Inactive
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
                            <button type="submit" class="btn green">Update</button>
                            <a href="{{ Route('admin-category') }}" class="btn default">Back</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@stop