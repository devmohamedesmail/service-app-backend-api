<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api_controllers\AdsController;
use App\Http\Controllers\api_controllers\AdtypeController;
use App\Http\Controllers\api_controllers\ArticlesController;
use App\Http\Controllers\api_controllers\CategoryController;
use App\Http\Controllers\api_controllers\ChatController;
use App\Http\Controllers\api_controllers\CountryController;
use App\Http\Controllers\api_controllers\PortfolioController;
use App\Http\Controllers\api_controllers\StoriesController;
use App\Http\Controllers\api_controllers\UserController;
use App\Http\Controllers\AuthController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


//  ********************* Categories Controller ****************** 
Route::controller(CategoryController::class)->group(function () {
    Route::get('/show/categories', 'show_categories');
    Route::post('/add/categories', 'add_category');
    Route::post('/update/categories/{id}', 'update_category');
    Route::get('/delete/categories/{id}', 'delete_category');
});



// ********************** ads controller ***********************
Route::controller(AdsController::class)->group(function () {
    Route::get('/show/ads', 'show_ads');
    Route::post('/add/ads', 'add_ads');
    Route::post('/update/ad/{id}', 'update_ad');
    Route::get('/delete/ad/{id}', 'delete_ad');
});


// ********************** portfolio controller ***********************
Route::controller(PortfolioController::class)->group(function () {
    Route::post('/add/portfolio', 'add_portfolio');
    Route::get('/show/portfolio/{id}', 'show_user_portfolio');
    Route::post('/update/portfolio/{id}', 'update_user_portfolio');
    Route::get('/delete/portfolio/{id}', 'delete_user_portfolio');
    Route::get('/show/portfolios/data', 'show_portfolios_data');
});



// ********************** user controller ***********************
Route::controller(AuthController::class)->group(function () {
    Route::post('register', 'register');
    Route::post('login', 'login');
    Route::post('logout', 'logout');
});


// ********************** user controller ***********************
Route::controller(UserController::class)->group(function () {
   Route::get('/show/user/{id}', 'show_user');
   Route::get('/show/users', 'show_users');
   Route::post('/update/user/{id}', 'update_user');
   Route::get('/delete/user/{id}', 'delete_user');

});

// ********************** Stories controller ***********************
Route::controller(StoriesController::class)->group(function () {
   Route::post('/add/story/{id}', 'add_user_story');
   Route::get('/show/stories/data', 'show_stories_data');
   Route::get('/delete/story/{id}', 'delete_user_story');
 });



 Route::controller(CountryController::class)->group(function(){
    Route::get('/add/country', 'add_country');
    Route::get('/delete/country/{id}', 'delete_country');
    Route::get('/update/country/{id}', 'update_country');
    Route::get('/show/countries', 'show_countries');
 });


 Route::controller(AdtypeController::class)->group(function () {
    Route::get('/add/adtype', 'add_adtype');
    Route::get('/delete/adtype/{id}', 'delete_adtype');
    Route::get('/show/adtypes', 'show_adtypes');
    Route::post('/update/adtype/{id}', 'update_adtype');
 });

 Route::controller(ArticlesController::class)->group(function () {
    Route::get('/add/article', 'add_article');
    Route::get('/show/articles', 'show_articles');
    Route::post('/update/article/{id}', 'update_article');
    Route::get('/delete/article/{id}', 'delete_article');
 });



 Route::controller(ChatController::class)->group(function () {
    Route::post('send-message',  'sendMessage');
    Route::get('get-messages', 'getMessages');
 });