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
@if($type==1)
<li>News Feed Selected Challenges</li>
@endif
@if($type==2)
<li>Trending Selected Challenges</li>
@endif
@if($type==3)
<li>Trending Channels</li>
@endif
@if($type==4)
<li>Recommended selected challenges</li>
@endif
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
<div class="portlet-body form">
    <!-- BEGIN FORM-->
    <form class="form-horizontal" onsubmit="return false;">
        <div class="form-body">
            <div class="row">
            <input type="hidden" value="{{$type}}" id="challenge-type">
                <div class="col-sm-4">
                    <select name="" id="challenge-list-options" class="form-control" hidden>
                        <option value="0">{{ ($type==3) ? 'List of Creators': 'List of challenges' }}</option>
                        @foreach($model as $m)
                        <option value="{{$m->id}}">{{ ($type==3) ? $m->first_name.' '.$m->last_name: $m->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-4">
                    <button class="btn btn-success" id="add-challenge-selected">Add</button>
                </div>
                <div class="col-4 float-right">
                    <button class="btn btn-danger" id="delete-challenge-btn">Delete</button>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="portlet box blue-hoki">
    <div class="portlet-title">
        <div class="caption">
            <i class="icon-equalizer"></i>
            {{ ($type==3) ? 'Popular Creators': 'Selected Challenges' }}
        </div>
    </div>
    <div class="portlet-body ">
        <div class="clearfix">
            <div class="table-scrollable" style="border: none;">
                <table class="ui celled table table-bordered text-center" cellspacing="0" width="100%" id="challenge-management">
                    <thead>
                        <tr>
                            <th class="text-center"><input type="checkbox" id="check_all"></th>
                            <th class="text-center">#</th>
                            <th class="text-center">{{ ($type==3) ? 'Name': 'Challenge Name' }}</th>
                            <th class="text-center">Image</th>
                            <th class="text-center">Added on</th>
                            <!-- <th style="width: 100px;">Actions</th> -->
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
        var id = $('#challenge-type').val();
        ajaxindicatorstart();
        $('#challenge-management').DataTable({
            processing: true,
            serverSide: true,
            aaSorting: [[4,"DESC"]],
            bSortable: true,
            bRetrieve: true,
            "aoColumnDefs": [
            { "bSortable": false, "aTargets": [ 0,1,2,3] }, 
            { "bSearchable": false, "aTargets": [ 0,1,3,4] }
            ],
            ajax: {
                "url":'{!! Route("admin-selected-challenge-datatable") !!}',
                "type":"GET",
                "data":{
                    "type":id
                }
            },
            // order: [[6, "desc"]],
            columns: [
                {data: 'action', name: 'action'},
                {data: 'DT_RowIndex', name: 'DT_RowIndex',searchable: false},
                {data: 'name', name: 'name'},
                // {data: 'title', name: 'title'},
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
                {data: 'date', name: 'date'},
                // {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });
        ajaxindicatorstop();
    });


    $(function () {
        $('#add-challenge-selected').click(function(){
            var challenge = $('#challenge-list-options').val();
            var type = $('#challenge-type').val();
            // alert(type+'ker'+challenge);
            if(challenge > 0 && type > 0){
                ajaxindicatorstart();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: full_path+"admin-addselected-challenge?cid="+challenge+"&type="+type,
                    type: 'GET',
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    // data: {
                    //     cid : input
                    // },
                    success: function (data) {
                        console.log(data);
                        if (data.success) {
                            $('#challenge-list-options').empty();
                            if (type !=3) {
                                $.each(data.challenge, function (key, value) {
                                    $('#challenge-list-options').append('<option value="'+value.id+'">'+value.name+'</option>');
                                });
                            }else{
                                $.each(data.challenge, function (key, value) {
                                    $('#challenge-list-options').append('<option value="'+value.id+'">'+value.first_name+' '+value.last_name+'</option>');
                                });
                            }
                            $('#challenge-management').DataTable().ajax.reload(null, false);
                            swal({
                                title: 'Added successfully',
                                icon: "success",
                                buttons: false,
                                timer: 3000,
                            });
                        }
                        else{
                            $('#challenge-management').DataTable().ajax.reload(null, false);
                            $('#challenge-list-options').empty();
                            $('#challenge-list-options').append('<option value="">No challenge Available</option>');
                        }
                    },
                    error: function (resp) {
                        console.log(resp);
                    }
                });
                ajaxindicatorstop();
            }else{
                // alert('Please select options!');
                swal({
                    title: 'Please select Challenge!',
                    icon: "error",
                    buttons: false,
                    timer: 3000,
                });
            }
        });
    });

    // check all
$("#check_all").click(function(){
  if($("#check_all").prop("checked")){
    $("input[type=checkbox]").prop("checked",true);
    //or $(":checkbox").prop("checked",true);
  }else{
    $("input[type=checkbox]").prop("checked",false);
  }
});

$(function () {
    $('#delete-challenge-btn').click(function(){
        var input = [];
        $(".ids:checked").each(function(){
            input.push($(this).val());
            
        });
        var type = $('#challenge-type').val();
        if(input.length){
            $.confirm({
                title: 'Delete Challenge',
                content: 'Are you sure to remove this Challenge?',
                type: 'red',
                typeAnimated: true,
                buttons: {
                    confirm: {
                        text: '<i class="fa fa-check" aria-hidden="true"></i> Confirm',
                        btnClass: 'btn-red',
                        action: function () {
                            ajaxindicatorstart();
                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            });
                            $.ajax({
                                url: full_path+"admin-removeselected-challenge",
                                type: 'POST',
                                dataType: 'json',
                                // processData: false,
                                // contentType: false,
                                data: {
                                    cids : input,
                                    type: type
                                },
                                success: function (data) {
                                    console.log(data);
                                    if (data.success) {
                                        $('#challenge-management').DataTable().ajax.reload(null, false);
                                        swal({
                                            title: 'Deleted successfully',
                                            icon: "success",
                                            buttons: false,
                                            timer: 3000,
                                        });
                                    }
                                    else{
                                        swal({
                                            title: 'Ooops! soemthing went wrong!',
                                            icon: "error",
                                            buttons: false,
                                            timer: 3000,
                                        });
                                    }
                                },
                                error: function (resp) {
                                    console.log(resp);
                                }
                            });
                            ajaxindicatorstop();
                        }
                    },
                    cancel: function () {}
                }
            });
        }else{
            // alert('Please select at least one record');
            swal({
                    title: 'Please select at least one record!',
                    icon: "error",
                    buttons: false,
                    timer: 3000,
                });
        }
        
    });
});
</script>
@stop