<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\RemovingConnectionsModelTag;

class ListenRemovingConnectionsModelTag
{
    public function handle(RemovingConnectionsModelTag $event)
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
