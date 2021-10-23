<?php

namespace App\Listeners;

use App\Events\ArticleDelete;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Mail\ArticlesMail;

class SendArticleDeleteNotification
{
    public $action = 'delete';
    
    public function handle(ArticleDelete $event)
    {
        \Mail::to(env('MAIL_USERNAME'))->send(
            new ArticlesMail($event->article, $this->action)
        );
    }
}
