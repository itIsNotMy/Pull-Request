<?php

namespace App\Listeners;

use App\Events\ArticleUpdate;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Mail\ArticlesMail;

class SendArticleUpdateNotification
{
    public $action = 'update';
    
    public function handle(ArticleUpdate $event)
    {
        \Mail::to(adminMail())->send(
            new ArticlesMail($event->article, $this->action)
        );
    }
}
