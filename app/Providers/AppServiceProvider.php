<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Channel;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        \View::composer('*', function ($view) {
            $excludedViews = ['threads.create'];
            
            //Check if current view is not in excludedViews array
            if(!in_array($view->getName() , $excludedViews))
            {
                $channels = \Cache::rememberForever('channels', function () {
                    return Channel::all();
                });

                $view->with('channels', $channels); 
            }
            
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->isLocal()) {
            $this->app->register(\Barryvdh\Debugbar\ServiceProvider::class);
        }
    }
}
