<?php

namespace App\Providers;

use App\Like;
use App\Notification;
use App\Observers\LikeObserver;
use App\Observers\NotificationObserver;
use App\Observers\ProductObserver;
use App\Product;
use App\Repositories\BookmarkRepository;
use App\Repositories\CommentRepository;
use App\Repositories\Interfaces\BookmarkRepositoryInterface;
use App\Repositories\Interfaces\CommentRepositoryInterface;
use App\Repositories\Interfaces\LikeRepositoryInterface;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Repositories\Interfaces\ProductServiceRepositoryInterface;
use App\Repositories\Interfaces\ReportRepositoryInterface;
use App\Repositories\LikeRepository;
use App\Repositories\ProductRepository;
use App\Repositories\ProductServiceRepository;
use App\Repositories\ReportRepository;
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
        $this->app->bind(
            ProductRepositoryInterface::class,
            ProductRepository::class
        );

        $this->app->bind(
            BookmarkRepositoryInterface::class,
            BookmarkRepository::class
        );

        $this->app->bind(
            ProductServiceRepositoryInterface::class,
            ProductServiceRepository::class
        );

        $this->app->bind(
            ReportRepositoryInterface::class,
            ReportRepository::class
        );

        $this->app->bind(
            LikeRepositoryInterface::class,
            LikeRepository::class
        );

        $this->app->bind(
            CommentRepositoryInterface::class,
            CommentRepository::class
        );
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
