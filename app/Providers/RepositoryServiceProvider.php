<?php

namespace App\Providers;

use App\Repositories\StaffRepository;
use App\Repositories\Interfaces\StaffRepositoryInterface;
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
            StaffRepositoryInterface::class,
            StaffRepository::class
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
