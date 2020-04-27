<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'First_Name' => 'required',
            'Last_Name' => 'required',
            'Date_of_Birth' => 'required',
            'Gender' => 'required',
            'Address' => 'required',
            'Town' => 'required',
            'Country' => 'required',
            'Phone_Number' => 'required',
            'Email' => 'required | email | unique:users',
            'Username' => 'required | unique:users',
            'Password' => 'required',
            'Is_Tutor' => 'required'
        ];
    }
}
