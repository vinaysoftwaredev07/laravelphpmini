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

Route::group(["middleware" => "auth"], function(){
    Route::get('/employees', 'EmployeeController@index');
    Route::get('/employee/edit/{id}', 'EmployeeController@edit');
    Route::post('/employee/edit/{id}', 'EmployeeController@edit');
    Route::get('/employee/add', 'EmployeeController@add');
    Route::post('/employee/add', 'EmployeeController@add');

    Route::get('/companies', 'CompanyController@index');
    Route::get('/company/edit/{id}', 'CompanyController@edit');
    Route::post('/company/edit/{id}', 'CompanyController@edit');
    Route::get('/company/add', 'CompanyController@add');
    Route::post('/company/add', 'CompanyController@add');
    Route::post('/company/fetch', 'CompanyController@fetch');

});

Route::post('/api/admin/access', 'CompanyController@accessToken');

Route::group(["middleware" => "jwtAuth"], function(){
    Route::post('/api/admin/profile', 'CompanyController@accessProfile');
});


Route::get('/email', function(){
    return view('emails.companies.companyCreated');
});


Route::group(["prefix" => "oauth"], function(){
    Route::get('/home', 'OAuthController@index');
});




