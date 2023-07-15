<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Charts;
use App\Models\UserMaster;
use App\Models\Subscriber;
use App\Models\Inquiry;


class DashboardController extends AdminController {

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index() {
        $data = [];
        $data['total_user']=UserMaster::where('type_id','<>','1')->where('status', '<>', '3')->get()->count();
        $data['total_client']=UserMaster::where('type_id','2')->where('status', '<>', '3')->get()->count();
        $data['total_active_user']=UserMaster::where('type_id','<>','1')->where('status','1')->get()->count();
        $data['total_active_client']=UserMaster::where('type_id','2')->where('status','1')->get()->count();
        $data['total_subscriber']=Subscriber::where('status','1')->get()->count();
        $data['total_inquiries']=Inquiry::where('status','<>','3')->get()->count();
       
        // $data['total_subscriber']=Subscriber::where('status','1')->count();
        return view('admin::dashboard.index', $data);
    }

}
