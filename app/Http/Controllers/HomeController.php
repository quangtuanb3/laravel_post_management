<?php

namespace App\Http\Controllers;

use App\Http\Services\PostService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * @var PostService
     */
    protected PostService $postService;

    /**
     * HomeController constructor.
     *
     * @param PostService $postService
     */
    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    /**
     * Display the index page.
     *
     * @return View
     */
    public function index(): View
    {
        $new_posts = $this->postService->getNewPosts();
        $mostViewPosts = $this->postService->getMostViewPosts();
        return view('home.welcome')->with('new_posts', $new_posts)->with('mostViewPosts', $mostViewPosts);
    }

    /**
     * Display the post detail page.
     *
     * @param int $id
     * @return View
     */
    public function show($id): View
    {
        $post = $this->postService->getById($id);

        // Increase view count if user is not the author or guest
        if (auth()->check() && auth()->id() !== $post->user_id) {
            $post->increment('view_number');
        } elseif (!auth()->check()) {
            $post->increment('view_number');
        }

        return view('home.detail')->with('post', $post);
    }
}
