<?php

namespace App\Listeners;

use App\Events\ArticleCreate;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Mail\ArticleMailCreate;

class SendArticleCreateNotification
{
    public function handle(ArticleCreate $event)
    {
        \Mail::to(\Config::get('mailAdmin.mailAdmin', 'qwe@gmail.com'))->send(
            new ArticleMailCreate($event->article)
        );
    }
}
