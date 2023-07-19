<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    protected $table = 'stories';
    // protected $fillable = ['title_dr','description','status','image','created_at','updated_at'];
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function user(){
        return $this->belongsTo(UserMaster::class,'created_by');
    }
}
