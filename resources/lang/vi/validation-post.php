<?php
return [
    'image' => [
        'required' => 'Hình ảnh là bắt buộc.',
        'string' => 'Hình ảnh phải là một chuỗi.',
        'max' => 'Hình ảnh không được vượt quá 255 ký tự.',
    ],
    'subject' => [
        'required' => 'Tiêu đề là bắt buộc.',
        'string' => 'Tiêu đề phải là một chuỗi.',
        'min' => 'Tiêu đề phải có ít nhất 10 ký tự.',
        'max' => 'Tiêu đề không được vượt quá 500 ký tự.',
        'unique' => 'Tiêu đề đã được sử dụng.',
    ],
    'content' => [
        'required' => 'Nội dung là bắt buộc.',
        'string' => 'Nội dung phải là một chuỗi.',
        'min' => 'Nội dung phải có ít nhất 10 ký tự.',
    ],
    'hashtags' => [
        'regex' => 'Định dạng thẻ hashtag không hợp lệ (ví dụ: #hot, $tech).',
    ],
    'file' => [
        'required' => 'Tệp là bắt buộc.',
        'image' => 'Tệp phải là hình ảnh.',
        'mimes' => 'Tệp phải có định dạng: jpeg, png, jpg, gif, svg.',
        'max' => 'Tệp không được lớn hơn 10 MB.',
    ],
];
