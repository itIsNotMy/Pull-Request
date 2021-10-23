<?php

namespace App\Listeners;

use App\Events\ArticleCreate;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Mail\ArticlesMail;

class SendArticleCreateNotification
{
    public $action = 'create';
    
    public function handle(ArticleCreate $event)
    {
        \Mail::to(env('MAIL_USERNAME'))->send(
            new ArticlesMail($event->article, $this->action)
        );
    }
}
