<?php

namespace App\Http\Controllers;

use App\Models\ManageEmployeeTypes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Validator;
use Session;


class ManageEmployeeTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::id();

        $list = ManageEmployeeTypes::where(['status' => 1])->get();

        return view('hrmodule.manageemployeetypes')->with([
            'listData' => $list,
            'pageTitle' => "Employee Types",
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
                'name' => 'required',
            ]);
            if ($validator->fails()) {
                $action = 'manageemployeetypes';
                return redirect('manageemployeetypes
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
                Session::flash('message', 'Employee Type  Updated Successfully.');
                ManageEmployeeTypes::where('id', $input['id'])->update($input);
            } else {
                unset($input['id']);
                $input['created_at'] = date("Y-m-d H:i:s");
                $input['updated_at'] = date("Y-m-d H:i:s");
                Session::flash('message', 'Employee Type Added Successfully.');
                ManageEmployeeTypes::insertGetId($input);
            }
            return redirect('/manageemployeetypes');

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ManageEmployeeTypes  $manageEmployeeTypes
     * @return \Illuminate\Http\Response
     */
    public function show(ManageEmployeeTypes $manageEmployeeTypes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ManageEmployeeTypes  $manageEmployeeTypes
     * @return \Illuminate\Http\Response
     */
    public function edit(ManageEmployeeTypes $manageEmployeeTypes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ManageEmployeeTypes  $manageEmployeeTypes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ManageEmployeeTypes $manageEmployeeTypes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ManageEmployeeTypes  $manageEmployeeTypes
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $skill = ManageEmployeeTypes::find($id);
        $skill->status = 0;
        $skill->updated_at = date('Y-m-d H:i:s');
        $skill->save();
        Session::flash('message', 'Employee Type deleted successfully');
        return redirect("/manageemployeetypes");
    }
    public static function routes()
    {
        Route::group(array('prefix' => 'manageemployeetypes'), function () {
            Route::get('/', array('as' => 'manageemployeetypes.index', 'uses' => 'ManageEmployeeTypesController@index'));
            Route::get('/add', array('as' => 'manageemployeetypes.create', 'uses' => 'ManageEmployeeTypesController@create'));
            Route::post('/save', array('as' => 'manageemployeetypes.save', 'uses' => 'ManageEmployeeTypesController@store'));
            Route::get('/edit/{id}', array('as' => 'manageemployeetypes.edit', 'uses' => 'ManageEmployeeTypesController@edit'));
            Route::post('/update/{id}', array('as' => 'manageemployeetypes.create', 'uses' => 'ManageEmployeeTypesController@create'));
            Route::get('/delete/{id}', array('as' => 'manageemployeetypes.destroy', 'uses' => 'ManageEmployeeTypesController@destroy'));
        });
    }
}
