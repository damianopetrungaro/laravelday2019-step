<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repository\OrderRepository;
use App\Repository\SpatieOrderRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(OrderRepository::class, SpatieOrderRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
