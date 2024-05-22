<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
            'subject' => 'required|string|min:10|max:500|unique:posts',
            'content' => 'required|string|min:10',
            'hashtags' => [
                'nullable',
                'regex:/^(#[a-zA-Z0-9]*)(, ?#[a-zA-Z0-9]*)*$/'
            ],
        ];
    }

        /**
     * Message return when errors
     * @return array<string, string>
     */
    public function messages()
    {
        return [
            'image.required' => __('validation-post.image.required'),
            'image.string' => __('validation-post.image.string'),
            'image.max' => __('validation-post.image.max'),
            'subject.required' => __('validation-post.subject.required'),
            'subject.string' => __('validation-post.subject.string'),
            'subject.min' => __('validation-post.subject.min'),
            'subject.max' => __('validation-post.subject.max'),
            'subject.unique' => __('validation-post.subject.unique'),
            'content.required' => __('validation-post.content.required'),
            'content.string' => __('validation-post.content.string'),
            'content.min' => __('validation-post.content.min'),
            'hashtags.regex' => __('validation-post.hashtags.regex'),
        ];
    }
}
