<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubscriptionPlan extends Model {

    protected $table = 'subscription_plans';
    protected $fillable = ['amount','stripe_plan_id', 'stript_product_id','status'];
}