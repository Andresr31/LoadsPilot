<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        if($this->method()=='PUT'){
            // Edit form
            return[
                'fullname'  => 'required',
                'email'     => 'required|email|unique:users,email,'.$this->id,
                'role_id'   => 'required',
                'password'  => 'required|min:6'
            ];
        }else{
            // Create Form
            return[
                'fullname'  => 'required',
                'email'     => 'required|email|unique:users',
                'role_id'   => 'required',
                'password'  => 'required|min:6'

            ];
        }
    }
}
