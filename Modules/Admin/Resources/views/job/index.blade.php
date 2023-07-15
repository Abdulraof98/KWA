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
    <span class="active">Category</span>
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
            Categories
        </div>
        <!-- <div class="pull-right"><a href="" class="btn btn-success" style="position: relative; top: 3px;"><i class="fa fa-plus"></i> Add New</a></div> -->
    </div>
    <div class="portlet-body ">
        <div class="clearfix">
            <div class="table-scrollable" style="border: none;">
                <table class="ui celled table table-bordered text-center" cellspacing="0" width="100%" id="job-management">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Title</th>
                            <th class="text-center">User</th>
                            <th class="text-center">Assigned to</th>
                            <th class="text-center">Category</th>
                            <th class="text-center">Location</th>
                            <th class="text-center">Date</th>
                            <th class="text-center">Size</th>
                            <th class="text-center">Length</th>
                            <th class="text-center">Skill Level</th>
                            <th class="text-center">Budget</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Created On</th>
                            <th class="text-center" style="width: 100px;">Actions</th>
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
        $('#job-management').DataTable({
            processing: true,
            serverSide: true,
            aaSorting: [[11,"desc"]],
            bSortable: true,
            bRetrieve: true,
            "aoColumnDefs": [
            { "bSortable": false, "aTargets": [ 0,1,2,3,4,5,7,8,9,13] }, 
            { "bSearchable": false, "aTargets": [ 0,13] }
            ],
            ajax: '{{ Route("admin-job-list-datatable") }}',
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex',searchable: false},
                {data: 'title', name: 'title'},
                {data: 'user_id', name: 'user_id'},
                {data: 'assigned_to', name: 'assigned_to'},
                {data: 'category', name: 'category'},
                {data: 'location', name: 'location'},
                {data: 'date', name: 'date'},
                {data: 'size', name: 'size'},
                {data: 'length', name: 'length', render: function (data, type, row) {
                        if (data == '1') {
                            return '1-3 days';
                        } else if (data == '2') {
                            return '3-10 days';
                        } else if (data == '3') {
                            return 'More than 10 days (Ongoing Work)';
                        } else {
                            return '';
                        }
                    }
                },
                {data: 'skill_level', name: 'skill_level'},
                {data: 'budget', name: 'budget'},
                {data: 'status', name: 'status', render: function (data, type, row) {
                        if (data == '0') {
                            return '<span class="label label-sm label-warning">Inactive</span>';
                        } else if (data == '1') {
                            return '<span class="label label-sm label-success">Active</span>';
                        } else if (data == '3') {
                            return '<span class="label label-sm label-danger">Delete</span>';
                        } else {
                            return '';
                        }
                    }
                },
                {data: 'created_at', name: 'created_at'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });
    });
    function deleteJob(obj) {
        $.confirm({
            title: 'Delete Job',
            content: 'Are you sure to delete this Job?',
            type: 'red',
            typeAnimated: true,
            buttons: {
                confirm: {
                    text: '<i class="fa fa-check" aria-hidden="true"></i> Confirm',
                    btnClass: 'btn-red',
                    action: function () {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            url: full_path+'admin-deletejob',
                            type: 'POST',
                            dataType: 'json',
                            // processData: false,
                            // contentType: false,
                            data: {
                                jid:$(obj).data('id')
                            },
                            success: function (resp) {
                                console.log(resp);
                                if (resp.success) {
                                    notie.alert({
                                        type: 'success',
                                        text: '<i class="fa fa-check"></i> ' + resp.message,
                                        time: 3
                                    });
                                    $('#job-management').DataTable().ajax.reload(null, false);
                                }
                                ajaxindicatorstop();
                            },
                            error: function (resp) {
                                console.log(resp);
                                ajaxindicatorstop();
                            }
                        })
                    }
                },
                cancel: function () {}
            }
        });
    }
    
</script>
@stop