<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paymentdetail extends Model
{
    protected $table="payment_details";
    protected $fillable=["reference_id","user_id",'payment_gateway','total_amount','discount_amount','plan_id','pay_amount','currency','txn_id','chrage_id','refund_datetime','ip_address',"status","created_at","updated_at"];

    public function user() {
        return $this->belongsTo('App\Models\UserMaster','user_id','id');
    }
    public function classes(){
        return $this->belongsTo('App\Models\Classes','class_id','id');
    }
}
