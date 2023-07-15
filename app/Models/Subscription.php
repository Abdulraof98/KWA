<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model {

    protected $table = 'user_subscription';
    protected $fillable = ['user_id','plan_id','stripe_subscription_id','current_period_end','current_period_start','stripe_customer_id','subscription_status','trial_end','trial_start','response','status','updated_at','canceled_at','created_at'];
    
    public function plan(){
        return $this->belongsTo('App\Models\SubscriptionPlan', 'plan_id', 'id');
    }
}