<?php

namespace App\Providers;

use App\Repositories\HttpClientRepository;
use App\Repositories\Interfaces\HttpClientRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            HttpClientRepositoryInterface::class,
            HttpClientRepository::class
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
