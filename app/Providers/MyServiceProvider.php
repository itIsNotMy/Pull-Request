<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Services\TagsSynchronizer;
use App\Services\TagsSynchronizerInterface;

class MyServiceProvider extends ServiceProvider
{
    protected $defer = true;
    
    public function register()
    {
        $this->app->bind(\App\Services\TagsSynchronizerInterface::class, function(){
            return new \App\Services\TagsSynchronizer();
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
