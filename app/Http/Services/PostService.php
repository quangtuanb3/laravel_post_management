<?php

namespace App\Http\Services;

use App\Models\Hashtag;
use App\Models\Post;
use Illuminate\Support\Facades\Cache;

class PostService
{
    public HashTagService $hashtagService;
    public function __construct(HashTagService $hashtagService)
    {
        $this->hashtagService = $hashtagService;
    }

    /**
     * Create new post
     * @param array<string, string> $data
     * @return void
     */
    public function create(array $data)
    {
        // Create the post
        $post = Post::create([
            'subject' => $data['subject'],
            'content' => $data['content'],
            'image' => $data['image'],
            'view_number' => 0,
            'user_id' => isset(auth()->user()->id) ? auth()->user()->id : null,
        ]);

        if (isset($data['hashtags'])) {
            $hashtags = array_filter(array_map(function ($tag) {
                return str_replace('#', '', trim($tag));
            }, explode(',', $data['hashtags'])));
            foreach ($hashtags as $hashtagText) {
                $hashtag = Hashtag::firstOrCreate(['name' => $hashtagText]);
                $post->hashtags()->attach($hashtag->id);
            }
        }
    }
    /**
     * @param array<string, string> $data
     * @return void
     */
    public function update(array $data, int $id)
    {
        $post = Post::findOrFail($id);
        $user = isset(auth()->user()->id) ? auth()->user() : null;
        if ($user && $post->user_id !== $user->id && !$user->hasRole('admin')) {
            throw new \Exception('Unauthorized access.'); // Throw a generic Exception
        }

        // Update post attributes
        $post->update([
            'image' => $data['image'],
            'subject' => $data['subject'],
            'content' => $data['content'],
        ]);

        // Detach existing hashtags
        $post->hashtags()->detach();

        // Update or create new hashtags
        if (isset($data['hashtags'])) {
            $hashtags = array_filter(array_map(function ($tag) {
                return str_replace('#', '', trim($tag));
            }, explode(',', $data['hashtags'])));

            foreach ($hashtags as $hashtagText) {
                $hashtag = Hashtag::firstOrCreate(['name' => $hashtagText]);
                $post->hashtags()->attach($hashtag->id);
            }
        }
    }

    /**
     * Get all posts or by author with pagination
     * @return  \Illuminate\Pagination\LengthAwarePaginator<\App\Models\Post>
     */
    public function get(string $author = "all", int $page = 1)
    {

        // if (Cache::has('posts')) {
        //     $posts = Cache::get('posts');
        //     return $posts;
        // } else {
        //     $posts = Post::with('user', 'hashtags')
        //         ->orderBy('created_at', 'desc')
        //         ->paginate(10);
        //     Cache::put('posts', $posts, 600);
        //     return $posts;
        // }


        if ($author == 'all') {
            $cacheKey = 'posts_page_' . $page;
            $posts = Cache::remember($cacheKey, 60, function () use ($page) {
                return Post::with('user', 'hashtags')
                    ->orderBy('created_at', 'desc')
                    ->paginate(10, ['*'], 'page', $page);
            });
        } else {
            $cacheKey = "posts_{$author}_page_{$page}";
            $posts = Cache::remember($cacheKey, 60, function () use ($author) {
                return Post::with('user', 'hashtags')
                    ->orderBy('created_at', 'desc')
                    ->where('user_id', $author)
                    ->paginate(10);
            });
        }



        // if ($author == 'all') {

        //     $posts = Post::with('user', 'hashtags')
        //         ->orderBy('created_at', 'desc')
        //         ->paginate(10);
        // } else {

        //     $posts = Post::with('user', 'hashtags')
        //         ->orderBy('created_at', 'desc')
        //         ->where('user_id', $author)
        //         ->paginate(10);
        // }

        return $posts;
    }



    /**
     * Get post by id
     * @return Post
     */
    public function getById(int $id)
    {
        return Post::with('user', 'hashtags')->findOrFail($id);
    }

    /**
     * Delete post by id
     * @return void
     */
    public function destroy(int $id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
    }


    /**
     * Get New Posts
     * @return  \Illuminate\Pagination\LengthAwarePaginator<\App\Models\Post>
     */
    public function getNewPosts()
    {
        return Post::orderBy('created_at', 'desc')->paginate(3);
    }

    /**
     * Get Most views Posts
     * @return  \Illuminate\Pagination\LengthAwarePaginator<\App\Models\Post>
     */
    public function getMostViewPosts()
    {
        return Post::orderBy('view_number', 'desc')->paginate(3);
    }
}
