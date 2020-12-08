<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# About This Laravel Project:  
 
* php artisan --version 
=> Laravel Framework 8.14

This is a simple application that allows administators to perform C.R.U.D operations on products.
In this project it is only about selling books where each of them is composed of: <br>
 An id | A name | A price | A product image.

* Administrators must first register in order to get access and then perform C.R.U.D operations. 
   
## This project uses the following external libraries/packages: 

* https://github.com/CodeSeven/toastr => Toastr for displaying session messages. 

For the product cart: 

* https://github.com/hardevine/LaravelShoppingcart => Maintainted forks.

* https://stripe.com/ => Stripe API which provides an easy way to make paiments.

Websites Routes:

* php artisan route:list



| Domain | Method    | URI                                   | Name               | Action                                                                 | Middleware |
|--------|-----------|---------------------------------------|--------------------|------------------------------------------------------------------------|------------|
|        | GET|HEAD  | /                                     | index              | App\Http\Controllers\FrontEndController@index                          | web        |
|        | GET|HEAD  | api/user                              |                    | Closure                                                                | api        |
|        |           |                                       |                    |                                                                        | auth:api   |
|        | GET|HEAD  | cart                                  | cart               | App\Http\Controllers\shoppingController@cart                           | web        |
|        | POST      | cart/add/{product_M}                  | cart.add           | App\Http\Controllers\shoppingController@add_to_cart                    | web        |
|        | GET|HEAD  | cart/add/{product_M}                  | cart.rapid-add     | App\Http\Controllers\shoppingController@cart_rapid_add                 | web        |
|        | GET|HEAD  | cart/checkout                         | cart.checkout      | App\Http\Controllers\CheckoutController@index                          | web        |
|        | POST      | cart/checkout/payment                 | cart.pay           | App\Http\Controllers\CheckoutController@store                          | web        |
|        | GET|HEAD  | cart/checkout/payment/successful      | payment.successful | App\Http\Controllers\CheckoutController@successfulPayment              | web        |
|        | GET|HEAD  | cart/decrement/{productId}/{quantity} | cart.decrement     | App\Http\Controllers\shoppingController@cart_decrement                 | web        |
|        | GET|HEAD  | cart/increment/{productId}/{quantity} | cart.increment     | App\Http\Controllers\shoppingController@cart_increment                 | web        |
|        | GET|HEAD  | cart/{id}                             | cart.delete        | App\Http\Controllers\shoppingController@cart_delete                    | web        |
|        | GET|HEAD  | home                                  | home               | App\Http\Controllers\HomeController@index                              | web        |
|        |           |                                       |                    |                                                                        | auth       |
|        | GET|HEAD  | login                                 | login              | App\Http\Controllers\Auth\LoginController@showLoginForm                | web        |
|        |           |                                       |                    |                                                                        | guest      |
|        | POST      | login                                 |                    | App\Http\Controllers\Auth\LoginController@login                        | web        |
|        |           |                                       |                    |                                                                        | guest      |
|        | POST      | logout                                | logout             | App\Http\Controllers\Auth\LoginController@logout                       | web        |
|        | POST      | password/confirm                      |                    | App\Http\Controllers\Auth\ConfirmPasswordController@confirm            | web        |
|        |           |                                       |                    |                                                                        | auth       |
|        | GET|HEAD  | password/confirm                      | password.confirm   | App\Http\Controllers\Auth\ConfirmPasswordController@showConfirmForm    | web        |
|        |           |                                       |                    |                                                                        | auth       |
|        | POST      | password/email                        | password.email     | App\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail  | web        |
|        | POST      | password/reset                        | password.update    | App\Http\Controllers\Auth\ResetPasswordController@reset                | web        |
|        | GET|HEAD  | password/reset                        | password.request   | App\Http\Controllers\Auth\ForgotPasswordController@showLinkRequestForm | web        |
|        | GET|HEAD  | password/reset/{token}                | password.reset     | App\Http\Controllers\Auth\ResetPasswordController@showResetForm        | web        |
|        | GET|HEAD  | product/{product_M}                   | product.single     | App\Http\Controllers\FrontEndController@singleProduct                  | web        |
|        | GET|HEAD  | products                              | products.index     | App\Http\Controllers\ProductsController@index                          | web        |
|        | POST      | products                              | products.store     | App\Http\Controllers\ProductsController@store                          | web        |
|        | GET|HEAD  | products/create                       | products.create    | App\Http\Controllers\ProductsController@create                         | web        |
|        | DELETE    | products/{product_M}                  | products.destroy   | App\Http\Controllers\ProductsController@destroy                        | web        |
|        | PUT|PATCH | products/{product_M}                  | products.update    | App\Http\Controllers\ProductsController@update                         | web        |
|        | GET|HEAD  | products/{product_M}                  | products.show      | App\Http\Controllers\ProductsController@show                           | web        |
|        | GET|HEAD  | products/{product_M}/edit             | products.edit      | App\Http\Controllers\ProductsController@edit                           | web        |
|        | GET|HEAD  | register                              | register           | App\Http\Controllers\Auth\RegisterController@showRegistrationForm      | web        |
|        |           |                                       |                    |                                                                        | guest      |
|        | POST      | register                              |                    | App\Http\Controllers\Auth\RegisterController@register                  | web        |
|        |           |                                       |                    |                                                                        | guest      |
