<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Student;

class StoreStudentRequest extends FormRequest
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
            'name' => 'required',
            'study_level' => 'required',
            'islamic_level' => 'required',
            // 'dob' => 'required',
            'course' => 'required',
            // 'country' => 'required',
            // 'city' => 'required',
            // 'afg_class_time' => 'required',
            'class_type' => 'required',
            'phone_no' => 'required',
            'email' => 'required|email',
            'photo' => 'image|mimes:jpeg,jpg,png',
            'tazkira' => 'image|mimes:jpeg,jpg,png',
            
        ];
    }
    // public function withValidator($validator) {
    //     $validator->after(function ($validator) {
    //         // $email = Student::where('email',$this->email)->first();
    //         // $name = Student::where('name',$this->name)->where('surname ',$this->surname)->first();
            
    //         if($name){
    //                 $validator->errors()->add('name', 'This name is already exits in system');
    //         }
    //     });
    // }
}
