@extends('admin::layouts.main')

@section('breadcrumb')
<li> <a href="{{ Route('admin-job') }}">Job</a></li>
<li class="active">Update</li>
@stop

@section('content')
<div class="users-update">
    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-edit font-green-haze" aria-hidden="true"></i>
                <span class="caption-subject font-green-haze bold uppercase">Updating details of {{ $model->title }}</span>
            </div>
        </div>
        <div class="portlet-body form">
            <form class="form-horizontal form-row-seperated" action="{{ Route('admin-updatejob', ['id' => $model->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-body">
                    <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label">Title <span class="required">*</span></label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="title" value="{{ (old('title') != "") ? old('title') : $model->title }}" placeholder="title">
                            @if ($errors->has('title'))
                            <div class="help-block">{{ $errors->first('title') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('category') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label">Category <span class="required">*</span></label>
                        <div class="col-md-8">
                            <select name="category" id="" class="form-control">
                                <option value="">Select</option>
                                @foreach($categories as $c)
                                <option value="{{$c->id}}" {{($c->id == $model->category) ? 'selected' : ''}}>{{$c->name}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('category'))
                            <div class="help-block">{{ $errors->first('category') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label">Description <span class="required">*</span></label>
                        <div class="col-md-8">
                            <textarea name="description" id="" cols="30" rows="6" class="form-control">{{ (old('description') != "") ? old('description') : $model->description }}</textarea>
                            @if ($errors->has('description'))
                            <div class="help-block">{{ $errors->first('description') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('tags') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label">Tags <span class="required">*</span></label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="tags" value="{{ (old('tags') != "") ? old('tags') : $model->tags }}" placeholder="tags">
                            @if ($errors->has('tags'))
                            <div class="help-block">{{ $errors->first('tags') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('location') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label">Location <span class="required">*</span></label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="location" value="{{ (old('location') != "") ? old('location') : $model->location }}" placeholder="location">
                            @if ($errors->has('location'))
                            <div class="help-block">{{ $errors->first('location') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('date') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label">Date <span class="required">*</span></label>
                        <div class="col-md-8">
                            <input type="date" class="form-control" name="date" value="{{ (old('date') != "") ? old('date') : $model->date }}" placeholder="date">
                            @if ($errors->has('date'))
                            <div class="help-block">{{ $errors->first('date') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('size') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label">Size <span class="required">*</span></label>
                        <div class="col-md-8">
                            <select name="size" id="" class="form-control">
                                <option>Select size of job</option>
                                  <option value="Small" {{($model->size = 'Small') ? 'selected': ''}}>Small</option>
                                  <option value="Medium" {{($model->size = 'Medium') ? 'selected': ''}}>Medium</option>
                                  <option value="Large" {{($model->size = 'Large') ? 'selected': ''}}>Large</option>
                            </select>
                            @if ($errors->has('size'))
                            <div class="help-block">{{ $errors->first('size') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('length') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label">Length <span class="required">*</span></label>
                        <div class="col-md-8">
                            <select name="length" id="" class="form-control">
                                <option>Select length of job</option>
                                <option value="1" {{($model->length = 1) ? 'selected': ''}}>1-3 days</option>
                                <option value="2" {{($model->length = 2) ? 'selected': ''}}>3-10 days</option>
                                <option value="3" {{($model->length = 3) ? 'selected': ''}}>More than 10 days (Ongoing Work)</option>
                            </select>
                            @if ($errors->has('length'))
                            <div class="help-block">{{ $errors->first('length') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('skill_level') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label">Skill level <span class="required">*</span></label>
                        <div class="col-md-8">
                            <select name="skill_level" id="" class="form-control">
                                <option>Select length of job</option>
                                <option value="Basic" {{($model->skill_level = 'Basic') ? 'selected': ''}}>Basic</option>
                                <option value="Intermediate" {{($model->skill_level = 'Intermediate') ? 'selected': ''}}>Intermediate</option>
                                <option value="Expert" {{($model->skill_level = 'Expert') ? 'selected': ''}}>Expert</option>
                            </select>
                            @if ($errors->has('skill_level'))
                            <div class="help-block">{{ $errors->first('skill_level') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('question') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label">Screening Question <span class="required">*</span></label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="question" value="{{ (old('question') != "") ? old('question') : $model->question }}" placeholder="Screening Question">
                            @if ($errors->has('question'))
                            <div class="help-block">{{ $errors->first('question') }}</div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('budget') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label"> Budget (eur) <span class="required">*</span></label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="budget" value="{{ (old('budget') != "") ? old('budget') : $model->budget }}" placeholder="Budget (eur)">
                            @if ($errors->has('budget'))
                            <div class="help-block">{{ $errors->first('budget') }}</div>
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
                                @if ($errors->has('status'))
                                <div class="help-block">{{ $errors->first('status') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-3 col-md-6">
                            <button type="submit" class="btn green">Update</button>
                            <a href="{{ Route('admin-job') }}" class="btn default">Back</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@stop