<?php

namespace App\Listeners;

use App\Events\ArticleCreate;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendPushAllNotification
{
    public function handle(ArticleCreate $event)
    {
        $event->pushAll->send($event->article->title);
    }
}
