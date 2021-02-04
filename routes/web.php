<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect(route('users.dashboard'));
});

Route::group(['prefix' => 'users'], function() {
    Route::get('/sign-in', [\App\Http\Controllers\User\Auth\LoginController::class, 'signInForm'])->name('users.sign-in-form');
    Route::post('/sign-in', [\App\Http\Controllers\User\Auth\LoginController::class, 'signIn'])->name('users.sign-in');

    Route::group(['middleware' => 'auth:users-web'], function() {
        Route::get('/', function () { return redirect(route('users.dashboard')); })->name('users.root');
        
        Route::get('/sign-out', function() {
            return redirect(route('users.dashboard'));
        })->name('users.sign-out');
        Route::post('/sign-out', [\App\Http\Controllers\User\Auth\LoginController::class, 'signOut'])->name('administrator.sign-out');

        Route::get('/dashboard', [\App\Http\Controllers\User\HomeController::class, 'index'])->name('users.dashboard');

        // Products
        Route::get('/products', function() { return redirect(route('users.products.food.list')); });

        // Food
        Route::get('/products/food', [\App\Http\Controllers\User\FoodController::class, 'index'])->name('users.products.food.list');

        // Non-Food
        Route::get('/products/non-food', [\App\Http\Controllers\User\NonFoodController::class, 'index'])->name('users.products.non-food.list');

        // Suppliers
        Route::get('/suppliers', [\App\Http\Controllers\User\SupplierController::class, 'index'])->name('users.suppliers.list');
        
        // Inventory
        Route::get('/inventories', [\App\Http\Controllers\User\InventoryController::class, 'index'])->name('users.inventories.actual-stock');

        // Inventory Stock In
        Route::get('/inventories/stock-in', [\App\Http\Controllers\User\StockInController::class, 'index'])->name('users.inventories.stock-in');
        Route::post('/inventories/stock-in', [\App\Http\Controllers\User\StockInController::class, 'store'])->name('users.inventories.stock-in.store-order');
        Route::get('/inventories/stock-in/{uuid}', [\App\Http\Controllers\User\StockInController::class, 'show'])->name('users.inventories.stock-in.show');
        Route::post('/inventories/stock-in/{uuid}', [\App\Http\Controllers\User\StockInController::class, 'storeOrder'])->name('users.inventories.stock-in.storeOrder');
        Route::get('/inventories/stock-in/{uuid}/order', [\App\Http\Controllers\User\StockInController::class, 'order'])->name('users.inventories.stock-in.order');
        Route::post('/inventories/stock-in/{uuid}/order', [\App\Http\Controllers\User\StockInController::class, 'submitOrder'])->name('users.inventories.stock-in.submitOrder');
        Route::get('/inventories/stock-in/create-order', [\App\Http\Controllers\User\StockInController::class, 'create'])->name('users.inventories.stock-in.create-order');
        Route::delete('/inventories/stock-in/{headerId}/delete/{bodyId}', [\App\Http\Controllers\User\StockInController::class, 'deleteBody'])->name('users.inventories.stock-in.deleteBody');

        // Inventory Stock Out
        Route::get('/inventories/stock-out', [\App\Http\Controllers\User\StockOutController::class, 'index'])->name('users.inventories.stock-out');
        Route::post('/inventories/stock-out', [\App\Http\Controllers\User\StockOutController::class, 'create'])->name('users.inventories.stock-out.create');
        Route::get('/inventories/stock-out/{uuid}', [\App\Http\Controllers\User\StockOutController::class, 'show'])->name('users.inventories.stock-out.show');
        Route::post('/inventories/stock-out/{uuid}', [\App\Http\Controllers\User\StockOutController::class, 'storeChild'])->name('users.inventories.stock-out.storeChild');
        Route::get('/inventories/stock-out/{uuid}/order', [\App\Http\Controllers\User\StockOutController::class, 'order'])->name('users.inventories.stock-out.order');
        Route::post('/inventories/stock-out/{uuid}/order', [\App\Http\Controllers\User\StockOutController::class, 'submit'])->name('users.inventories.stock-out.submit');
        Route::delete('/inventories/stock-out/{parentId}/order/{childId}', [\App\Http\Controllers\User\StockOutController::class, 'destroy'])->name('users.inventories.stock-out.destroy');

        // Users Profile
        Route::get('/profile', [\App\Http\Controllers\User\ProfileController::class, 'index'])->name('users.profile');
        Route::put('/profile', [\App\Http\Controllers\User\ProfileController::class, 'update'])->name('users.profile.update');
        Route::post('/profile', [\App\Http\Controllers\User\ProfileController::class, 'password'])->name('users.profile.change-password');

        // Up Product
        Route::get('/up-product', [\App\Http\Controllers\User\UpProductController::class, 'index'])->name('users.up-product');

        // New Product
        Route::get('/new-product', [\App\Http\Controllers\User\NewProductController::class, 'index'])->name('users.new-product');
        
        // Prepare Product
        Route::get('/prepare-product', [\App\Http\Controllers\User\PrepareProductController::class, 'index'])->name('users.prepare-product');
    });
});

Route::group(['prefix' => 'administrator'], function() {
    Route::get('/sign-in', [\App\Http\Controllers\Admin\Auth\LoginController::class, 'signInForm'])->name('administrator.sign-in-form');
    Route::post('/sign-in', [\App\Http\Controllers\Admin\Auth\LoginController::class, 'signIn'])->name('administrator.sign-in');

    Route::group(['middleware' => 'auth:administrator-web'], function() {
        Route::get('/', function () { return redirect(route('administrator.dashboard')); })->name('administrator.root');
        
        Route::get('/sign-out', function() {
            return redirect(route('administrator.dashboard'));
        })->name('administrator.sign-out');
        Route::post('/sign-out', [\App\Http\Controllers\Admin\Auth\LoginController::class, 'signOut'])->name('administrator.sign-out');

        Route::get('/dashboard', [\App\Http\Controllers\Admin\HomeController::class, 'index'])->name('administrator.dashboard');

        // Users Management Routes
        Route::get('/users', [\App\Http\Controllers\Admin\UserController::class, 'index'])->name('administrator.users.list');
        Route::get('/users/create', [\App\Http\Controllers\Admin\UserController::class, 'create'])->name('administrator.users.create');
        Route::post('/users/create', [\App\Http\Controllers\Admin\UserController::class, 'store'])->name('administrator.users.store');
        Route::get('/users/{uuid}', [\App\Http\Controllers\Admin\UserController::class, 'show'])->name('administrator.users.show');
        Route::delete('/users/{uuid}', [\App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('administrator.users.destroy');
        Route::get('/users/{uuid}/edit', [\App\Http\Controllers\Admin\UserController::class, 'edit'])->name('administrator.users.edit');
        Route::put('/users/{uuid}/edit', [\App\Http\Controllers\Admin\UserController::class, 'update'])->name('administrator.users.update');
        Route::post('/users/{uuid}/reset-password', [\App\Http\Controllers\Admin\UserController::class, 'resetPassword'])->name('administrator.users.password-reset');

        // Suppliers
        Route::get('/suppliers', [\App\Http\Controllers\Admin\SupplierController::class, 'index'])->name('administrator.suppliers.list');
        Route::get('/suppliers/create', [\App\Http\Controllers\Admin\SupplierController::class, 'create'])->name('administrator.suppliers.create');
        Route::post('/suppliers/create', [\App\Http\Controllers\Admin\SupplierController::class, 'store'])->name('administrator.suppliers.store');
        Route::get('/suppliers/{uuid}', [\App\Http\Controllers\Admin\SupplierController::class, 'show'])->name('administrator.suppliers.show');
        Route::delete('/suppliers/{uuid}', [\App\Http\Controllers\Admin\SupplierController::class, 'destroy'])->name('administrator.suppliers.destroy');
        Route::get('/suppliers/{uuid}/edit', [\App\Http\Controllers\Admin\SupplierController::class, 'edit'])->name('administrator.suppliers.edit');
        Route::put('/suppliers/{uuid}/edit', [\App\Http\Controllers\Admin\SupplierController::class, 'update'])->name('administrator.suppliers.update');
        
        Route::get('/products', function() {
            return redirect(route('administrator.products.food.list'));
        });
        
        // Products Food
        Route::get('/products/food', [\App\Http\Controllers\Admin\FoodController::class, 'index'])->name('administrator.products.food.list');
        Route::get('/products/food/create', [\App\Http\Controllers\Admin\FoodController::class, 'create'])->name('administrator.products.food.create');
        Route::post('/products/food/create', [\App\Http\Controllers\Admin\FoodController::class, 'store'])->name('administrator.products.food.store');
        Route::get('/products/food/{uuid}', [\App\Http\Controllers\Admin\FoodController::class, 'show'])->name('administrator.products.food.show');
        Route::delete('/products/food/{uuid}', [\App\Http\Controllers\Admin\FoodController::class, 'destroy'])->name('administrator.products.food.destroy');
        Route::get('/products/food/{uuid}/edit', [\App\Http\Controllers\Admin\FoodController::class, 'edit'])->name('administrator.products.food.edit');
        Route::put('/products/food/{uuid}/edit', [\App\Http\Controllers\Admin\FoodController::class, 'update'])->name('administrator.products.food.update');

        // Product Non-Food
        Route::get('/products/non-food', [\App\Http\Controllers\Admin\NonFoodController::class, 'index'])->name('administrator.products.non-food.list');
        Route::get('/products/non-food/create', [\App\Http\Controllers\Admin\NonFoodController::class, 'create'])->name('administrator.products.non-food.create');
        Route::post('/products/non-food/create', [\App\Http\Controllers\Admin\NonFoodController::class, 'store'])->name('administrator.products.non-food.store');
        Route::get('/products/non-food/{uuid}', [\App\Http\Controllers\Admin\NonFoodController::class, 'show'])->name('administrator.products.non-food.show');
        Route::delete('/products/non-food/{uuid}', [\App\Http\Controllers\Admin\NonFoodController::class, 'destroy'])->name('administrator.products.non-food.destroy');
        Route::get('/products/non-food/{uuid}/edit', [\App\Http\Controllers\Admin\NonFoodController::class, 'edit'])->name('administrator.products.non-food.edit');
        Route::put('/products/non-food/{uuid}/edit', [\App\Http\Controllers\Admin\NonFoodController::class, 'update'])->name('administrator.products.non-food.update');
        
        // Actual Inventory
        Route::get('/inventory/actual-stock', [\App\Http\Controllers\Admin\InventoryController::class, 'index'])->name('administrator.inventory.actual-stock');

        // Stock In
        Route::get('/inventory/stock-in', [\App\Http\Controllers\Admin\StockInController::class, 'index'])->name('administrator.inventory.stock-in');
        Route::get('/inventory/stock-in/{uuid}', [\App\Http\Controllers\Admin\StockInController::class, 'show'])->name('administrator.inventory.stock-in.show');
        Route::post('/inventory/stock-in/{uuid}/approve', [\App\Http\Controllers\Admin\StockInController::class, 'approve'])->name('administrator.inventory.stock-in.approve');
        Route::post('/inventory/stock-in/{uuid}/reject', [\App\Http\Controllers\Admin\StockInController::class, 'reject'])->name('administrator.inventory.stock-in.reject');

        // Stock Out
        Route::get('/inventory/stock-out', [\App\Http\Controllers\Admin\StockOutController::class, 'index'])->name('administrator.inventory.stock-out');
        Route::get('/inventory/stock-out/{uuid}', [\App\Http\Controllers\Admin\StockOutController::class, 'show'])->name('administrator.inventory.stock-out.show');
        Route::post('/inventory/stock-out/{uuid}/approve', [\App\Http\Controllers\Admin\StockOutController::class, 'approve'])->name('administrator.inventory.stock-out.approve');
        Route::post('/inventory/stock-out/{uuid}/reject', [\App\Http\Controllers\Admin\StockOutController::class, 'reject'])->name('administrator.inventory.stock-out.reject');
        
        // Promotions
        Route::get('/promotions', [\App\Http\Controllers\Admin\PromotionController::class, 'index'])->name('administrator.promotions.list');
        Route::get('/promotions/create', [\App\Http\Controllers\Admin\PromotionController::class, 'create'])->name('administrator.promotions.create');
        Route::post('/promotions/create', [\App\Http\Controllers\Admin\PromotionController::class, 'store'])->name('administrator.promotions.store');
        Route::get('/promotions/{uuid}', [\App\Http\Controllers\Admin\PromotionController::class, 'show'])->name('administrator.promotions.show');
        Route::delete('/promotions/{uuid}', [\App\Http\Controllers\Admin\PromotionController::class, 'destroy'])->name('administrator.promotions.destroy');
        Route::get('/promotions/{uuid}/edit', [\App\Http\Controllers\Admin\PromotionController::class, 'edit'])->name('administrator.promotions.edit');
        Route::put('/promotions/{uuid}/edit', [\App\Http\Controllers\Admin\PromotionController::class, 'update'])->name('administrator.promotions.update');

        // Up Product
        Route::get('/up-product', [\App\Http\Controllers\Admin\UpProductController::class, 'index'])->name('administrator.up-product');
        Route::get('/up-product/create', [\App\Http\Controllers\Admin\UpProductController::class, 'create'])->name('administrator.up-product.create');
        Route::post('/up-product/create', [\App\Http\Controllers\Admin\UpProductController::class, 'store'])->name('administrator.up-product.store');
        Route::get('/up-product/{id}', [\App\Http\Controllers\Admin\UpProductController::class, 'edit'])->name('administrator.up-product.edit');
        Route::put('/up-product/{id}', [\App\Http\Controllers\Admin\UpProductController::class, 'update'])->name('administrator.up-product.update');
        Route::delete('/up-product/{id}', [\App\Http\Controllers\Admin\UpProductController::class, 'destroy'])->name('administrator.up-product.destroy');

        // New Product
        Route::get('/new-product', [\App\Http\Controllers\Admin\NewProductController::class, 'index'])->name('administrator.new-product');
        Route::get('/new-product/create', [\App\Http\Controllers\Admin\NewProductController::class, 'create'])->name('administrator.new-product.create');
        Route::post('/new-product/create', [\App\Http\Controllers\Admin\NewProductController::class, 'store'])->name('administrator.new-product.store');
        Route::get('/new-product/{id}', [\App\Http\Controllers\Admin\NewProductController::class, 'edit'])->name('administrator.new-product.edit');
        Route::put('/new-product/{id}', [\App\Http\Controllers\Admin\NewProductController::class, 'update'])->name('administrator.new-product.update');
        Route::delete('/new-product/{id}', [\App\Http\Controllers\Admin\NewProductController::class, 'destroy'])->name('administrator.new-product.destroy');

        // Prepare Product
        Route::get('/prepare-product', [\App\Http\Controllers\Admin\PrepareProductController::class, 'index'])->name('administrator.prepare-product');
        Route::get('/prepare-product/create', [\App\Http\Controllers\Admin\PrepareProductController::class, 'create'])->name('administrator.prepare-product.create');
        Route::post('/prepare-product/create', [\App\Http\Controllers\Admin\PrepareProductController::class, 'store'])->name('administrator.prepare-product.store');
        Route::get('/prepare-product/{id}', [\App\Http\Controllers\Admin\PrepareProductController::class, 'edit'])->name('administrator.prepare-product.edit');
        Route::put('/prepare-product/{id}', [\App\Http\Controllers\Admin\PrepareProductController::class, 'update'])->name('administrator.prepare-product.update');
        Route::delete('/prepare-product/{id}', [\App\Http\Controllers\Admin\PrepareProductController::class, 'destroy'])->name('administrator.prepare-product.destroy');

        // Report redirector
        Route::get('/reports', function() { return redirect('administrator/reports/stock'); });
        
        // Stock Report
        Route::get('/reports/stock', [\App\Http\Controllers\Admin\ReportStockController::class, 'index'])->name('administrator.reports.stock');
        Route::post('/reports/stock', [\App\Http\Controllers\Admin\ReportStockController::class, 'store'])->name('administrator.reports.stock.store');
        Route::get('/reports/stock/{uuid}', [\App\Http\Controllers\Admin\ReportStockController::class, 'show'])->name('administrator.reports.stock.show');

    });
});