<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Pagination\Paginator;

class MyServiceProvider extends ServiceProvider
{
    protected $defer = true;

    public function register()
    {
        $this->app->bind(\App\Services\TagsSynchronizerInterface::class, \App\Services\TagsSynchronizer::class);

        $this->app->bind(\App\Services\Pushall::class, function() {
            return new \App\Services\PushallSelf(config('pushAll.pushAll.api.id'), config('pushAll.pushAll.api.key'));
        });

        $this->app->singleton(\App\Services\CreatorCommentArticleAndNewsInterface::class, \App\Services\CreatorCommentArticleAndNews::class);
    }

    public function boot()
    {
        View()->composer('layout.sidebar', function($view) {
            $view->with('tagsSidebar', \App\Models\Tag::get());
        });

        Paginator::defaultView('pagination::default');
    }

    public function provides()
    {
        return [\App\Services\TagsSynchronizerInterface::class];
    }
}
