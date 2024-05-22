<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Services\HashTagService;
use App\Http\Services\PostService;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
    /**
     * @var PostService
     */
    public $postService;

    /**
     * @var HashTagService
     */
    public $hashtagService;

    /**
     * UserController constructor.
     *
     * @param PostService $postService
     * @param HashTagService $hashtagService
     */
    public function __construct(PostService $postService, HashTagService $hashtagService)
    {
        $this->postService = $postService;
        $this->hashtagService = $hashtagService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Request $request): \Illuminate\Contracts\View\View
    {
        $page =  $request->query('page') ?? 1;
        $author = $request->query('author');
        $positions = Position::pluck('name', 'id')->toArray();
        Session::put('positions', $positions);
        $posts = $this->postService->get($author, $page);
        return view('user.posts')->with('posts', $posts);
    }

    /**
     * Display the specified resource.
     *
     * @param int $postId
     * @return \Illuminate\Contracts\View\View
     */
    public function show($postId): \Illuminate\Contracts\View\View
    {
        $post = $this->postService->getById($postId);
        $user = auth()->user();
        if ($user && $user->id !== $post->user_id) {
            $post->view_number++;
            $post->save();
        }
        return view('user.detail')->with('post', $post);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create(): \Illuminate\Contracts\View\View
    {
        $hashtags = $this->hashtagService->getAll();
        return view('user.add')->with('hashtags', $hashtags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StorePostRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StorePostRequest $request): \Illuminate\Http\RedirectResponse
    {
        $validatedData = $request->validated();

        $this->postService->create($validatedData);
        $userId = auth()->user() ? auth()->user()->id : null;
        return redirect()->route('user.post.index', ['author' =>  $userId])->with('success', __('messages.create_post_success'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|null
     */
    public function edit($id)
    {

        $post = $this->postService->getById($id);
        $userId = auth()->user() ? auth()->user()->id : null;
        if ($userId != $post->user_id) {
            return null;
        }

        return view('user.edit')->with('post', $post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdatePostRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdatePostRequest $request, $id): \Illuminate\Http\RedirectResponse
    {
        $validatedData = $request->validated();
        $this->postService->update($validatedData, $id);
        return redirect()->route('user.post.show', $id)->with('success', __('messages.update_post_success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id): \Illuminate\Http\RedirectResponse
    {
        $userId = auth()->user() ? auth()->user()->id : null;
        $this->postService->destroy($id);
        return redirect()->route('user.post.index', ['author' => $userId])->with('success', __('messages.delete_post_success'));
    }
}
