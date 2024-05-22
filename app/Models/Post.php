<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;

class Post extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        'subject',
        'content',
        'image',
        'user_id',
        'view_number',

    ];

    /**
     * Get the user that owns the post.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<User, Post>
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the hashtags associated with the post.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany<Hashtag>
     */
    public function hashtags()
    {
        return $this->belongsToMany(Hashtag::class);
    }


    protected static function booted()
    {
        static::created(function ($post) {
            self::clearPostCache($post);
        });

        static::updated(function ($post) {
            self::clearPostCache($post);
        });

        static::deleted(function ($post) {
            self::clearPostCache($post);
        });
    }

    /**
     * Clear post cache.
     *
     * @param \App\Models\Post $post The post instance.
     * @return void
     */
    protected static function clearPostCache(Post $post)
    {
        $page = 1;
        while (Cache::has("posts_page_$page")) {
            Cache::forget("posts_page_$page");
            $page++;
        }

        // Clear all caches tagged with 'posts'
        //  Cache::tags('posts')->flush();


        while (Cache::has("posts_{$post->user_id}_page_{$page}")) {
            Cache::forget("posts_{$post->user_id}_page_{$page}");
            $page++;
        }
    }
}
