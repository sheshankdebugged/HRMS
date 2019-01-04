<?php

namespace App\Http\Controllers;

use App\Models\OnBoarding;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

class OnBoardingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::id();

        $list = OnBoarding::where(['status' => 1])->get();

        return view('hrmodule.onboarding.list')->with([
            'listData' => $list,
            'pageTitle' => "Onboarding",
            'title' => "Initiate Onboarding Process For"
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
     * @param  \App\Models\OnBoarding  $onBoarding
     * @return \Illuminate\Http\Response
     */
    public function show(OnBoarding $onBoarding)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OnBoarding  $onBoarding
     * @return \Illuminate\Http\Response
     */
    public function edit(OnBoarding $onBoarding)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OnBoarding  $onBoarding
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OnBoarding $onBoarding)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OnBoarding  $onBoarding
     * @return \Illuminate\Http\Response
     */
    public function destroy(OnBoarding $onBoarding)
    {
        //
    }
    public static function routes()
    {
        Route::group(array('prefix' => 'onboarding'), function () {
            Route::get('/', array('as' => 'onboarding.index', 'uses' => 'OnBoardingController@index'));
            Route::get('/add', array('as' => 'onboarding.create', 'uses' => 'OnBoardingController@create'));
            Route::post('/save', array('as' => 'onboarding.save', 'uses' => 'OnBoardingController@store'));
            Route::get('/edit/{id}', array('as' => 'onboarding.edit', 'uses' => 'OnBoardingController@edit'));
            Route::post('/update/{id}', array('as' => 'onboarding.create', 'uses' => 'OnBoardingController@create'));
            Route::get('/delete/{id}', array('as' => 'onboarding.destroy', 'uses' => 'OnBoardingController@destroy'));
        });
    }
}
