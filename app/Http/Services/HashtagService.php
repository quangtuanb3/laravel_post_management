<?php

namespace App\Http\Services;

use App\Models\Hashtag;

class HashTagService
{
    /**
     * Get all hashtag
     * @return  \Illuminate\Database\Eloquent\Collection<int, \App\Models\Hashtag>
     */
    public function getAll()
    {
        return Hashtag::all();
    }
}
