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

   
    public function rules(): mixed
    {
        return [
            'name' => 'required',
            'email' => ['required', 'email', 'unique:users,email', 'regex:/(.*)@(gmail|yahoo|hotmail)\.com/i'],
            'password' => 'required',
            'role' => 'required',
            'image' => 'mimes:jpg,jpeg,png|max:2048'
        ];
    }
    public function messages(): mixed
    {
        return [
            'name.required' => 'A Name is required',
            'email.required' => 'A Email is required',
            'email.email' => 'A Email Must be an Email Format',
            'email.unique' => 'The email already Exist',
            'email.regex' => 'We accept only gmail or yahoo or hotmail provided Email Address',
            'password.required' => 'Password is required',
            'role.required' => 'You Do not Assign any Role',
        ];
    }
}
