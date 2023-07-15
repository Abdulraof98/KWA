@extends('admin::layouts.main')

@section('breadcrumb')
<li class="active">CMS</li>
@stop

@section('content')
<h3 class="page-title">CMS
    <small>Manage all the cms of the site from here</small>
</h3>

<div class="row">
    <div class="col-md-12">
        <!-- BEGIN SAMPLE TABLE PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-picture-o font-green-haze" aria-hidden="true"></i>
                    <span class="caption-subject font-green-haze bold uppercase">CMS</span>
                </div>
                <div class="pull-right">
                <a class="btn btn-info" href="{{ Route('admin-createcms') }}"></i> Add New CMS</a>
                    <!-- <a class="btn btn-info" href="javascript:;" onclick="$('#search_filter').toggle();"><i class="fa fa-search" aria-hidden="true"></i> Filter</a>&nbsp; -->
                    <a class="btn btn-info" href="{{ Route('admin-cms') }}"><i class="glyphicon glyphicon-repeat"></i></i> Reset</a>
                   
                </div>
            </div>
           
            <div class="portlet-body">
                <div class="table-scrollable">
                    <table class="table table-striped table-bordered table-advance table-hover">
                        <thead>
                            <tr>
                                <th class="bold"> # </th>
                                <th class="bold"> Page Code </th>
                                <th class="bold"> Title </th>
                                <th class="bold"> Title </th>
                                <th class="bold"> Last Updated </th>
                                <th class="bold"> Status </th>
                                <th class="bold"> Actions </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($model as $key => $val)
                            <tr>
                                <td> {{ $key + 1 }} </td>
                                <td> {{ (isset($val->slug) && $val->slug != '') ? $val->slug : "Not Given" }} </td>
                                <!-- <td>
                                    @if($val->type == '2')
                                    {{ 'Image' }}
                                    @elseif($val->type == '3')
                                    {{ 'Video' }}
                                    @else
                                    {{ 'Text' }}
                                    @endif
                                </td> -->
                                <td>{{ $val->title_dr }}</td>
                                <td> {{ (isset($val->title_en) && $val->title_en != '') ? $val->title_en : "Not Given" }} </td>
                                <td> {{ (isset($val->updated_at) && $val->updated_at != '') ? date('jS M Y, g:i A', strtotime($val->updated_at)) : "Not Updated" }} </td>
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
                                    <a href="{{ Route('admin-viewcms', ['id' => $val->id]) }}" class="btn btn-outline btn-circle btn-sm blue">
                                        <i class="fa fa-eye"></i> View
                                    </a>
                                    <a href="{{ Route('admin-updatecms', ['id' => $val->id]) }}" class="btn btn-outline btn-circle btn-sm purple">
                                        <i class="fa fa-edit"></i> Edit
                                    </a>
                                    @if(in_array($val->slug,['about_us*','logo_content*','*']))

                                    @else
                                    <a href="#" onclick="deleteCreators(this);" data-href="{{Route('admin-deletecms', ['id' => $val->id])}}" data-id="' . $val->id . '" class="btn btn-outline btn-circle btn-sm dark" data-toggle="tooltip" title="Delete">
                                        <i class="fa fa-trash">&nbsp;&nbsp;Delete</i>
                                    </a>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" style="text-align: center;">No Record Found!</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                {{ $model->appends(request()->all())->render() }}
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
            content: 'Are you sure to delete this CMS ?',
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