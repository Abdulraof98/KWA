<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\UserMaster;

class SignupRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username'=>'required|max:120',
            //  'first_name' => 'required|max:100',
            //  'last_name' => 'required|max:100',
            'email' => 'required|email|max:255',
            'password' => 'required|min:6',
            'password_confirmation' => 'required|same:password',
//            'terms_and_conditions' => 'required',
        ];
    }
    public function withValidator($validator) {
        $validator->after(function ($validator) {			
            // $model = UserMaster::where('email', '=', $this->email)->where('login_type','3')->where('status','<>','3')->first();
            $model = UserMaster::where('email', '=', $this->email)->where('status','<>','3')->first();
            if (!empty($model)) {
                $validator->errors()->add('email', "This Email is already use.");
            }
        });
    }
}
