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


Route::get('/setting', function () {
    return view('hrmodule.setting');
});





Auth::routes();

Route::group(['middleware' => 'auth'], function () {

    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

// Companies Routes
    \App\Http\Controllers\CompaniesController::routes();

// Employees Routes
    \App\Http\Controllers\EmployeesController::routes();

// JobPosts Routes
    \App\Http\Controllers\JobPostsController::routes();

// Project Routes
    \App\Http\Controllers\ProjectsController::routes();

// Departments Routes
    \App\Http\Controllers\DepartmentsController::routes();

// Departments Routes
    \App\Http\Controllers\DepartmentsController::routes();

//Stations Routes
    \App\Http\Controllers\StationsController::routes();

// Assignments
    \App\Http\Controllers\AssignmentsController::routes();

// Resignations
    \App\Http\Controllers\ResignationsController::routes();
//OrganizationNews Routes
    \App\Http\Controllers\OrganizationNewsController::routes();
    // job Routes
    
	\App\Http\Controllers\JobRequestsController::routes();

    
    // Contracts Routes
    \App\Http\Controllers\contractsController::routes();

     // Transfers Routes
     \App\Http\Controllers\transfersController::routes();

     // Polls Routes
     \App\Http\Controllers\pollsController::routes();

     // Achievements Routes
     \App\Http\Controllers\achievementsController::routes();

     // Promotions Routes
     \App\Http\Controllers\promotionsController::routes();

     // Complaints Routes
     \App\Http\Controllers\complaintsController::routes();
});
