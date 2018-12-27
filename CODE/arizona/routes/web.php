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


//Stations Routes
    \App\Http\Controllers\StationsController::routes();

// Assignments
    \App\Http\Controllers\AssignmentsController::routes();

// Resignations
    \App\Http\Controllers\ResignationsController::routes();

// Polls
    \App\Http\Controllers\PollsController::routes();

//OrganizationNews Routes
    \App\Http\Controllers\OrganizationNewsController::routes();

// job Routes
    \App\Http\Controllers\JobRequestsController::routes();
    
// jobrequests Routes
    \App\Http\Controllers\JobRequestsController::routes();

// JobTests Routes
    \App\Http\Controllers\JobTestsController::routes();
    
// JobInterviews Routes
    \App\Http\Controllers\JobInterviewsController::routes();

// Contracts Routes
    \App\Http\Controllers\ContractsController::routes();

 // Transfers Routes
     \App\Http\Controllers\TransfersController::routes();

 // Employees Exit
     \App\Http\Controllers\EmployeesexitController::routes();

// Travels
     \App\Http\Controllers\TravelsController::routes();

// Warnings
     \App\Http\Controllers\WarningsController::routes();

// Achievements
     \App\Http\Controllers\AchievementsController::routes();

     // Polls Routes
     \App\Http\Controllers\PollsController::routes();

     // Achievements Routes
     \App\Http\Controllers\AchievementsController::routes();

     // Promotions Routes
     \App\Http\Controllers\PromotionsController::routes();

     // Complaints Routes
     \App\Http\Controllers\ComplaintsController::routes();

     // Memos Routes
     \App\Http\Controllers\MemosController::routes();

      // Terminations Routes
      \App\Http\Controllers\TerminationsController::routes();

      // Worksheet Routes
      \App\Http\Controllers\WorksheetController::routes();

      // Workshifts Routes
      \App\Http\Controllers\WorkshiftsController::routes();

       // Holidays Routes
       \App\Http\Controllers\HolidaysController::routes();
});
