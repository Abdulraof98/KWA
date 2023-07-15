@extends('admin::layouts.main')

@section('breadcrumb')
<li> <a href="{{ Route('admin-cms') }}">CMS</a></li>
<li> <a href="{{ Route('admin-viewcms', ['id' => $model->id]) }}">{{ $model->title_en }}</a></li>
<li class="active">Update</li>
@stop

@section('content')
<div class="cms-update">
    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-edit font-green-haze" aria-hidden="true"></i>
                <span class="caption-subject font-green-haze bold uppercase">Updating details of {{ $model->title_en}}</span>
            </div>
        </div>
        <div class="portlet-body form">
            <form class="form-horizontal form-row-seperated" action="{{ Route('admin-updatecms', ['id' => $model->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-body">
                    <div class="form-group {{ $errors->has('slug') ? ' has-error' : '' }}">
                        <label class="col-md-2 control-label">Page Code</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="slug" value="{{ (old('slug') != "") ? old('slug') : $model->slug }}" placeholder="Page Code" disabled >
                            @if ($errors->has('slug'))
                            <div class="help-block">{{ $errors->first('slug') }}</div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="form-group {{ $errors->has('title_en') ? ' has-error' : '' }}">
                        <label class="col-md-2 control-label">Title English <span class="required">*</span></label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="title_en" value="{{ (old('title_en') != "") ? old('title_en') : $model->title_en }}" placeholder="title" disabled>
                            @if ($errors->has('title_en'))
                            <div class="help-block">{{ $errors->first('title_en') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('title_dr') ? ' has-error' : '' }}">
                        <label class="col-md-2 control-label">Title Persian <span class="required">*</span></label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="title_dr" value="{{ (old('title_dr') != "") ? old('title_dr') : $model->title_dr }}" placeholder="عنوان">
                            @if ($errors->has('title_dr'))
                            <div class="help-block">{{ $errors->first('title_dr') }}</div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="form-group {{ $errors->has('content_body_en') ? ' has-error' : '' }}">
                        <label class="col-md-2 control-label">English Content <span class="required">*</span></label>
                        <div class="col-md-9">
                            <textarea class="form-control ckeditor" name="content_body_en" placeholder="Content">{{ (old('content_body_en') != "") ? old('content_body_en') : $model->content_body_en }}</textarea>
                            @if ($errors->has('content_body_en'))
                            <div class="help-block">{{ $errors->first('content_body_en') }}</div>
                            @endif
              
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('content_body_dr') ? ' has-error' : '' }}">
                        <label class="col-md-2 control-label">Persian Content <span class="required">*</span></label>
                        <div class="col-md-9">
                            <textarea class="form-control ckeditor" name="content_body_dr" placeholder="Content">{{ (old('content_body_dr')  != "") ? old('content_body_dr') : $model->content_body_dr }}</textarea>
                            @if ($errors->has('content_body_dr'))
                            <div class="help-block">{{ $errors->first('content_body_dr') }}</div>
                            @endif
                        </div>
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
                            <a href="{{ Route('admin-cms') }}" class="btn default">Back</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@stop