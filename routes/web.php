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
Route::post('login/mobile', 'AuthController@mobileLogin');

Route::get('/', 'HomeController@login')->name('home');
Route::get('/forgot-password', 'HomeController@resetPasswordStart')->name('password_reset.start');
Route::get('/password-reset/{secret}/admin', 'AuthController@resetPasswordPage')->name('password.reset.page');

Route::group(['middleware'=>'admin_ware'], function () {

    Route::prefix('admin')->group(function () {
        Route::get('dashboard', 'AdminController@dashboard')->name('admin.dashboard');
        Route::get('create/user', 'AdminController@createUserPage')->name('create.user');
        Route::get('preview/user', 'AdminController@previewUserPage')->name('preview.user');
        Route::post('create/user', 'RegisterController@createUser')->name('create.user');
        Route::get('edit/user/{id}', 'AdminController@editUserPage')->name('edit.user');
        Route::post('edit/user/{id}', 'RegisterController@updateUser')->name('update.user');
        Route::get('accounts', 'AdminController@users')->name('users');
        Route::get('my-clients', 'AdminController@myClients')->name('users.my');
        Route::get('reports', 'ReportController@index')->name('reports');
        Route::get('accounts/summary/{year}', 'ReportController@summary')->name('accounts.summary');
        Route::get('accounts/financial/{year}/{end}', 'ReportController@financial')->name('accounts.financial');
        Route::get('accounts/update/financial', 'ReportController@financialUpdate')->name('accounts.update.financial');
    });

});


Route::get('/date', function(){
    return [
        date('Y-m-d h:i:s', strtotime('today')),
        date('m'),
        date('H', time()),
        date('Y-m-d h:i:s', time()),
        date('2020-06-07 06:56:21', time()),
    ];
});

Route::get('inspire', function (){
   return \Illuminate\Foundation\Inspiring::quote();
});
