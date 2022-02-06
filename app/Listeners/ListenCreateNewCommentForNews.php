<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\CreateNewCommentForNews;

class ListenCreateNewCommentForNews
{
    public function handle(CreateNewCommentForNews $event)
    {
        if (\Cache::tags(['comment', 'news'])->has('comment=' . $event->news->id)) {
                \Cache::tags(['comment', 'news'])->forget('comment=' . $event->news->id);
        }
    }
}
