@extends('admin::layouts.main')

@section('breadcrumb')
<li> <a href="{{ Route('admin-manageclasses') }}">Classes</a></li>
<li class="active">View</li>
@stop

@section('content')
<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-eye font-green-haze"></i>
            <span class="caption-subject font-green-haze bold uppercase">Viewing details of {{ $model->class_name_en }}</span>
        </div>
    </div>
    <div class="portlet-body form">
        <!-- BEGIN FORM-->
        <form class="form-horizontal">
            <div class="form-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Class Name En:</label>
                            <div class="col-md-9">
                                <p class="form-control-static"> {{ (isset($model->class_name_en) && $model->class_name_en != null) ? $model->class_name_en : "Not Given" }} </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Class Name Dr:</label>
                            <div class="col-md-9">
                                <p class="form-control-static"> {{ (isset($model->class_name_dr) && $model->class_name_dr != null) ? $model->class_name_dr : "Not Given" }} </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Contents En</label>
                            <div class="col-md-9">
                                <p class="form-control-static"> {!! (isset($model->content_en) && $model->content_en != null) ? $model->content_en : "Not Given" !!} </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Contents Dr</label>
                            <div class="col-md-9">
                                <p class="form-control-static"> {!! (isset($model->content_dr) && $model->content_dr != null) ? $model->content_dr : "Not Given" !!} </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Image:</label>
                            <div class="col-md-9">
                                <img class="img-responsive" style="width:200px; height:auto;" src="{{ URL::asset('public/alifba/class_img/' . $model->image) }}" alt="{{ $model->image }}">
                            </div>
                          
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-actions text-right">
            <button href="{{route('admin-updatecms',['id'=>$model->id])}}" type="submit" class="btn green " >Update</button>
                <a href="{{route('admin-manageclasses')}}" class="btn default">Back</a>
            </div>
        </form>
        <!-- END FORM-->
    </div>
</div>
@stop