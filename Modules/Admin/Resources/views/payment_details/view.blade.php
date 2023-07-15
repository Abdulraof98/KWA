@extends('admin::layouts.main')

@section('breadcrumb')
<li> <a href="{{ Route('admin-payment-index') }}">Payment Details</a></li>
<li class="active">View</li>
@stop

@section('content')
<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-eye font-green-haze"></i>
            <span class="caption-subject font-green-haze bold uppercase">Viewing details of Payment </span>
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
                                <p class="form-control-static">{{ $payment_details->user->name }} </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Email:</label>
                            <div class="col-md-9">
                                <p class="form-control-static"> {{ $payment_details->user->email }}  </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Plan Starts On:</label>
                            <div class="col-md-9">
                                <p class="form-control-static">{{ $payment_details->plan->current_period_start}}  </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Plan Ends On:</label>
                            <div class="col-md-9">
                                <p class="form-control-static">{{ $payment_details->plan->current_period_end }} </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Plan Duration:</label>
                            <div class="col-md-9">
                                <p class="form-control-static">{{ $payment_details->plan->duration }}  </p>
                            </div>
                        </div>
                    </div>
                </div> -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Plan Name:</label>
                            <div class="col-md-9">
                                <p class="form-control-static"> {{ $payment_details->plan->name }} </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Total Amount:</label>
                            <div class="col-md-9">
                                <p class="form-control-static">$  {{ $payment_details->total_amount }} </p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Coupon Discount Amount:</label>
                            <div class="col-md-9">
                                <p class="form-control-static">$  {{ $payment_details->discount_amount }} </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Payment Amount:</label>
                            <div class="col-md-9">
                                <p class="form-control-static">$  {{ $payment_details->pay_amount }} </p>
                            </div>
                        </div>
                    </div>
                </div> -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Payment Gateway:</label>
                            <div class="col-md-9">
                                <p class="form-control-static">{{  $payment_details->payment_gateway }} </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Tax No:</label>
                            <div class="col-md-9">
                                <p class="form-control-static">{{  $payment_details->txn_id }} </p>
                            </div>
                        </div>
                    </div>
                </div> -->

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Status:</label>
                            <div class="col-md-9">
                                <p class="form-control-static"> {{$payment_details->status}} </p>
                            </div>
                        </div>
                    </div>
                </div>



            </div>
            <div class="form-actions text-right">
<!--                <a href="" class="btn green">
                    <i class="fa fa-pencil"></i> Edit
                </a>-->
                <a href="{{ Route('admin-payment-index') }}" class="btn default">Back</a>
            </div>
        </form>
        <!-- END FORM-->
    </div>
</div>
@stop
