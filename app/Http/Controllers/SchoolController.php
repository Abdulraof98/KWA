<?php

namespace App\Http\Controllers;
// use Illuminate\Support\Facades\Mail;
use Mail;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Requests\signupRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManagerStatic as Image;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use DataTables;
use Validator;
use App\Models\SubscriptionPlan;
use App\Models\UserMaster;
use App\Models\Challenge;
use App\Mail\userMail;
use App\Models\Cms;
use App\Models\Classes;
use App\Models\Student;
use App\Models\Inquiry;
use App\Http\Requests\StoreStudentRequest;
use Session;
use App\Models\SelectForm;
use App\Models\Blog;


class SchoolController extends Controller
{
    // use HelperTrait;


    protected $locale;
    public function __construct(Request $request){
         $this->locale = app()->getLocale();
    }
    public function send_test_email(){
        Mail::to('abdulraof.froutan@gmail.com')->send(new userMAil());
    }

    public function index() {
        $data = []; 
        $data['slide'] = $slide = Cms::where('slug','header_slide')->first();
        $data['aboutus']=Cms::where('title_en', 'like', '%About Us Body%')->first();
        $data['classes'] =  Classes::where('status','1')->orderBy('priority', 'ASC')->paginate(3);
        return view('alifba.home', $data);
    }
    public function load_classes(Request $r){
        if ($r->ajax()) {
            $response = [];
            $data = [];
            // $user= auth()->guard('frontend')->user();
            $data['classes']=Classes::where('status','1')->paginate(3);
            // dd($data['models']);
            $view = view('ajax.class_ajax',$data)->render();
            $response['count'] = count($data['classes']);
            $response['success'] = true;
            $response['content'] = $view;
            return response()->json($response);
        }

    }
    public function login(Request $request){ 

        $validator = Validator::make($request->all(), [
                    'useremail' => 'required|email',
                    'userpassword' => 'required'
        ]);
        if ($validator->passes()) {
            $model = UserMaster::where('email', $request->input('useremail'))
                    ->where('type_id', '3')
                    // ->where('status', '1')
                    ->first();
                    if (!empty($model) && Hash::check($request->input('userpassword'), $model->password)) {
                
                        // dd($model);
                        if ($request->input('rememberMe') != '') {
                            $expire = time() + 3600;
                            setcookie('user_email', $request->input('useremail'), $expire);
                            setcookie('user_password', $request->input('userpassword'), $expire);
                        } else {
                            $expire = time() - 3600;
                            setcookie('user_email', '', $expire);
                            setcookie('user_password', '', $expire);
                        }
                        Auth::guard('frontend')->login($model);
                        $model->last_login = date('Y-m-d H:i:s');
                        $model->save();
                        $user = auth()->guard('frontend')->user();
                        Auth::guard('frontend')->login($user);
                        $data['msg'] = 'You are logged in successfully.';
                        $data['link'] = Route('/');
                        $data['status'] = 'success';
                        if(app()->getLocale()=='dr'){
                            Session::flash('success','شما اکنون وارد سیستم شده اید');
                        }else{
                            Session::flash('success','you are login Now!');
                        }
                        
                        
                    } else {
                        // if(app()->getLocale()=='dr'){
                        //     Session::flash('error','شما اکنون وارد سیستم شده اید');
                        // }else{
                        //     Session::flash('error','Incorrect Email and Password!');
                        // }
                        $data['msg'] = 'Incorrect Email and Password';
                        $data['link'] = Route('/');
                        $data['status'] = 'errors';   
                    }
                    return response()->json($data);
    }
    }
    public function logout() {
        Auth::guard('frontend')->logout();
        if(app()->getLocale()=='dr'){
            return redirect('/')->with('success', 'شما با موفقیت خارج شدید');
        }else{
            return redirect('/')->with('success', 'You are successfully logged out.');
        }
        
    }
    public function signup() {
        $data = []; 
        return view('alifba.signup', $data);
    }
    public function send_mail(){
       $order=UserMaster::find(27);
       
        Mail::to('abdulraof.froutan@gmail.com')->send(new userMail($order));
    }
    public function signup_post(signupRequest $request)
    {
        if ($request->ajax()) {
            $data = [];
            $input=[];
            // $input = $request->input();
            $input['name']=$request->input('username');
            $input['email']=$request->input('email');
            $input['type_id']="3";
            $input['password'] = Hash::make($request->input("password"));
            $input['ip_address'] = $request->ip();
            $input['status'] = '1';
            $input['active_token'] = $this->rand_string(20);
            $input['created_at'] = Carbon::now()->toDateTimeString();
            $input['login_type'] = '3';
            $user = UserMaster::create($input);
            
             $url = Route('active-account', ['id' => base64_encode($user->id), 'token' => $input['active_token']]);
             $link = '<a href="' . $url . '">Click Here</a>';
            // Mail::to($model->email)->send(new Registration($model, $link));
//            $email_setting = $this->get_email_data('user_registration', array('NAME' => $user->first_name,"LINK"=>$link));
//            $email_data = [
//                'to' => $user->email,
//                'subject' => $email_setting['subject'],
//                'template' => 'signup',
//                'data' => ['message' => $email_setting['body']]
//            ];
//            $this->SendMail($email_data);
//            $data['msg'] = 'A Verification Link has been sent on your registered email address.';
             Auth::guard('frontend')->login($user);
            $data['msg'] = 'You have registered successfully.';
            $data['link'] = Route('/');
            $data['status'] = 'success';
            if(app()->getLocale()=='dr'){
                Session::flash('success','شما موفقانه راجستر شدید');
            }elseif(app()->getLocale()=='en'){
                Session::flash('success','You are registered successfully!');
            }
            
            return response()->json($data);
        }
    }
    public function about(){
        $data = [];
        $data['teachers']=UserMaster::where('type_id','4')->where('profile_picture','!=','')->where('status','1')->get();
        $data['about']= Cms::where('status','1')->where('slug','about_us')->get();
        return view('alifba.about',$data);
    }
    public function class(){
        $data=[];
        $data['classes']=Classes::where('status','1')->get();
        $data['aboutus']=Cms::where('title_en', 'like', '%About Us Body%')->first();
        return view('alifba.class',$data);
    }
    public function guest_class(Request $request){
        $data=[];
        $data=$request->except('_token');
        $data['name']=$request->input('guest_name');
        $data['course']=$request->input('guest_class');
        $data['email']=$request->input('guest_email');
        $data['type_id']='1';// guest
        Student::create($data);
        if(app()->getLocale()=='en'){
            $request->session()->flash('success','Class Booked Successfully, wait for your guidance to reach you');
        }else{
            $request->session()->flash('success','کلاس با موفقیت رزرو شد، منتظر راهنمایی شما باشید');
        }
        return Redirect()->back();
        
    }
    public function contact(){
        $data=[];
        return view('alifba.contact',$data);
    }
    public function team(){
        $data=[];
        return view('alifba.team',$data);
    }
    public function register() {
        $data = [];
        $data['register_context']=Cms::where('slug','block_register')->first();
        $data['classes'] =Classes::where('status','1')->get();
        $data['selects']= SelectForm::where('status','1')->get();
        return view('alifba.register', $data);
    }
    public function register_block($id){
        $data = [];
        $data['register_context']=Cms::where('slug','block_register')->first();
        // dd($data['register_context']->content_body_en);
        $data['model']=Classes::findOrFail($id);
        $data['classes'] =Classes::where('status','1')->get();
        $data['selects']= SelectForm::where('status','1')->get();
        return view('school.register_block', $data);
    }
    public function gallery() {
        $data = [];
        return view('alifba.gallery', $data);
    }
    public function post_register(Request $request) { 
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
        $user = Student::create($input);
        if(app()->getLocale()=='en'){
            $request->session()->flash('success','Class Booked Successfully, wait for your guidance to reach you');
        }else{
            $request->session()->flash('success','کلاس با موفقیت رزرو شد، منتظر راهنمایی شما باشید');
        }
        return Redirect()->route('/');
    }
    public function lang_change($lang) {
        App::setLocale($lang);
        // session()->put('locale', $lang);
        // if ($lang != 'it'){
        // $baseUrl = str_replace('//', '//'.$lang.'.', 'https://charmescorts.com/');
        //     return redirect($baseUrl);
     
        // }
       // return redirect('https://charmescorts.com/');//->back();
       return redirect('/');
    }
    public function new_inq(Request $request){
        $data=[];
          $input = new Inquiry;
          $input->name= $request->name;
          $input->email= $request->email;
          $input->phone_no= $request->phone_no;
          $input->comment= $request->comment;
          $input->save();
          if(app()->getLocale()=='dr'){
            Session::flash('success','!مسج شما موفقانه ارسال شد');
          }elseif(app()->getLocale()=='en'){
            Session::flash('success', 'Your Message sent successfully!');
          }
          return back();

    }
    public function blog_index(){
        $data=[];
        
        $data['blogs']=Blog::where('status','1')->get();
        return view('blog.index',$data);
    }
    public function load_blog(Request $r){
        if($r->ajax()){
            $response=[];
            $data=[];
            $data['blogs']=$blogs=Blog::where('status','1')->paginate(3);
            // dd('blog',$blogs);
            $view= view('ajax.blog_ajax',$data)->render();
            // dd('view',$view);
            $response['success']=true;
            $response['count']=count($blogs);
            $response['content']=$view;
            return response()->json($response);
        }
    }
    public function show_blog($id){
        $data=[];
        $data['blog']=Blog::where('status','1')->where('id',$id)->first();
        return view('blog.blog',$data);

    }
}
