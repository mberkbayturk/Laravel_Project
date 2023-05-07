<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/','FrontEnd\FrontEndController@index');
Route::get('all_categories','FrontEnd\FrontEndController@categories');
Route::get('all_products','FrontEnd\FrontEndController@products');
Route::get('services','FrontEnd\FrontEndController@services');
Route::get('about','FrontEnd\FrontEndController@about');
Route::get('view-category/{slug}','FrontEnd\FrontEndController@viewCategory');
Route::get('details/{category_slug}/{product_slug}','FrontEnd\FrontEndController@viewProduct');

Auth::routes();

Route::get('load-wishlist-data','FrontEnd\WishlistController@wishlistCount');
Route::get('load-cart-data','FrontEnd\CartController@cartCount');
Route::get('product_list','FrontEnd\FrontEndController@productsListAjax');
Route::post('search_product','FrontEnd\FrontEndController@search_product');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('add_to_cart','FrontEnd\CartController@addToCart');
Route::post('delete_cart_item','FrontEnd\CartController@delete_cart_item');
Route::post('update_qty','FrontEnd\CartController@update_qty');
Route::post('add_to_wishlist','FrontEnd\WishlistController@addToWishlist');
Route::post('delete_wishlist_item','FrontEnd\WishlistController@delete_wishlist_item');

Route::middleware(['auth'])->group(function(){
    Route::get('cart','FrontEnd\CartController@viewCart');
    Route::get('checkout','FrontEnd\CheckoutController@index');
    Route::post('place_order','FrontEnd\CheckoutController@place_order');
    Route::get('my_orders','FrontEnd\UserController@index');
    Route::get('order_details/{id}','FrontEnd\UserController@view');

    // wishlist
    Route::get('wishlist','FrontEnd\WishlistController@index');
    // add rating
    Route::post('add_rating','FrontEnd\RatingController@add');
    // add review
    Route::get('add_review/{product_slug}/user_review','FrontEnd\ReviewController@add');
    Route::post('add_review','FrontEnd\ReviewController@add_review');
    Route::get('edit_review/{product_slug}/user_review','FrontEnd\ReviewController@edit_review');
    Route::put('update_review','FrontEnd\ReviewController@update_review');
});

Route::middleware(['auth','isAdmin'])->group(function(){
    Route::get('/dashboard','Admin\FrontEndController@index');
    // category routes
    Route::get('categories','Admin\CategoriesController@index');
    Route::get('addCategory','Admin\CategoriesController@create');
    Route::post('insertCategory','Admin\CategoriesController@store');
    Route::get('editCategory/{id}','Admin\CategoriesController@edit');
    Route::put('updateCategory/{id}','Admin\CategoriesController@update');
    Route::get('deleteCategory/{id}','Admin\CategoriesController@destroy');

    // product routes
    Route::get('products','Admin\ProductsController@index');
    Route::get('addProduct','Admin\ProductsController@create');
    Route::post('insertProduct','Admin\ProductsController@store');
    Route::get('editProduct/{id}','Admin\ProductsController@edit');
    Route::put('updateProduct/{id}','Admin\ProductsController@update');
    Route::get('deleteProduct/{id}','Admin\ProductsController@destroy');

    // orders routes
    Route::get('orders','Admin\OrderController@index');
    Route::get('admin/order_details/{id}','Admin\OrderController@view');
    Route::put('update_status/{id}','Admin\OrderController@update_status');
    // users
    Route::get('users','Admin\DashboardController@users');
    Route::get('view_user/{id}','Admin\DashboardController@view_user');
});
