<?php

namespace App\Traits;

use App\Post;

trait searchFilters
{
    function composeQuery($request)
    {
        $postsQuery = Post::whereRaw('1 = 1');

        if ($request->search_str) {
            $postsQuery->where(function ($query) use ($request) { // per aggiungere le parentesi nell'SQL
                $query->where('title', 'LIKE', "%$request->search_str%")
                    ->orWhere('content', 'LIKE', "%$request->search_str%");
            });
        }

        if ($request->category) {
            $postsQuery->where('category_id', $request->category);
        }

        return $postsQuery;
    }
}
