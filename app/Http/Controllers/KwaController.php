<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Validator;
use App\Helpers\Subscription;
use App\Services\Payments;
use Carbon\Carbon;
use App\Models\Slide;
use App\Models\Cms;
use App\Models\Event;
use App\Models\Project;
use App\Models\Subscriber;
use App\Models\Inquiry;
use App\Models\ContactUs;
use App\Models\Image;

class KwaController extends Controller
{
    public $ABOUTUS='';
    public function __construct(){
        $this->ABOUTUS=Cms::where('slug', 'like', '%about_us*%')->first();
        
    }
    // dd($ABOUTUS);
    public function  home(){

        $data=[];
        $data['slide']    = Event::where('status','1')->take(3)->get();
        // dd($data['slide']);
        $data['aboutus']  = Cms::where('slug', 'like', '%about_us*%')->first();
        $data['events']   = Event::where('status','1')->orderBy('id', 'desc')->take(3)->get();
        $data['projects'] = Project::where('status','1')->orderBy('id', 'desc')->take(3)->get();

        return view('kwa.index',$data);
    }
    public function  about(){

        $data=[];
        $data['aboutus']=Cms::where('status','1')->where('slug','about_us')->get();
        return view('kwa.about',$data);
    }
    public function  events(){

        $data=[];
        $data['events']=Event::where('status','1')->get();
        return view('kwa.events',$data);
    }
    public function projects(){
        $data=[];
        $data['projects']=Project::where('status','1')->get();
        return view('kwa.projects',$data);
    }
    public function single_project($id){
        $data=[];
        $data['model']=Project::find($id);
        return view('kwa.single_project',$data);
    }
    public function  news(){

        $data=[];
        return view('kwa.news',$data);
    }
    public function  contact(){

        $data=[];
        return view('kwa.contact',$data);
    }
    public function add_contact(Request $request){
        if($request->ajax()){
            $data=[];
            $input=$request->except('_token');
         
            ContactUs::create($input);
            $data['status']='success';
            if(app()->getLocale()=='en'){
                $data['success']='Your message is sent!';
            }else{
                $data['success']='مسج شما ارسال شد';
            }
            return response()->json($data);
        }else{
            $input=$request->except('_token');
            ContactUs::create($input);
            if(app()->getLocale()=='en'){
                Session::flash('success','Your message is sent!');
            }else{
                Session::flash('success','مسج شما ارسال شد');
            }
            return back();
        }
    }
    public function kwa_gallery(){
        $data=[];
        $data['model']=Image::where('status','1')->latest()->get();
        return view('kwa.gallery',$data);
    }
    public function single_event($id=null){
        $data=[];
        $data['model']=Event::find($id);
        return view('kwa.single_news',$data);
    }
    public function kwa_register(Request $request){
        $data=[];
        if($request->ajax()){
            $input=$request->except('_token');
            $input['status']='1';
            Subscriber::create($input);
            if(app()->getLocale()=='en'){
                $data['success']='You are registed successfully!';
            }else{
                $data['success']='شما با موفقیت ثبت نام کردید';
            }
            $data['status'] = 'success';
            $data['link']=  Route('kwa_home');
            return response()->json($data);
        }
       
        
    }
    
    public function add_inquiry(Request $request){
        if($request->ajax()){
            $data=[];
            $input=$request->except('_token');
            Inquiry::create($input);
            $data['status']='success';
            if(app()->getLocale()=='en'){
                $data['success']='Your inquiry is sent!';
            }else{
                $data['success']='سوال شما ارسال شد';
            }
            return response()->json($data);
        }else{
            $input=$request->except('_token');
            Inquiry::create($input);
            if(app()->getLocale()=='en'){
                Session::flash('success','Your inquiry is sent!');
            }else{
                Session::flash('success','سوال شما ارسال شد');
            }
            return back();
        }

    }
}