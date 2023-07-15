@extends('admin::layouts.main')

@section('breadcrumb')
<li> <a href="{{ Route('admin-inquiry') }}">Inquiry</a></li>
<li class="active">View</li>
@stop

@section('content')
<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-eye font-green-haze"></i>
        </div>
    </div>
    <div class="portlet-body form ">
        <!-- BEGIN FORM-->
        <form class="form-horizontal" action="{{ Route('admin-updateinquiry', ['id' => $model->id]) }} " method="post">
            @csrf
            <div class="form-body">
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3"> Name:</label>
                            <div class="col-md-9">
                                <p class="form-control-static"> {{ (isset($model->name) && $model->name != null) ? $model->name : "Not Given" }} </p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Phone Number:</label>
                            <div class="col-md-9">
                                <p class="form-control-static"> {{ (isset($model->phone_no) && $model->phone_no != null) ? $model->phone_no : "Not Given" }} </p>
                            </div>
                        </div>
                    </div>
                </div> -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Email:</label>
                            <div class="col-md-9">
                                <p class="form-control-static"> {{ (isset($model->email) && $model->email != null) ? $model->email : "Not Given" }} </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Comment:</label>
                            <div class="col-md-9">
                                <p class="form-control-static"> {{ (isset($model->comment) && $model->comment != null) ? $model->comment : "Not Given" }} </p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Result:</label>
                            <div class="col-md-9">
                             <select name="result" id="">
                             <option value="2">Under Process</option>
                             <option value="3">Accepted</option>
                             <option value="4">Rejected</option>
                             </select>
                        
                        </div>
                        </div>
                    </div>
                </div> -->
                <hr>
                <!-- <div class="form-group {{ $errors->has('reply') ? ' has-error' : '' }}">
                        <label class="col-md-2 control-label">Reply<span class="required">*</span></label>
                        <div class="col-md-9">
                            <textarea class="form-control ckeditor" name="reply" placeholder="description">{{ (old('reply') != "") ? old('reply') : '' }}</textarea>
                            @if ($errors->has('reply'))
                            <div class="help-block">{{ $errors->first('reply') }}</div>
                            @endif
                        </div>
                </div> -->
            </div>
            <div class="form-actions text-right">
            <!-- <button type="submit" class="btn green">Update</button> -->
                <a href="{{ Route('admin-inquiry') }}" class="btn default">Back</a>
            </div>
        </form>
        <!-- END FORM-->
    </div>
</div>
@stop