<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $table = 'favorites';
    protected $fillable = ['user_id','challenge_id','image_id','status','created_at','updated_at'];

    public function user() {
        return $this->belongsTo('App\Models\UserMaster', 'user_id');
    }

    public function challenge() {
        return $this->belongsTo('App\Models\Challenge', 'challenge_id');
    }

    public function check_favorite($cid,$user_id){
        $resp = $this->where('user_id',$user_id)->where('challenge_id',$cid)->where('status','1')->first();
        if (!empty($resp)) {
            return true;
        } else {
            return false;
        }
    }
    
    public function check_favorite_image($image_id,$user_id){
        $check = $this->where('user_id',$user_id)->where('image_id',$image_id)->where('status','1')->get();
        if (count($check)) {
            return true;
        }else{
            return false;
        }
    }
}
