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
use App\Models\UserFile;
use App\Http\Requests\StoreUserRequest;
use App\Models\Classes;
use Session;

class UserController extends AdminController {

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function create_user(){
        $data=[];
        $data['userTypes']=DB::table('user_type')->where('id','<>','1')->get();
        return view('admin::user.create_user',$data);
    }
    public function create_user_post(Request $request){
          $data=[];
           $input = $request->except('_token'); 
           if($request->hasFile('profile_picture')){
                $photo = time().'.'.$request->profile_picture->extension();  
                $request->profile_picture->move(public_path('backend/assets/users/photo'), $photo);
                $input['profile_picture']='backend/assets/users/photo/'.$photo;
           }
           $input['password']=Hash::make('123456');
           $input['name']=$request->first_name .' '.$request->last_name;
           $id=UserMaster::create($input)->id;
           $request->session()->flash('success','User Created Successfully');
           return redirect()->route('update-user',['id'=>$id]);
        //    return $this->update_user($id);
    }
    public function update_user($id){
        $data=[];
            $data['user']=UserMaster::find($id);
        return view('admin::user.update_user',$data);
    }
    public function post_update_users(Request $request , $id){
        $data=[];
                $input = $request->except('_token'); 
                if($request->hasFile('profile_picture')){
                    $photo = time().'.'.$request->profile_picture->extension();  
                    $request->profile_picture->move(public_path('backend/assets/users/photo'), $photo);
                    $input['profile_picture']='backend/assets/users/photo/'.$photo;
                }
                $input['name']=$request->first_name .' '.$request->last_name;
                $data['user']=UserMaster::where('id',$id)->update($input);
                $request->session()->flash('success','User Updated Successfully');

            return Redirect()->back();
        
    }
    public function view_user($id){
        $data=[];
        $data['user']=UserMaster::findOrFail($id);
        return view('admin::user.view_user',$data);
    }
    public function manage_user(){
        $data=[];
       
       if(isset($_GET['action']) && $_GET['action']=='delete'){
        $update=UserMaster::where('id',$_GET['id'])->update(['status'=>'2']);
        if($update){
            Session::flash('success','User Deleted Successfully');
        }
       }
        $data['users']= $users = UserMaster::where('type_id','<>','1')->where('status','<>', '2')->latest()->get();
        
            return view('admin::school.manage_users',$data);
      }
    public function creator_index() {
        $deleted_users = UserMaster::where('status', '=', '3')->get();
        foreach($deleted_users as $del)
        {
            $datetime1 = new DateTime($del->updated_at);
            $datetime2 = new DateTime(Carbon::now()->format('Y-m-d H:i:s'));
            $interval = $datetime1->diff($datetime2);
            $days = $interval->format('%a');
            if ($days >= 7) {
                UserMaster::find($del->id)->delete();
            }
        }
        $data = [];
        $data['name'] = $name = isset($_GET['name']) ? $_GET['name'] : "";
        // $data['last_name'] = $last_name = isset($_GET['last_name']) ? $_GET['last_name'] : "";
        $data['email'] = $email = isset($_GET['email']) ? $_GET['email'] : "";
        $data['status'] = $status = isset($_GET['status']) ? $_GET['status'] : "";
        $data['created_at'] = $created_at = isset($_GET['created_at']) ? $_GET['created_at'] : "";
        $data['search_filter'] = isset($_GET['search_filter']) ? $_GET['search_filter'] : "";
        $query = UserMaster::where('type_id','2')->where('status', '<>', '3');
        if ($name != "") {
            $query->where('name', 'like', '%' . $name . '%');
        }
        // if ($last_name != "") {
        //     $query->where('last_name', 'like', '%' . $last_name . '%');
        // }
        if ($email != "") {
            $query->where('email', 'like', '%' . $email . '%');
        }
        if ($created_at != "") {
            $query->whereDate('created_at','=',date($created_at));
        }
        if ($status != "") {
            if ($status == 'inactive') {
                $query->where('status', '=', '0');
            } else if ($status == 'active') {
                $query->where('status', '=', '1');
            }else if ($status == 'suspended') {
                $query->where('status', '=', '2');
            }else {
                
            }
        }
        $query->orderBy('id', 'DESC');
        $model = $query->paginate(10);
        $data['model'] = $model;
        return view('admin::user.creator_index',$data);
    }

    public function view_creator($id)
    {
        $data = [];
        $data['model'] = $model = UserMaster::findOrFail($id);
        return view('admin::user.creator_view',$data);
    }
    
    // public function get_customer_data()
    // {
    //     $user_list = UserMaster::where('type_id','2')->where('status', '<>', '3');
    //     return Datatables::of($user_list)
    //         ->addIndexColumn()
    //         ->editColumn('first_name', function ($model) {
    //             return $model->first_name;
    //         })
    //         ->editColumn('last_name', function ($model) {
    //             return $model->last_name;
    //         })
    //         ->editColumn('email', function ($model) {
    //             return $model->email;
    //         })
    //         ->editColumn('status', function ($model) {
    //             return $model->status;
    //         })
    //         ->editColumn('created_at', function ($model) {
    //             return date("jS M Y, g:i A", strtotime($model->created_at));
    //         })
    //         ->addColumn('action', function ($model) {
    //             $action_html = '<a href="' . Route('admin-updatecustomer', ['id' => $model->id]) . '" class="btn btn-outline btn-circle btn-sm purple" data-toggle="tooltip" title="Edit">'
    //                     . '<i class="fa fa-edit"></i>'
    //                     . '</a>'
    //                     . '<a href="javascript:void(0);" onclick="deleteWorker(this);" data-href="' . Route("admin-deletecustomer", ['id' => $model->id]) . '" data-id="' . $model->id . '" class="btn btn-outline btn-circle btn-sm dark" data-toggle="tooltip" title="Delete">'
    //                     . '<i class="fa fa-trash"></i>'
    //                     . '</a>';
                       
    //             // $action_html="";
    //             return $action_html;
    //         })
    //         ->make(true);
    // }
    
    public function customer_add()
    {
        $data = [];
        return view('admin::user.customer_add',$data);
    }
    
    // public function customer_post_add(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'first_name' => 'required|max:100|regex:/^[a-zA-Z\s]+$/',
    //         'last_name' => 'required|max:100|regex:/^[a-zA-Z\s]+$/',
    //         'email'=> 'required|email|max:255',
    //         'phone' => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/',
    //         // 'about_me' => 'required',
    //         // 'gender'=> 'required',
    //         // 'status' => 'required',
    //     ]);

    //     $validator->after(function($validator)use ($request) {
    //             $other_user = UserMaster::where('email', $request->input('email'))->where('status', '<>', '3')->first();
    //             if (!empty($other_user)) {
    //                 $validator->errors()->add('email', 'This Email id is already in use.');
    //             }
    //     });
    //     if ($validator->passes()) {
    //         $customerIP = request()->ip();
    //         $password = $this->rand_string(8);
           

    //         $input = new UserMaster;
    //         $input->type_id = '2';
    //         $input->first_name = $request->first_name;
    //         $input->last_name = $request->last_name;
    //         $input->password = Hash::make($password);
    //         $input->phone = $request->phone;
    //         $input->email = $request->email;
    //         $input->gender = $request->gender;
    //         $input->about_me = $request->about_me;
    //         $input->ip_address = $customerIP;
    //         $input->status = '1';
    //         $input->created_by =  $admin_id = Auth::guard('backend')->user()->id;
    //         $input->login_type='3';
    //         $input->save();


    //        $email_setting = $this->get_email_data('user_registration_by_admin', array('NAME' => $request->first_name, 'EMAIL' => $request->email,'PASSWORD' => $password));
    
    //        $email_data = [           
    //            'to' => $request->email,
    //            'subject' => $email_setting['subject'],
    //            'template' => 'signup',
    //            'data' => ['message' => $email_setting['body']]
    //        ];
         
    //        $this->SendMail($email_data);
 

    //         $request->session()->flash('success', 'Customer added successfully.');
    //     }else{
    //         return redirect()->route('admin-addcustomer')->withErrors($validator)->withInput();
    //     }
    //     return redirect()->route('admin-customer')->withErrors($validator)->withInput();
    // }
    
    public function creator_update(Request $request,$id)
    {
        $data = [];
        $data['model'] = $model = UserMaster::findOrFail($id);
        return view('admin::user.creator_update',$data);
    }
    
    public function creator_post_update(Request $request,$id)
    {
        $data = [];
        $model = UserMaster::findOrFail($id);
        // print_r($model);
        // exit();
        $validator = Validator::make($request->all(), [
                    'first_name' => 'required|max:120|regex:/^([^0-9]*)$/',
                    'last_name' => 'required|max:120|regex:/^([^0-9]*)$/',
                    // 'first_name' => 'required|max:100|regex:/^([^0-9]*)$/',
                    // 'last_name' => 'required|max:100|regex:/^([^0-9]*)$/',
                    'email'=> 'required|email|max:255',
//                    'phone' => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/',
                    //  'about_me' => 'required',
                    //  'gender'=> 'required',
                    'phone'=>'required',
                    'status'=> 'required',
        ]);
            $validator->after(function($validator)use ($request,$id) {
                $current_user = UserMaster::findOrFail($id); 
                $other_user = UserMaster::where('email', $request->input('email'))->where('status', '<>', '3')->where('id','<>',$id)->where('type_id', '=', $current_user->type_id)->first();
                if (!empty($other_user)) {
                    $validator->errors()->add('email', 'This Email is already in use.');
                }
//                if (!empty($request->input('phone'))) {
//                if(strlen($request->input('phone')) < 10){
//                    $validator->errors()->add('phone', 'Phone number must be at least 10  digits.'); 
//                }
//                }
        });
            if ($validator->passes()) {
            $model->first_name = $request->first_name;
            $model->about_me = $request->about_me;
            $model->last_name = $request->last_name;
            $model->name = $request->first_name.' '.$request->last_name;
            $model->email = $request->email;
//            $model->phone = $request->phone;
            // $model->gender = $request->gender;
            // $model->about_me = $request->about_me;
            $model->status = $request->status;
            $model->save();
            $request->session()->flash('success', 'Creator updated successfully.');
            return redirect()->route('admin-client')->withErrors($validator)->withInput();
        }else{
            return redirect()->route('admin-updateclient', ['id' => $id])->withErrors($validator)->withInput();
        }
    }
    
    public function cretor_delete(Request $request) {
       
        if (isset($_GET['id']) && $_GET['id'] != "") {
            $model = UserMaster::findOrFail($_GET['id']);
            if (!empty($model) && $model->status != '3') {
                $model->status = '3';
                $model->updated_at = Carbon::now()->format('Y-m-d H:i:s');
                $model->save();
                $request->session()->flash('success', 'Creator deleted successfully.');
            } else {
                $request->session()->flash('danger', 'Oops. Something went wrong.');
            }
        } else {
            $request->session()->flash('danger', 'Oops. Something went wrong.');
        }
        return redirect()->route('admin-client');
    }
    
    public function member_index()
    {
        $deleted_users = UserMaster::where('status', '=', '3')->get();
        foreach($deleted_users as $del)
        {
            $datetime1 = new DateTime($del->updated_at);
            $datetime2 = new DateTime(Carbon::now()->format('Y-m-d H:i:s'));
            $interval = $datetime1->diff($datetime2);
            $days = $interval->format('%a');
            if ($days >= 7) {
                UserMaster::find($del->id)->delete();
            }
        }
        $data = [];
        $data['name'] = $name = isset($_GET['name']) ? $_GET['name'] : "";
        // $data['last_name'] = $last_name = isset($_GET['last_name']) ? $_GET['last_name'] : "";
        $data['email'] = $email = isset($_GET['email']) ? $_GET['email'] : "";
        $data['status'] = $status = isset($_GET['status']) ? $_GET['status'] : "";
        $data['created_at'] = $created_at = isset($_GET['created_at']) ? $_GET['created_at'] : "";
        $data['search_filter'] = isset($_GET['search_filter']) ? $_GET['search_filter'] : "";
        $query = UserMaster::where('type_id','3')->where('status', '<>', '3');
        if ($name != "") {
            $query->where('name', 'like', '%' . $name . '%');
        }
        // if ($last_name != "") {
        //     $query->where('last_name', 'like', '%' . $last_name . '%');
        // }
        if ($email != "") {
            $query->where('email', 'like', '%' . $email . '%');
        }
        if ($created_at != "") {
            $query->whereDate('created_at','=',date($created_at));
        }
        if ($status != "") {
            if ($status == 'inactive') {
                $query->where('status', '=', '0');
            } else if ($status == 'active') {
                $query->where('status', '=', '1');
            }else if ($status == 'suspended') {
                $query->where('status', '=', '2');
            }else {
                
            }
        }
        $query->orderBy('id', 'DESC');
        $model = $query->paginate(10);
        $data['model'] = $model;
        return view('admin::user.member_index',$data);
    }
    
    // public function get_booster_data()
    // {
    //     $user_list = UserMaster::where('type_id','3')->where('status', '<>', '3');
    //     return Datatables::of($user_list)
    //         ->addIndexColumn()
    //         ->editColumn('first_name', function ($model) {
    //             return $model->first_name;
    //         })
    //         ->editColumn('last_name', function ($model) {
    //             return $model->last_name;
    //         })
    //         ->editColumn('email', function ($model) {
    //             return $model->email;
    //         })
    //         ->editColumn('status', function ($model) {
    //             return $model->status;
    //         })
    //         ->editColumn('created_at', function ($model) {
    //             return date("jS M Y, g:i A", strtotime($model->created_at));
    //         })
    //         ->addColumn('action', function ($model) {
    //             $action_html = '<a href="' . Route('admin-updatebooster', ['id' => $model->id]) . '" class="btn btn-outline btn-circle btn-sm purple" data-toggle="tooltip" title="Edit">'
    //                     . '<i class="fa fa-edit"></i>'
    //                     . '</a>'
    //                     . '<a href="javascript:void(0);" onclick="deleteTrainer(this);" data-href="' . Route("admin-deletebooster", ['id' => $model->id]) . '" data-id="' . $model->id . '" class="btn btn-outline btn-circle btn-sm dark" data-toggle="tooltip" title="Delete">'
    //                     . '<i class="fa fa-trash"></i>'
    //                     . '</a>';
                       
    //             // $action_html="";
    //             return $action_html;
    //         })
    //         ->make(true);
    // }
    
    public function booster_add()
    {
        $data = [];
        return view('admin::user.booster_add',$data);
    }
    
    public function booster_post_add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|max:100|regex:/^([^0-9]*)$/',
            'last_name' => 'required|max:100|regex:/^([^0-9]*)$/',
            'email'=> 'required|email|max:255',
            // 'phone' => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/',
            // 'about_me' => 'required',
            'gender'=> 'required',
            // 'status' => 'required',
        ]);

        $validator->after(function($validator)use ($request) {
                $other_user = UserMaster::where('email', $request->input('email'))->where('type_id','3')->where('status', '<>', '3')->first();
                if (!empty($other_user)) {
                    $validator->errors()->add('email', 'This email address is already in use.');
                }
                if (!empty($request->input('phone'))) {
                if(strlen($request->input('phone')) < 10){
                    $validator->errors()->add('phone', 'Phone number must be at least 10  digits.'); 
                }
                }
        });
        if ($validator->passes()) {
            $customerIP = request()->ip();
            $password = $this->rand_string(8);
           

            $input = new UserMaster;
            $input->type_id = '3';
            $input->first_name = $request->first_name;
            $input->last_name = $request->last_name;
            $input->password = Hash::make($password);
            $input->phone = $request->phone;
            $input->email = $request->email;
            $input->gender = $request->gender;
            $input->about_me = $request->about_me;
			$input->wallet_balance = "0";
			$input->total_purchase = "0";
            $input->ip_address = $customerIP;
            $input->status = '1';
            $input->created_by =  $admin_id = Auth::guard('backend')->user()->id;
            $input->login_type='3';
            $input->save();


           $email_setting = $this->get_email_data('booster_registration_by_admin', array('NAME' => $request->first_name, 'EMAIL' => $request->email,'PASSWORD' => $password));
    
           $email_data = [           
               'to' => $request->email,
               'subject' => $email_setting['subject'],
               'template' => 'signup',
               'data' => ['message' => $email_setting['body']],
               'email_reason' => "Please do not reply to this e-mail. This is a system-generated email arising from your registration at eloboost.com",
           ];
         
           $this->SendMail($email_data);
 

            $request->session()->flash('success', 'Booster added successfully.');
        }else{
            return redirect()->route('admin-addbooster')->withErrors($validator)->withInput();
        }
        return redirect()->route('admin-booster')->withErrors($validator)->withInput();
    }
    
    public function member_update(Request $request,$id)
    {
        $data = [];
        $data['model'] = $model = UserMaster::findOrFail($id);
        return view('admin::user.member_update',$data);
    }
    
    public function member_post_update(Request $request,$id)
    {
        $data = [];
        $model = UserMaster::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'first_name'=>'required|min:3',
            'last_name'=>'required|min:3',
            'email'=>'required|email',
            // 'zipcode'=>'required|numeric',
            'address_line1'=>'required',
            'company_name'=>'required',
            'working_trade'=>'required',
            'city'=>'required',
            // 'country'=>'required',
            'working_area'=>'required',
            'phone'=>'required|min:10|regex:/^([0-9\s\-\+\(\)]*)$/',
            // 'alt_phone'=>'required',
            'company_email'=>'required|email',
            // 'website'=>'required',
            'status'=>'required'
        ]);
            $validator->after(function($validator)use ($request,$id) {
                $current_user = UserMaster::findOrFail($id); 
                $other_user = UserMaster::where('email', $request->input('email'))->where('status', '<>', '3')->where('id','<>',$id)->where('type_id', '=', $current_user->type_id)->first();
                if (!empty($other_user)) {
                    $validator->errors()->add('email', 'This Email is already in use.');
               }
        });
            if ($validator->passes()) {
                $input = $request->input();
                $input['name'] = $request->first_name.' '.$request->last_name;
                if (empty($request->insurance)) {
                    $input['insurance'] = '0';
                }
                if (empty($request->address)) {
                    $input['address'] = '0';
                }
                if (empty($request->balloon_id)) {
                    $input['balloon_id'] = '0';
                }
                if (empty($request->references_verified)) {
                    $input['references_verified'] = '0';
                }
                $model->update($input);
                $request->session()->flash('success', 'Member updated successfully.');
                return redirect()->route('admin-expert')->withErrors($validator)->withInput();
        }else{
            // dd($validator->errors());
            return redirect()->back()->withErrors($validator)->withInput();
        }
    }

    public function view_member($id)
    {
        $data = [];
        $data['model'] = $model = UserMaster::findOrFail($id);
        return view('admin::user.member_view',$data);
    }
    
    public function member_delete(Request $request) {
       
        if (isset($_GET['id']) && $_GET['id'] != "") {
            $model = UserMaster::findOrFail($_GET['id']);
            if (!empty($model) && $model->status != '3') {
                $model->status = '3';
                $model->updated_at = Carbon::now()->format('Y-m-d H:i:s');
                $model->save();
                $request->session()->flash('success', 'Member deleted successfully.');
            } else {
                $request->session()->flash('danger', 'Oops. Something went wrong.');
            }
        } else {
            $request->session()->flash('danger', 'Oops. Something went wrong.');
        }
        return redirect()->route('admin-expert');
    }

    public function user_docs($id)
    {
        $data = [];
        $data['model'] = UserMaster::find($id);
        $data['files'] = UserFile::where(['user_id'=>$id, 'status'=>'1'])->get();
        return view('admin::user.member_files', $data);
    }

    public function post_user_doc(Request $request,$id)
    {
        $request->validate([
            'file'=>'required',
            'name'=>'required'
        ]);
        if ($request->file('file')) {
            $img_name = $this->rand_string(12) . '.' . $request->file('file')->getClientOriginalExtension();
            $file = $request->file('file');
            $file->move(public_path('uploads/admin/user_files/'), $img_name);
            $model = new UserFile();
            $model->name = $request->name;
            $model->file_name = $img_name;
            $model->user_id = $id;
            $model->save();
            return redirect()->back()->with('success','File Uploaded successfully.');
        }
    }


    
    // public function employee_index()
    // {
    //     $data = [];
    //     return view('admin::user.employee_index',$data);
    // }
    
    // public function get_employee_data()
    // {
    //     $user_list = UserMaster::where('type_id','2')->where('status', '<>', '3');
    //     return Datatables::of($user_list)
    //         ->addIndexColumn()
    //         ->editColumn('first_name', function ($model) {
    //             return $model->first_name;
    //         })
    //         ->editColumn('last_name', function ($model) {
    //             return $model->last_name;
    //         })
    //         ->editColumn('email', function ($model) {
    //             return $model->email;
    //         })
    //         ->editColumn('status', function ($model) {
    //             return $model->status;
    //         })
    //         ->editColumn('created_at', function ($model) {
    //             return date("jS M Y, g:i A", strtotime($model->created_at));
    //         })
    //         ->addColumn('action', function ($model) {
    //             $action_html = '<a href="' . Route('admin-updateemployee', ['id' => $model->id]) . '" class="btn btn-outline btn-circle btn-sm purple" data-toggle="tooltip" title="Edit">'
    //                     . '<i class="fa fa-edit"></i>'
    //                     . '</a>'
    //                     . '<a href="javascript:void(0);" onclick="deleteEmployee(this);" data-href="' . Route("admin-deleteemployee", ['id' => $model->id]) . '" data-id="' . $model->id . '" class="btn btn-outline btn-circle btn-sm dark" data-toggle="tooltip" title="Delete">'
    //                     . '<i class="fa fa-trash"></i>'
    //                     . '</a>';
                       
    //             // $action_html="";
    //             return $action_html;
    //         })
    //         ->make(true);
    // }
    
    // public function employee_add()
    // {
    //     $data = [];
    //     return view('admin::user.employee_add',$data);
    // }
    
    // public function employee_post_add(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'first_name' => 'required|max:100|regex:/^[a-zA-Z\s]+$/',
    //         'last_name' => 'required|max:100|regex:/^[a-zA-Z\s]+$/',
    //         'email'=> 'required|email||max:255',
    //         'phone' => 'required|min:11|numeric',
    //         'status' => 'required',
    //     ]);

    //     $validator->after(function($validator)use ($request) {
    //             $other_user = UserMaster::where('email', $request->input('email'))->where('status', '<>', '3')->first();
    //             if (!empty($other_user)) {
    //                 $validator->errors()->add('email', 'Email id already in use.');
    //             }
    //     });
    //     if ($validator->passes()) {
    //         $customerIP = request()->ip();
    //         $password = $this->rand_string(8);
           

    //         $input = new UserMaster;
    //         $input->type_id = 2;
    //         $input->first_name = $request->first_name;
    //         $input->last_name = $request->last_name;
    //         $input->password = Hash::make($password);
    //         $input->phone = $request->phone;
    //         $input->email = $request->email;
    //         $input->ip_address = $customerIP;
    //         $input->status = $request->status;
    //         $input->created_by =  $admin_id = Auth::guard('backend')->user()->id;
    //         $input->login_type='3';
    //         $input->save();


    //        $email_setting = $this->get_email_data('user_registration_by_admin', array('NAME' => $request->first_name." ".$request->last_name, 'EMAIL' => $request->email,'PASSWORD' => $password));
    
    //        $email_data = [           
    //            'to' => $request->email,
    //            'subject' => $email_setting['subject'],
    //            'template' => 'signup',
    //            'data' => ['message' => $email_setting['body']]
    //        ];
         
    //        $this->SendMail($email_data);
 

    //         $request->session()->flash('success', 'Employee added successfully.');
    //     }else{
    //         return redirect()->route('admin-addemployee')->withErrors($validator)->withInput();
    //     }
    //     return redirect()->route('admin-employee')->withErrors($validator)->withInput();
    // }
    
    // public function employee_update(Request $request,$id)
    // {
    //     $data = [];
    //     $data['model'] = $model = UserMaster::findOrFail($id);
    //     return view('admin::user.employee_update',$data);
    // }
    
    // public function employee_post_update(Request $request,$id)
    // {
    //     $data = [];
    //     $model = UserMaster::findOrFail($id);
    //     $validator = Validator::make($request->all(), [
    //                 'first_name' => 'required|max:100|regex:/^[a-zA-Z\s]+$/',
    //                 'last_name' => 'required|max:100|regex:/^[a-zA-Z\s]+$/',
    //                 'email'=> 'required|email||max:255',
    //                 'phone' => 'required|min:11|numeric',
    //                 'status'=> 'required',
    //     ]);
    //         $validator->after(function($validator)use ($request,$id) {
    //             $other_user = UserMaster::where('email', $request->input('email'))->where('status', '<>', '3')->where('id','<>',$id)->first();
    //             if (!empty($other_user)) {
    //                 $validator->errors()->add('email', 'Email id already in use.');
    //            }
    //     });
    //         if ($validator->passes()) {
    //         $model->first_name = $request->first_name;
    //         $model->last_name = $request->last_name;
    //         $model->email = $request->email;
    //         $model->phone = $request->phone;
    //         $model->status = $request->status;
    //         $model->save();
    //         $request->session()->flash('success', 'Employee updated successfully.');
    //         return redirect()->route('admin-employee')->withErrors($validator)->withInput();
    //     }else{
    //         return redirect()->route('admin-updateemployee', ['id' => $id])->withErrors($validator)->withInput();
    //     }
    // }
    
    // public function employee_delete(Request $request) {
       
    //     if (isset($_GET['id']) && $_GET['id'] != "") {
    //         $model = UserMaster::findOrFail($_GET['id']);
    //         if (!empty($model) && $model->status != '3') {
    //             $model->status = '3';
    //             $model->save();
    //             $request->session()->flash('success', 'Employee deleted successfully.');
    //         } else {
    //             $request->session()->flash('danger', 'Oops. Something went wrong.');
    //         }
    //     } else {
    //         $request->session()->flash('danger', 'Oops. Something went wrong.');
    //     }
    //     return redirect()->route('admin-employee');
    // }
    
    
}
