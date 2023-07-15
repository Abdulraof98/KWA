<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAsset extends Model
{
    use HasFactory;
    protected $table = 'user_asset';
    protected $fillable = ['user_id','name','type','created_at','updated_at'];
}