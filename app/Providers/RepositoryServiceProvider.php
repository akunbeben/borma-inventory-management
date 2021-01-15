<?php

namespace App\Providers;

use App\Repositories\Interfaces\Admin\IDivisionRepository;
use App\Repositories\Interfaces\Admin\IInventoryRepository;
use App\Repositories\Interfaces\Admin\IProductRepository;
use App\Repositories\Interfaces\Admin\IProductTypeRepository;
use App\Repositories\Interfaces\Admin\ISupplierRepository;
use App\Repositories\Interfaces\Admin\IUserRepository;
use App\Repositories\Interfaces\IBaseRepository;

use App\Repositories\Repository\Admin\DivisionRepository;
use App\Repositories\Repository\Admin\InventoryRepository;
use App\Repositories\Repository\Admin\ProductRepository;
use App\Repositories\Repository\Admin\ProductTypeRepository;
use App\Repositories\Repository\Admin\SupplierRepository;
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
        $this->app->bind(ISupplierRepository::class, SupplierRepository::class);
        $this->app->bind(IProductRepository::class, ProductRepository::class);
        $this->app->bind(IProductTypeRepository::class, ProductTypeRepository::class);
        $this->app->bind(IInventoryRepository::class, InventoryRepository::class);
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
