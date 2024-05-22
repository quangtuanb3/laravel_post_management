<?php
return [
    'username' => [
        'required' => 'Tên đăng nhập là bắt buộc.',
        'string' => 'Tên đăng nhập phải là một chuỗi.',
        'max' => 'Tên đăng nhập không được vượt quá 255 ký tự.',
        'unique' => 'Tên đăng nhập đã được sử dụng.',
    ],
    'email' => [
        'required' => 'Email là bắt buộc.',
        'string' => 'Email phải là một chuỗi.',
        'email' => 'Email phải là một địa chỉ email hợp lệ.',
        'max' => 'Email không được vượt quá 255 ký tự.',
        'unique' => 'Email đã được sử dụng.',
    ],
    'password' => [
        'required' => 'Mật khẩu là bắt buộc.',
        'string' => 'Mật khẩu phải là một chuỗi.',
        'min' => 'Mật khẩu phải có ít nhất 8 ký tự.',
        'confirmed' => 'Xác nhận mật khẩu không khớp.',
    ],
    'current_password' => [
        'required' => 'Trường mật khẩu hiện tại là bắt buộc.',
        'current_password' => 'Mật khẩu hiện tại không chính xác.',
    ],
    'gender' => [
        'required' => 'Giới tính là bắt buộc.',
        'string' => 'Giới tính phải là một chuỗi.',
    ],
    'phone' => [
        'required' => 'Số điện thoại là bắt buộc.',
        'string' => 'Số điện thoại phải là một chuỗi.',
        'max' => 'Số điện thoại không được vượt quá 17 ký tự.',
        'regex' => 'Số điện thoại không hợp lệ.'
    ],
    'address' => [
        'required' => 'Địa chỉ là bắt buộc.',
        'string' => 'Địa chỉ phải là một chuỗi.',
        'max' => 'Địa chỉ không được vượt quá 255 ký tự.',
    ],
    'position_id' => [
        'required' => 'Vị trí là bắt buộc.',
        'exists' => 'Vị trí đã chọn không hợp lệ.',
    ],
];
