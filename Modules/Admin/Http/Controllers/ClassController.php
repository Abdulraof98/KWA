<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Mail;
use Validator;
use App\Models\Email;
use App\Models\Classes;
use Session;
use App\Mail\useMail;

class ClassController extends AdminController {


    public function class_index(){
        $data=[];
        return view('admin::class.create_class');
    }
    public function post_class(Request $request){
    
        $validator = Validator::make($request->all(), [
            'class_name_dr' => 'required|unique:classes',
            'class_name_en' => 'required|unique:classes',
            'content_dr' => 'required',
            'content_en' => 'required',
            'image'         => 'required|mimes:jpg,jpeg,png|max:15360',    
        ]);
        if ($request->file('image')) {
            $img_name = $this->rand_string(10) . '.' . $request->file('image')->getClientOriginalExtension();
            $file = $request->file('image');
            $file->move(public_path('alifba/class_img/'), $img_name);
            // Image::make(public_path('uploads/frontend/cms/pictures/original/') . $img_name)->resize(1220, 500)
            // ->save(public_path('uploads/frontend/cms/pictures/preview/') . $img_name);
            $input['image'] = $img_name;
        }
        $input['class_name_en']=$request->input('class_name_en');
        $input['class_name_dr']=$request->input('class_name_dr');
        $input['content_en']=$request->input('content_en');
        $input['content_dr']=$request->input('content_dr');
        $input['age']=$request->input('age');
        $input['total_seat']=$request->input('total_seat');
        $input['time']=$request->input('time');
        $input['fee']=$request->input('fee');
        $input['status']=$request->input('status');
        Classes::create($input);
        $request->Session()->flash('success',"You have created a Class successfully");
        return $this->manage_classes();
    
    }
   
    public function manage_classes(){
        $data=[];
        $data['classes']=Classes::where('status','<>','2')->get();
        return view('admin::class.manage_classes',$data);
    }
    public function delete_class($id){
        if(Classes::where('id',$id)->update(['status'=>'2']))
        Session::flash('success', 'Class Deleted successfully.');
        return Redirect()->back();
    }
    public function view_class($id){
        $data = [];
        $data['model'] = $model = Classes::find($id);
        return view('admin::class.view',$data);
    }

    public function get_update($id){
        $data['model'] = $model = Classes::find($id);
        return view('admin::class.update',$data);
    }
    public function class_update(Request $request,$id){
        $data=[];
        $model = Classes::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'class_name_dr' => 'required|unique:classes',
            'class_name_en' => 'required|unique:classes',
            'content_dr'    => 'required',
            'content_en'    => 'required',
            'image'         => 'required|mimes:jpg,jpeg,png|max:15360',       
        ]);
        if ($request->file('image')) {
            $img_name = $this->rand_string(10) . '.' . $request->file('image')->getClientOriginalExtension();
            $file = $request->file('image');
            $file->move(public_path('alifba/class_img/'), $img_name);
            // Image::make(public_path('uploads/frontend/cms/pictures/original/') . $img_name)->resize(1220, 500)
            // ->save(public_path('uploads/frontend/cms/pictures/preview/') . $img_name);
            $model->image = $img_name;
        }
        $model['class_name_en']=$request->input('class_name_en');
        $model['class_name_dr']=$request->input('class_name_dr');
        $model['content_en']=$request->input('content_en');
        $model['content_dr']=$request->input('content_dr');
        $model['age']=$request->input('age');
        $model['total_seat']=$request->input('total_seat');
        $model['time']=$request->input('time');
        $model['fee']=$request->input('fee');
        $model['status']=$request->input('status');
        $model->save();
        $request->Session()->flash('success',"You have Updated the Class successfully");
        return $this->manage_classes();
    }
   
}
