<?php

namespace App\Providers;

use App\Like;
use App\Notification;
use App\Observers\LikeObserver;
use App\Observers\NotificationObserver;
use App\Observers\ProductObserver;
use App\Product;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Product::observe(ProductObserver::class);
        Like::observe(LikeObserver::class);
        Notification::observe(NotificationObserver::class);
    }
}
