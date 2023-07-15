@extends('admin::layouts.main')

@section('breadcrumb')
<li> <a href="{{ Route('admin-slide') }}">Slide</a></li>
<li class="active">Add</li>
@stop

@section('content')
<div class="users-update">
    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-edit font-green-haze" aria-hidden="true"></i>
                <span class="caption-subject font-green-haze bold uppercase">Add Slide</span>
            </div>
        </div>
        <div class="portlet-body form">
            <form class="form-horizontal form-row-seperated" action="{{ Route('admin-addslide') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-body">
                    <div class="form-group {{ $errors->has('title_en') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label">Title English <span class="required">*</span></label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="title_en" value="{{ (old('title_en') != "") ? old('title_en') : '' }}" placeholder="event title in English">
                                   @if ($errors->has('title_en'))
                                   <div class="help-block">{{ $errors->first('title_en') }}</div>
                                    @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label">Title Persian <span class="required">*</span></label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="title_dr" value="{{ (old('title_dr') != "") ? old('title_dr') : '' }}" placeholder="event title in Persian">
                                   @if ($errors->has('title_dr'))
                                   <div class="help-block">{{ $errors->first('title_dr') }}</div>
                                    @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('image') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label">Image<span class="required">*</span></label>
                        <div class="col-md-8">
                            <input type="file" class="form-control" name="image">
                                   @if ($errors->has('image'))
                                   <div class="help-block">{{ $errors->first('image') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('description_en') ? ' has-error' : '' }}">
                        <label class="col-md-2 control-label">description English<span class="required">*</span></label>
                        <div class="col-md-9">
                            <textarea class="form-control ckeditor" name="description_en" placeholder="description">{{ (old('description_en') != "") ? old('description') : '' }}</textarea>
                            @if ($errors->has('description_en'))
                            <div class="help-block">{{ $errors->first('description_en') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('description_dr') ? ' has-error' : '' }}">
                        <label class="col-md-2 control-label">description Persian<span class="required">*</span></label>
                        <div class="col-md-9">
                            <textarea class="form-control ckeditor" name="description_dr" placeholder="description">{{ (old('description_dr') != "") ? old('description') : '' }}</textarea>
                            @if ($errors->has('description_dr'))
                            <div class="help-block">{{ $errors->first('description_dr') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('status') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label">Status <span class="required">*</span></label>
                        <div class="col-md-8">
                            <div class="radio-list">
                                <label class="radio-inline">
                                    <input type="radio" name="status" value="1" {{ (old('status') != "" && old('status')=='1') ? 'checked' : 'checked' }}> Active
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="status" value="0" {{ (old('status') != "" && old('status')=='0') ? 'checked' : '' }}> Inactive
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
                            <button type="submit" class="btn green">Submit</button>
                            <a href="{{ Route('admin-slide') }}" class="btn default">Back</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@stop