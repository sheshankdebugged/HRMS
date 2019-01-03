<?php

namespace App\Http\Controllers;

use App\Models\ManageInsuranceTypes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Validator;
use Session;

class ManageInsuranceTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::id();

        $list = ManageInsuranceTypes::where(['status' => 1])->get();

        return view('hrmodule.manageinsurancetypes')->with([
            'listData' => $list,
            'pageTitle' => "Insurance Types",
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
                'insurance_title' => 'required',
            ]);
            if ($validator->fails()) {
                $action = 'manageinsurancetypes';
                return redirect('manageinsurancetypes
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
                Session::flash('message', 'Insurance Type  Updated Successfully.');
                ManageInsuranceTypes::where('id', $input['id'])->update($input);
            } else {
                unset($input['id']);
                $input['created_at'] = date("Y-m-d H:i:s");
                $input['updated_at'] = date("Y-m-d H:i:s");
                Session::flash('message', 'Insurance Type Added Successfully.');
                ManageInsuranceTypes::insertGetId($input);
            }
            return redirect('/manageinsurancetypes');

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ManageInsuranceTypes  $manageInsuranceTypes
     * @return \Illuminate\Http\Response
     */
    public function show(ManageInsuranceTypes $manageInsuranceTypes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ManageInsuranceTypes  $manageInsuranceTypes
     * @return \Illuminate\Http\Response
     */
    public function edit(ManageInsuranceTypes $manageInsuranceTypes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ManageInsuranceTypes  $manageInsuranceTypes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ManageInsuranceTypes $manageInsuranceTypes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ManageInsuranceTypes  $manageInsuranceTypes
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $skill = ManageInsuranceTypes::find($id);
        $skill->status = 0;
        $skill->updated_at = date('Y-m-d H:i:s');
        $skill->save();
        Session::flash('message', 'Insurance Type deleted successfully');
        return redirect("/manageinsurancetypes");
    }
    public static function routes()
    {
        Route::group(array('prefix' => 'manageinsurancetypes'), function () {
            Route::get('/', array('as' => 'manageinsurancetypes.index', 'uses' => 'ManageInsuranceTypesController@index'));
            Route::get('/add', array('as' => 'manageinsurancetypes.create', 'uses' => 'ManageInsuranceTypesController@create'));
            Route::post('/save', array('as' => 'manageinsurancetypes.save', 'uses' => 'ManageInsuranceTypesController@store'));
            Route::get('/edit/{id}', array('as' => 'manageinsurancetypes.edit', 'uses' => 'ManageInsuranceTypesController@edit'));
            Route::post('/update/{id}', array('as' => 'manageinsurancetypes.create', 'uses' => 'ManageInsuranceTypesController@create'));
            Route::get('/delete/{id}', array('as' => 'manageinsurancetypes.destroy', 'uses' => 'ManageInsuranceTypesController@destroy'));
        });
    }
}
