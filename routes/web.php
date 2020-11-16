<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', [\App\Http\Controllers\IndexController::class, 'main_page'])
    ->name('index');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//Ajax
    //Category
    Route::get('/ajax/category/all', [\App\Http\Controllers\ProductCategoryController::class, 'ajax_get_all_category']);

    //Product
    // TODO Поміняти на метод пост
    Route::get('/ajax/product/new', [ \App\Http\Controllers\ProductController::class, 'ajax_get_new_product' ]);
    Route::get('/ajax/product/popular', [\App\Http\Controllers\ProductController::class, 'ajax_popular_products']);

    Route::get('/ajax/product/{product_alias}', [ \App\Http\Controllers\ProductController::class, 'ajax_get_product' ]);


    //Attribute
    // TODO Помінять метод на пост
    Route::get('/ajax/attribute/all', [\App\Http\Controllers\ProductAttributeController::class, 'get_list_attributes']);

    //Order
    Route::post('/ajax/order/new', [\App\Http\Controllers\OrderController::class, 'ajax_create_order'])
        ->name('ajax.order.new');

//Product
Route::get('/product/', function(){
    return redirect('/');
});
Route::get('/product/{product_alias}', [\App\Http\Controllers\ProductController::class, 'show_product'])
    ->name('product.show');


Route::group([
    'prefix' => '/admin',
    'middleware' => ['auth', 'can:admin-panel'],
], function(){


    Route::get('/', [\App\Http\Controllers\AdminIndexController::class, 'main_page'])
        ->name('admin.index');

    //API
    Route::get('/api/token/create', [\App\Http\Controllers\ApiTokenController::class, 'create_new_page'])
        ->name('api.token.create');
    Route::post('/api/token/create/action', [\App\Http\Controllers\ApiTokenController::class, 'create_new_page_action'])
        ->name('api.token.create.action');
    //Ajax ApiToken
    Route::get('/api/token/all', [\App\Http\Controllers\ApiTokenController::class, 'ajax_get_all_from_user'])
        ->name('ajax.api.token.all');
    Route::post('/api/token/toggle', [\App\Http\Controllers\ApiTokenController::class, 'ajax_active_token'])
        ->name('ajax.api.token.toggle');
    Route::post('/api/token/delete', [\App\Http\Controllers\ApiTokenController::class, 'ajax_delete_token'])
        ->name('ajax.api.token.delete');

    //Price
    Route::post('/price/create', [\App\Http\Controllers\PriceController::class, 'ajax_create_new'])
        ->name('price.ajax.create');

    //Products
    Route::get('/product/create', [\App\Http\Controllers\ProductController::class, 'create_product_page'])
        ->name('product.create');
    Route::post('/product/create/action', [\App\Http\Controllers\ProductController::class, 'create_product_form_action'])
        ->name('product.create.action');


    //Images
    Route::post('/image/upload', [\App\Http\Controllers\ImageController::class, 'upload_image'])
        ->name('image.upload');

    //Category
    Route::get('/category/create', [\App\Http\Controllers\ProductCategoryController::class, 'create_category_page'])
        ->name('category.create');
    Route::post('/category/create/action', [\App\Http\Controllers\ProductCategoryController::class, 'create_category_form_action'])
        ->name('category.create.action');

    //Attribute
    Route::get('/attribute/create', [\App\Http\Controllers\ProductAttributeController::class, 'create_attribute_page'])
        ->name('attribute.create');
    Route::post('/attribute/create/action', [\App\Http\Controllers\ProductAttributeController::class, 'create_attribute_form_action'])
        ->name('attribute.create.action');
    Route::get('/attribute/add/product', [\App\Http\Controllers\ProductAttributeController::class, 'add_attribute_from_product'])
        ->name('attribute.add.product');

    //Orders
    Route::get('/ajax/order/get/all/new', [\App\Http\Controllers\OrderController::class, 'ajax_get_all_new'])
        ->name('admin.ajax.order.getAllNew');
    Route::get('/order/{order_id}', [\App\Http\Controllers\OrderController::class, 'show_order'])
        ->name('order.show');
});
