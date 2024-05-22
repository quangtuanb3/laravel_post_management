<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hashtag extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];


    /**
     * Define a many-to-many relationship with posts.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany<Post>
     */
    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
}
