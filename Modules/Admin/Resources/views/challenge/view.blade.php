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
                            <label class="control-label col-md-3">Challenge Image:</label>
                            <div class="col-md-9">
                                <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                    <img src="{{ ($model->image != '') ? URL::asset('public/uploads/frontend/challenge/' . $model->image) : URL::asset('public/backend/assets/pages/img/admin-default.jpg') }}" alt=""> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
                            <label class="control-label col-md-3">User Name:</label>
                            <div class="col-md-9">
                                <p class="form-control-static"> {{ (isset($model->user->name) != null) ? ucfirst($model->user->name) : "Not Given" }} </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Description:</label>
                            <div class="col-md-9 form-control-static">
                                {!! (isset($model->description) && $model->description != null) ? $model->description : "Not Given" !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Category Name:</label>
                            <div class="col-md-9 form-control-static">
                                {{ (isset($model->cat->name) && $model->cat->name != null) ? $model->cat->name : "Not Given" }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Challenge Duration:</label>
                            <div class="col-md-9 form-control-static">
                                {{ (isset($model->duration) && $model->duration != null) ? $model->duration : "Not Given" }}
                            </div>
                        </div>
                    </div>
                </div>
                @if($model->duration=="Limited")
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Expiration Date:</label>
                            <div class="col-md-9 form-control-static">
                                {{ (isset($model->expiration_date) && $model->expiration_date != null) ? $model->expiration_date : "Not Given" }}
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Participants:</label>
                            <div class="col-md-9 form-control-static">
                                {{ (isset($model->participants) && $model->participants != null) ? ( ($model->participants=='1') ? 'Only creator Images' : 'Only users images') : "Not Given" }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Type of matchmaking:</label>
                            <div class="col-md-9 form-control-static">
                                {{ (isset($model->matchmaking) && $model->matchmaking != null) ? $model->matchmaking : "Not Given" }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Starting Score For Each Image:</label>
                            <div class="col-md-9 form-control-static">
                                {{ (isset($model->score_for_image) && $model->score_for_image != null) ? $model->score_for_image : "Not Given" }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Score When Win A Battle:</label>
                            <div class="col-md-9 form-control-static">
                                {{ (isset($model->score_win_battle) && $model->score_win_battle != null) ? $model->score_win_battle : "Not Given" }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Score When Lose A Battle:</label>
                            <div class="col-md-9 form-control-static">
                                {{ (isset($model->score_lose_battle) && $model->score_lose_battle != null) ? $model->score_lose_battle : "Not Given" }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Winning Score:</label>
                            <div class="col-md-9 form-control-static">
                                {{ (isset($model->winning_score) && $model->winning_score != null) ? $model->winning_score : "Not Given" }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Voting type:</label>
                            <div class="col-md-9 form-control-static">
                                {{ (isset($model->voting_type) && $model->voting_type != null) ? $model->voting_type : "Not Given" }}
                            </div>
                        </div>
                    </div>
                </div>
                @if($model->voting_type!="Public")
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Security Mode:</label>
                            <div class="col-md-9 form-control-static">
                                {{ (isset($model->security_mode) && $model->security_mode != null) ? $model->security_mode : "Not Given" }}
                            </div>
                        </div>
                    </div>
                </div>
                @if($model->security_mode=="password")
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Password:</label>
                            <div class="col-md-9 form-control-static">
                                {{ (isset($model->password) && $model->password != null) ? $model->password : "Not Given" }}
                            </div>
                        </div>
                    </div>
                </div>
                @else
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Link:</label>
                            <div class="col-md-9 form-control-static">
                                {{ (isset($model->link) && $model->link != null) ? $model->link : "Not Given" }}
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @endif
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
                            <label class="control-label col-md-3">Other Images:</label>
                            <div class="col-md-9">
                                <div class="row">
                                    @foreach($model->images as $value)
                                    <div class="col-md-4">
                                        <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                        @if($model->type == '1')
                                            <img src="{{ ($value->image_name != '') ? URL::asset('public/uploads/frontend/challenge/' . $value->image_name) : URL::asset('public/backend/assets/pages/img/admin-default.jpg') }}" alt="" style="width: 200px; height: 150px;"> 
                                        @else
                                        <img src="{{ ($value->image_name != '') ? 'https://img.youtube.com/vi/'.youtube_video_id($value->image_name).'/hqdefault.jpg' : URL::asset('public/backend/assets/pages/img/admin-default.jpg') }}" alt="" style="width: 200px; height: 150px;"> 
                                        @endif
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-actions text-right">
                <a href="{{ Route('admin-challenge') }}" class="btn default">Back</a>
            </div>
        </form>
        <!-- END FORM-->
    </div>
</div>
@stop