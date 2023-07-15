@extends('admin::layouts.main')

@section('breadcrumb')
<li> <a href="{{ Route('admin-client') }}">Client</a></li>
<li class="active">View</li>
@stop

@section('content')
<div class="users-update">
    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-edit font-green-haze" aria-hidden="true"></i>
                <span class="caption-subject font-green-haze bold uppercase">Viewing details of {{$model->name}}</span>
            </div>
        </div>
        <div class="portlet-body form">
            <form class="form-horizontal form-row-seperated" action="">
                <div class="form-body">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Profile Picture <span class="required">*</span></label>
                        <div class="col-md-8">
                            <img src="{{($model->profile_picture != '') ? asset('public/uploads/frontend/profile_picture/preview/'.$model->profile_picture) : asset('storage/frontend/img/man-2.png')}}" alt="" style="width:150px;height:150px;" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group ">
                                <label class="col-md-3 control-label"> First Name :</span></label>
                                <div class="col-md-9">
                                    <p class="form-control-static">{{ (!empty($model->first_name) ? $model->first_name : 'N/A' )}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group ">
                                <label class="col-md-3 control-label"> Last Name :</span></label>
                                <div class="col-md-9">
                                    <p class="form-control-static">{{ (!empty($model->last_name) ? $model->last_name : 'N/A' )}}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group ">
                                <label class="col-md-3 control-label"> Email :</span></label>
                                <div class="col-md-9">
                                    <p class="form-control-static">{{ (!empty($model->email) ? $model->email : 'N/A' )}}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group ">
                                <label class="col-md-3 control-label"> Phone :</span></label>
                                <div class="col-md-9">
                                    <p class="form-control-static">{{ (!empty($model->phone) ? $model->phone : 'N/A' )}}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group ">
                                <label class="col-md-3 control-label"> Admin comment :</span></label>
                                <div class="col-md-9">
                                    <p class="form-control-static">{{ (!empty($model->about_me) ? $model->about_me : 'N/A' )}}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group ">
                                <label class="col-md-3 control-label">Status :</span></label>
                                <div class="col-md-9">
                                    @if($model->status == '0')
                                    <p class="form-control-static">Inactive</p>
                                    @elseif($model->status == '1')
                                    <p class="form-control-static">Active</p>
                                    @else
                                    <p class="form-control-static"> Banned Account</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-3 col-md-6">
                            <a href="{{Route('admin-updateclient', ['id' => $model->id])}}">Edit</a>
                            <a href="{{ Route('admin-client') }}" class="btn default">Back</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@stop
