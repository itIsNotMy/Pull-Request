<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Events\ArticleCreate;
use App\Events\ArticleUpdate;
use App\Events\ArticleDelete;
use App\Listeners\SendArticleCreateNotification;
use App\Listeners\SendArticleUpdateNotification;
use App\Listeners\SendArticleDeleteNotification;

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
        ],
        
        ArticleUpdate::class => [
            SendArticleUpdateNotification::class,
        ],
        
        ArticleDelete::class => [
            SendArticleDeleteNotification::class,
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
