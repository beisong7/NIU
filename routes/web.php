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


Route::get('auth/logout', 'LawyerController@logoutUser')->name('logout');

Route::post('authenticate/lawyer', 'AuthController@validateSystemAdmin')->name('lawyer.validate');
Route::post('check/lawyer', 'AuthController@passwordResetStart')->name('password.reset.start');
Route::post('update/lawyer/password', 'AuthController@passwordResetUpdate')->name('password.reset.update');


Route::get('/', 'HomeController@login')->name('home');
Route::get('/forgot-password', 'HomeController@resetPasswordStart')->name('password_reset.start');
Route::get('/password-reset/{secret}/lawyer', 'AuthController@resetPasswordPage')->name('password.reset.page');




//logged in lawyer routes
Route::group(['middleware'=>'valid_lawyer'], function () {

    Route::get('dashboard', 'LawyerController@dashboard')->name('dashboard');

    Route::get('lawyer/security', 'LawyerController@lawyerSecurity')->name('lawyer.security');

    Route::post('lawyer/change/password', 'AuthController@updateMyPassword')->name('lawyer.change.password');

});

Route::group(['middleware'=>'valid_admin'], function () {

    Route::prefix('admin')->group(function () {
        Route::get('submitted', 'LawyerController@submittedRequests')->name('lawyers.submitted');
        Route::get('dashboard', 'LawyerController@dashboard')->name('admin.dashboard');
    });

});








Route::get("/ldap/{username}/{password}", "LdapController@auth");