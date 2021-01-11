<?php

namespace App\Providers;

use App\Repositories\Interfaces\Admin\IDivisionRepository;
use App\Repositories\Interfaces\Admin\IUserRepository;
use App\Repositories\Interfaces\IBaseRepository;
use App\Repositories\Repository\Admin\DivisionRepository;
use App\Repositories\Repository\Admin\UserRepository;
use App\Repositories\Repository\BaseRepository;
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
        $this->app->bind(IBaseRepository::class, BaseRepository::class);
        $this->app->bind(IUserRepository::class, UserRepository::class);
        $this->app->bind(IDivisionRepository::class, DivisionRepository::class);
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
