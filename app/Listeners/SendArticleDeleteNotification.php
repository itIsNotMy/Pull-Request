<?php

namespace App\Listeners;

use App\Events\ArticleDelete;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Mail\ArticleMailDelete;

class SendArticleDeleteNotification
{
    public function handle(ArticleDelete $event)
    {
        \Mail::to(adminMail())->send(
            new ArticleMailDelete($event->article)
        );
    }
}
