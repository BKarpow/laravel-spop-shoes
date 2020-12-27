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

Route::get('/h', function (){
    dd(auth()->user()->userContact);
    return 'ok';
})
    ->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group([
    'prefix' => '/ajax'
], function(){
    //Ajax
    Route::get('/', function(){
        return redirect('/');
    });

    //Category
    Route::get('/category/all', [\App\Http\Controllers\ProductCategoryController::class, 'ajax_get_all_category']);
    Route::get('/category/sorted', [\App\Http\Controllers\ProductCategoryController::class, 'ajax_get_sorted_category']);

    //Product
    // TODO Поміняти на метод пост
    Route::get('/product/new', [ \App\Http\Controllers\ProductController::class, 'ajax_get_new_product' ]);
    Route::get('/product/popular', [\App\Http\Controllers\ProductController::class, 'ajax_popular_products']);

    Route::get('/product/{product_alias}', [ \App\Http\Controllers\ProductController::class, 'ajax_get_product' ]);


    //Attribute
    // TODO Помінять метод на пост
    Route::get('/attribute/all', [\App\Http\Controllers\ProductAttributeController::class, 'get_list_attributes']);

    //Order
    Route::post('/order/new', [\App\Http\Controllers\OrderController::class, 'ajax_create_order'])
        ->name('ajax.order.new');
    Route::get('/cart/products', [\App\Http\Controllers\CartOrderController::class, 'ajax_all_products']);


    //Likes
    Route::post('/like/get/', [\App\Http\Controllers\LikeController::class, 'ajax_get_likes']);
//    Route::get('deb/ajax/like/get/', [\App\Http\Controllers\LikeController::class, 'ajax_get_likes_debug']);
    Route::post('/like/plus', [\App\Http\Controllers\LikeController::class, 'ajax_increment_like']);
    Route::post('/like/minus', [\App\Http\Controllers\LikeController::class, 'ajax_decrement_like']);
    Route::get('/like/products', [\App\Http\Controllers\LikeController::class, 'ajax_get_like_products']);

    //Cart
    Route::post('/cart/get', [\App\Http\Controllers\CartController::class, 'ajax_get_products_from_cart']);
    Route::post('/cart/add', [\App\Http\Controllers\CartController::class, 'ajax_add_to_cart']);
    Route::post('/cart/remove', [\App\Http\Controllers\CartController::class, 'ajax_remove_product_cart']);
    Route::post('/cart/check', [\App\Http\Controllers\CartController::class, 'ajax_check_product_from_cart']);

    //NovaPoshta
    Route::get('/np/regions', [\App\Http\Controllers\NPController::class, 'ajax_regions']);
    Route::post('/np/city', [\App\Http\Controllers\NPController::class, 'ajax_city_from_area']);
    Route::post('/np/city/branch', [\App\Http\Controllers\NPController::class, 'ajax_get_branch']);
    Route::post('/np/calc/', [\App\Http\Controllers\NPController::class, 'ajax_calc_cost']);
    Route::post('/np/pay/', [\App\Http\Controllers\NPInfoController::class, 'ajax_save_data']);
    Route::post('/np/data/', [\App\Http\Controllers\NPInfoController::class, 'ajax_get_data']);


    //Search
    Route::post('/search', [\App\Http\Controllers\SearchController::class, 'ajax_search']);
});


//Sitemap
Route::get('/sitemap/product', [\App\Http\Controllers\SitemapController::class, 'products'])
    ->name('sitemap.product');
Route::get('/sitemap/category', [\App\Http\Controllers\SitemapController::class, 'category'])
    ->name('sitemap.category');
Route::get('/sitemap', [\App\Http\Controllers\SitemapController::class, 'index'])
    ->name('sitemap');


//Search
Route::get('/search/', [\App\Http\Controllers\SearchController::class, 'page_search_result'])
    ->name('search');


//Pages
Route::get('/about', [\App\Http\Controllers\PageController::class, 'about'])
    ->name('page.about');
Route::post('/feedback/', [\App\Http\Controllers\FeedbackController::class, 'create'])
    ->name('feedback.action');

//Product
Route::get('/product/', function(){
    return redirect('/');
});
Route::get('/product/{product_alias}', [\App\Http\Controllers\ProductController::class, 'show_product'])
    ->name('product.show');

//Comment
Route::post('/comment/new', [\App\Http\Controllers\CommentController::class, 'new_comment'])
    ->name('comment.new');

//Likes
Route::get('/my/likes', [\App\Http\Controllers\LikeController::class, 'page_likes'])
    ->name('likes.my');

//Category
Route::get('/catalog/{category_id}', [\App\Http\Controllers\ProductCategoryController::class, 'show_products_from_category'])
    ->name('category.show');

//Order
Route::get('/order/delivery', [\App\Http\Controllers\CartOrderController::class, 'index'])
    ->name('delivery');
Route::get('/order/success/', [\App\Http\Controllers\OrderSetController::class, 'success']);
Route::post('/order/new', [\App\Http\Controllers\OrderSetController::class, 'create'])
    ->name('order,new');



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

    // Statuses
    Route::get('/statuses', [\App\Http\Controllers\OrderStatusController::class, 'index'])
        ->name('statuses');
    Route::get('/statuses/create', [\App\Http\Controllers\OrderStatusController::class, 'create'])
        ->name('statuses.create');
    Route::post('/statuses/create/action', [\App\Http\Controllers\OrderStatusController::class, 'create_action'])
        ->name('statuses.create.action');
    Route::get('/statuses/update/{status_id}', [\App\Http\Controllers\OrderStatusController::class, 'update'])
        ->name('statuses.update');
    Route::post('/statuses/update/action', [\App\Http\Controllers\OrderStatusController::class, 'update_action'])
        ->name('statuses.update.action');
    Route::get('/statuses/delete/{status_id}', [\App\Http\Controllers\OrderStatusController::class, 'delete'])
        ->name('statuses.delete');
});

