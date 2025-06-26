<?php

namespace App\Providers;

use App\Interfaces\CartServiceInterface;
use App\Interfaces\CommentsServiceInterface;
use App\Interfaces\ProductsServiceInterface;
use App\Services\CartService;
use App\Services\CommentsService;
use App\Services\TelegramService;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use App\Services\ProductsService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(ProductsServiceInterface::class, function ($app) {
            return new ProductsService();
        });

        $this->app->singleton(TelegramService::class, function ($app) {
            return new TelegramService();
        });

        $this->app->singleton(CartServiceInterface::class, function ($app) {
            return new CartService();
        });

        $this->app->singleton(CommentsServiceInterface::class, function ($app) {
            return new CommentsService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }
    }
}
