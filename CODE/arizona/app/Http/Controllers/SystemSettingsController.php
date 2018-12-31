<?php

namespace App\Http\Controllers;

use App\Models\SystemSettings;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SystemSettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
  
    public function index()
    {

        $user_id = Auth::id();

        $list =SystemSettings::where(['user_id'=>$user_id])->paginate(10);
        // $list = complaints::where(['status' => 1])->paginate(10);
        return view('hrmodule.setting')->with([
            'listData' => $list,
            'pageTitle' => "System Settings",
        ]);
        //return view('hrmodule.setting');
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
     * @param  \App\Models\SystemSettings  $systemSettings
     * @return \Illuminate\Http\Response
     */
    public function show(SystemSettings $systemSettings)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SystemSettings  $systemSettings
     * @return \Illuminate\Http\Response
     */
    public function edit(SystemSettings $systemSettings)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SystemSettings  $systemSettings
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SystemSettings $systemSettings)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SystemSettings  $systemSettings
     * @return \Illuminate\Http\Response
     */
    public function destroy(SystemSettings $systemSettings)
    {
        //
    }
}
