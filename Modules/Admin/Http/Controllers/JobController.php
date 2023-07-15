<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManagerStatic as Image;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Hash;
use App\Models\UserMaster;
use App\Models\Category;
use App\Models\Job;

class JobController extends Controller
{
    public function index()
    {
        $data = [];
        return view('admin::job.index', $data);
    }

    public function load_jobs()
    {
        $jobs = Job::where('status', '<>', '3');
        return Datatables::of($jobs)
            ->addIndexColumn()
            ->editColumn('category', function ($model) {
                return $model->cat->name;
            })
            ->editColumn('user_id', function ($model) {
                return $model->user->name;
            })
            ->editColumn('assigned_to', function ($model) {
                if (!empty($model->assigned_to)) {
                    return $model->profes->name;
                }else{
                    return 'N/A';
                }
            })
            ->editColumn('created_at', function ($model) {
                return date("jS M Y, g:i A", strtotime($model->created_at));
            })
            ->editColumn('status', function ($model) {
                return $model->status;
            })
            ->addColumn('action', function ($model) {
                $action_html = '<a href="' . Route('admin-updatejob', ['id' => $model->id]) . '" class="btn btn-outline btn-circle btn-sm purple" data-toggle="tooltip" title="Edit">'
                        . '<i class="fa fa-edit"></i>'
                        . '</a>'
                        . '<a href="javascript:void(0);" onclick="deleteJob(this);"  data-id="' . $model->id . '" class="btn btn-outline btn-circle btn-sm dark" data-toggle="tooltip" title="Delete">'
                        . '<i class="fa fa-trash"></i>'
                        . '</a>';
                // $action_html="";
                return $action_html;
            })
            ->make(true);
    }

    public function edit($id)
    {
        $data = [];
        $data['model'] = Job::findOrFail($id);
        $data['categories'] = Category::where('status','1')->get();
        return view('admin::job.update', $data);
    }

    public function post_update(Request $request,$id)
    {
        $request->validate(['title'=>'required','category'=>'required','description'=>'required','tags'=>'required',
        'location'=>'required','date'=>'required','size'=>'required','length'=>'required','skill_level'=>'required',
        'question'=>'required','budget'=>'required|numeric','status'=>'required'
        ]);
        $input = $request->input();
        Job::find($id)->update($input);
        return redirect()->back()->with('success','Updated successfully.');
    }

    public function delete_job(Request $request)
    {
        if ($request->ajax()) {
            $response = [];
            $request->validate(['jid'=>'required']);
            $job = Job::findOrFail($request->jid);
            $job->status = '3';
            $job->save();
            $response['success'] = true;
            $response['message'] = 'job deleted successfully.';
            return response()->json($response);
        }
    }
}
