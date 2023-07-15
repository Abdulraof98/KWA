@extends('admin::layouts.main')

@section('breadcrumb')
<li> <a href="{{ Route('manage-students') }}">Students</a></li>
<li class="active">View</li>
@stop

@section('content')
<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-eye font-green-haze"></i>
            <span class="caption-subject font-green-haze bold uppercase">Viewing details of {{ $model->name }}</span>
        </div>
    </div>
    <div class="portlet-body form">
        <!-- BEGIN FORM-->
        <form class="form-horizontal">
            <div class="form-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Name:</label>
                            <div class="col-md-9">
                                <p class="form-control-static"> {{ (isset($model->name) && $model->name != null) ? $model->name : "Not Given" }} </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Surname</label>
                            <div class="col-md-9">
                                <p class="form-control-static"> {{ (isset($model->surname) && $model->surname != null) ? $model->surname : "Not Given" }} </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Date of Birth</label>
                            <div class="col-md-9">
                                <p class="form-control-static"> {!! (isset($model->dob) && $model->dob != null) ? $model->dob : "Not Given" !!} </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">City</label>
                            <div class="col-md-9">
                                <p class="form-control-static"> {!! (isset($model->city) && $model->city != null) ? $model->city : "Not Given" !!} </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Country</label>
                            <div class="col-md-9">
                                <p class="form-control-static"> {!! (isset($model->country) && $model->country != null) ? $model->country : "Not Given" !!} </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Study Level</label>
                            <div class="col-md-9">
                                <p class="form-control-static"> 
                            @if($model->study_level == '1' ) "Under Graduate" @elseif($model->study_level == '2') "School Graduate" @elseif($model->study_level == '3') "University" @elseif($model->study_level == '4')  "University Graduate" @elseif($model->study_level == '5') "Master" @elseif($model->study_level == '6') "Master Graduate" @else "Not Given" @endif   </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">City</label>
                            <div class="col-md-9">
                                <p class="form-control-static"> {!! (isset($model->city) && $model->city != null) ? $model->city : "Not Given" !!} </p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Image:</label>
                            <div class="col-md-9">
                                <img class="img-responsive" style="width:200px; height:auto;" src="{{ URL::asset('public/' . $model->photo) }}" alt="{{ $model->photo }}">
                            </div>
                          
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Tazkira:</label>
                            <div class="col-md-9">
                                <img class="img-responsive" style="width:200px; height:auto;" src="{{ URL::asset('public/' . $model->tazkira) }}" alt="{{ $model->tazkira }}">
                            </div>
                          
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-actions text-right">
                <a href="{{route('manage-students')}}" class="btn default">Back</a>
            </div>
        </form>
        <!-- END FORM-->
    </div>
</div>
@stop