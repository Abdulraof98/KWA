@extends('admin::layouts.main')

@section('breadcrumb')
<li> <a href="{{ Route('admin-cms') }}">CMS</a></li>
<!-- <li> <a href=""></a></li> -->
<li class="active">Create</li>
@stop

@section('content')
<div class="cms-update">
    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-edit font-green-haze" aria-hidden="true"></i>
                <span class="caption-subject font-green-haze bold uppercase">Create New CMS</span>
            </div>
        </div>
        <div class="portlet-body form">
            <form class="form-horizontal form-row-seperated" action="{{ Route('admin-createcms') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-body">
                    <div class="form-group {{ $errors->has('slug') ? ' has-error' : '' }}">
                        <label class="col-md-2 control-label">Page Code <span class="required">*</span></label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="slug" value="{{old('slug')}}" placeholder="page Code" required>
                            @if ($errors->has('slug'))
                            <div class="help-block">{{ $errors->first('slug') }}</div>
                            @endif
                        </div>
                    </div>
                    <!-- <div class="form-group {{ $errors->has('page_name') ? ' has-error' : '' }}">
                        <label class="col-md-2 control-label">Page Name <span class="required">*</span></label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="page_name" value="{{ old('page_name') }}" placeholder="Page Name" required>
                            @if ($errors->has('page_name'))
                            <div class="help-block">{{ $errors->first('page_name') }}</div>
                            @endif
                        </div>
                    </div> -->
                    
                    <div class="form-group {{ $errors->has('title_en') ? ' has-error' : '' }}">
                        <label class="col-md-2 control-label">Title English <span class="required">*</span></label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="title_en" value="{{ old('title_en')  }}" placeholder="title" required>
                            @if ($errors->has('title_en'))
                            <div class="help-block">{{ $errors->first('title_en') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('title_dr') ? ' has-error' : '' }}">
                        <label class="col-md-2 control-label">Title Persian <span class="required">*</span></label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="title_dr" value="{{ old('title_dr') }}" placeholder="عنوان"  required>
                            @if ($errors->has('title_dr'))
                            <div class="help-block">{{ $errors->first('title_dr') }}</div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="form-group {{ $errors->has('content_body_en') ? ' has-error' : '' }}">
                        <label class="col-md-2 control-label">English Content <span class="required">*</span></label>
                        <div class="col-md-9">
                            <textarea class="form-control ckeditor" name="content_body_en" placeholder="Content"  required>{{ old('content_body_en')  }}</textarea>
                            @if ($errors->has('content_body_en'))
                            <div class="help-block">{{ $errors->first('content_body_en') }}</div>
                            @endif
                           
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('content_body') ? ' has-error' : '' }}">
                        <label class="col-md-2 control-label">Dari Content <span class="required">*</span></label>
                        <div class="col-md-9">
                            <textarea class="form-control ckeditor" name="content_body_dr" placeholder="Content"  required>{{ old('content_body_dr') }}</textarea>
                            @if ($errors->has('content_body_dr'))
                            <div class="help-block">{{ $errors->first('content_body_dr') }}</div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-3 col-md-6">
                            <button type="submit" class="btn green">Create</button>
                            <a href="{{ Route('admin-cms')}}" class="btn default">Back</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@stop