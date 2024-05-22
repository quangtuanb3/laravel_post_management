<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Services\HashTagService;
use App\Http\Services\PostService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class PostController extends Controller
{
    public PostService $postService;
    public HashTagService $hashtagService;

    public function __construct(PostService $postService, HashTagService  $hashtagService)
    {
        $this->postService = $postService;
        $this->hashtagService = $hashtagService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(): View
    {
        $posts = $this->postService->get();
        return view('admin.posts')->with('posts', $posts);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $postId
     * @return \Illuminate\Contracts\View\View
     */
    public function show($postId): View
    {
        $post = $this->postService->getById($postId);
        return view('admin.detail')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id): View
    {
        $post = $this->postService->getById($id);
        return view('admin.edit')->with('post', $post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdatePostRequest $request, $id): RedirectResponse
    {
        $validatedData = $request->validated();
        $this->postService->update($validatedData, $id);
        return redirect()->route('admin.post.show', $id)->with('success', __('messages.update_post_success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        $this->postService->destroy($id);
        return redirect()->route('admin.post.index', ['author' => 'all'])->with('success', __('messages.delete_post_success'));
    }
}
