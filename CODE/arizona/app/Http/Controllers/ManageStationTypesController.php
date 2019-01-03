<?php

namespace App\Http\Controllers;

use App\Models\ManageStationTypes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Validator;
use Session;

class ManageStationTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::id();

        $list = ManageStationTypes::where(['status' => 1])->get();

        return view('hrmodule.managestationtypes')->with([
            'listData' => $list,
            'pageTitle' => "Station Types",
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
        if ($request->all()) {
            $validator = Validator::make($request->all(), [
                'station_type_name' => 'required',
            ]);
            if ($validator->fails()) {
                $action = 'managestationtypes';
                return redirect('managestationtypes
                ')
                    ->withErrors($validator)
                    ->withInput()
                    ->with([
                        'action' => $action,
                    ]);
            }

            $input = $request->all();

            // echo "<pre>";
            // print_r($input); die;

            $input['status'] = 1;
            $input['user_id'] = Auth::id();

            unset($input['_token']);
            if ($input['id'] > 0) {
                $input['updated_at'] = date("Y-m-d H:i:s");
                Session::flash('message', 'Station Type  Updated Successfully.');
                ManageStationTypes::where('id', $input['id'])->update($input);
            } else {
                unset($input['id']);
                $input['created_at'] = date("Y-m-d H:i:s");
                $input['updated_at'] = date("Y-m-d H:i:s");
                Session::flash('message', 'Station Type Added Successfully.');
                ManageStationTypes::insertGetId($input);
            }
            return redirect('/managestationtypes');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ManageStationTypes  $manageStationTypes
     * @return \Illuminate\Http\Response
     */
    public function show(ManageStationTypes $manageStationTypes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ManageStationTypes  $manageStationTypes
     * @return \Illuminate\Http\Response
     */
    public function edit(ManageStationTypes $manageStationTypes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ManageStationTypes  $manageStationTypes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ManageStationTypes $manageStationTypes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ManageStationTypes  $manageStationTypes
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $stationtypes = ManageStationTypes::find($id);
        $stationtypes->status = 0;
        $stationtypes->updated_at = date('Y-m-d H:i:s');
        $stationtypes->save();
        Session::flash('message', 'Station Type deleted successfully');
        return redirect("/managestationtypes");
    }
    public static function routes()
    {
        Route::group(array('prefix' => 'managestationtypes'), function () {
            Route::get('/', array('as' => 'managestationtypes.index', 'uses' => 'ManageStationTypesController@index'));
            Route::get('/add', array('as' => 'managestationtypes.create', 'uses' => 'ManageStationTypesController@create'));
            Route::post('/save', array('as' => 'managestationtypes.save', 'uses' => 'ManageStationTypesController@store'));
            Route::get('/edit/{id}', array('as' => 'managestationtypes.edit', 'uses' => 'ManageStationTypesController@edit'));
            Route::post('/update/{id}', array('as' => 'managestationtypes.create', 'uses' => 'ManageStationTypesController@create'));
            Route::get('/delete/{id}', array('as' => 'managestationtypes.destroy', 'uses' => 'ManageStationTypesController@destroy'));
        });
    }
}
