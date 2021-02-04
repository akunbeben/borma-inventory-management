<?php

namespace App\Providers;

use App\Repositories\Interfaces\Admin\IDivisionRepository;
use App\Repositories\Interfaces\Admin\IInventoryRepository;
use App\Repositories\Interfaces\Admin\INewProductRepository;
use App\Repositories\Interfaces\Admin\IPrepareProductRepository;
use App\Repositories\Interfaces\Admin\IProductRepository;
use App\Repositories\Interfaces\Admin\IProductTypeRepository;
use App\Repositories\Interfaces\Admin\IPromotionRepository;
use App\Repositories\Interfaces\Admin\IReportRepository;
use App\Repositories\Interfaces\Admin\IStockInRepository;
use App\Repositories\Interfaces\Admin\IStockOutRepository;
use App\Repositories\Interfaces\Admin\ISupplierRepository;
use App\Repositories\Interfaces\Admin\IUpProductRepository;
use App\Repositories\Interfaces\Admin\IUserRepository;
use App\Repositories\Interfaces\IBaseRepository;
use App\Repositories\Interfaces\User\IStockInRepository as UserIStockInRepository;
use App\Repositories\Interfaces\User\IStockOutRepository as UserIStockOutRepository;
use App\Repositories\Repository\Admin\DivisionRepository;
use App\Repositories\Repository\Admin\InventoryRepository;
use App\Repositories\Repository\Admin\NewProductRepository;
use App\Repositories\Repository\Admin\PrepareProductRepository;
use App\Repositories\Repository\Admin\ProductRepository;
use App\Repositories\Repository\Admin\ProductTypeRepository;
use App\Repositories\Repository\Admin\PromotionRepository;
use App\Repositories\Repository\Admin\ReportRepository;
use App\Repositories\Repository\Admin\StockInRepository;
use App\Repositories\Repository\Admin\StockOutRepository;
use App\Repositories\Repository\Admin\SupplierRepository;
use App\Repositories\Repository\Admin\UpProductRepository;
use App\Repositories\Repository\Admin\UserRepository;
use App\Repositories\Repository\BaseRepository;
use App\Repositories\Repository\User\StockInRepository as UserStockInRepository;
use App\Repositories\Repository\User\StockOutRepository as UserStockOutRepository;
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
        $this->app->bind(IStockInRepository::class, StockInRepository::class);
        $this->app->bind(UserIStockInRepository::class, UserStockInRepository::class);
        $this->app->bind(IStockOutRepository::class, StockOutRepository::class);
        $this->app->bind(UserIStockOutRepository::class, UserStockOutRepository::class);
        $this->app->bind(IPromotionRepository::class, PromotionRepository::class);
        $this->app->bind(IUpProductRepository::class, UpProductRepository::class);
        $this->app->bind(INewProductRepository::class, NewProductRepository::class);
        $this->app->bind(IPrepareProductRepository::class, PrepareProductRepository::class);
        $this->app->bind(IReportRepository::class, ReportRepository::class);
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
