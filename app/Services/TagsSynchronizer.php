<?php

namespace App\Services;

use App\Models\Article;
use App\Models\Tag;

class TagsSynchronizer
{
    public function sync($tagsRequest, Article $article)
    {
        $articleTags = $article->tags->keyBy('title');

        $tagsAdded = $tagsRequest->diffKeys($articleTags);

        $tagsRemote = $articleTags->diffKeys($tagsRequest);

        if ($tagsAdded->isNotEmpty()) {
            foreach ($tagsAdded as $val){
                $tag = Tag::where('title', $val)->get();
                $article->tags()->attach($tag);
            }
        }

        if ($tagsRemote->isNotEmpty()) {
            $article->tags()->detach($tagsRemote);
        }
    }
}