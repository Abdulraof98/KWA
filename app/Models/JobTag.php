<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobTag extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'job_tags';
    protected $fillable = ['job_id','tag_id'];
}
