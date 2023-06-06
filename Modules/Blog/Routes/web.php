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

Route::prefix('/admin/blog')->middleware(['auth','RegisterAdminMenuServiceProvider','locale'])->group(function () {
    Route::get('/', 'BlogController@index')->name('blog.index');
    Route::get('/create', 'BlogController@create')->name('blog.create');
    Route::get('/{blog}/edit', 'BlogController@edit')->name('blog.edit');
    Route::post('/process','BlogController@store')->name('blog.store');
    Route::get('/search', 'BlogController@blogSearch')->name('blog.search');
    Route::get('/category', 'BlogController@blogCategory')->name('blog.category.index');
    Route::get('/category/create','BlogController@blogCategoryDetail')->name('admin.blog.category.create');
    Route::get('/category/{blogCategory}/edit','BlogController@blogCategoryDetailEdit')->name('admin.blog.category.edit');
    Route::post('/category/process','BlogController@blogCategoryProcess')->name('admin.blog.category.process');
});
