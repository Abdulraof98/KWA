<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MessageConnection extends Model {

    protected $fillable = ['job_id','from_user_id', 'to_user_id', 'message', 'status', 'updated_by'];

    public function job()
    {
        return $this->belongsTo(Job::class, 'job_id','id');
    }

    public function from() {
        return $this->belongsTo('App\Models\UserMaster', 'from_user_id', 'id')->select('name', 'id', 'type_id', 'profile_picture');
    }

    public function to() {
        return $this->belongsTo('App\Models\UserMaster', 'to_user_id', 'id')->select('name', 'id', 'type_id', 'profile_picture');
    }

}
