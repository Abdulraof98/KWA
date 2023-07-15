<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Validator;
use Stripe\Stripe;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManagerStatic as Image;
use App\Models\Mf_plan;
use App\Models\SubscriptionPlan;
use App\Models\Settings;
use Yajra\Datatables\Datatables;

class SubplanController extends AdminController {

    /**
     * Display a listing of the resource.
     * @return Response
     */
    protected $stripe_secret;

    public function __construct() {
        $stripeSecret = Settings::select('value')->where(['slug' => 'stripe_secret'])->first();
        $this->stripe_secret = (isset($stripeSecret->value) && !empty($stripeSecret->value)) ? $stripeSecret->value : 'sk_test_KvZ9UQCw3u3CW01ReuQxl95k00Wr9xNOyK';
    }
    
    public function index() {
        $data = [];
        return view('admin::sub_plan.index');
    }

    public function get_subplans_list_datatable() {
        $plan_list = SubscriptionPlan::where('status', '<>', '3');
        return Datatables::of($plan_list)
                        ->editColumn('id', function ($model) {
                            return $model->id;
                        })
                        ->editColumn('name', function ($model) {
                            return $model->name;
                        })
                        ->editColumn('amount', function ($model) {
                            return $model->amount;
                        })
                        ->editColumn('interval', function ($model) {
                            return ucwords($model->interval);
                        })
                        ->editColumn('created_at', function ($model) {
                            return date("Y-m-d H:i:s", strtotime($model->created_at));
                        })
                        ->editColumn('status', function ($model) {
                            return $model->status;
                        })
                        ->addColumn('action', function ($model) {
                            $action_html = '<a href="' . Route('admin-updatesubplan', ['id' => $model->id]) . '" class="btn btn-outline btn-circle btn-sm purple" data-toggle="tooltip" title="Edit">'
                                    . '<i class="fa fa-edit"></i>'
                                    . '</a>';
                            return $action_html;
                        })
                        ->make(true);
    }

    
    public function get_update(Request $request, $id) {
        $data = [];
        // $data['mfplan'] = Mf_plan::where('status', '1')->get();
        $data['model'] = $model = SubscriptionPlan::findOrFail($id);
        if (!empty($model) && $model->status != '3') {
//            $data['all_country'] = MetaLocation::where('type', '=', "CO")->where('Status', '=', '1')->orderBy('local_name', 'ASC')->get();
            return view('admin::sub_plan.update', $data);
        } else {
            $request->session()->flash('danger', 'Oops. Something went wrong.');
            return redirect()->route('admin-subplans');
        }
    }

    public function post_update(Request $request, $id) {
        $data = [];
        $model = SubscriptionPlan::findOrFail($id);
        $validator = Validator::make($request->all(), [
                    'amount' => 'required',
                    'stripe_plan_id' => 'required',
                    'stript_product_id' => 'required',
        ]);
        if ($validator->passes()) {
            $input = $request->input();
            // $amount=$request->input('amount');
            /* \Stripe\Stripe::setApiKey($this->stripe_secret);
             $plans = \Stripe\Plan::update($model->stripe_plan_id,[
                 'amount' => $amount*10,
                 'amount_decimal'=>$amount*10
                 ]); */
            
            // $stripe = new \Stripe\StripeClient($this->stripe_secret);

            // $stripe->plans->retrieve(
            //     'price_1KM8Q82eZvKYlo2Ck930tNKO',
            //   );
            
            //OR
            // $ch = curl_init();

            // curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/plans/'.$request->stripe_plan_id);
            // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

            // curl_setopt($ch, CURLOPT_USERPWD, $this->stripe_secret . ':' . '');

            // $result = curl_exec($ch);
            // if (curl_errno($ch)) {
            //     echo 'Error:' . curl_error($ch);
            // }
            // curl_close($ch);
            //  echo "<pre>";
            //  print_r($result->items->data[0]->plan->id);
            //  print_r(json_decode($result));exit;
            // $result = json_decode($result);
             
            // $input=[];
            // $input['stripe_plan_id']=$result->id;
            // $input['stript_product_id']=$result->product;
            // $input['amount']=$result->amount/100;
            // $input['currency']=$result->currency;
            // $input['interval']=$result->interval;
            // $input['status']=$result->active;
            // $input['trial_period_days']=$result->trial_period_days;
            // $input['created_at']=date("Y-m-d H:i:s", strtotime($result->created));
            $model->update($input);
            $request->session()->flash('success', 'Subscription Plan updated successfully.');
            return redirect()->route('admin-subplans');
        }
        return redirect()->route('admin-updatesubplan', ['id' => $id])->withErrors($validator)->withInput();
    }

    

 
}
