<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cms extends Model {

    public $timestamps = false;
    protected $table = 'cms';
    protected $guarded = ['created_at','updated_at'];

}
