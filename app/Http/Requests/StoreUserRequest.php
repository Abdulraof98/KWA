<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\UserMaster;
class storeUserRequest extends FormRequest
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
            'first_name' => 'required',
            'gender' => 'required',
            'phone' => 'required',
            'position' => 'required',
            'status' => 'required',
            'email' => 'required|email|max:255',
            
        ];
    }
    public function withValidator($validator) {
        $validator->after(function ($validator) {
            $email = UserMaster::where('email',$this->email)->first();
            $name = UserMaster::where('first_name',$this->first_nama)->where('last_name',$this->last_name)->first();
            if ($email && !isset($this->update)) {
                    $validator->errors()->add('email', 'This email is already exits in system');
            }
            
        });
    }
}
