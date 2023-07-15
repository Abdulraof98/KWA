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
use App\Models\Subscriber;

class SubscriberController extends AdminController
{
    public function index()
    {
        $data = [];
        return view('admin::subscriber.index',$data);
    }

    public function subscriber_list()
    {
        $blog = Subscriber::where('status','<>','3')->latest()->get();
        return Datatables::of($blog)
            ->addIndexColumn()
            ->make(true);
    }

    public function add()
    {
        $data = [];
        return view('admin::blog.add');
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
            $input = $request->input();
            $destinationPath = 'public/uploads\admin\blog';
            if($request->hasFile('image')) {
                $img_name = $this->rand_string(12) . '.' . $request->file('image')->getClientOriginalExtension();
                $file = $request->file('image');
                $file->move(public_path('uploads/admin/blog/'), $img_name);
                $input['image']=$img_name;
            }else{
                $input['image']="";
            }
            Blog::create($input);
            $request->session()->flash('success', 'Blog added successfully.');
            return redirect()->route('admin-blog')->withErrors($validator)->withInput();
        }else{
            return redirect()->back()->withErrors($validator)->withInput();
        }
    }

    public function edit($id)
    {
        $data = [];
        $data['model'] = Subscriber::find($id);
        return view('admin::subscriber.edit',$data);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            // 'title' => 'required|max:250',
            // 'description' => 'required',
            // 'image'=>'mimes:jpeg,jpg,png,gif',
            // 'status' => 'required',
            'comment'=>'required'
        ]);

        if ($validator->passes()) {
            $input = $request->input();
           
            Subscriber::find($id)->update($input);
            $request->session()->flash('success', 'Subscriber updated successfully.');
            return redirect()->route('admin-subscriber')->withErrors($validator)->withInput();
        }else{
            return redirect()->back()->withErrors($validator)->withInput();
        }
    }

    public function view($id)
    {
        $data = [];
        return view('subscriber.view');
    }

    public function delete_blog(Request $request)
    {
        if (isset($_GET['id']) && $_GET['id'] != "") {
            $model = Subscriber::findOrFail($_GET['id']);
            if (!empty($model) && $model->status != '3') {
                $model->status = '3';
                $model->save();
                $request->session()->flash('success', 'Subscriber deleted successfully.');
            } else {
                $request->session()->flash('danger', 'Oops. Something went wrong.');
            }
        } else {
            $request->session()->flash('danger', 'Oops. Something went wrong.');
        }
        return redirect()->route('admin-subscriber');
    }

}
