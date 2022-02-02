<?php

namespace App\Services;

use App\Models\Tag;
use App\Events\CreatingConnectionsModelTag;
use App\Events\RemovingConnectionsModelTag;

class TagsSynchronizer implements TagsSynchronizerInterface
{
    public function sync(\Illuminate\Support\Collection $collection, \App\Services\TaggingModel $model)
    {

        $articleTags = $model->tags->keyBy('title');

        $tagsAdded = $collection->diffKeys($articleTags);

        $tagsRemote = $articleTags->diffKeys($collection);

        if ($tagsAdded->isNotEmpty()) {
            foreach ($tagsAdded as $val) {
                $tag = Tag::firstOrCreate(['title' => $val]);
                $model->tags()->attach($tag);
                event(new CreatingConnectionsModelTag($model, $tagsAdded));
            }
        }

        if ($tagsRemote->isNotEmpty()) {
            $model->tags()->detach($tagsRemote);
            event(new RemovingConnectionsModelTag($model, $tagsRemote));
        }
    }
}
