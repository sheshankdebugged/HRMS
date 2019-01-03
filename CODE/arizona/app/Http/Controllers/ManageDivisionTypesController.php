<?php

namespace App\Http\Controllers;

use App\Models\ManageDivisionTypes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Validator;
use Session;

class ManageDivisionTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::id();

        $list = ManageDivisionTypes::where(['status' => 1])->get();

        return view('hrmodule.managedivisiontypes')->with([
            'listData' => $list,
            'pageTitle' => "Division Types",
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
                'division_name' => 'required',
            ]);
            if ($validator->fails()) {
                $action = 'managedivisiontypes';
                return redirect('managedivisiontypes
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
                Session::flash('message', 'Division Type Updated Successfully.');
                ManageDivisionTypes::where('id', $input['id'])->update($input);
            } else {
                unset($input['id']);
                $input['created_at'] = date("Y-m-d H:i:s");
                $input['updated_at'] = date("Y-m-d H:i:s");
                Session::flash('message', 'Division Type Added Successfully.');
                ManageDivisionTypes::insertGetId($input);
            }
            return redirect('/managedivisiontypes');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ManageDivisionTypes  $manageDivisionTypes
     * @return \Illuminate\Http\Response
     */
    public function show(ManageDivisionTypes $manageDivisionTypes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ManageDivisionTypes  $manageDivisionTypes
     * @return \Illuminate\Http\Response
     */
    public function edit(ManageDivisionTypes $manageDivisionTypes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ManageDivisionTypes  $manageDivisionTypes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ManageDivisionTypes $manageDivisionTypes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ManageDivisionTypes  $manageDivisionTypes
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $skill = ManageDivisionTypes::find($id);
        $skill->status = 0;
        $skill->updated_at = date('Y-m-d H:i:s');
        $skill->save();
        Session::flash('message', 'Division Type deleted successfully');
        return redirect("/managedivisiontypes");
    }
    public static function routes()
    {
        Route::group(array('prefix' => 'managedivisiontypes'), function () {
            Route::get('/', array('as' => 'managedivisiontypes.index', 'uses' => 'ManageDivisionTypesController@index'));
            Route::get('/add', array('as' => 'managedivisiontypes.create', 'uses' => 'ManageDivisionTypesController@create'));
            Route::post('/save', array('as' => 'managedivisiontypes.save', 'uses' => 'ManageDivisionTypesController@store'));
            Route::get('/edit/{id}', array('as' => 'managedivisiontypes.edit', 'uses' => 'ManageDivisionTypesController@edit'));
            Route::post('/update/{id}', array('as' => 'managedivisiontypes.create', 'uses' => 'ManageDivisionTypesController@create'));
            Route::get('/delete/{id}', array('as' => 'managedivisiontypes.destroy', 'uses' => 'ManageDivisionTypesController@destroy'));
        });
    }
}
