<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Hash;
use DB;
use Redirect;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Exception;
use Cookie;
use Validator;
use Image;
use File;
// ************ Requests ************
use App\Http\Requests\UserEditProfile;
use App\Http\Requests\ProAccountSettingRequest;
/** Models */
use App\Models\UserMaster;
use App\Models\Country;
use App\Models\Settings;
use App\Models\UserAsset;
use App\Models\Tag;

class UserController extends Controller
{
    public function client_edit_profile(){
        $id = Auth::guard('frontend')->user()->id;
        $user = UserMaster::findOrFail($id);
        $data['user'] = $user;
        return view('user.client_account_setting',$data);
    }

    public function pro_edit_profile(){
        $id = Auth::guard('frontend')->user()->id;
        $user = UserMaster::findOrFail($id);
        $data['user'] = $user;
        return view('user.pro_account_setting',$data);
    }

    public function post_edit_user(UserEditProfile $request)
    {
        if ($request->ajax()) {
            $model = Auth()->guard('frontend')->user();
            if ($request->file('profile_picture')) {
                if(file_exists(public_path('uploads/frontend/profile_picture/original/' . $model->profile_picture)))
                {
                    File::delete(public_path('uploads/frontend/profile_picture/original/' . $model->profile_picture));
                    File::delete(public_path('uploads/frontend/profile_picture/preview/' . $model->profile_picture));
                    File::delete(public_path('uploads/frontend/profile_picture/thumb/' . $model->profile_picture));
                }
                $img_name = $this->rand_string(12) . '.' . $request->file('profile_picture')->getClientOriginalExtension();
                $file = $request->file('profile_picture');
                $file->move(public_path('uploads/frontend/profile_picture/original/'), $img_name);
                Image::make(public_path('uploads/frontend/profile_picture/original/') . $img_name)->resize(500, 500)->save(public_path('uploads/frontend/profile_picture/preview/') . $img_name);
                Image::make(public_path('uploads/frontend/profile_picture/original/') . $img_name)->resize(200, 200)->save(public_path('uploads/frontend/profile_picture/thumb/') . $img_name);
                $model->profile_picture = $img_name;
            }
            $model->first_name=$request->input('first_name');
            $model->name=$request->input('first_name').' '.$request->input('last_name');
            $model->last_name=$request->input('last_name');
            $model->email=$request->input('email');
            $model->phone=$request->input('phone');
            $model->updated_at = Carbon::now()->toDateTimeString();
            $model->save();
            $response['msg'] = 'Your profile has been updated.';
            $response['success'] = true;
            return response()->json($response);
        }
    }

    public function post_change_password(Request $r)
    {
        $r->validate([
            'old_password'=>'required|min:6',
            'new_password'=>'required|min:6',
            'confirm_password'=>'required|same:new_password'
        ]);
        $id = Auth::guard('frontend')->user()->id;
        $user = UserMaster::find($id,['password']);
        $response = [];
        if (Hash::check($r->old_password,$user->password)) {
            $input = [];
            $input['password'] = Hash::make($r->new_password);
            UserMaster::find($id)->update($input);
            $response['success'] = true;
            $response['message'] = 'Password updated successfully';
            return response()->json($response);
        }else{
            $response['success'] = false;
            $response['message'] = 'Sorry your old password does not match our records!';
            return response()->json($response);
        }
    }

    public function delete_account()
    {
        $user = auth()->guard('frontend')->user();
        $user->status = '3';
        $user->save();
        Auth::guard('frontend')->logout();
        return redirect()->route('/')->with('success','Your account deleted');
    }
    public function logout(){
        Auth::guard('frontend')->logout();
        return redirect()->route('/')->with('success','You are logg off');
    }

    public function user_dashboard()
    {
        $data = [];
        if (isset($_COOKIE['redirect_after_payment']) && $_COOKIE['redirect_after_payment'] != "") {
                $link = $_COOKIE['redirect_after_payment'];
                $expire2 = time() - 900;
                setcookie('redirect_after_payment','', $expire2);
            if(!session()->has('error')){
                session()->flash('success', 'Amount added successfully to your wallet.Now complete your bet.');
                return Redirect::to($link);
            }
        }
        $user_id = Auth::guard('frontend')->user()->id;
        $data['model'] = UserMaster::find($user_id);

        $data['current'] = Event::select('events.*','bets.outcome_id','bets.amount','event_outcomes.outcome')
        ->join('bets','events.id','bets.event_id')->join('event_outcomes','bets.outcome_id','event_outcomes.id')
        ->where('events.status','1')->where('bets.status','0')->where('bets.user_id',$user_id)
        ->orderBy('events.deadline','ASC')->get();

        $data['past'] = Event::select('events.*','bets.outcome_id','bets.amount','event_outcomes.outcome','event_outcomes.id as oid')
        ->join('bets','events.id','bets.event_id')->join('event_outcomes','bets.outcome_id','event_outcomes.id')
        ->where('events.status','2')->where('bets.status','<>','0')->where('bets.user_id',$user_id)
        ->orderBy('events.deadline','DESC')->get();
        $data['bet'] = new Bet();
        return view('user.dashboard',$data);
    }

    public function account_settings()
    {
        $user = auth()->guard('frontend')->user();
        if ($user->type_id == '2') {
            return redirect()->route('client-account');
        }else{
            return redirect()->route('pro-account');
        }
    }

    public function pro_account_settings()
    {
        $data = [];
        $user = auth()->guard('frontend')->user();
        $data['skills'] = '';
        if (!empty($user->skills)) {
            $tags = explode(',',$user->skills);
            $arr = [];
            foreach($tags as $t)
            {
                $arr[] = Tag::find($t)->tag; 
            }
            $data['skills'] = implode(',',$arr);
        }
        $data['user'] = $user;
        return view('user.pro_account_elements',$data);
    }

    public function post_pro_account_setting(ProAccountSettingRequest $request)
    {
        if($request->ajax())
        {
            
            $response = [];
            $input = $request->except('AllImages');
            // dd($input);
            $tags = explode(',',$request->input('skills'));
            $input_tags = [];
            foreach($tags as $t)
            {
                $tag = Tag::where('status','<>','3')->where('tag',$t)->first();
                if (empty($tag)) {
                    $obj = new Tag();
                    $obj->tag = $t;
                    $obj->count = 1;
                    $obj->save();
                    $input_tags[] = $obj->id;
                }else{
                    $input_tags[] = $tag->id;
                }
            }
            $input['skills'] = implode(',',$input_tags);
            $images = $request->input('AllImages');
            $user_id = auth()->guard('frontend')->user()->id;
            $model = UserMaster::find($user_id);
            if (isset($images['image']) && $images['image'] !== NULL && !empty($model->id)) {
                // $images = $input['AllImages'];
                UserAsset::where('user_id',$model->id)->delete();
                foreach ($images['image'] AS $i => $image) {
                    $input1 = [];
                    $input1['user_id'] = $model->id;
                    $input1['name'] = $image;
                    $input1['status'] = '1';
                    $arr = explode('.',$image);
                    $input1['type'] = in_array($arr[1],['jpg','jpeg','png']) ? '1' : '2';
                    UserAsset::create($input1);
                }
            }
            // $input['name'] = $request->first_name.' '.$request->last_name;
            $input['updated_at'] = Carbon::now()->toDateTimeString();
            $model->update($input);
            $response['success'] = true;
            $response['message'] = 'Profile updated successfully.';
            return response()->json($response);
        }
    }

    public function upload_user_photo(Request $request)
    {
        if ($request->ajax()) {
           $file = $request->file('file');
           $mime = $file->getMimeType();
           $data_msg['file_name'] = $this->imageUpload($request, 'file');
           $data_msg['modelName'] = 'AllImages';
           $status = 200;
           return response()->json($data_msg, $status);
        }
    
    }

    function imageUpload(Request $request, $fname) {
        if ($request->hasFile($fname)) { //check the file present or not
            $image = $request->file($fname); //get the file
            $name = $this->rand_string(50) . time() . '.' . $image->getClientOriginalExtension(); //get the file extention
            $destinationPath = public_path('uploads/frontend/user_asset/'); //public path folder dir
            $image->move($destinationPath, $name);
            return $name;
        }
    }

    public function remove_user_photo(Request $request)
    {
        if ($request->ajax()) {
            $data_msg = [];
            $file_name = $request->input('file_name');
            if (!empty($file_name)) {
                $path = public_path('uploads/frontend/user_asset/' . $file_name);
                if (file_exists($path)) {
                    $file = UserAsset::where('name',$file_name)->first();
                    if (!empty($file)) {
                        $file->delete();
                    }
                    unlink($path);
                    $data_msg['status']="success";
                }   
            }
            return response()->json($data_msg);
        }  
    }

    public function showimages(Request $request) {
        if ($request->ajax()) {
            $data_msg = [];
            $images = [];
            $user_id = auth()->guard('frontend')->user()->id;
            $productImages = UserAsset::where('user_id', $user_id)->where('status', '1')->get();
            //print_r($productImages);exit;
            if (sizeof($productImages) > 0) {
                foreach ($productImages as $key => $image) {
                $images[$key]['name'] = $image->name;
                $targetFile = public_path('uploads/frontend/user_asset/' . $image->name);
                $images[$key]['size'] = filesize($targetFile);
                }
                $data_msg['res'] = 1;
                $data_msg['images'] = $images;
            }
            return response()->json($data_msg);
        }
    }

    public function update_msg_setting(Request $request)
    {
        if ($request->ajax()) {
            $response = [];
            $user = auth()->guard('frontend')->user();
            $user->message_setting = $request->setting;
            $user->save();
            $response['success'] = true;
            return response()->json($response);
        }
    }

}
