<?php

use App\Http\Controllers\FacebookController;
use App\Http\Controllers\MotorwayVignetteController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RefuelingController;
use App\Http\Controllers\VehicleController;
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

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home')->middleware('auth');

Route::group(['middleware' => ['auth', 'verified']], function () {

	Route::get('table-list', function () {
		return view('pages.table_list');
	})->name('table');

	Route::get('notifications', function () {
		return view('pages.notifications');
	})->name('notifications');
});

Route::group(['middleware' => ['auth', 'verified']], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
    Route::put('profile/avatar', [ProfileController::class, 'avatar'])->name('profile.avatar');

    Route::resource('/vehicle', VehicleController::class);
    Route::resource('/refueling', RefuelingController::class);
    Route::resource('/motorwayVignette', MotorwayVignetteController::class);
});

Route::prefix('facebook')->name('facebook.')->group(function (){
    Route::get('auth', [FacebookController::class, 'loginUsingFacebook'])->name('login');
    Route::get('callback', [FacebookController::class, 'callbackFromFacebook'])->name('callback');
});
