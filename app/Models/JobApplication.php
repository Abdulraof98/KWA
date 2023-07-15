<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    use HasFactory;
    protected $table = 'job_applications';
    protected $fillable = ['job_id','user_id','date','cover_letter','past_works','quote_price',
    'application_status','status','new','created_at','updated_at'];

    public function job()
    {
        return $this->belongsTo(Job::class, 'job_id','id');
    }

    public function user()
    {
        return $this->belongsTo(UserMaster::class, 'user_id','id');
    }

    public function job_application_count($job_id)
    {
        $new_applications = $this->where(['job_id'=>$job_id, 'status'=>'1', 'application_status'=>'0'])->where('new','1')->count();
        $applications = $this->where(['job_id'=>$job_id, 'status'=>'1', 'application_status'=>'0'])->count();
        return [
            'new'=>$new_applications,
            'all'=>$applications
        ];
    }
    public function check_if_applied($job_id, $user=null){
        $user_id = empty($user) ? auth()->guard('frontend')->user()->id : $user ;
        $check = $this->where(['job_id'=>$job_id, 'user_id'=>$user_id])->where('status','<>','3')->first();
       if(!empty($check)){
           return true;
       }else{
           return false;
       }
    }
}
