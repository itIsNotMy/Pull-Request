<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\CreatingConnectionsModelTag;

class ListenCreatingConnectionsModelTag
{

    public function handle(CreatingConnectionsModelTag $event)
    {
        if (is_a($event->model, 'App\Models\News')) {
            foreach ($event->tagsCollect as $key=>$val) {
                \Cache::tags('news_tag')->forget('news_tag=' . $key);
            }
        } else {
            foreach ($event->tagsCollect as $key=>$val) {
                \Cache::tags('article_tag')->forget('article_tag=' . $key);
            }
        }
    }
}
