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

Route::prefix('/admin/administration')->middleware(['auth','RegisterAdminMenuServiceProvider','locale'])->group(function () {
    // role
    Route::get('/role','AdministrationController@rolePage')->name('roles.page');
    Route::post('/role-assign','AdministrationController@assignRole')->name('roles.store');
    Route::get('/role-edit/{id}','AdministrationController@roleEditPage')->name('roles.edit');

    // permission
    Route::get('/permission','AdministrationController@permissionPage')->name('permission.page');
    Route::get('/permission-edit/{id}','AdministrationController@permissionEditPage')->name('permission.edit');
    Route::post('/permission-assign','AdministrationController@assignPermission')->name('permission.store');

});
