<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\system as Backend;
use App\Http\Controllers\fronts as Client ;

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

Route::redirect('/system', 'login');
Route::get('/', [Backend\BaseController::class, 'login'])->name('login');
Route::post('post/login', [Backend\BaseController::class, 'postLogin'])->name('post.login');
Route::get('logout', [Backend\BaseController::class, 'logout'])->name('logout');


Route::group(['middleware'=>'auth', 'namespace'=>'system', 'prefix'=>'sokha.stock'], function(){
    Route::get('/', [Backend\BaseController::class , 'index'])->name("home.page");


    Route::group(['prefix'=>'user', 'as'=>'user.'], function()
    {
        Route::get('/list', [Backend\UserController::class, 'index'])->name('list');
        Route::get('/create/{id?}', [Backend\UserController::class, 'create'])->name('create');
        Route::post('/store', [Backend\UserController::class, 'store'])->name('store');
        Route::post('/update/{id}', [Backend\UserController::class, 'update'])->name('update');
        Route::get('/edit/{id}', [Backend\UserController::class, 'edit'])->name('edit');
        Route::get('/status/{id?}/{status?}', [Backend\UserController::class, 'status'])->name('status');

        // Route::match(['get', 'post'], '/status/{id?}/{status?}', [Backend\CategoryController::class, 'status'])->name('status');
    });

    Route::group(['prefix'=>'category', 'as'=>'category.'], function()
    {
        Route::get('/list', [Backend\CategoryController::class, 'index'])->name('list');
        Route::get('/list/sub/{id}', [Backend\CategoryController::class, 'index'])->name('sub.list');
        Route::get('/create/{id?}', [Backend\CategoryController::class, 'create'])->name('create');
        Route::post('/store', [Backend\CategoryController::class, 'store'])->name('store');
        Route::post('/update/{id}', [Backend\CategoryController::class, 'update'])->name('update');
        Route::get('/edit/{id}', [Backend\CategoryController::class, 'edit'])->name('edit');
        Route::get('/order/{id}/{order}/{mode}', [Backend\CategoryController::class, 'order'])->name('order');

        // Route::match(['get', 'post'], '/status/{id?}/{status?}', [Backend\CategoryController::class, 'status'])->name('status');
    });

    // product management route
    Route::group(['prefix'=>'product', 'as'=>'product.'], function(){

        Route::get("list", [Backend\ProductController::class, 'index'])->name("index");
        Route::get("create", [Backend\ProductController::class, 'create'])->name("create");
        Route::get("edit/{id}", [Backend\ProductController::class, 'edit'])->name("edit");
        Route::post("store", [Backend\ProductController::class, 'store'])->name("store");
        Route::post("update", [Backend\ProductController::class, 'update'])->name("update");
        Route::post("search", [Backend\ProductController::class, 'search'])->name("search");


        // route for product saling

    });

    Route::group(['prefix'=>'sale', 'as'=>'sale.'], function(){

        Route::get("index", [Backend\SaleController::class, 'index'])->name("index");
        Route::post("store", [Backend\SaleController::class, 'store'])->name("store");
        Route::get("view", [Backend\SaleController::class, 'view'])->name('view');
    });

    Route::group(['prefix'=>'reciev/product', 'as'=>'reciev.product.'], function(){

        Route::get("list", [Backend\RecievProductController::class, 'index'])->name("index");
        Route::get("create", [Backend\RecievProductController::class, 'create'])->name("create");
        Route::get("edit/{id}", [Backend\RecievProductController::class, 'edit'])->name("edit");
        Route::get("cet/filter", [Backend\RecievProductController::class, 'cat_filter'])->name("cet.filter");
        Route::get("product/price", [Backend\RecievProductController::class, 'pro_filter'])->name("pro.price");
        Route::post("store", [Backend\RecievProductController::class, 'store'])->name("store");
        Route::get("search", [Backend\RecievProductController::class, 'search'])->name("search");
        // Route::post("update", [Backend\RecievProductController::class, 'update'])->name("update");
        // Route::post("search", [Backend\RecievProductController::class, 'search'])->name("search");
    });


    //  below route control and execute of telegram bot selebrapt with laravel
    //  that write and controby bode module



});


Route::group(['prefix' => 'order/product', 'as' => 'order.'], function(){
    Route::get('/',[Client\ProductOrderController::class, 'index'])->name('index');
    Route::get('/filter-cat',[Client\ProductOrderController::class, 'filterCategory'])->name('filter_cat');
    Route::get('/get-price-by-id',[Client\ProductOrderController::class, 'price_by_id'])->name('price_byid');
});



