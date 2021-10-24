<?php

namespace App\Listeners;

use App\Events\ArticleUpdate;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Mail\ArticleMailUpdete;

class SendArticleUpdateNotification
{
    public function handle(ArticleUpdate $event)
    {
        \Mail::to(adminMail())->send(
            new ArticleMailUpdete($event->article)
        );
    }
}
