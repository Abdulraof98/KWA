@extends('admin::layouts.main')

@section('breadcrumb')
<li> <a href="{{ Route('admin-manage-users') }}">Manage Users</a></li>
<li class="active">View</li>
@stop

@section('content')
<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-eye font-green-haze"></i>
            <span class="caption-subject font-green-haze bold uppercase">Viewing details of {{ $user->name }}</span>
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
                                <p class="form-control-static"> {{ (isset($user->name) && $user->name != null) ? $user->name : "Not Given" }} </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Surnme:</label>
                            <div class="col-md-9">
                                <p class="form-control-static"> {{ (isset($user->surname) && $user->surname != null) ? $user->surname : "Not Given" }} </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Position:</label>
                            <div class="col-md-9">
                                <p class="form-control-static">@if($user->type_id == '2') Admin @elseif($user->type_id == '3') User @elseif($user->type_id == '4') Teacher @else Not Given @endif </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Status:</label>
                            <div class="col-md-9">
                                <p class="form-control-static"> @if( $user->status =='0') Not Active @elseif( $user->status =='1') Active  @elseif($user->status =='2')  Suspended @else Not Given @endif  </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Date Of Birth:</label>
                            <div class="col-md-9">
                                <p class="form-control-static"> {{ (isset($user->dob) && $user->dob != null) ? $user->dob : "Not Given" }} </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Gender</label>
                            <div class="col-md-9">
                                <p class="form-control-static"> @if($user->gender=='M') Male  @else Female @endif</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Email:</label>
                            <div class="col-md-9">
                                <p class="form-control-static"> {{ (isset($user->email) && $user->email != null) ? $user->email : "Not Given" }} </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Contact No:</label>
                            <div class="col-md-9">
                                <p class="form-control-static"> {{ (isset($user->phone) && $user->phone != null) ? $user->phone : "Not Given" }} </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            
                            <label class="control-label col-md-3">Image:</label>
                            <div class="col-md-9">
                                <img class="img-responsive" style="width:200px; height:auto;" src="{{ URL::asset('public/' . $user->profile_picture) }}" alt="{{ $user->profile_picture }}">
                            </div>
                        </div>
                    </div>
                </div>
               
            </div>
            <div class="form-actions text-right">
                <a href="{{ Route('update-user', ['id' => $user->id]) }}" class="btn green">
                    <i class="fa fa-pencil"></i> Edit
                </a>
                <a href="{{ Route('admin-manage-users') }}" class="btn default">Back</a>
            </div>
        </form>
        <!-- END FORM-->
    </div>
</div>
@stop