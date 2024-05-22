<?php
return [
    'image' => [
        'required' => 'The image is required.',
        'string' => 'The image must be a string.',
        'max' => 'The image must not exceed 255 characters.',
    ],
    'subject' => [
        'required' => 'The subject is required.',
        'string' => 'The subject must be a string.',
        'min' => 'The subject must be at least 10 characters.',
        'max' => 'The subject must not exceed 500 characters.',
        'unique' => 'The subject has already been taken.',
    ],
    'content' => [
        'required' => 'The content is required.',
        'string' => 'The content must be a string.',
        'min' => 'The content must be at least 10 characters.',
    ],
    'hashtags' => [
        'regex' => 'The hashtags format is invalid (ex: #hot, $tech).',
    ],
    'file' => [
        'required' => 'The file is required.',
        'image' => 'The file must be an image.',
        'mimes' => 'The file must be a type of: jpeg, png, jpg, gif, svg.',
        'max' => 'The file may not be greater than 10 MB.',
    ],
];
