<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});


//user related route
Route::resource('users','Api\User\UserController');
Route::get('users/verify/{token}', 'Api\User\UserController@verify')->name('create.user.activation');

//buyer related route
Route::resource('buyers', 'Api\Buyer\BuyerController', ['only' => ['index', 'show']]);
Route::resource('buyers.products', 'Api\Buyer\BuyerProductController', ['only' => ['index']]);
Route::resource('buyers.categories', 'Api\Buyer\BuyerCategoryController', ['only' => ['index']]);
Route::resource('buyers.sellers', 'Api\Buyer\BuyerSellerController', ['only' => ['index']]);

//seller related route
Route::resource('sellers', 'Api\Seller\SellerController', ['only' => ['index', 'show']]);
Route::resource('sellers.products', 'Api\Seller\SellerProductController', ['only' => ['index']]);
Route::resource('sellers.categories', 'Api\Seller\SellerCategoryController', ['only' => ['index']]);
Route::resource('sellers.buyers', 'Api\Seller\SellerBuyerController', ['only' => ['index']]);

//product related route
Route::resource('products', 'Api\Product\ProductController', ['only' => ['index', 'show']]);

//category related route
Route::resource('categories', 'Api\Category\CategoryController', ['only' => ['index', 'show']]);
Route::resource('categories.products', 'Api\Category\CategoryProductController', ['only' => ['index']]);
Route::resource('categories.sellers', 'Api\Category\CategorySellerController', ['only' => ['index']]);
Route::resource('categories.buyers', 'Api\Category\CategoryBuyerController', ['only' => ['index']]);

//transaction related route
Route::resource('transactions', 'Api\Transaction\TransactionController', ['only' => ['index', 'show']]);