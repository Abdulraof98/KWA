@extends('admin::layouts.main')

@section('breadcrumb')
<li> <a href="{{ Route('admin-expert') }}">Experts</a></li>
<li class="active">Update</li>
@stop

@section('content')
<div class="users-update">
    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-edit font-green-haze" aria-hidden="true"></i>
                <span class="caption-subject font-green-haze bold uppercase">Updating details of {{ $model->name }}</span>
            </div>
        </div>
        <div class="portlet-body form">
            <form class="form-horizontal form-row-seperated" action="{{ Route('admin-updatemember', ['id' => $model->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-body">
                    <div class="form-group {{ $errors->has('first_name') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label"> First Name <span class="required">*</span></label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="first_name" value="{{ (old('first_name') != "") ? old('first_name') : $model->first_name }}" placeholder="first name">
                                   @if ($errors->has('first_name'))
                                   <div class="help-block">{{ $errors->first('first_name') }}</div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('last_name') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label"> Last Name <span class="required">*</span></label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="last_name" value="{{ (old('last_name') != "") ? old('last_name') : $model->last_name }}" placeholder="first name">
                                @if ($errors->has('last_name'))
                                <div class="help-block">{{ $errors->first('last_name') }}</div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label">Email <span class="required">*</span></label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="email" value="{{ (old('email') != "") ? old('email') : $model->email }}" placeholder="Email">
                                   @if ($errors->has('email'))
                                   <div class="help-block">{{ $errors->first('email') }}</div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('about_me') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label">Admin comment</label>
                        <div class="col-md-8">
                            <textarea class="form-control" name="about_me" placeholder="About me">{{ (old('about_me') != "") ? old('about_me') : $model->about_me }}</textarea>
                            @if ($errors->has('about_me'))
                                <div class="help-block">{{ $errors->first('about_me') }}</div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('company_name') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label"> Comany Name <span class="required">*</span></label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="company_name" value="{{ (old('company_name') != "") ? old('company_name') : $model->company_name }}" placeholder="company name">
                                   @if ($errors->has('company_name'))
                                   <div class="help-block">{{ $errors->first('company_name') }}</div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('working_trade') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label"> Working trade <span class="required">*</span></label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="working_trade" value="{{ (old('working_trade') != "") ? old('working_trade') : $model->working_trade }}" placeholder="Working trade">
                                   @if ($errors->has('working_trade'))
                                   <div class="help-block">{{ $errors->first('working_trade') }}</div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('zipcode') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label"> Postcode </label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="zipcode" value="{{ (old('zipcode') != "") ? old('zipcode') : $model->zipcode }}" placeholder="postcode">
                                   @if ($errors->has('zipcode'))
                                   <div class="help-block">{{ $errors->first('zipcode') }}</div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('address_line1') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label"> Address Line1 <span class="required">*</span></label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="address_line1" value="{{ (old('address_line1') != "") ? old('address_line1') : $model->address_line1 }}" placeholder="Address Line1">
                                   @if ($errors->has('address_line1'))
                                   <div class="help-block">{{ $errors->first('address_line1') }}</div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('address_line2') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label"> Address Line2 </label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="address_line2" value="{{ (old('address_line2') != "") ? old('address_line2') : $model->address_line2 }}" placeholder="Address Line2">
                                   @if ($errors->has('address_line2'))
                                   <div class="help-block">{{ $errors->first('address_line2') }}</div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('city') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label"> City <span class="required">*</span></label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="city" value="{{ (old('city') != "") ? old('city') : $model->city }}" placeholder="City">
                                   @if ($errors->has('city'))
                                   <div class="help-block">{{ $errors->first('city') }}</div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('country') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label"> Country </label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="country" value="{{ (old('country') != "") ? old('country') : $model->country }}" placeholder="Country">
                                   @if ($errors->has('country'))
                                   <div class="help-block">{{ $errors->first('country') }}</div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('working_area') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label"> Working Radius <span class="required">*</span></label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="working_area" value="{{ (old('working_area') != "") ? old('working_area') : $model->working_area }}" placeholder="Working Radius">
                                   @if ($errors->has('working_area'))
                                   <div class="help-block">{{ $errors->first('working_area') }}</div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('phone') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label"> Phone <span class="required">*</span></label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="phone" value="{{ (old('phone') != "") ? old('phone') : $model->phone }}" placeholder="Phone">
                                   @if ($errors->has('working_area'))
                                   <div class="help-block">{{ $errors->first('working_area') }}</div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('alt_phone') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label"> Alt Phone</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="alt_phone" value="{{ (old('alt_phone') != "") ? old('alt_phone') : $model->alt_phone }}" placeholder="Alt Phone">
                                   @if ($errors->has('alt_phone'))
                                   <div class="help-block">{{ $errors->first('alt_phone') }}</div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('company_email') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label"> Customer contact email<span class="required">*</span></label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="company_email" value="{{ (old('company_email') != "") ? old('company_email') : $model->company_email }}" placeholder="Customer contact email">
                                   @if ($errors->has('company_email'))
                                   <div class="help-block">{{ $errors->first('company_email') }}</div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('website') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label"> Website</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="website" value="{{ (old('website') != "") ? old('website') : $model->website }}" placeholder="Website">
                                   @if ($errors->has('website'))
                                   <div class="help-block">{{ $errors->first('website') }}</div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('status') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label">Status <span class="required">*</span></label>
                        <div class="col-md-8">
                            <div class="radio-list">
                                <label class="radio-inline">
                                    <input type="radio" name="status" value="1" {{ ($model->status == '1') ? 'checked' : '' }}> Active
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="status" value="0" {{ ($model->status == '0') ? 'checked' : '' }}> Inactive
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="status" value="2" {{ ($model->status == '2') ? 'checked' : '' }}> Suspended
                                </label>
                                @if ($errors->has('status'))
                                <div class="help-block">{{ $errors->first('status') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <hr>

                    <div class="form-group {{ $errors->has('verified') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label">Verified <span class="required">*</span></label>
                        <div class="col-md-8">
                            <div class="radio-list">
                                <label class="radio-inline">
                                    <input type="radio" name="verified" value="1" {{ ($model->verified == '1') ? 'checked' : '' }}> Yes
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="verified" value="0" {{ ($model->verified == '0') ? 'checked' : '' }}> No
                                </label>
                                @if ($errors->has('verified'))
                                <div class="help-block">{{ $errors->first('verified') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('insurance') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label">Insurance </label>
                        <div class="col-md-8">
                            <div class="radio-list">
                                <label class="radio-inline">
                                    <input type="checkbox" name="insurance" value="1" {{ ($model->insurance == '1') ? 'checked' : '' }}> 
                                </label>
                                @if ($errors->has('insurance'))
                                <div class="help-block">{{ $errors->first('insurance') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('address') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label">Address verifed </label>
                        <div class="col-md-8">
                            <div class="radio-list">
                                <label class="radio-inline">
                                    <input type="checkbox" name="address" value="1" {{ ($model->address == '1') ? 'checked' : '' }}> 
                                </label>
                                @if ($errors->has('address'))
                                <div class="help-block">{{ $errors->first('address') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('company_type') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label"> Company type</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="company_type" value="{{ (old('company_type') != "") ? old('company_type') : $model->company_type }}" placeholder="Company type">
                                   @if ($errors->has('company_type'))
                                   <div class="help-block">{{ $errors->first('company_type') }}</div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('references_verified') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label">References </label>
                        <div class="col-md-8">
                            <div class="radio-list">
                                <label class="radio-inline">
                                    <input type="checkbox" name="references_verified" value="1" {{ ($model->references_verified == '1') ? 'checked' : '' }}> 
                                </label>
                                @if ($errors->has('references_verified'))
                                <div class="help-block">{{ $errors->first('references_verified') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('balloon_id') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label">Balloon Terms & ID </label>
                        <div class="col-md-8">
                            <div class="radio-list">
                                <label class="radio-inline">
                                    <input type="checkbox" name="balloon_id" value="1" {{ ($model->balloon_id == '1') ? 'checked' : '' }}> 
                                </label>
                                @if ($errors->has('balloon_id'))
                                <div class="help-block">{{ $errors->first('balloon_id') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-3 col-md-6">
                            <button type="submit" class="btn green">Update</button>
                            <a href="{{ Route('admin-expert') }}" class="btn default">Back</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@stop