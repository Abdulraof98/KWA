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
                    <tbody></tbody>
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
    $(function () {
        var table= $('#payment-details-management').DataTable({
            processing: false,
            serverSide: true,
            ajax:
            {
                url: '{{ Route("admin-payment-list") }}',
                     data: function (d) {
                     d.status = $('#status').val(),
                    //  d.country = $('#country').val(),
                    //  d.city = $('#city').val(),
                    //  d.gender = $('#gender').val(),
                     d.plan = $('#plan').val(),
                     d.search = $('input[type="search"]').val()
                 }

             },
            order: [[5, "desc"]],
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex',searchable: false},
                {data: 'name', name: 'name'},
                // {data: 'first_name', name: 'first_name'},
                // {data: 'last_name' , name: 'last_name'},
                {data: 'email', name: 'email'},
                // {data: 'gender', name: 'gender'},
                // {data: 'city', name: 'city'},
                // {data: 'country', name: 'country'},
                {data: 'subscription', name: 'subscription', orderable: false, searchable: false},
                {data: 'status', name: 'status'},
                {data: 'created_at', name: 'created_at'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });
        $('#status').change(function(){
                table.draw();
        });
        // $('#country').on("keyup",function(){
        //         table.draw();
        // });
        // $('#city').on("keyup",function(){
        //         table.draw();
        // });
        // $('#gender').change(function(){
        //         table.draw();
        // });
        $('#plan').change(function(){
                table.draw();
        });
    });
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
