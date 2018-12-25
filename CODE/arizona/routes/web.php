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

// Project Routes
    \App\Http\Controllers\ProjectsController::routes();

// Departments Routes
    \App\Http\Controllers\DepartmentsController::routes();

//Stations Routes
    \App\Http\Controllers\StationsController::routes();

// Assignments
    \App\Http\Controllers\AssignmentsController::routes();

// Resignations
    \App\Http\Controllers\ResignationsController::routes();
});
