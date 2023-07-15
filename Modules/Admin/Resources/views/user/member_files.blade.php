                    
@extends('admin::layouts.main')

@section('breadcrumb')
<li> <a href="{{ Route('admin-expert') }}">Experts</a></li>
<li class="active">Files</li>
@stop

@section('content')
<div class="users-update">
    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-edit font-green-haze" aria-hidden="true"></i>
                <!-- <span class="caption-subject font-green-haze bold uppercase">Viewing details of </span> -->
            </div>
        </div>
        <div class="portlet-body form">
            <form class="form-horizontal form-row-seperated" action="{{ route('admin-post-expertfiles',['id'=>$model->id]) }}" method="post" enctype="multipart/form-data">
                <div class="form-body">
                    @csrf
                    @foreach($files as $m)
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group ">
                            <label class="col-md-3 control-label"> {{$m->name}} :</label>
                                <div class="col-md-8">
                                    <p class="form-control-static">
                                        <a href="{{asset('public/uploads/admin/user_files/'.$m->file_name)}}" download="{{$m->name}}"><i class="fa fa-file"></i> download</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <div class="form-group {{ $errors->has('file') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label"> File<span class="required">*</span></label>
                        <div class="col-md-8">
                            <input type="file" class="form-control" name="file" value="" placeholder="File">
                                   @if ($errors->has('file'))
                                   <div class="help-block">{{ $errors->first('file') }}</div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label"> Name<span class="required">*</span></label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="name" value="{{ old('name')}}" placeholder="name">
                                   @if ($errors->has('name'))
                                   <div class="help-block">{{ $errors->first('name') }}</div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-3 col-md-6">
                            <button type="submit" class="btn green">Submit</button>
                            <a href="{{ Route('admin-expert') }}" class="btn default">Back</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@stop
