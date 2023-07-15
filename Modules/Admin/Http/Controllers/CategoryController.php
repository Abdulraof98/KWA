<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use DataTables;
use Validator;
use App\Models\Category;

class CategoryController extends AdminController {

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index() {
        $data = [];
        return view('admin::category.index', $data);
    }

    public function category_list()
    {
        $category_list = Category::where('parent_id','0')->where('status', '<>', '3');
        return Datatables::of($category_list)
            ->addIndexColumn()
            ->editColumn('name', function ($model) {
                return $model->name;
            })
            ->editColumn('created_at', function ($model) {
                return date("jS M Y, g:i A", strtotime($model->created_at));
            })
            ->editColumn('status', function ($model) {
                return $model->status;
            })
            ->addColumn('action', function ($model) {
                $action_html = '<a href="' . Route('admin-updatecategory', ['id' => $model->id]) . '" class="btn btn-outline btn-circle btn-sm purple" data-toggle="tooltip" title="Edit">'
                        . '<i class="fa fa-edit"></i>'
                        . '</a>'
                        . '<a href="javascript:void(0);" onclick="deleteCategory(this);" data-href="' . Route("admin-deletecategory", ['id' => $model->id]) . '" data-id="' . $model->id . '" class="btn btn-outline btn-circle btn-sm dark" data-toggle="tooltip" title="Delete">'
                        . '<i class="fa fa-trash"></i>'
                        . '</a>';
                // $action_html="";
                return $action_html;
            })
            ->make(true);
    }

    public function add()
    {
        $data=[];
        return view('admin::category.add',$data);
    }

    public function post_category(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:250',
            // 'image'=>'required|mimes:jpeg,jpg,png,gif',
            'status' => 'required'
        ]);
        $validator->after(function($validator)use ($request) {
            $slug = $this->create_slug($request->name);
            $check = Category::where('slug',$slug)->where('status','<>','3')->first(); 
            if (!empty($check)) {
                $validator->errors()->add('name', 'This category already exists.');
            }
        });

        if ($validator->passes()) {
            $input = $request->input();
            $input['slug'] = $this->create_slug($request->name);
            // $destinationPath = 'public/uploads\admin\category_image';
            // if($request->hasFile('image')) {
            //     $img_name = $this->rand_string(12) . '.' . $request->file('image')->getClientOriginalExtension();
            //     $file = $request->file('image');
            //     $file->move(public_path('uploads/admin/category_image/'), $img_name);
            //     $input['image']=$img_name;
            // }else{
            //     $input['image']="";
            // }
            $input['created_at']=date("Y-m-d h:i:s");
            Category::create($input);
            $request->session()->flash('success', 'Category added successfully.');
        }else{
            return redirect()->route('admin-addcategory')->withErrors($validator)->withInput();
        }
        return redirect()->route('admin-category')->withErrors($validator)->withInput();
    }

    public function edit($id)
    {
        $data=[];
        $data['model'] = $model = Category::findOrFail($id);
        return view('admin::category.update', $data);
    }

    public function post_update(Request $request,$id)
    {
        $data = [];
        $model = Category::findOrFail($id);
        $validator = Validator::make($request->all(), [
                    'name' => 'required|max:250',
                    // 'image'=>'mimes:jpeg,jpg,png,gif',
                    'status' => 'required'
        ]);
        $validator->after(function($validator)use ($request,$id) {
            $slug = $this->create_slug($request->name);
            $check = Category::where('slug',$slug)->where('status','<>','3')->where('id','<>',$id)->first(); 
            if (!empty($check)) {
                $validator->errors()->add('name', 'This category already exists.');
            }
        });
        if ($validator->passes()) {
            $input = $request->input();
            $input['slug'] = $this->create_slug($request->name);
            // $destinationPath = 'public/uploads\admin\category_image';
            // if($request->hasFile('image')) {
            //     $img_name = $this->rand_string(12) . '.' . $request->file('image')->getClientOriginalExtension();
            //     $file = $request->file('image');
            //     $file->move(public_path('uploads/admin/category_image/'), $img_name);
            //     $input['image']=$img_name;
            // }
            $input['updated_at']=date("Y-m-d h:i:s");
            $model->update($input);
            $request->session()->flash('success', 'Category updated successfully.');
            return redirect()->route('admin-category')->withErrors($validator)->withInput();
        }else{
            return redirect()->route('admin-updatecategory', ['id' => $id])->withErrors($validator)->withInput();
        }
    }

    public function delete(Request $request) {
        if (isset($_GET['id']) && $_GET['id'] != "") {
            $model = Category::findOrFail($_GET['id']);
            if (!empty($model) && $model->status != '3') {
                $model->status = '3';
                $model->save();
                $request->session()->flash('success', 'Category deleted successfully.');
            } else {
                $request->session()->flash('danger', 'Oops. Something went wrong.');
            }
        } else {
            $request->session()->flash('danger', 'Oops. Something went wrong.');
        }
        return redirect()->route('admin-category');
    }

    private function create_slug($name){
        $filter2=str_replace("#","-",$name);
        $filter=str_replace("$","-",$filter2);
        $filter1=str_replace("@","-",$filter);
        $filter3=str_replace("?","-",$filter1);
        return str_replace(" ","-",$filter3);
    }

}
