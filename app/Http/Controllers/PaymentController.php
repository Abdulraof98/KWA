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
// ************ Requests ************
// ************ models ************
use App\Models\UserSubscription;
use App\Models\SubscriptionPlan;
use App\Models\Paymentdetail;
use App\Models\Settings;
use App\Models\UserMaster;
use App\Models\Cupon;
use App\Models\CuponTrack;
use DB;
use App\Models\Classes;

class PaymentController extends Controller
{
    protected $subscription;
    public function __construct() {
        // $this->subscription = new Subscription();
        $paypal_client = Settings::where('slug', '=', 'PAYPAL_CLIENT_ID')->first();
        $paypal_client_secret = Settings::where('slug', '=', 'PAYPAL_CLIENT_SECRET')->first();
        Config::set('paypal_payment.account.client_id',(isset($paypal_client->value) && $paypal_client->value != "") ? $paypal_client->value : "ARwMQMvpe5VqNOd_9Lzl7ULVBce9x7Z9Fvga6ATflVggrKuK_PwtNEhVEz3nBje7p08j873F_f_rc94G");
        Config::set('paypal_payment.account.client_secret',(isset($paypal_client_secret->value) && $paypal_client_secret->value != "") ? $paypal_client_secret->value : "EG-hdUIZzFdUw404zsH-jbTqQB1kH60swU9V9-ale1TCG_xUxWkH5PDTkeQAL1RhTNeK2R2DZUDdX037");
    }

    public function my_subscription(Request $request)
   {
       $data=[];
       $user=Auth::guard('frontend')->user();
       $data['active_plan']=$this->subscription->check_subscription($user->id);
       $data['silver_plans']= SubscriptionPlan::Where('name','Silver')->get();
       $data['gold_plans']= SubscriptionPlan::Where('name','Gold')->get();
       $data['platinum_plans']= SubscriptionPlan::Where('name','Platinum')->get();
       return view('user.my_subscription',$data);
   }

//    public function check_plan_price(Request $request)
//    {
//        if($request->ajax())
//        {
//            $data=[];
//            $plan_id=$request->input("plan_id");
//            $plan=SubscriptionPlan::Where('id',$plan_id)->first();
//            $data['price']= number_format($plan->amount,2);
//            $data['intervel']= $plan->duration;
//            return response()->json($data);
//        }
//    }

   public function pay_subscription(Request $request,Payments $payment)
   {
       if($request->ajax())
       {
            $data=[];
            $discount = 0;
            $user=Auth::guard('frontend')->user();
            $class_id=$request->input("class_id");
            $class=Classes::findOrFail($class_id);
            // $plan=SubscriptionPlan::Where('id',$plan_id)->first();
            Session::put('class_id', $class_id);
            $store_card = $payment->post_express_payment($request);
            if (isset($store_card['status']) && $store_card['status'] == 200) {
                $data['msg'] = 'Agreement created successfully.Redireted to paypal page.';
                $data['link'] = $store_card['link'];
                $data['status'] = 200;
            } else {
                $data['msg'] = $store_card['msg'];
                $data['status'] = 400;
            }
           return response()->json($data);
       }
   }
   
// //    public function checkout($id)
// //    {
// //        $data=[];
// //        $data['plan']= SubscriptionPlan::find(base64_decode($id));
// //        return view('user.checkout',$data);
// //    }
   
// //    public function post_checkout(Request $request, Payments $payment) {
// //         $user_id=Auth::guard('frontend')->user()->id;
// //         $check_card = $this->check_card($request);
// //         if (isset($check_card['status']) && $check_card['status'] === 422) {
// //             $data['errors'] = $check_card['errors'];
// //         } else {
// //             $store_card = $payment->post_payment($request);
// //             if (isset($store_card['status']) && $store_card['status'] == 200) {
// //                 $payment_store = $this->store_payment_details($store_card, $user_id, $request);
// //                 if ($payment_store->status === 'completed') {
// //                     $data['msg'] = 'Your Subscription has been activated Successfully.';
// //                     $data['link'] = route('my-subscription');
// //                     $data['status'] = 200;
// //                 } else {
// //                     $data['status'] = 400;
// //                     $data['msg'] = 'Your payment is failed.';
// //                 }
// //             } else {
// // //                        $this->store_payment_details($store_card, $user_id);
// //                 $data['msg'] = $store_card['msg'];
// //                 $data['status'] = 400;
// //             }
// //         }
// //         return response()->json($data);
// //     }
    
//     public function check_card(Request $request) {
//         $data = [];
//         $validator = Validator::make($request->all(), [
//                     'card_type' => 'required',
//                     'full_name' => 'required',
//                     'card_number' => 'required',
//                     'month' => 'required',
//                     'year' => 'required',
//                     'cvc' => 'required',
//                     'plan' => 'required',
//         ]);
//         $validator->after(function($validator)use ($request) {
//             $card_number = str_replace(" ", "", $request->input('card_number'));
//             if (strlen($card_number) != 16) {
//                 $validator->errors()->add('card_number', 'Please give a prorper card number.');
//             }
//             $year = $request->input('year');
//             $month = $request->input('month');
//             if (strlen(trim($year)) !== 4) {
//                 $validator->errors()->add('year', 'Please give a proper year.');
//             }
//             if (strlen($month) != 2) {
//                 $validator->errors()->add('month', 'Please give a proper month.');
//             }
//             if (strlen($request->input('cvc')) < 3) {
//                 $validator->errors()->add('cvc', 'Please give a proper cvc.');
//             }
//             if($request->input('card_type')=="")
//             {
//                 $validator->errors()->add('card_number', 'Invalid card number.');
//             }
//         });
//         if ($validator->fails()) {
//             $data['errors'] = $validator->errors()->getMessages();
//             $data['status'] = 422;
//         } else {
//             $data['status'] = 200;
//         }
//         return $data;
//     }
    
    private function store_payment_details($user_id, $request) {
        
        $plan = SubscriptionPlan::findorFail($request->plan_id);
        $random_number= $this->rand_number(10);
        $get_last_data= Paymentdetail::orderBy('id', 'desc')->first();
        if(empty($get_last_data))
        {
            $input['reference_id'] = "OD".$random_number."0";
        }else{
            $input['reference_id'] = "OD".$random_number.$get_last_data->id;
        }
        $input['escort_id'] = $user_id;
        $user = UserMaster::where('id', $user_id)->first();
        $input['payment_gateway'] = "Paypal";
        $input['payment_for'] = (($plan->name=="Silver")?"0":(($plan->name=="Gold")?"1":"2"));
        $amount = number_format($plan->amount, 2);
        $input['total_amount'] = $plan->amount;
        $input['currency'] = "usd";
        
        $input['discount_amount'] =$request->discount;
        $input['pay_amount'] = $request->discount-$amount;
        $input['ip_address'] = request()->ip();
        $input['status'] = '1';
        $flag = 1;
        $payment = Paymentdetail::create($input);

        if ($flag == 1) {

            if(session()->has('cupon'))
            {
                $input2 = [];
                $cup = session()->get('cupon');
                $input2['user_id'] = $user_id;
                $input2['cupon_id'] = $cup;
                $input2['ip_address'] = request()->ip();
                CuponTrack::create($input2);
                $cupon = Cupon::find($cup);
                $cupon->count += 1;
                $cupon->status = '2';
                $cupon->save();
                session()->forget('cupon');
            }

            $previous_plan= UserSubscription::where("user_id",$user->id)->where("status","1")->first();
            if(!empty($previous_plan))
            {
                 $previous_plan->status="2";
                 $previous_plan->save();
            }
            UserSubscription::create([
                    'user_id'		=>	$user->id,
                    'reference_id'		=>	$payment->reference_id,
                    'plan_id'		=>	$plan->id,
                    'amount'		=>	$plan->amount,
                    'start_date'		=>	date("Y-m-d"),
                    'end_date'		=>	date('Y-m-d', strtotime(date("Y-m-d", time()) . " + ".$plan->interval_day." day")),
                    'status'		=>	"1"
            ]);
        //Mail::to($user->email)->send(new NewAdvisorCreateMail($user));
        //$link = '<a href="' . Route('active-account', ['id' => base64_encode($user->id), 'token' => $user->active_token]) . '" style="text-decoration: none;">Click here</a>';
        //$email_setting = $this->get_email_data('user_registration', array('NAME' => $user->first_name, 'LINK' => $link));
//            $email_setting = $this->get_email_data('user_registration', array('NAME' => $user->first_name));
//            $email_data = [
//                'to' => $user->email,
//                'subject' => $email_setting['subject'],
//                'template' => 'signup',
//                'data' => ['message' => $email_setting['body']]
//            ];
//            $this->SendMail($email_data);
        }
        return $payment;
    }
    
    public function payments($status,Payments $payment)
    {
        if($status=="success")
        {
            $data_arr = [
                'paymentId' => $_GET['paymentId'],
                'PayerID' => $_GET['PayerID'],
            ];
            $resp=$payment->payment_execute($data_arr);
//            echo "<pre>";
        //    print_r($resp);exit;
            $user_id=Auth::guard('frontend')->user()->id;
            $class_id = Session::get('class_id');
            $input = $resp;
            $class = Classes::findorFail($class_id);
            $details = $resp['msg'];
            $random_number= $this->rand_number(10);
            $get_last_data= Paymentdetail::orderBy('id', 'desc')->first();
            // if(empty($get_last_data))
            // {
            //     $input['reference_id'] = "OD".$random_number."0";
            // }else{
            //     $input['reference_id'] = "OD".$random_number.$get_last_data->id;
            // }
            $input['user_id'] = $user_id;
            $user = UserMaster::where('id', $user_id)->first();
            $input['payment_gateway'] = "Paypal";
            $input['class_id'] = $class->id;
            // $input['payment_for'] = (($plan->name=="Silver")?"0":(($plan->name=="Gold")?"1":"2"));
            $amount = number_format($details->transactions[0]->amount->total, 2);
            $input['total_amount'] = $class->fee;
            $input['currency'] = $details->transactions[0]->amount->currency;
            $relatedResources = $details->transactions[0]->getRelatedResources();
            $sale = $relatedResources[0]->getSale();
            $input['txn_id'] = ($sale->getId() !== NULL) ? $sale->getId() : NULL;
            $input['pay_amount'] = $amount;
            // $input['discount_amount'] =$plan->amount - $amount;
            $input['chrage_id'] = $details->id;
            $input['ip_address'] = request()->ip();
            if (isset($details->status) && $details->status == 'succeeded') {
                $input['status'] = '1';
                $flag = 1;
            } else if (isset($details->state) && $details->state == 'approved') {
                $input['status'] = '1';
                $flag = 1;
            } else {
                $input['status'] = '2';
                $flag = 0;
            }
            $payment = Paymentdetail::create($input);

            if ($flag == 1) {
                
                // $user->wallet += $plan->coins;
                // $user->save();
            //     $previous_plan= UserSubscription::where("user_id",$user->id)->where("status","1")->first();
            //     if(!empty($previous_plan))
            //     {
            //          $previous_plan->status="2";
            //          $previous_plan->save();
            //     }
            //     UserSubscription::create([
            //             'user_id'		=>	$user->id,
            //             'reference_id'		=>	$payment->reference_id,
            //             'plan_id'		=>	$plan->id,
            //             'amount'		=>	$plan->amount,
            //             'start_date'		=>	date("Y-m-d"),
            //             'end_date'		=>	date('Y-m-d', strtotime(date("Y-m-d", time()) . " + ".$plan->interval_day." day")),
            //             'status'		=>	"1"
            //     ]);
            //     Session::forget('plan_id');
            //     return redirect('my-subscription')->with('success', 'Your Subscription has been activated Successfully.');
                //Mail::to($user->email)->send(new NewAdvisorCreateMail($user));
                //$link = '<a href="' . Route('active-account', ['id' => base64_encode($user->id), 'token' => $user->active_token]) . '" style="text-decoration: none;">Click here</a>';
                //$email_setting = $this->get_email_data('user_registration', array('NAME' => $user->first_name, 'LINK' => $link));
    //            $email_setting = $this->get_email_data('user_registration', array('NAME' => $user->first_name));
    //            $email_data = [
    //                'to' => $user->email,
    //                'subject' => $email_setting['subject'],
    //                'template' => 'signup',
    //                'data' => ['message' => $email_setting['body']]
    //            ];
    //            $this->SendMail($email_data);
            return redirect('/')->with('success', 'Payment succesfull!.');
            }
        }else{
        //     Session::forget('plan_id');
            return redirect('/')->with('error', 'Something error.Please try again.');
        }
    }
}
