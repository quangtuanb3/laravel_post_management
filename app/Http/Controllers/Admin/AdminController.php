<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\PostService;

class AdminController extends Controller
{
    /**
     * @var PostService
     */
    public PostService $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    /**
     * Display the admin dashboard.
     *
     * @return string
     */
    public function dashboard(): string
    {
        return "Admin Dashboard";
    }

    /**
     * Display the admin profile.
     *
     * @return string
     */
    public function profile(): string
    {
        return "Admin Profile";
    }
}
