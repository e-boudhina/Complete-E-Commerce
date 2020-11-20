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

Route::get('/', 'FrontEndController@index')->name('index');
Route::get('/product/{product_M}', 'FrontEndController@singleProduct')->name('product.single');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
//since we changed the model name then we need to change the default parameter name | the paramter names by convention always start with lower case then it depends
//_ if the second word follows the name of your model
Route::resource('/products', 'ProductsController',['parameters' => ['products'=>'product_M']]);

//Checkout
Route::get('/cart/checkout', 'shoppingController@cart_checkout')->name('cart.checkout');

//Add to cart
Route::post('/cart/add/{product_M}', 'shoppingController@add_to_cart', ['parameters' => ['products'=>'product_M']])->name('cart.add');
Route::get('/cart', 'shoppingController@cart')->name('cart');
Route::get('/cart/{id}', 'shoppingController@cart_delete')->name('cart.delete');

// Adding and reducing quantity
Route::get('/cart/increment/{productId}/{quantity}', 'shoppingController@cart_increment')->name('cart.increment');
Route::get('/cart/decrement/{productId}/{quantity}', 'shoppingController@cart_decrement')->name('cart.decrement');
//Home add to cart route
Route::get('/cart/add/{product_M}', 'shoppingController@cart_rapid_add', ['parameters' => ['products'=>'product_M']])->name('cart.rapid-add');


