<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model {

    protected $fillable = ['connection_id', 'from_user_id', 'to_user_id', 'message_type', 'message','tip_amount', 'file_name', 'file_type', 'is_read','is_approved'];

    public function from() {
        return $this->belongsTo('App\Models\UserMaster', 'from_user_id', 'id')->select('name', 'id', 'type_id', 'profile_picture');
    }

    public function to() {
        return $this->belongsTo('App\Models\UserMaster', 'to_user_id', 'id')->select('name', 'id', 'type_id', 'profile_picture');
    }

}
