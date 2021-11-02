<?php

use App\Http\Controllers\FacebookController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\MotorwayVignetteController;
use App\Http\Controllers\OtherCostsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RefuelingController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ServiceImagesController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\YearKMController;
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

Route::group(['middleware' => ['auth', 'verified']], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
    Route::put('profile/avatar', [ProfileController::class, 'avatar'])->name('profile.avatar');

    Route::resource('/vehicle', VehicleController::class);
    Route::resource('/refueling', RefuelingController::class);
    Route::resource('/motorwayVignette', MotorwayVignetteController::class);
    Route::resource("/yearkm", YearKMController::class);
    Route::resource('/services', ServiceController::class);
    Route::get('/services/gallery/{id}', [ServiceImagesController::class, 'viewServicePictures'])->name('serviceGallery');
    Route::post('/services/image/upload', [ServiceImagesController::class, 'imageUpload'])->name('serviceImageUpload');
    Route::delete('services/image/delete/{id}', [ServiceImagesController::class, 'deleteImage'])->name('deleteServiceImage');
    Route::resource("/otherCosts", OtherCostsController::class);

    //PDF-ek
    Route::post('/refueling/pdf', [RefuelingController::class, 'createPDF'])->name('refuelingPDF');
    Route::post('/motorwayVignette/pdf', [MotorwayVignetteController::class, 'createPDF'])->name('motorwayVignettePDF');
    Route::post('/yearkm/pdf', [YearKMController::class, 'createPDF'])->name('yearkmPDF');
    Route::post('/otherCosts/pdf', [OtherCostsController::class, 'createPDF'])->name('otherCostsPDF');
    Route::post('/services/pdf', [ServiceController::class, 'createPDF'])->name('servicesPDF');
});

//Social auth
Route::prefix('facebook')->name('facebook.')->group(function (){
    Route::get('auth', [FacebookController::class, 'loginUsingFacebook'])->name('login');
    Route::get('callback', [FacebookController::class, 'callbackFromFacebook'])->name('callback');
});

Route::prefix('google')->name('google.')->group(function (){
    Route::get('auth', [GoogleController::class, 'loginWithGoogle'])->name('login');
    Route::get('callback', [GoogleController::class, 'callbackFromGoogle'])->name('callback');
});
