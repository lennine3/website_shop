<?php
use Illuminate\Support\Facades\Route;
use Modules\User\Http\Controllers\UserController;
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

Route::prefix('/admin/users')->middleware(['auth','RegisterAdminMenuServiceProvider','locale'])->group(function () {
    Route::get('/list', 'UserController@index')->name('users.index');
    // Route::get('/setting/{id}','UserController@userSetting')->name('users.setting');
    Route::get('/setting/{user}', [UserController::class, 'userSetting'])->name('users.setting');
    Route::post('setting/{user}/process',[UserController::class, 'userSettingProcess'])->name('users.setting.process');
    Route::post('setting/{user}/password/process/',[UserController::class, 'userSettingPasswordProcess'])->name('users.setting.password.process');
    Route::post('/setting/{userId}/permissions/{permissionId}',[UserController::class, 'assignPermission'])->name('users.setting.permission.process');
});
