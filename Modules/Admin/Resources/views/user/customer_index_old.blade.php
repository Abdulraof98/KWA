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
    <span class="active">Clients</span>
</li>
@stop

@section('content')


<div class="portlet box blue-hoki">
    <div class="portlet-title">
        <div class="caption">
            <i class="icon-equalizer"></i>
            Customers
        </div>
        <!-- <div class="pull-right"><a href="{{route('admin-addcustomer')}}" class="btn btn-success" style="position: relative; top: 3px;"><i class="fa fa-plus"></i> Add New</a></div> -->
    </div>
    <div class="portlet-body ">
        <div class="clearfix">
            <div class="table-scrollable" style="border: none;">
                <table class="ui celled table table-bordered" cellspacing="0" width="100%" id="users-management">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Registered On</th>
                            <th style="width: 100px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@stop

@section('js')

<script>
    $(function () {
        $('#users-management').DataTable({
            processing: false,
            serverSide: true,
            ajax: '{{ Route("admin-customer-list-datatable") }}',
            order: [[5, "desc"]],
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex',searchable: false},
                {data: 'first_name', name: 'first_name'},
                {data: 'last_name' , name: 'last_name'},
                {data: 'email', name: 'email'},
                {data: 'status', name: 'status', render: function (data, type, row) {
                        if (data == '0') {
                            return '<span class="label label-sm label-warning">Inactive</span>';
                        } else if (data == '1') {
                            return '<span class="label label-sm label-success">Active</span>';
                        }else if (data == '2') {
                            return '<span class="label label-sm label-primary">Suspended</span>';
                        }else if (data == '3') {
                            return '<span class="label label-sm label-danger">Delete</span>';
                        } else {
                            return '';
                        }
                    }
                },
                {data: 'created_at', name: 'created_at'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ],
            /*drawCallback: function () {
             $('[data-toggle=confirmation]').confirmation({
             rootSelector: '[data-toggle=confirmation]',
             container: 'body'
             });
             }*/
        });
    });
    function deleteWorker(obj) {
        $.confirm({
            title: 'Delete Customer',
            content: 'Are you sure to delete this customer?',
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
<script>
    /*function deleteUser(obj) {
     var id = $(obj).attr("data-id");
     var url = full_path + 'admin-deleteuser?id=' + id;
     $("#deleteuserButton").attr("href", url);
     $("#deleteuserModal").modal('show');
     }
     $(document).ready(function () {
     $('[data-toggle="tooltip"]').tooltip();
     });*/
</script>
@stop