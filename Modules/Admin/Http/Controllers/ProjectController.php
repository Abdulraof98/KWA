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
use App\Models\Project;

class ProjectController extends AdminController
{
    public function index()
    {
        $data = [];
        return view('admin::project.index',$data);
    }

    public function project_list()
    {
        $project = Project::where('status', '<>', '3')->latest()->get();
        return Datatables::of($project)
            ->addIndexColumn()
            ->editColumn('created_at', function ($model) {
                return Carbon::parse($model->created_at)->diffForHumans();
            })
            ->addColumn('action', function ($model) {
                $action_html = '<a href="' . Route('admin-editproject', ['id' => $model->id]) . '" class="btn btn-outline btn-circle btn-sm purple" data-toggle="tooltip" title="Edit">'
                        . '<i class="fa fa-edit"></i>'
                        . '</a>'
                        . '<a href="javascript:void(0);" onclick="deleteproject(this);" data-href="' . Route("admin-deleteproject", ['id' => $model->id]) . '" data-id="' . $model->id . '" class="btn btn-outline btn-circle btn-sm dark" data-toggle="tooltip" title="Delete">'
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
        return view('admin::project.add');
    }

    public function post_add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title_en' => 'required|max:250',
            'title_dr' => 'required|max:250',
            'description_en' => 'required',
            'description_dr' => 'required',
            'image'=>'required|mimes:jpeg,jpg,png,gif',
            'status' => 'required'
        ]);

        if ($validator->passes()) {
            $input = $request->except('_token');
            $destinationPath = 'public/uploads\admin\project';
            if($request->hasFile('image')) {
                $img_name = $this->rand_string(12) . '.' . $request->file('image')->getClientOriginalExtension();
                $file = $request->file('image');
                $file->move(public_path('uploads/admin/project/'), $img_name);
                $input['image']=$img_name;
            }else{
                $input['image']="";
            }
            Project::create($input);
            $request->session()->flash('success', 'project added successfully.');
            return redirect()->route('admin-project')->withErrors($validator)->withInput();
        }else{
            return redirect()->back()->withErrors($validator)->withInput();
        }
    }

    public function edit($id)
    {
        $data = [];
        $data['model'] = Project::find($id);
        return view('admin::project.edit',$data);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title_en' => 'required|max:250',
            'title_dr' => 'required|max:250',
            'description_en' => 'required',
            'description_dr' => 'required',
            'image'=>'mimes:jpeg,jpg,png,gif',
            'status' => 'required'
        ]);

        if ($validator->passes()) {
            $input = $request->input();
            $destinationPath = 'public/uploads\admin\project';
            if($request->hasFile('image')) {
                $img_name = $this->rand_string(12) . '.' . $request->file('image')->getClientOriginalExtension();
                $file = $request->file('image');
                $file->move(public_path('uploads/admin/project/'), $img_name);
                $input['image']=$img_name;
            }else{
                unset($input['image']);
            }
            Project::find($id)->update($input);
            $request->session()->flash('success', 'project updated successfully.');
            return redirect()->route('admin-project')->withErrors($validator)->withInput();
        }else{
            return redirect()->back()->withErrors($validator)->withInput();
        }
    }

    public function view($id)
    {
        $data = [];
        return view('project.view');
    }

    public function delete_project(Request $request)
    {
        // dd($request->test_id);
        if (isset($_GET['id']) && $_GET['id'] != "") {
            $model = Project::findOrFail($_GET['id']);
            // dd($model);
            if (!empty($model) && $model->status != '3') {
                $model->status = '3';
                $model->save();
                $request->session()->flash('success', 'Blog deleted successfully.');
            } else {
                $request->session()->flash('danger', 'Oops. Something went wrong.');
            }
        } else {
            $request->session()->flash('danger', 'Oops. Something went wrong.');
        }
        return redirect()->route('admin-project');
    }

}
