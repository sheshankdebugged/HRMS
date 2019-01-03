<?php

namespace App\Http\Controllers;

use App\Models\ManageJobTypes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Validator;
use Session;

class ManageJobTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::id();

        $list = ManageJobTypes::where(['status' => 1])->get();

        return view('hrmodule.managejobtypes')->with([
            'listData' => $list,
            'pageTitle' => "Job Types",
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
                'job_title' => 'required',
            ]);
            if ($validator->fails()) {
                $action = 'managejobtypes';
                return redirect('managejobtypes
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
                Session::flash('message', 'Job Types  Updated Successfully.');
                ManageJobTypes::where('id', $input['id'])->update($input);
            } else {
                unset($input['id']);
                $input['created_at'] = date("Y-m-d H:i:s");
                $input['updated_at'] = date("Y-m-d H:i:s");
                Session::flash('message', 'Job Types Added Successfully.');
                ManageJobTypes::insertGetId($input);
            }
            return redirect('/managejobtypes');

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ManageJobTypes  $manageJobTypes
     * @return \Illuminate\Http\Response
     */
    public function show(ManageJobTypes $manageJobTypes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ManageJobTypes  $manageJobTypes
     * @return \Illuminate\Http\Response
     */
    public function edit(ManageJobTypes $manageJobTypes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ManageJobTypes  $manageJobTypes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ManageJobTypes $manageJobTypes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ManageJobTypes  $manageJobTypes
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $skill = ManageJobTypes::find($id);
        $skill->status = 0;
        $skill->updated_at = date('Y-m-d H:i:s');
        $skill->save();
        Session::flash('message', 'Skill deleted successfully');
        return redirect("/managejobtypes");
    }
    public static function routes()
    {
        Route::group(array('prefix' => 'managejobtypes'), function () {
            Route::get('/', array('as' => 'managejobtypes.index', 'uses' => 'ManageJobTypesController@index'));
            Route::get('/add', array('as' => 'managejobtypes.create', 'uses' => 'ManageJobTypesController@create'));
            Route::post('/save', array('as' => 'managejobtypes.save', 'uses' => 'ManageJobTypesController@store'));
            Route::get('/edit/{id}', array('as' => 'managejobtypes.edit', 'uses' => 'ManageJobTypesController@edit'));
            Route::post('/update/{id}', array('as' => 'managejobtypes.create', 'uses' => 'ManageJobTypesController@create'));
            Route::get('/delete/{id}', array('as' => 'managejobtypes.destroy', 'uses' => 'ManageJobTypesController@destroy'));
        });
    }
}
