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
        \Mail::to(env('MAIL_USERNAME'))->send(
            new ArticlesMail($event->article, $this->action)
        );
    }
}
