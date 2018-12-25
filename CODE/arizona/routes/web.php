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
    return view('home.login');
});



Auth::routes();

Route::group(['middleware' => 'auth'], function () {

    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');


    Route::get('/companies', 'CompaniesController@index');
    Route::get('/addcompanies', 'CompaniesController@create');
    Route::post('/savecompanies', 'CompaniesController@store');
    Route::get('/companies/edit/{id}', 'CompaniesController@edit');
    Route::post('/companies/update/{id}', 'CompaniesController@update');
    Route::get('/companies/delete/{id}', 'CompaniesController@destroy');

// Employees Routes
    \App\Http\Controllers\EmployeesController::routes();

// JobPosts Routes
    \App\Http\Controllers\JobPostsController::routes();

    Route::get('/departments', 'DepartmentsController@index');
    Route::get('/adddepartments', 'DepartmentsController@create');
    Route::post('/savedepartments', 'DepartmentsController@store');
    Route::get('/departments/edit/{id}', 'DepartmentsController@edit');
    Route::post('/departments/update/{id}', 'DepartmentsController@update');
    Route::get('/departments/delete/{id}', 'DepartmentsController@destroy');


    Route::get('/stations', 'StationsController@index');
    Route::get('/addstations', 'StationsController@create');
    Route::post('/savestations', 'StationsController@store');
    Route::get('/stations/edit/{id}', 'StationsController@edit');
    Route::post('/stations/update/{id}', 'StationsController@update');
    Route::get('/stations/delete/{id}', 'StationsController@destroy');


});
