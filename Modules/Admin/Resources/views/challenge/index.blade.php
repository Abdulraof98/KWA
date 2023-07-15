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
    <span class="active">Challenge</span>
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
            Challenges
        </div>
        
    </div>
    <div class="portlet-body ">
        <div class="clearfix">
            <div class="table-scrollable" style="border: none;">
                <table class="ui celled table table-bordered" cellspacing="0" width="100%" id="challenge-management">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Challenge Name</th>
                            <th>User Name</th>
                            <th> Type</th>
                            <th>Category Name</th>
                            <th>Voting Type</th>
                            <th>Participation Start</th>
                            <th>Voting Start</th>
                            <th>Status</th>
                            <th>Created On</th>
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
        $('#challenge-management').DataTable({
            processing: false,
            serverSide: true,
            ajax: '{{ Route("admin-challenge-list-datatable") }}',
            order: [[9, "desc"]],
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex',searchable: false},
                {data: 'name', name: 'name'},
                {data: 'first_name', name: 'first_name'},
                {data: 'type', name: 'status', render: function (data, type, row) {
                        if (data == '1') {
                            return '<span class="label label-sm label-success">Image</span>';
                        } else if (data == '2') {
                            return '<span class="label label-sm label-danger">Video</span>';
                        } else {
                            return '';
                        }
                    }
                },
                {data: 'categories.name', name: 'categories.name'},
                {data: 'voting_type', name: 'voting_type'},
                {data: 'participation_start', name: 'participation_start'},
                {data: 'voting_start', name: 'voting_start'},
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
    function deleteChallenge(obj) {
        $.confirm({
            title: 'Delete Challenge',
            content: 'Are you sure to delete this Challenge?',
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