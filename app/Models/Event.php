<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'events';
    // protected $fillable = ['title_dr','description','status','image','created_at','updated_at'];
    protected $guarded = ['id', 'created_at', 'updated_at'];
}
