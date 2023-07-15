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
<li> <a href="{{ Route('admin-challenge') }}">Challenges</a></li>
<li class="active">Participants</li>
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
            Participants
        </div>
        
    </div>
    <div class="portlet-body ">
        <div class="clearfix">
            <div class="table-scrollable" style="border: none;">
                <table class="ui celled table table-bordered" cellspacing="0" width="100%" id="challenge-management">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Image Title</th>
                            <th>Image</th>
                            <th>Participated On</th>
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
$.urlParam = function(name){
	var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
	return results[1] || 0;
}
var id = $.urlParam('id');
console.log(id);
    $(function () {
        $('#challenge-management').DataTable({
            processing: true,
            serverSide: true,
            aaSorting: [[5,"desc"]],
            bSortable: true,
            bRetrieve: true,
            "aoColumnDefs": [
            { "bSortable": false, "aTargets": [ 0,1,2,3,4,6] }, 
            { "bSearchable": false, "aTargets": [ 0,6] }
            ],
            ajax: {
                "url":'{!! Route("admin-participant-list") !!}',
                "type":"GET",
                "data":{
                    "cid":id
                }
            },
            // order: [[6, "desc"]],
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex',searchable: false},
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'title', name: 'title'},
                // {data: 'image_name', name: 'image_name'},
                {data: 'image_name', name: 'image_name', render: function (data, type, row) {
                        return '<img src="'+data+'" height="50px" width="50px" >'
                    }
                },
                // {data: 'status', name: 'status', render: function (data, type, row) {
                //         if (data == '0') {
                //             return '<span class="label label-sm label-warning">Inactive</span>';
                //         } else if (data == '1') {
                //             return '<span class="label label-sm label-success">Active</span>';
                //         } else if (data == '3') {
                //             return '<span class="label label-sm label-danger">Delete</span>';
                //         } else {
                //             return '';
                //         }
                //     }
                // },
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