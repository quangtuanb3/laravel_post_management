<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // Set to true to allow all users to make this request
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'gender' => 'required|string',
            'phone' => 'required|string|max:17|regex:/^\+?[0-9]{1,4}?[-.\s]?(\(?\d{1,3}?\)?[-.\s]?){1,4}\d{1,4}[-.\s]?\d{1,9}$/',
            'address' => 'required|string|max:255',
            'position_id' => 'required|exists:positions,id',
        ];
    }
    
    /**
     * Message return when errors
     * @return array<string, string>
     */
    public function messages()
    {
        return [
            'username.required' => __('validation-user.username.required'),
            'username.string' => __('validation-user.username.string'),
            'username.max' => __('validation-user.username.max'),
            'username.unique' => __('validation-user.username.unique'),
            'email.required' => __('validation-user.email.required'),
            'email.string' => __('validation-user.email.string'),
            'email.email' => __('validation-user.email.email'),
            'email.max' => __('validation-user.email.max'),
            'email.unique' => __('validation-user.email.unique'),
            'password.required' => __('validation-user.password.required'),
            'password.string' => __('validation-user.password.string'),
            'password.min' => __('validation-user.password.min'),
            'password.confirmed' => __('validation-user.password.confirmed'),
            'gender.required' => __('validation-user.gender.required'),
            'gender.string' => __('validation-user.gender.string'),
            'phone.required' => __('validation-user.phone.required'),
            'phone.string' => __('validation-user.phone.string'),
            'phone.regex' => __('validation-user.phone.regex'),
            'phone.max' => __('validation-user.phone.max'),
            'address.required' => __('validation-user.address.required'),
            'address.string' => __('validation-user.address.string'),
            'address.max' => __('validation-user.address.max'),
            'position_id.required' => __('validation-user.position_id.required'),
            'position_id.exists' => __('validation-user.position_id.exists'),
        ];
    }
}
