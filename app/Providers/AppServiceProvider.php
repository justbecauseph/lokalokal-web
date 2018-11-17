<?php

namespace LokaLocal\Providers;

use Illuminate\Auth\Events\Authenticated;
use Illuminate\Support\ServiceProvider;
use LokaLocal\Observers\UserObserver;
use LokaLocal\User;
use Schema;

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
        User::observe(UserObserver::class);

        $this->app['events']->listen(Authenticated::class, function ($e) {
            view()->share('user', $e->user);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() !== 'production') {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }
    }
}
