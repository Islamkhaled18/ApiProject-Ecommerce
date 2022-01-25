<?php

use App\Http\Controllers\Api\AboutUsController;
use App\Http\Controllers\Api\AdvertiseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ContactUsController;
use App\Http\Controllers\Api\MessageController;
use App\Http\Controllers\Api\PreventProductController;
use App\Http\Controllers\Api\SearchController;
use App\Http\Controllers\Api\ServiceController;

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




Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);

});

Route::post('forgot-password', [AuthController::class, 'forgotPassword']);
Route::post('reset-password', [AuthController::class, 'reset'])->name('password.reset');

///// Services /////
Route::get('/services',[ServiceController::class,'index']);
Route::get('/service/{id}',[ServiceController::class,'show']);
Route::post('/services',[ServiceController::class,'store']);
Route::post('/service/{id}',[ServiceController::class,'update']);
Route::post('/service/{id}',[ServiceController::class,'destroy']);
Route::post('/serviceComment',[ServiceController::class,'storeComment']); // save comment on service

//// Services ////////////

/// advertises ///
Route::group (['prefix'=>'advertises'], function()
{

    Route::get('/advertises',[AdvertiseController::class,'index']);
    Route::get('/advertise/{id}',[AdvertiseController::class,'show']);
    Route::post('/advertises',[AdvertiseController::class,'store']);
    Route::post('/advertise/{id}',[AdvertiseController::class,'update']);
    Route::post('/advertise/{id}',[AdvertiseController::class,'destroy']);

});
// advertises ///

// Search //
Route::get('/search/{advertise_model}',[SearchController::class,'index']);
// search //


/// aboutus ///
Route::group (['prefix'=>'aboutus'], function()
{

    Route::get('/aboutuss',[AboutUsController::class,'index']);
    Route::get('/aboutus/{id}',[AboutUsController::class,'show']);
    Route::post('/aboutuss',[AboutUsController::class,'store']);
    Route::post('/aboutus/{id}',[AboutUsController::class,'update']);
    Route::post('/aboutus/{id}',[AboutUsController::class,'destroy']);

});
// aboutus ///

/// aboutus ///
Route::group (['prefix'=>'preventproducts'], function()
{
    Route::get('/preventproducts',[PreventProductController::class,'index']);
    Route::get('/preventproduct/{id}',[PreventProductController::class,'show']);
    Route::post('/preventproducts',[PreventProductController::class,'store']);
    Route::post('/preventproduct/{id}',[PreventProductController::class,'update']);
    Route::post('/preventproduct/{id}',[PreventProductController::class,'destroy']);
});
// aboutus ///


/// contactus ///
Route::group (['prefix'=>'contactus'], function()
{
    Route::get('/contactuss',[ContactUsController::class,'index']);
    Route::get('/contactus/{id}',[ContactUsController::class,'show']);
    Route::post('/contactus',[ContactUsController::class,'store']);
    Route::post('/contactus/{id}',[ContactUsController::class,'destroy']);
});
// aboutus ///

/// Chat ///
Route::group (['prefix'=>'Chat'], function()
{
    Route::post('/Chat',[MessageController::class,'send']);
    Route::get('/Chat',[MessageController::class,'messages']);
});
// Chat ///