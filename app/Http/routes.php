<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'HomeController@index');

//Public
Route::get('about','HomeController@getDocumentation');
Route::get('home', 'HomeController@index');
Route::get('check','HomeController@checkUser');
Route::get('/*','HomeController@getSuccess');


//Auths
Route::get('login','Auth\AuthController@Login');
Route::post('login','Auth\AuthController@postLogin');
Route::get('register','Auth\AuthController@register');
Route::post('register', 'Auth\AuthController@postRegister');
Route::get('logout','Auth\AuthController@getLogout');
Route::get('password','Auth\PasswordResetController@getPasswordReset');
Route::get('password','Auth\PasswordResetController@postPasswordReset');
Route::get('password\{token}','Auth\PasswordResetController@getPasswordResetForm');
Route::get('password\{token}','Auth\PasswordResetController@postPasswordResetForm');
Route::get('/social/redirect/{provider}', 'Auth\AuthController@Redirect');
Route::get('/social/handle/{provider}', 'Auth\AuthController@Callback');
Route::get('settings','SettingsController@getSettingsPage');

//Main Pages:Day, Week and Month

//Logs or Day
Route::get('day','LogController@index');
Route::post('addLog','LogController@addLog');
Route::get('dayBefore/{day}/{month}/{year}','LogController@showLogsBySpecificDate');
Route::get('dayAfter/{day}/{month}/{year}','LogController@showLogsBySpecificDate');
Route::get('targetDay/{day}/{month}/{year}','LogController@showLogsBySpecificDate');

//Lists or Week
Route::get('week','ListsController@index');
Route::get('weekBefore/{year}/{month}/{day}','ListsController@specificDatesOfWeek');
Route::get('weekAfter/{year}/{month}/{day}','ListsController@specificDatesOfWeek');
Route::post('addList','ListsController@addList');

//Month
Route::get('thisMonth','MonthController@index');
Route::get('beforeMonth/{monthBefore}/{beforeYear}','MonthController@getMonthMove');
Route::get('nextMonth/{monthAfter}/{afterYear}','MonthController@getMonthMove');
Route::post('searchMonth','MonthController@getSpecificDate');



//Admin
Route::get('adminHome','AdminController@index');