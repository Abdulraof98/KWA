<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','assigned_to','title','category','description','tags','location','date','size','length','skill_level',
        'question','budget','status','viewed_by','discarded_by','created_at','updated_at'
    ];

    public function cat()
    {
        return $this->belongsTo(Category::class,'category','id');
    }

    public function user()
    {
        return $this->belongsTo(UserMaster::class,'user_id','id');
    }
    
    public function profes()
    {
        return $this->belongsTo(UserMaster::class,'assigned_to','id');
    }

    public function offers()
    {
        $query = $this->hasMany(JobApplication::class,'job_id','id')->where(['status'=>'1', 'application_status'=>'0']);
        if (isset($_GET['sort'])) {
            $sort = $_GET['sort'];
            $type = 'asc';
            if (isset($_GET['type'])) {
                $type = $_GET['type'];
            }
            $data['filter'] = $sort;
            $data['type'] = $type;
            $jobs = $query->groupBy('id')->orderBy($sort,$type);
        }
        return $query;
    }
}
