<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Traits\HelperTrait;
use App\Models\UserMaster;
use App\Helpers\Subscription;
use Carbon\Carbon;
use Mail;
use DataTables;
use App\Models\Email;
use DB;
//Models
use App\Models\Paymentdetail;

class PaymentDetailsController extends Controller {
    protected $subscription;
    public function __construct() {
        // $this->subscription = new Subscription();
    }

    public function index(){
        $data=[];
        // $payment_details = Paymentdetail::select('payment_details.*', 'user_master.id as user_id', 'user_master.name as name', 'user_master.email as email','user_master.gender as gender','user_master.city as city','user_master.country as country', 'subscription_plans.name as subscription_name')
        // ->join('user_subscription', 'payment_details.reference_id', '=', 'user_subscription.reference_id')
        // ->join('user_master', 'payment_details.escort_id', '=', 'user_master.id')
        // ->join('subscription_plans', 'user_subscription.plan_id', '=', 'subscription_plans.id')
        // ->orderBy('id','DESC')->get();
        $data['payments'] = Paymentdetail::select('payment_details.*','user_master.id as user_id',
        'user_master.name as name',
        'user_master.email as email','user_master.gender as gender',
        'user_master.city as city',
        'user_master.country as country')
        ->join('user_master', 'payment_details.user_id', '=', 'user_master.id')->get();
        // dd( $payments->user_id);exit;
        return view('admin::payment_details.index1',$data);
    }


    public function payment_details_list(Request $request)
    {
        $payment_details = Paymentdetail::all();
        return Datatables::of($payment_details)
        ->addIndexColumn()
        ->editColumn('name', function ($model) {
        return $model->user->name;
        }) 
        ->editColumn('email', function ($model) {
        return $model->user->email;
        })
        // ->editColumn('city', function ($model) {
        //     return $model->city;
        // })
        // ->editColumn('country', function ($model) {
        //     return $model->country;
        // })
        ->editColumn('subscription', function ($model) {
        return $model->plan->name;
        })
        ->editColumn('status', function ($model) {
        return $model->status;
        })
        ->editColumn('created_at', function ($model) {
        return ($model->created_at);
        })
        ->filter(function ($instance) use ($request) {
            if ($request->get('status') == 'today'){
                $instance->where('payment_details.created_at', date('y-m-d'));
            }
            if ($request->get('status') == 'lastweek'){
                $today_date=Carbon::now();
                $back_days=Carbon::now()->subDays(7);
                $instance->whereBetween('payment_details.created_at', [$back_days,$today_date]);
            }
            if (!empty($request->get('country'))) {
                $instance->where('country',"like", "%".$request->get('country')."%");
            }
            if (!empty($request->get('city'))) {
                $instance->where('city',"like", "%".$request->get('city')."%");
            }
            if (!empty($request->get('plan'))) {
                if($request->get('plan')!="Free")
                {
                $instance->where('subscription_plans.name',$request->get('plan'));
                }else{
                    $instance->selectRaw("user_subscription.plan_id")->leftjoin('user_subscription', 'user_subscription.user_id', '=', 'user_master.id')

                    ->where('user_subscription.status', '=', '1')
                    ->whereDate('user_subscription.end_date', '>=', date("Y-m-d"))
                            ->whereNull('user_subscription.plan_id');
                }
            }

        })
        ->addColumn('action', function ($model) {
        $action_html = '<a href="' . Route('admin-payment-view', ['id' => $model->id]) . '" class="btn btn-outline btn-circle btn-sm purple" data-toggle="tooltip" title="View">'
             . '<i class="fa fa-eye"></i>'
             . '</a>'
            ;

        // $action_html="";
        return $action_html;
        })
        ->make(true);
    }


    public function payment_details_view($id)
    {
     $data=[];
    //  $data['payment_details']=Paymentdetail::join('user_subscription', 'payment_details.user_id', '=', 'user_subscription.user_id')
    //                         ->join('user_master', 'payment_details.user_id', '=', 'user_master.id')
    //                         ->join('subscription_plans', 'user_subscription.plan_id', '=', 'subscription_plans.id')
    //                         ->select('payment_details.*','user_subscription.*', 'user_master.id as user_id', 'user_master.name as name', 'user_master.email as email',
    //                                  'subscription_plans.name as subscription_name')
    //                         ->findOrFail($id);
    $data['payment_details']=Paymentdetail::findOrFail($id);
     return view('admin::payment_details.view',$data);
    }


}
