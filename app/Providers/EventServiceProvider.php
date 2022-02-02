<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Events\ArticleCreate;
use App\Events\ArticleUpdate;
use App\Events\ArticleDelete;
use App\Events\CreateNewCommentForArticle;
use App\Events\CreateNewCommentForNews;
use App\Events\RemovingConnectionsModelTag;
use App\Events\CreatingConnectionsModelTag;
use App\Listeners\SendArticleCreateNotification;
use App\Listeners\SendArticleUpdateNotification;
use App\Listeners\SendArticleDeleteNotification;
use App\Listeners\SendPushAllNotification;
use App\Listeners\ListenCreateNewCommentForArticle;
use App\Listeners\ListenCreateNewCommentForNews;
use App\Listeners\ListenRemovingConnectionsModelTag;
use App\Listeners\ListenCreatingConnectionsModelTag;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        ArticleCreate::class => [
            SendArticleCreateNotification::class,
            SendPushAllNotification::class,
        ],

        ArticleUpdate::class => [
            SendArticleUpdateNotification::class,
        ],

        ArticleDelete::class => [
            SendArticleDeleteNotification::class,
        ],

        CreateNewCommentForArticle::class => [
            ListenCreateNewCommentForArticle::class,
        ],

        CreateNewCommentForNews::class => [
            ListenCreateNewCommentForNews::class,
        ],

        RemovingConnectionsModelTag::class => [
            ListenRemovingConnectionsModelTag::class,
        ],

        CreatingConnectionsModelTag::class => [
            ListenCreatingConnectionsModelTag::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
