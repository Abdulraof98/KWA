@extends('admin::layouts.main')
@section('css')
<style>
    .form-control-static h3 {
        margin-top: 0px;
    }
</style>
@stop
@section('breadcrumb')
<li> <a href="{{ Route('admin-challenge') }}">Challenges</a></li>
<li>Participants</li>
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
                @php
                function youtube_video_id($url)
                {
                    preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match);
                    $youtube_id = $match[1];
                    return $youtube_id;
                }
                @endphp
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Image:</label>
                            <div class="col-md-9">
                                <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                @if($model->challenge->type == '1')
                                    <img src="{{ ($model->image_name != '') ? URL::asset('public/uploads/frontend/challenge/' . $model->image_name) : URL::asset('public/backend/assets/pages/img/admin-default.jpg') }}" alt=""> 
                                @else
                                <img src="{{ ($model->image_name != '') ? 'https://img.youtube.com/vi/'.youtube_video_id($model->image_name).'/hqdefault.jpg' : URL::asset('public/backend/assets/pages/img/admin-default.jpg') }}" alt=""> 
                                @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Title:</label>
                            <div class="col-md-9">
                                <p class="form-control-static"> {{ (isset($model->title) && $model->title != null) ? $model->title : "Not Given" }} </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Participant Name:</label>
                            <div class="col-md-9">
                                <p class="form-control-static"> {{ (isset($model->user->name) && $model->user->name != null) ? ucfirst($model->user->name): "Not Given" }} </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Participated on:</label>
                            <div class="col-md-9 form-control-static">
                                {{ date("jS M Y, g:i A", strtotime($model->created_at)) }}
                            </div>
                        </div>
                    </div>
                </div>
               
            </div>
            <div class="form-actions text-right">
                <a href="{{ url()->previous() }}" class="btn default">Back</a>
            </div>
        </form>
        <!-- END FORM-->
    </div>
</div>
@stop