@extends('admin::layouts.main')

@section('page_css')
<style>
    .table>thead:first-child>tr:first-child>th {
        vertical-align: middle;
        text-align: center;
    }
    .table>tbody>tr>td {
        vertical-align: middle;
        text-align: center;
    }
    .dataTables_filter input {
        height: 34px;
        padding: 6px 12px;
        border: 1px solid #c2cad8;
    }
</style>
@endsection
@section('breadcrumb')
<li>
    <span class="active">Payment Details</span>
</li>
@stop

@section('content')

<div class = "alert alert-danger" id='error'>
    <ul id='errordata'>
    </ul>
</div>
<div class = "alert alert-success" id='success'>
    <ul id='successdata'>
    </ul>
</div>
<div class="portlet box blue-hoki">
    <div class="portlet-title">
        <div class="caption">
            <i class="icon-equalizer"></i>
           Payment Details
        </div>
        <!-- <div class="pull-right"><a href="{{route('admin-adduser')}}" class="btn btn-success" style="position: relative; top: 3px;"><i class="fa fa-plus"></i> Add New</a></div> -->
    </div>
    <div class="portlet-body form" id="search_filter" style="">
        <!-- BEGIN FORM-->
        <form class="form-horizontal" action="" method="GET">
            <div class="form-body">
                <div class="row">
                </div>
                <div class="row">
                    <div class="col-md-12 text-right">
                        {{-- <button type="submit" class="btn green">Search</button> --}}
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="portlet-body ">
        <div class="clearfix">
            <div class="table-scrollable" style="border: none;">
                <table class="ui celled table table-bordered" cellspacing="0" width="100%" id="payment-details-management">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <!-- <th>Last Name</th> -->
                            <th>Email</th>
                            <!-- <th>Gender</th>
                            <th>City</th>
                            <th>Country</th> -->
                            <th>Class Name</th>
                            <th>Status</th>
                            <th>Payment On</th>
                            <th style="width: 100px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse ($payments as $key => $val)
                    <tr>
                        <td> {{ $key + 1 }} </td>
                        <td> {{ (isset($val->name) && $val->name != '') ? $val->name : "Not Given" }} </td>
                        <td> {{ (isset($val->email) && $val->email != '') ? $val->email : "Not Given" }} </td>
                        <td> {{ (isset($val->classes->class_name_en) && $val->classes->class_name_en != '') ? $val->classes->class_name_en : "Not Given"}}</td>
                        <td> {{ (isset($val->payment_gateway) && $val->payment_gateway != '') ? $val->payment_gateway : "Not Given"}}</td>
                        <td> 
                            @if($val->status == 'pending')
                            <span class="label label-sm label-warning">Pending </span>
                            @elseif($val->status == 'proccessing')
                            <span class="label label-sm label-success"> Proccessing </span>
                            @elseif($val->status == 'completed')
                            <span class="label label-sm label-info"> Completed </span>
                            @elseif($val->status == 'decline')
                            <span class="label label-sm label-error"> Decline </span>
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
                            <a href="javascript:;" onclick="deleteCreators(this);" data-href="{{Route('update-user', ['id' => $val->id])}}" data-id="' . $val->id . '" class="btn btn-outline btn-circle btn-sm dark" data-toggle="tooltip" title="Delete">
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
        </div>
    </div>
</div>
<style>
#error{
    display:none;
}
#success{
    display:none;
}
</style>
@stop

@section('js')

<script>
    
    function deleteUser(obj) {
        $.confirm({
            title: 'Delete User',
            content: 'Are you sure to delete this user?',
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
