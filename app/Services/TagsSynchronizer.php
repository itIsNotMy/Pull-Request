<?php

namespace App\Services;

use App\Models\Article;
use App\Models\Tag;

class TagsSynchronizer implements TagsSynchronizerInterface
{
    public function sync(\Illuminate\Support\Collection $Collection, Article $article)
    {

        $articleTags = $article->tags->keyBy('title');

        $tagsAdded = $Collection->diffKeys($articleTags);

        $tagsRemote = $articleTags->diffKeys($Collection);
        
        if ($tagsAdded->isNotEmpty()) {
            foreach ($tagsAdded as $val){
                $tag = Tag::firstOrCreate(['title' => $val]);
                $article->tags()->attach($tag);
            }
        }

        if ($tagsRemote->isNotEmpty()) {
            $article->tags()->detach($tagsRemote);
        }
    }
}