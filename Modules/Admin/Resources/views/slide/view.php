@extends('admin::layouts.main')

@section('breadcrumb')
<li> <a href="{{ Route('admin-manageevent') }}">Events</a></li>
<li class="active">View</li>
@stop

@section('content')
<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-eye font-green-haze"></i>
            <span class="caption-subject font-green-haze bold uppercase">Viewing details of {{ $model->title_en }}</span>
        </div>
    </div>
    <div class="portlet-body form">
        <!-- BEGIN FORM-->
        <form class="form-horizontal">
            <div class="form-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Title English:</label>
                            <div class="col-md-9">
                                <p class="form-control-static"> {{ (isset($model->title_en) && $model->title_en != null) ? $model->title_en : "Not Given" }} </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Title Persian:</label>
                            <div class="col-md-9">
                                <p class="form-control-static"> {{ (isset($model->title_dr) && $model->title_dr != null) ? $model->title_dr : "Not Given" }} </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Contents English</label>
                            <div class="col-md-9">
                                <p class="form-control-static"> {!! (isset($model->description_en) && $model->description_en != null) ? $model->description_en : "Not Given" !!} </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Contents Persian</label>
                            <div class="col-md-9">
                                <p class="form-control-static"> {!! (isset($model->description_dr) && $model->description_dr != null) ? $model->description_dr : "Not Given" !!} </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Image:</label>
                            <div class="col-md-9">
                                <img class="img-responsive" style="width:200px; height:auto;" src="{{ URL::asset('public/uploads/admin/event/' . $model->image) }}" alt="{{ $model->image }}">
                            </div>
                          
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-actions text-right">
            <button href="{{route('admin-updateevent',['id'=>$model->id])}}" type="submit" class="btn green " >Update</button>
                <a href="{{route('admin-event')}}" class="btn default">Back</a>
            </div>
        </form>
        <!-- END FORM-->
    </div>
</div>
@stop