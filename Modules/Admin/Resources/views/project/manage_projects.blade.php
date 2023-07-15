@extends('admin::layouts.main')

@section('breadcrumb')
<li class="active">Manage</li>
<li class="active">Users</li>
@stop

@section('content')
<h3 class="page-title">Classes
    <small>Manage all the Classes of the site from here</small>
</h3>
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN SAMPLE TABLE PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-user font-green-haze" aria-hidden="true"></i>
                    <span class="caption-subject font-green-haze bold uppercase">Classes</span>
                </div>
            
            
            <div class="portlet-body">
                <div class="table-scrollable">
                    <table class="table table-striped table-bordered table-advance table-hover">
                        <thead>
                            <tr>
                                <th class="bold"> # </th>
                                <th class="bold"> Class Name </th>
                                <!-- <th class="bold"> Last Name </th> -->
                                <th class="bold"> Class Time </th>
                                <th class="bold">Total Seats</th>
                                <th class="bold">Starting Date</th>
                                <th class="bold">Updated by</th>
                                <th class="bold"> Status </th>
                                <th class="bold" width="22%"> Actions </th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse ($classes as $key => $val)
                            <tr>
                                <td> {{ $key + 1 }} </td>
                                <td> {{ (isset($val->class_name_dr) && $val->class_name_dr != '') ? $val->class_name_dr : "Not Given" }} </td>
                                <td> {{ (isset($val->time) && $val->time != '') ? $val->time : "Not Given" }} </td>
                                <td> {{ (isset($val->total_seat) && $val->total_seat != '') ? $val->total_seat : "Not Given"}}</td>
                                <td> {{ (isset($val->date) && $val->date != '') ? $val->date : "Not Given"}}</td>
                                <td> {{ (isset($val->updated_by) && $val->updated_by != '') ? $val->updated_by : "Not Given"}}</td>
                                <td> 
                                    @if($val->status == '0')
                                    <span class="label label-sm label-warning"> Not Active </span>
                                    @elseif($val->status == '1')
                                    <span class="label label-sm label-success"> Active </span>
                                    @elseif($val->status == '2')
                                    <span class="label label-sm label-info"> Suspended </span>
                                    @else
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ Route('admin-viewclass', ['id' => $val->id]) }}" class="btn btn-outline btn-circle btn-sm blue" data-toggle="tooltip" title="View">
                                        <i class="fa fa-eye"></i> 
                                    </a>
                                    <a href="{{Route('admin-updateclass', ['id' => $val->id])}}" class="btn btn-outline btn-circle btn-sm purple" data-toggle="tooltip" title="Edit">
                                        <i class="fa fa-edit">&nbsp;&nbsp;Edit</i> 
                                    </a>
                                    <a href="javascript:;" onclick="deleteCreators(this);" data-href="{{Route('admin-deleteclass', ['id' => $val->id])}}" data-id="' . $val->id . '" class="btn btn-outline btn-circle btn-sm dark" data-toggle="tooltip" title="Delete">
                                        <i class="fa fa-trash">&nbsp;&nbsp;Delete</i>
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
            title: 'Delete User',
            content: 'Are you sure to delete this Class ?',
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