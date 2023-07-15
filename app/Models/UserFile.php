<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserFile extends Model
{
    use HasFactory;
    protected $table = 'user_files';
    protected $fillable = ['name','file_name','type','status','created_at','updated_at'];
}
