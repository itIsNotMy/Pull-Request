<?php

namespace App\Services;

use App\Models\Tag;

class TagsSynchronizer implements TagsSynchronizerInterface
{
    public function sync(\Illuminate\Support\Collection $Collection, \App\Services\TaggingModel $model)
    {

        $articleTags = $model->tags->keyBy('title');

        $tagsAdded = $Collection->diffKeys($articleTags);

        $tagsRemote = $articleTags->diffKeys($Collection);
        
        if ($tagsAdded->isNotEmpty()) {
            foreach ($tagsAdded as $val){
                $tag = Tag::firstOrCreate(['title' => $val]);
                $model->tags()->attach($tag);
            }
        }

        if ($tagsRemote->isNotEmpty()) {
            $model->tags()->detach($tagsRemote);
        }
    }
}