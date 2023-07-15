<?php

namespace App\Services;

use Illuminate\Support\Facades\Session;
use Anouar\Paypalpayment\Facades\PaypalPayment as Paypalpayment;
use Carbon\Carbon;
use Exception;
use Mail;
// ************ Request ************
use App\Http\Requests\PaymentRequest;
// ************ Models ************
use App\Models\UserMaster;
use App\Models\PaymentDetail;
use App\Models\Settings;
use App\Models\SubscriptionPlan;
use App\Models\Classes;

class Payments {

    protected $clientSecret;
    protected $clientId;

    public function __construct() {
        $paypal_client = Settings::where('slug', '=', 'PAYPAL_CLIENT_ID')->first();
        $paypal_client_secret = Settings::where('slug', '=', 'PAYPAL_CLIENT_SECRET')->first();
        $this->clientId = (isset($paypal_client->value) && $paypal_client->value != "") ? $paypal_client->value : "AVQZXty21E4WbVQpUPY8BrW5viTKdedDSscLSnbbbz-SLlUO0ym6St1f-uZ5jBqMjaYk1Lzbd1_oFWVE";
        $this->clientSecret = (isset($paypal_client_secret->value) && $paypal_client_secret->value != "") ? $paypal_client_secret->value : "EHoySBvwR0xUalZVAlzLtNZn0vt9eDpweOh7HuFxDvC6jTZmWcRucE3O1XybmrL6QpbTLteCZfiAoZfJ";
    }

    public function post_payment($request) {
        $data = [];
        $plan = SubscriptionPlan::findorFail(base64_decode($request->input('plan')));
        $plan_amount = number_format($plan->amount, 2);
        $card_number = str_replace(" ", "", $request->input('card_number'));
        $month=$request->input('month');
        $year=$request->input('year');
        $name = explode(" ", $request->input('full_name'));
        $data_arr = [
            'plan' => base64_decode($request->input('plan')),
            'plan_title' => (isset($plan->name) && !empty($plan->name)) ? $plan->name : 'Test',
            'amount' => $plan_amount,
            'cardType' => ($request->input('card_type') != "") ? strtolower($request->input('card_type')) : "visa",
            'first_Name' => trim($name[0]),
            'last_Name' => (isset($name[1]) && $name[1] != "") ? trim($name[1]) : "Test",
            'cardNumber' => $card_number,
            'cardExpiryYear' => trim($year),
            'cardExpiryMonth' => trim($month),
            'cardCVC' => $request->input('cvc'),
        ];
//        print_r($data_arr);exit;
        $response = $this->paywithCreditCard($data_arr);
        if ($response['type'] == 1) {
            $data['status'] = 200;
            $data['details'] = $response['msg'];
        } else {
            $data['status'] = 400;
            $data['msg'] = $response['msg'];
        }
        return $data;
    }

    /*
     * Process payment using credit card
     */

    private function paywithCreditCard($info) {

        // ### CreditCard
        $card = Paypalpayment::creditCard();
        $card->setType(strtolower(trim($info['cardType'])))
                ->setNumber(trim($info['cardNumber']))
                ->setExpireMonth(trim($info['cardExpiryMonth']))
                ->setExpireYear(trim($info['cardExpiryYear']))
                ->setCvv2(trim($info['cardCVC']))
                ->setFirstName(trim($info['first_Name']))
                ->setLastName(trim($info['last_Name']));

        $fi = Paypalpayment::fundingInstrument();
        $fi->setCreditCard($card);

        // ### Payer
        // A resource representing a Payer that funds a payment
        // Use the List of `FundingInstrument` and the Payment Method
        // as 'credit_card'
        $payer = Paypalpayment::payer();
        $payer->setPaymentMethod("credit_card")
                ->setFundingInstruments([$fi]);

        $item1 = Paypalpayment::item();
        $item1->setName($info['plan_title'])
                ->setDescription('Plan')
                // ->setCurrency('USD')
                ->setCurrency('USD')
                ->setQuantity(1)
                ->setTax(0.00)
                ->setPrice($info['amount']);


        $itemList = Paypalpayment::itemList();
        $itemList->setItems([$item1]);

        //Payment Amount
        $amount = Paypalpayment::amount();
        $amount->setCurrency("USD")
                // the total is $17.8 = (16 + 0.6) * 1 ( of quantity) + 1.2 ( of Shipping).
                ->setTotal($info['amount']);
//                ->setDetails($details);
        // ### Transaction
        // A transaction defines the contract of a
        // payment - what is the payment for and who
        // is fulfilling it. Transaction is created with
        // a `Payee` and `Amount` types

        $transaction = Paypalpayment::transaction();
        $transaction->setAmount($amount)
                ->setItemList($itemList)
                ->setDescription("Payment description")
                ->setInvoiceNumber(uniqid());
        // ### Payment
        // A Payment Resource; create one using
        // the above types and intent as 'sale'
        
        $payment = Paypalpayment::payment();

        $payment->setIntent("sale")
                ->setPayer($payer)
                ->setTransactions([$transaction]);
//        print_r($payment);exit;
//        print_r(Paypalpayment::apiContext());exit;
        try {
            // ### Create Payment
            // Create a payment by posting to the APIService
            // using a valid ApiContext
            // The return object contains the status;
            try {
                $response = $payment->create(Paypalpayment::apiContext());
                $data['msg'] = $response;
                $data['type'] = 1;
                return $data;
                exit();
            } catch (Exception $ex) {
                $data['type'] = 2;
                $data['msg'] = $ex->getMessage();
                return $data;
                exit();
            }
        } catch (\PayPal\Exception\PayPalConnectionException $ex) {
            $data['type'] = 2;
            $data['msg'] = $ex->getMessage();
            return $data;
            exit();
        } catch (Exception $ex) {

            $data['type'] = 2;
            $data['msg'] = $ex->getMessage();
            return $data;
            exit();
        }
    }
    
    public function post_express_payment($request)
    {
        $data = [];
        // $plan = SubscriptionPlan::findorFail($request->input('plan_id'));
        // $plan_amount = number_format($plan->amount, 2);
        // $plan_amount -=$request->discount ;
        // $data_arr = [
        //     'plan' => $request->input('plan_id'),
        //     'plan_title' => (isset($plan->name) && !empty($plan->name)) ? $plan->name : 'Test',
        //     'amount' => $plan_amount
        // ];
        $class_id=$request->input("class_id");
        $class=Classes::findOrFail($class_id);
        $class_fee = number_format($class->fee, 2);
        $data_arr = [
            'class_name' => $class->class_name_en,
            // 'plan_title' => (isset($plan->name) && !empty($plan->name)) ? $plan->name : 'Test',
            'amount' => $class_fee
        ];
        // dd($request->class_name_en);
        $response = $this->paywithPaypal($data_arr);
        if ($response['type'] == 1) {
            $data['status'] = 200;
            $data['link'] = $response['msg'];
        } else {
            $data['status'] = 400;
            $data['msg'] = $response['msg'];
        }
        return $data;
    }
    
    public function paywithPaypal($info)
    {
        // ### Payer
        // A resource representing a Payer that funds a payment
        // Use the List of `FundingInstrument` and the Payment Method
        // as 'credit_card'
        $payer = Paypalpayment::payer();
        $payer->setPaymentMethod("paypal");

        $item1 = Paypalpayment::item();
        $item1->setName($info['class_name'])
                // ->setDescription('class_name')
                ->setCurrency('USD')
                // ->setQuantity(1)
                ->setTax(0.00)
                ->setPrice($info['amount']);
        
        // $itemList = Paypalpayment::itemList();
        // $itemList->setItems([$item1]);

        //Payment Amount
        $amount = Paypalpayment::amount();
        $amount->setCurrency("USD")
                // the total is $17.8 = (16 + 0.6) * 1 ( of quantity) + 1.2 ( of Shipping).
                ->setTotal($info['amount']);

        // ### Transaction
        // A transaction defines the contract of a
        // payment - what is the payment for and who
        // is fulfilling it. Transaction is created with
        // a `Payee` and `Amount` types

        $transaction = Paypalpayment::transaction();
        $transaction->setAmount($amount)
            // ->setItemList($itemList)
            ->setDescription("Payment description")
            ->setInvoiceNumber(uniqid());

        // ### Payment
        // A Payment Resource; create one using
        // the above types and intent as 'sale'

        $redirectUrls = Paypalpayment::redirectUrls();
        $redirectUrls->setReturnUrl(url("/payments/success"))
            ->setCancelUrl(url("/payments/fails"));

        $payment = Paypalpayment::payment();

        $payment->setIntent("sale")
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions([$transaction]);

        try {
            // ### Create Payment
            // Create a payment by posting to the APIService
            // using a valid ApiContext
            // The return object contains the status;
            $payment->create(Paypalpayment::apiContext());
        //    print_r($payment->getApprovalLink());exit;
            $data['msg'] = $payment->getApprovalLink();
            $data['type'] = 1;
            return $data;
            exit();
        } catch (Exception $ex) {
            $data['type'] = 2;
            $data['msg'] = $ex->getMessage();
            return $data;
            exit();
        }
    }
    
    public function payment_execute($info)
    {
        $payment = Paypalpayment::getById($info['paymentId'], Paypalpayment::apiContext());
        $class_id = Session::get('class_id');
        $class = Classes::findorFail($class_id);
        $execution = Paypalpayment::PaymentExecution();
        $execution->setPayerId($info['PayerID']);
        
        $transaction = Paypalpayment::transaction();
        $amount = Paypalpayment::amount();
        $amount->setCurrency("USD")
                // the total is $17.8 = (16 + 0.6) * 1 ( of quantity) + 1.2 ( of Shipping).
                ->setTotal($class['fee']);
        $transaction->setAmount($amount);
        try {
            $result = $payment->execute($execution, Paypalpayment::apiContext());
            $data['msg'] = $payment;
            $data['status'] = 200;
            return $data;
            exit();
            try {
                $payment = Paypalpayment::getById($info['paymentId'], Paypalpayment::apiContext());
                $data['msg'] = $payment;
                $data['status'] = 200;
                return $data;
                exit();
            } catch (Exception $ex) {
                $data['status'] = 400;
                $data['msg'] = $ex->getMessage();
                return $data;
                exit();
            }
        } catch (Exception $ex) {
            $data['status'] = 400;
            $data['msg'] = $ex->getMessage();
            return $data;
            exit();
        }
    }
}
