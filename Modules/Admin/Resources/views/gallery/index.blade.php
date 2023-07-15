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
    <span class="active">Gallery</span>
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
<!-- BEGIN FORM-->
                <form class="form-horizontal" action="{{route('add-gallery')}}" method="post" enctype= "multipart/form-data">
                     @csrf
                    <div class="form-body" id="image_id" style="display:none;">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label col-md-4">Title</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" name="image_title" placeholder="Title" value="" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label col-md-4">Images</label>
                                    <div class="col-md-8">
                                        <input type="file" class="form-control" name="images[]" multiple required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                      <div class="pull-right"><button type="submit" class="btn btn-success" style="position: relative;top: 0px;right: 270px;"><i class="fa fa-plus"></i> Add Image</button></div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
<div class="portlet box blue-hoki">
    
    <div class="portlet-title">
        <div class="caption">
            <i class="icon-equalizer"></i>
            Galleries
        </div>
          
        <div class="pull-right"><a href="#" class="btn btn-success" style="position: relative; top: 3px;" onClick="display()"><i class="fa fa-plus"></i> Add New</a></div>
    </div>
    <div class="portlet-body ">
        <div class="clearfix">
            <div class="table-scrollable" style="border: none;">
                <table class="ui celled table table-bordered" cellspacing="0" width="100%" id="category-management">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Image Title</th>
                            <th>Image Preview</th>
                            <th>Status</th>
                            <th style="width: 100px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse ($model as $key => $val)
                            <tr>
                                <td> {{ $key + 1 }} </td>
                                <td> {{ (isset($val->image_title) && $val->image_title != '') ? $val->image_title : "Not Given" }} </td>
                                <td> <img src="{{URL::asset('public/uploads/admin/gallery/'.$val->image_name)}}" width='100' alt=""></td>
                              
                                <td class="border-radius" > 
                                    @if($val->status == '0')
                                    <button class=" btn btn-danger " style="border-radius:5px"> Not Active </button>
                                    @elseif($val->status == '1')
                                    <button class=" btn btn-primary " style="border-radius: 70%;"> Active </button>
                                    @elseif($val->status == '2')
                                    <button class=" btn btn-secondary "> Suspended </button>
                                    @else
                                    @endif
                                </td>
                                <td>
                                   
                                    <!-- <a href="" class="btn btn-outline btn-circle btn-sm purple" data-toggle="tooltip" title="Edit">
                                        <i class="fa fa-edit">&nbsp;&nbsp;Edit</i> 
                                    </a> -->
                                    <a data-href="{{route('delete-image',['id'=>$val->id])}}" onclick="deleteImage(this);" data-href="" data-id="' . $val->id . '" class="btn btn-outline btn-circle btn-sm dark" data-toggle="tooltip" title="Delete">
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
   function deleteImage(obj) {
        $.confirm({
            title: 'Delete Image',
            content: 'Are you sure to delete this image?',
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
    function display(){
        $('#image_id').css('display','block');
    }
</script>
@stop