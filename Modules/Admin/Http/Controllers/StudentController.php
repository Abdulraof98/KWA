<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManagerStatic as Image;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Hash;
use DateTime;
use Carbon\Carbon;

use App\Models\UserMaster;
use App\Models\Student;
use App\Models\UserFile;
use App\Models\Inquiry;
// use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\StoreStudentRequest;
use App\Models\Classes;
use Session;
use App\Models\SelectForm;

class StudentController extends AdminController {

    public function get_new_students(){
    $data=[];
    $data['students']=Student::where('payment',0)->get();
    return view ('admin::school.students',$data);
    }
    public function manage_student(){
     $data=[];
            $data['students']=Student::where('payment',1)->get();
            return view ('admin::student.manage_student',$data);
        
    }
    public function create_student(){
        $data = [];
        $data['classes']=Classes::where('status','1')->get();
        $data['selects']= SelectForm::where('status','1')->get();
        return view('admin::student.create_student', $data);
    }
    public function post_new_student(StoreStudentRequest $request){
        $data = [];
        $input = $request->input();
        
        if($request->hasFile('photo')){ 
            $photo = time().'.'.$request->photo->extension();  
            $request->photo->move(public_path('uploads/frontend/students/photo'), $photo);
            $input['photo']='uploads/frontend/students/photo/'.$photo;
        }
        if($request->hasFile('tazkira')){
            $tazkira = time().'taz.'.$request->tazkira->extension();  
            $request->tazkira->move(public_path('uploads/frontend/students/tazkira'), $tazkira);
            $input['tazkira']='uploads/frontend/students/tazkira/'.$tazkira;
        }
        // dd($input);
        $user = Student::create($input);
        $request->Session()->flash('success',"Student registered successfully");
        return redirect()->route('update-student', [$user->id]);
    }
    public function update_student($id){
             $data=[];
             $data['student']=Student::findOrFail($id);
             $data['classes']=Classes::where('status','1')->get();
             $data['selects']= SelectForm::where('status','1')->get();
             return view('admin::student.update_student',$data);
    }
    public function post_update_student(StoreStudentRequest $request, $id){
        $data = [];
        $input = $request->except('_token');
        // dd($input);
        if($request->hasFile('photo')){ 
            $photo = time().'.'.$request->photo->extension();  
            $request->photo->move(public_path('uploads/frontend/students/photo'), $photo);
            $input['photo']='uploads/frontend/students/photo/'.$photo;
        }
        if($request->hasFile('tazkira')){
            $tazkira = time().'taz.'.$request->tazkira->extension();  
            $request->tazkira->move(public_path('uploads/frontend/students/tazkira'), $tazkira);
            $input['tazkira']='uploads/frontend/students/tazkira/'.$tazkira;
        }
        Student::where('id',$id)->update($input);
        $data['student']=Student::find($id);
        $data['classes']=Classes::where('status','1')->get();
        $data['selects']= SelectForm::where('status','1')->get();
        $request->Session()->flash('success',"Student Updated successfully");
        return view('admin::student.update_student',$data);
        
    }

    public function delete_student($id){
        $deleted = Student::where('id',$id)->update(['status'=>'2']);
        if(!$deleted) return false;
        Session::flash('success','Student Deleted successfully');
        return $this-> manage_student();
    }
    public function view_Student($id){
        $data=[];
        $data['model']=Student::findOrFail($id);
        $data['selects']= SelectForm::all();
        return view('admin::student.view',$data);
    }
 
    public function get_inquiries(){
        $data=[];
        $data['inquiries']=$item= Inquiry::where('status','<>','2')->get();
        // Carbon::parse($item['created_at']);
        // $data['users']=UserMaster::where('status','<>','3')->get();
        $data['user']= new UserMaster();
        return view('admin::school.inquiries',$data);
    }
    public function update_inquiry($id){

        $data=[];
        $data['model']=Inquiry::where('id',$id)->first();
        return view('admin::comment.index',$data);
    }
    public function post_inquiries(Request $request,$id){
        $data=[];
        // dd('adas');
        Inquiry::where('id',$id)->update(['result'=>$request->result]);
        $request->Session()->flash('success',"Inquiry Updated successfully");
        return Redirect()->route('admin-inquiry');
        // return redirect()->route('update-student', [$user->id]);
    }


}