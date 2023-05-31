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


Route::prefix('/admin/product')->middleware(['auth','RegisterAdminMenuServiceProvider','locale'])->group(function () {
    Route::get('/category', 'ProductController@index')->name('product.category.index');
    Route::get('/category/create','ProductController@create')->name('product.category.create');
    Route::get('/category/{product_cate}/edit','ProductController@edit')->name('product.category.edit');
    Route::post('/category/process','ProductController@categoryProcess')->name('product.category.process');

    Route::get('/','ProductController@productCreate')->name('product.create');
    Route::post('/process','ProductController@productProcess')->name('product.process');
    Route::post('/child/process','ProductController@productChildProcess')->name('product.child.process');
    Route::get('/child/{product}/edit','ProductController@productChildEdit')->name('product.edit');
    Route::get('/{product}/edit','ProductController@productEdit')->name('product.edit');
});

Route::prefix('/admin/feature')->middleware(['auth','RegisterAdminMenuServiceProvider','locale'])->group(function () {
    Route::get('/', 'FeatureController@index')->name('product.feature.index');
    Route::get('/create','FeatureController@create')->name('product.feature.create');
    Route::post('/process','FeatureController@featureProcess')->name('product.feature.process');
    Route::get('/{feature}/edit','FeatureController@edit')->name('product.feature.edit');
});
