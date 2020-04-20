<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'name'=>'required',
            'email'=>'required|email|unique:users,email',
            'date_of_birth'=>'required',
            'phone_number'=>'required',
            'address'=>'required',
            'role_id'=>'required',
            'daily_rate'=>'required',
            'monthly_rate'=>'required',
        ];
    }
}
