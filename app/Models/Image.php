<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model {

   
    protected $guarded = ['id', 'created_at','updated_at'];
    public function userNameNById(){
    return $this->belongsTo('App\Models\UserMaster','updated_by','id');
    }
    public function user(){
        return $this->belongsTo('App\Models\UserMaster','updated_by','id');
        }
}