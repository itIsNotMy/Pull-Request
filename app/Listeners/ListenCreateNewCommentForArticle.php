<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\CreateNewCommentForArticle;

class ListenCreateNewCommentForArticle
{
    public function handle(CreateNewCommentForArticle $event)
    {
        if (\Cache::tags(['comment', 'article'])->has('comment=' . $event->article->id)) {
                \Cache::tags(['comment', 'article'])->forget('comment=' . $event->article->id);
        }
    }
}
