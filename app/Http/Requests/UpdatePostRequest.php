<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePostRequest extends FormRequest
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
        return [
            'image' => 'required|string|max:255',
            'subject' => [
                'required',
                'string',
                'min:10',
                'max:500',
                Rule::unique('posts')->ignore($this->route('id')),
            ],
            'content' => 'required|string|min:10',
            'hashtags' => [
                'nullable',
                'regex:/^(#[a-zA-Z0-9]*)(, ?#[a-zA-Z0-9]*)*$/'
            ],
        ];
    }
    public function messages()
    {
        return [
            'hashtags.regex' => 'Hashtags must start with # and contain only alphanumeric characters, separated by commas.'
        ];
    }
}
