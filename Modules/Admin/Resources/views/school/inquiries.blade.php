@extends('admin::layouts.main')

@section('breadcrumb')
<li class="active">Manage</li>
<li class="active">Inquiries</li>
@stop

@section('content')
<h3 class="page-title">Inquiries
    <small>Manage all the inquiries of the site from here</small>
</h3>
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN SAMPLE TABLE PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-user font-green-haze" aria-hidden="true"></i>
                    <span class="caption-subject font-green-haze bold uppercase">Inquiries</span>
                </div>
                {{--
                <div class="pull-right">
                    <!-- <a class="btn btn-success" href="{{ Route('admin-addclient') }}"><i class="fa fa-plus" aria-hidden="true"></i> Create</a>&nbsp; -->
                    <a class="btn btn-info" href="javascript:;" onclick="$('#search_filter').toggle();"><i class="fa fa-search" aria-hidden="true"></i> Filter</a>&nbsp;
                    <a class="btn btn-info" href="{{ Route('admin-client') }}"><i class="glyphicon glyphicon-repeat"></i></i> Reset</a>
                </div>
                --}}
            </div>
            {{--
            <div class="portlet-body form" id="search_filter" style="display: {{ ($search_filter == 1) ? 'block;' : 'none;' }}">
                <!-- BEGIN FORM-->
                <form class="form-horizontal" action="" method="GET">
                    <input type="hidden" name="search_filter" value="1"/>
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label col-md-4"> Name</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" name="name" placeholder="Name" value="{{ (isset($name) && $name != '') ? $name : '' }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label col-md-4">Email</label>
                                    <div class="col-md-8">
                                        <input type="email" class="form-control" name="email" placeholder="Email" value="{{ (isset($email) && $email != '') ? $email : '' }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label col-md-4">Status</label>
                                    <div class="col-md-8">
                                        <select class="form-control" name="status">
                                            <option value="">Select Status</option>
                                            <option <?= (isset($status) && $status == 'all') ? 'selected' : ''; ?> value="all">Show All</option>
                                            <option <?= (isset($status) && $status == 'inactive') ? 'selected' : ''; ?> value="inactive">Inactive</option>
                                            <option <?= (isset($status) && $status == 'active') ? 'selected' : ''; ?> value="active">Active</option>
                                            <option <?= (isset($status) && $status == 'suspended') ? 'selected' : ''; ?> value="suspended">Suspended</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label col-md-4">Registered On</label>
                                    <div class="col-md-8">
                                        <input type="date" class="form-control" name="created_at" placeholder="Registered On" value="{{ (isset($created_at) && $created_at != '') ? $created_at : '' }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 text-right">
                                <button type="submit" class="btn green">Search</button>               
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            --}}
            <div class="portlet-body">
                <div class="table-scrollable">
                    <table class="table table-striped table-bordered table-advance table-hover text-center">
                        <thead >
                            <tr >
                                <th class="bold"> # </th>
                                <th class="bold text-center"> Name </th>
                                <!-- <th class="bold"> Last Name </th> -->
                                <th class="bold text-center"> Email </th>
                                <th class="bold text-center">WhatsApp No.</th>
                                <th class="bold text-center"> Created at </th>
                                <th class="bold text-center"> Last Update </th>
                                <th class="bold"> Upldated By </th>
                                <th class="bold text-center"> Result </th>
                                <th class="bold text-center" > Actions </th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse ($inquiries as $key => $val)
                            <tr>
                                <td> {{ $key + 1 }} </td>
                                <td> {{ (isset($val->name) && $val->name != '') ? $val->name : "Not Given" }} </td>
                                <td> {{ (isset($val->email) && $val->email != '') ? $val->email : "Not Given" }} </td>
                                <td> {{ (isset($val->phone_no) && $val->phone_no != '') ? $val->phone_no : "Not Given" }} </td>
                                <td>{{date_format($val->created_at,"d-m-y l h:i A")}}</td>
                                <td>{{date_format($val->updated_at,"d-m-y l h:i A")}}</td>
                                <td>{{ $val->user->name}}</td>
                                
                               <!-- <td> 
                                    @if($val->status == '0')
                                    <span class="label label-sm label-warning"> Inactive </span>
                                    @elseif($val->status == '1')
                                    <span class="label label-sm label-success"> Active </span>
                                    @elseif($val->status == '2')
                                    <span class="label label-sm label-info"> Suspended </span>
                                    @else
                                    @endif
                                </td> -->
                                <td> @if($val->result == '1') <span style="color:green">New </span> @elseif($val->result == '2') <span style="color:yello">Under Process </span> @elseif ($val->result == '3') <span style="color:blue">Joined </span>@else <span style="color:red">Rejected</span> @endif</td>
                               
                                <td>
                                    <!-- <a href="{{ Route('create_user', ['id' => $val->id,'view'=>true]) }}" class="btn btn-outline btn-circle btn-sm blue" data-toggle="tooltip" title="View">
                                        <i class="fa fa-eye"></i> 
                                    </a> -->
                                    <a href="{{Route('admin-updateinquiry',['id' => $val->id])}}" class="btn btn-outline btn-circle btn-sm purple" data-toggle="tooltip" title="Edit">
                                        <i class="fa fa-edit">&nbsp;&nbsp;Edit</i> 
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="10" style="text-align: center;">No Record Found!</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                {{-- $users->appends(request()->all())->render() --}}
            </div>
        </div>
    </div>
</div>
@stop

@section('js')
<script>
    function deleteCreators(obj) {
        $.confirm({
            title: 'Delete Inquiry',
            content: 'Are you sure to delete this Inquiry?',
            type: 'red',
            typeAnimated: true,
            buttons: {
                confirm: {
                    text: '<i class="fa fa-check" aria-hidden="true"></i> Confirm',
                    btnClass: 'btn-red',
                    action: function () {
                        window.location.href = $(obj).attr('data-href');
                    }
                },
                cancel: function () {}
            }
        });
    }
</script>
@stop