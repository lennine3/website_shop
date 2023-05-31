<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\HomeController;
use App\Http\Controllers\AjaxHomeController;
use Illuminate\Support\Facades\Auth;

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
// Auth route
Auth::routes();
Route::get('/logout', function () {
    Auth::logout();
    return redirect('/');
});



Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'home')->name('home');
    Route::post('/process-contact', 'processContact')->name('home.process.contact');
    Route::get('/clear-cache', 'clearCache')->name('home.clear-cache');
    Route::get('/{alias}','handleURL')->name('slug');
    // Language
    Route::get('/change-language/{language}', 'changeLanguage')->name('home.change-language');
});
