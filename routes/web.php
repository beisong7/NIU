<?php

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


Route::get('auth/logout', 'AdminController@logoutUser')->name('logout');

Route::post('authenticate/admin', 'AuthController@validateSystemAdmin')->name('admin.validate');
Route::post('check/admin', 'AuthController@passwordResetStart')->name('password.reset.start');
Route::post('update/admin/password', 'AuthController@passwordResetUpdate')->name('password.reset.update');

Route::post('register/mobile', 'RegisterController@mobileReg');

Route::get('/', 'HomeController@login')->name('home');
Route::get('/forgot-password', 'HomeController@resetPasswordStart')->name('password_reset.start');
Route::get('/password-reset/{secret}/admin', 'AuthController@resetPasswordPage')->name('password.reset.page');

Route::group(['middleware'=>'admin_ware'], function () {

    Route::prefix('admin')->group(function () {
        Route::get('dashboard', 'AdminController@dashboard')->name('admin.dashboard');
        Route::get('create/user', 'AdminController@createUserPage')->name('create.user');
        Route::post('create/user', 'RegisterController@createUser')->name('create.user');
        Route::get('users', 'AdminController@users')->name('users');
    });

});
