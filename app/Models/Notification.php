<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = 'notifications';
    protected $fillable = ['notifier_id','user_id','challenge_id','message','link','type','status','view','created_at','updated_at'];

    public function user(){
        return $this->belongsTo('App\Models\UserMaster','notifier_id','id');
    }

    public function challenge(){
        return $this->belongsTo('App\Models\Challenge','challenge_id','id');
    }
}
