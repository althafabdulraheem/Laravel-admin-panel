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
    return view('index');
});

Route::post('authenticate-user',[App\Http\Controllers\LoginController::class,'authenticate'])->name('login');

Route::group(['middleware'=>'checkUser'],function(){

    //dasboard
    Route::get('dashboard',[App\Http\Controllers\HomeController::class,'index']);

    //logout
    Route::get('logout-user',[App\Http\Controllers\LoginController::class,'logout']);

    //user
    Route::resource('user','App\Http\Controllers\UserController')->middleware('checkUser');
    Route::get('fetch-user',[App\Http\Controllers\UserController::class,'fetchUser']);
    Route::get('enable-user',[App\Http\Controllers\UserController::class,'enableUser'])->name('enable');
    Route::get('disable-user',[App\Http\Controllers\UserController::class,'disableUser'])->name('disable');
    
    //product
    Route::resource('product','App\Http\Controllers\ProductController');
    Route::get('fetch-product',[App\Http\Controllers\ProductController::class,'fetchProduct']);
    
    //category
    Route::resource('category','App\Http\Controllers\CategoryController');
    Route::get('fetch-category',[App\Http\Controllers\CategoryController::class,'fetchCategory']);
});
