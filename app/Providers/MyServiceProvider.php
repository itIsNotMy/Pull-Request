<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class MyServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('TagsSynchronizer', function(){
            return new \App\Services\TagsSynchronizer();
        });
    }
    
    public function boot()
    {
        View()->composer('layout.sidebar', function($view) {
            $view->with('tagsSidebar', \App\Models\Tag::all());
        });
    }
}
