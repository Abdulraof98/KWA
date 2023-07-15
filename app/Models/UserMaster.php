<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;

class UserMaster extends Model implements Authenticatable {

    use \Illuminate\Auth\Authenticatable;

    protected $table = 'user_master';
    protected $fillable = ['type_id','name', 'first_name', 'last_name', 'password', 'email', 'phone','company_phone','alt_phone', 'other_number','about_me',
     'address_line1','address_line2','gender','city', 'state', 'country','zipcode','dob','profile_picture','resume',
     'remark','active_token','login_type', 'status', 'reset_password_token','is_plan_used','subscription_end',
     'popular_creator','popularity_date', 'created_by', 'updated_by','last_login','avaliable','working_area','working_trade',
     'company_email','website','company_name','reset_token_time','bio','skills','verified','insurance','references_verified',
     'address','company_type','balloon_id','facebook','instagram','linkedin','message_setting',
];
    
    // public function getId(){
    //     return $this->select('id')->first();
    // }


}
