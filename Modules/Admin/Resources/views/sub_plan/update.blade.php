@extends('admin::layouts.main')

@section('breadcrumb')
<li> <a href="{{ Route('admin-subplans') }}">Subcription Plans</a></li>
<li> <a href="{{ Route('admin-viewsubplan', ['id' => $model->id]) }}">{{ $model->name }} </a></li>
<li class="active">Update</li>
@stop

@section('content')
<div class="users-update">
    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-edit font-green-haze" aria-hidden="true"></i>
                <span class="caption-subject font-green-haze bold uppercase">Updating details of "{{ $model->name }}"</span>
            </div>
        </div>
        <div class="portlet-body form">
            <form class="form-horizontal form-row-seperated" action="{{ Route('admin-updatesubplan', ['id' => $model->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-body">
                    <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                        <label class="col-md-4 control-label">Plan Name <span class="required">*</span></label>
                        <div class="col-md-5">
                            <input type="text" readonly class="form-control" name="name" value="{{ (old('name') != "") ? old('name') : $model->name }}" placeholder="Plan Name">
                                   @if ($errors->has('name'))
                                   <div class="help-block">{{ $errors->first('name') }}</div>
                            @endif
                        </div>
                    </div>


                    <div class="form-group {{ $errors->has('stripe_plan_id') ? ' has-error' : '' }}">
                        <label class="col-md-4 control-label">Stripe Price ID <span class="required">*</span></label>
                        <div class="col-md-5">
                            <input type="text" class="form-control" name="stripe_plan_id" value="{{ (old('stripe_plan_id') != "") ? old('stripe_plan_id') : $model->stripe_plan_id }}" placeholder="stripe_plan_id">
                                   @if ($errors->has('stripe_plan_id'))
                                   <div class="help-block">{{ $errors->first('stripe_plan_id') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('stript_product_id') ? ' has-error' : '' }}">
                        <label class="col-md-4 control-label">Stripe Product ID <span class="required">*</span></label>
                        <div class="col-md-5">
                            <input type="text" class="form-control" name="stript_product_id" value="{{ (old('stript_product_id') != "") ? old('stript_product_id') : $model->stript_product_id }}" placeholder="stript_product_id">
                                   @if ($errors->has('stript_product_id'))
                                   <div class="help-block">{{ $errors->first('stript_product_id') }}</div>
                                    @endif
                        </div>
                    </div>


                    <div class="form-group {{ $errors->has('amount') ? ' has-error' : '' }}">
                        <label class="col-md-4 control-label">Amount <span class="required">*</span></label>
                        <div class="col-md-5">
                            <input type="text" class="form-control" name="amount" value="{{ (old('amount') != "") ? old('amount') : $model->amount }}" placeholder="Amount">
                                   @if ($errors->has('amount'))
                                   <div class="help-block">{{ $errors->first('amount') }}</div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="form-group {{ $errors->has('interval_period') ? ' has-error' : '' }}">
                        <label class="col-md-4 control-label">Interval Period <span class="required">*</span></label>
                        <div class="col-md-5">
                            <select class='form-control' name='interval_period' disabled="">
                            <option value="">-----Select Interval Period-----</option>
                            <option value="week" {{($model->interval =="week")?"selected":""}}>Weekly</option>
                            <option value="month" {{($model->interval =="month")?"selected":""}}>Monthly</option>
                            <option value="year" {{($model->interval =="year")?"selected":""}}>Yearly</option>
                            </select>
                                   @if ($errors->has('interval_period'))
                                   <div class="help-block">{{ $errors->first('interval_period') }}</div>
                                    @endif
                        </div>
                    </div>
<!--                    <div class="form-group {{ $errors->has('status') ? ' has-error' : '' }}">
                        <label class="col-md-4 control-label">Status <span class="required">*</span></label>
                        <div class="col-md-5">
                            <div class="radio-list">
                                <label class="radio-inline">
                                    <input type="radio" name="status" value="1" {{ ($model->status == '1') ? 'checked' : '' }}> Active
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="status" value="0" {{ ($model->status == '0') ? 'checked' : '' }}> Inactive
                                </label>
                                @if ($errors->has('status'))
                                <div class="help-block">{{ $errors->first('status') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>-->
                </div>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-3 col-md-6">
                            <button type="submit" class="btn green">Update</button>
                            <a href="{{ Route('admin-viewsubplan', ['id' => $model->id]) }}" class="btn default">Back</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@stop
<script
  src="https://code.jquery.com/jquery-3.4.1.js"></script>
<script>
$(function() {
    var value=$("#user_type").val();
    type_change(value);
});

function type_change(value)
{
    if(value=="3")
    {
        $("#allow").hide();
    }else{
        $("#allow").show();
    }
}

</script>