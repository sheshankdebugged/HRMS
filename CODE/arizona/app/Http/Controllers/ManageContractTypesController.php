<?php

namespace App\Http\Controllers;

use App\Models\ManageContractTypes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use Session;
use Illuminate\Support\Facades\Route;

class ManageContractTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::id();

        $list = ManageContractTypes::where(['status' => 1])->get();

        return view('hrmodule.managecontracttypes')->with([
            'listData' => $list,
            'pageTitle' => "Contract Types",
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
                'contract_type' => 'required',
            ]);
            if ($validator->fails()) {
                $action = 'managecontracttypes';
                return redirect('managecontracttypes
                ')
                    ->withErrors($validator)
                    ->withInput()
                    ->with([
                        'action' => $action,
                    ]);
            }

            $input = $request->all();

            $input['status'] = 1;
            $input['user_id'] = Auth::id();

            unset($input['_token']);
            if ($input['id'] > 0) {
                $input['updated_at'] = date("Y-m-d H:i:s");
                Session::flash('message', 'Contract Type  Updated Successfully.');
                ManageContractTypes::where('id', $input['id'])->update($input);
            } else {
                unset($input['id']);
                $input['created_at'] = date("Y-m-d H:i:s");
                $input['updated_at'] = date("Y-m-d H:i:s");
                Session::flash('message', 'Contract Type Added Successfully.');
                ManageContractTypes::insertGetId($input);
            }
            return redirect('/managecontracttypes');

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ManageContractTypes $manageContractTypes
     * @return \Illuminate\Http\Response
     */
    public function show(ManageContractTypes$manageContractTypes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ManageContractTypes $manageContractTypes
     * @return \Illuminate\Http\Response
     */
    public function edit(ManageContractTypes$manageContractTypes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ManageContractTypes $manageContractTypes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ManageContractTypes$manageContractTypes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ManageContractTypes $manageContractTypes
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ContractTypes = ManageContractTypes::find($id);
        $ContractTypes->status = 0;
        $ContractTypes->updated_at = date('Y-m-d H:i:s');
        $ContractTypes->save();
        Session::flash('message', 'Contract Type deleted successfully');
        return redirect("/managecontracttypes");
    }
    public static function routes()
    {
        Route::group(array('prefix' => 'managecontracttypes'), function () {
            Route::get('/', array('as' => 'managecontracttypes.index', 'uses' => 'ManageContractTypesController@index'));
            Route::get('/add', array('as' => 'managecontracttypes.create', 'uses' => 'ManageContractTypesController@create'));
            Route::post('/save', array('as' => 'managecontracttypes.save', 'uses' => 'ManageContractTypesController@store'));
            Route::get('/edit/{id}', array('as' => 'managecontracttypes.edit', 'uses' => 'ManageContractTypesController@edit'));
            Route::post('/update/{id}', array('as' => 'managecontracttypes.create', 'uses' => 'ManageContractTypesController@create'));
            Route::get('/delete/{id}', array('as' => 'managecontracttypes.destroy', 'uses' => 'ManageContractTypesController@destroy'));
        });
    }
}
