<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use DataTables;;
use Validator;
use App\Models\Blog;
use App\Models\Inquiry;

class InquiryController extends AdminController
{
    public function index()
    {
        $data = [];
        return view('admin::comment.index',$data);
    }

    public function inquiry_list()
    {
        $inq = Inquiry::where('status', '<>', '3')->latest()->get();
        return Datatables::of($inq)
            ->addIndexColumn()
            ->editColumn('created_at', function ($model) {
                return Carbon::parse($model->created_at)->diffForHumans();
            })
            ->addColumn('action', function ($model) {
                $action_html = '<a href="' . Route('admin-editinquiry', ['id' => $model->id]) . '" class="btn btn-outline btn-circle btn-sm purple" data-toggle="tooltip" title="Edit">'
                        . '<i class="fa fa-eye"></i>'
                        . '</a>'
                        . '<a href="javascript:void(0);" onclick="deleteInquiry(this);" data-href="' . Route("admin-deleteinquiry", ['id' => $model->id]) . '" data-id="' . $model->id . '" class="btn btn-outline btn-circle btn-sm dark" data-toggle="tooltip" title="Delete">'
                        . '<i class="fa fa-trash"></i>'
                        . '</a>';
                // $action_html="";
                return $action_html;
            })
            ->make(true);
    }

    public function add()
    {
        $data = [];
        return view('admin::blog.add');
    }


    public function edit($id)
    {
        $data = [];
        $data['model'] = Inquiry::find($id);
        return view('admin::comment.edit',$data);
    }

    public function update(Request $request, $id)
    {
            $input = $request->input();
            Blog::find($id)->update($input);
            $request->session()->flash('success', 'Iquiry updated successfully.');
            return redirect()->route('admin-inquiry')->withErrors($validator)->withInput();
        
    }

    public function view($id)
    {
        $data = [];
        return view('comment.view');
    }

    public function delete(Request $request)
    {
        if (isset($_GET['id']) && $_GET['id'] != "") {
            $model = Inquiry::findOrFail($_GET['id']);
            if (!empty($model) && $model->status != '3') {
                $model->status = '3';
                $model->save();
                $request->session()->flash('success', 'Inquiry deleted successfully.');
            } else {
                $request->session()->flash('danger', 'Oops. Something went wrong.');
            }
        } else {
            $request->session()->flash('danger', 'Oops. Something went wrong.');
        }
        return redirect()->route('admin-inquiry');
    }

}
