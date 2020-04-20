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

Route::get('/', function () {

    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function(){

	Route::post('user/delete', 'UserController@delete');
	Route::get('user/datatables', 'UserController@datatables');
	Route::resource('user', 'UserController');

	Route::post('period/delete', 'PeriodController@delete');
	Route::get('period/datatables', 'PeriodController@datatables');
	Route::resource('period', 'PeriodController');


	Route::get('payroll/select2User', 'PayrollController@select2User');
	Route::get('payroll/select2Period', 'PayrollController@select2Period');
	Route::get('payroll/datatables', 'PayrollController@datatables');
	Route::resource('payroll', 'PayrollController');
	
});
