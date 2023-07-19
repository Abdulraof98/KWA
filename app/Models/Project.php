<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model {

    // protected $table = 'select_forms';
    // protected $fillable = ['amount','stripe_plan_id', 'stript_product_id','status'];
    protected $guarded= ['id','created_at','updated_at'];

    public function user(){
        return $this->belongsTo(UserMaster::class,'created_by');
    }
}