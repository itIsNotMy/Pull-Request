<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\CreatingConnectionsModelTag;

class ListenCreatingConnectionsModelTag
{

    public function handle(CreatingConnectionsModelTag $event)
    {
        foreach ($event->tagsCollect as $key=>$val) {
            \Cache::tags(['news', 'tag'])->forget('news_tag=' . $key);
            \Cache::tags(['article', 'tag'])->forget('article_tag=' . $key);
        }
    }
}
