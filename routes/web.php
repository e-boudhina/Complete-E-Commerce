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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
//since we changed the model name then we need to change the default parameter name | the paramter names by convention always start with lower case then it depends
//_ if the second word follows the name of your model
Route::resource('/products', 'ProductsController',['parameters' => ['products'=>'product_M']]);
