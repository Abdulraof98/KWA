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
    <span class="active">Subscriber</span>
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
            Subscribers
        </div>
        <!-- <div class="pull-right"><a href="{{route('admin-addblog')}}" class="btn btn-success" style="position: relative; top: 3px;"><i class="fa fa-plus"></i> Add New</a></div> -->
    </div>
    <div class="portlet-body ">
        <div class="clearfix">
            <div class="table-scrollable" style="border: none;">
                <table class="ui celled table table-bordered" cellspacing="0" width="100%" id="category-management">
                    <thead >
                        <tr class="text-center">
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                        </tr>
                    </thead>
                    <tbody ></tbody>
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
        $('#category-management').DataTable({
            processing: false,
            serverSide: true,
            ajax: '{{ Route("admin-subscriber-list-datatable") }}',
            order: [[3, "desc"]],
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false ,searchable: false},
                {data: 'name', name: 'name', orderable: false},
                {data: 'email', name: 'email', orderable: false},
                {data: 'phone_no', name: 'phone_no', orderable: false},
            ]
        });
    });
    function deleteInquiry(obj) {
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