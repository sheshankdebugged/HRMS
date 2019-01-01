<?php

namespace App\Http\Controllers;

use App\Models\HRReports;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


class HRReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::id();
        $list =HRReports::where(['user_id'=>$user_id])->paginate(10);
        return view('hrmodule.hrreports')->with([
            'listData' => $list,
            'pageTitle' => "HR Reports",
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HRReports  $hRReports
     * @return \Illuminate\Http\Response
     */
    public function show(HRReports $hRReports)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HRReports  $hRReports
     * @return \Illuminate\Http\Response
     */
    public function edit(HRReports $hRReports)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HRReports  $hRReports
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HRReports $hRReports)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HRReports  $hRReports
     * @return \Illuminate\Http\Response
     */
    public function destroy(HRReports $hRReports)
    {
        //
    }
    public static function routes()
    {
        Route::group(array('prefix' => 'hrreports'), function () {
            Route::get('/', array('as' => 'hrreports.index', 'uses' => 'HRReportsController@index'));
            Route::get('/add', array('as' => 'hrreports.create', 'uses' => 'HRReportsController@create'));
            Route::post('/save', array('as' => 'hrreports.save', 'uses' => 'HRReportsController@store'));
            Route::get('/edit/{id}', array('as' => 'hrreports.edit', 'uses' => 'HRReportsController@edit'));
            Route::post('/update/{id}', array('as' => 'hrreports.create', 'uses' => 'HRReportsController@create'));
            Route::get('/delete/{id}', array('as' => 'hrreports.destroy', 'uses' => 'HRReportsController@destroy'));
        });

    }
}
