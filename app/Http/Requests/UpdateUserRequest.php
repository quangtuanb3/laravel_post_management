<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $userId = $this->user() ? $this->user()->id : null;
        return [
            'id' => [
                'required',
                Rule::exists('users')->where(function ($query) use ($userId) {
                    $query->where('id', $userId);
                }),
            ],
            'username' => [
                'required',
                'string',
                'max:255',
                Rule::unique('users')->ignore($userId),
            ],
            // 'id' => 'required',
            'current_password' => [
                'required',
                'current_password',
            ],
            'gender' => 'required|string',
            'phone' => 'required|string|max:17|regex:/^\+?[0-9]{1,4}?[-.\s]?(\(?\d{1,3}?\)?[-.\s]?){1,4}\d{1,4}[-.\s]?\d{1,9}$/',
            'address' => 'required|string|max:255',
            'position_id' => 'required|exists:positions,id',
            'avatar' => 'nullable|string|max:255'
        ];
    }

    /**
     * Message return when errors
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            // English messages
            'id.required' => __('validation-user.id.required'),
            'id.exists' => __('validation-user.id.exists'),
            'username.required' => __('validation-user.username.required'),
            'username.string' => __('validation-user.username.string'),
            'username.max' => __('validation-user.username.max'),
            'username.unique' => __('validation-user.username.unique'),
            'current_password.required' => __('validation-user.current_password.required'),
            'current_password.current_password' => __('validation-user.current_password.current_password'),
            'gender.required' => __('validation-user.gender.required'),
            'gender.string' => __('validation-user.gender.string'),
            'phone.required' => __('validation-user.phone.required'),
            'phone.regex' => __('validation-user.phone.regex'),
            'phone.string' => __('validation-user.phone.string'),
            'phone.max' => __('validation-user.phone.max'),
            'address.required' => __('validation-user.address.required'),
            'address.string' => __('validation-user.address.string'),
            'address.max' => __('validation-user.address.max'),
            'position_id.required' => __('validation-user.position_id.required'),
            'position_id.exists' => __('validation-user.position_id.exists'),
            'avatar.nullable' => __('validation-user.avatar.nullable'),
            'avatar.string' => __('validation-user.avatar.string'),
            'avatar.max' => __('validation-user.avatar.max'),
        ];
    }
}
