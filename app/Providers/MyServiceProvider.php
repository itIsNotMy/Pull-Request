<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class MyServiceProvider extends ServiceProvider
{
    protected $defer = true;

    public function register()
    {
        $this->app->bind(\App\Services\TagsSynchronizerInterface::class, \App\Services\TagsSynchronizer::class);
        
        $this->app->bind(\App\Services\Pushall::class, function() {
            return new \App\Services\PushallSelf(config('pushAll.pushAll.api.id'), config('pushAll.pushAll.api.key'));
        });
    }
    
    public function boot()
    {
        View()->composer('layout.sidebar', function($view) {
            $view->with('tagsSidebar', \App\Models\Tag::all());
        });
    }
    
    public function provides()
    {
        return [\App\Services\TagsSynchronizerInterface::class];
    }
}
