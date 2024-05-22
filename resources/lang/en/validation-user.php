<?php
return [
    'username' => [
        'required' => 'The username is required.',
        'string' => 'The username must be a string.',
        'max' => 'The username must not exceed 255 characters.',
        'unique' => 'The username has already been taken.',
    ],
    'email' => [
        'required' => 'The email is required.',
        'string' => 'The email must be a string.',
        'email' => 'The email must be a valid email address.',
        'max' => 'The email must not exceed 255 characters.',
        'unique' => 'The email has already been taken.',
    ],
    'password' => [
        'required' => 'The password is required.',
        'string' => 'The password must be a string.',
        'min' => 'The password must be at least 8 characters.',
        'confirmed' => 'The password confirmation does not match.',
    ],
    'current_password' => [
        'required' => 'The current password field is required.',
        'current_password' => 'The current password is incorrect.',
    ],
    'gender' => [
        'required' => 'The gender is required.',
        'string' => 'The gender must be a string.',
    ],
    'phone' => [
        'required' => 'The phone number is required.',
        'string' => 'The phone number must be a string.',
        'max' => 'The phone number must not exceed 17 characters.',
        'regex' => 'Invalid phone format'
    ],
    'address' => [
        'required' => 'The address is required.',
        'string' => 'The address must be a string.',
        'max' => 'The address must not exceed 255 characters.',
    ],
    'position_id' => [
        'required' => 'The position is required.',
        'exists' => 'The selected position is invalid.',
    ],
];
